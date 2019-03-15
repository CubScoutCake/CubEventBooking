<?php
namespace App\Controller;

use App\Form\DiscountForm;
use App\Model\Entity\User;
use Cake\ORM\TableRegistry;

/**
 * Invoices Controller
 *
 * @property \App\Model\Table\InvoicesTable $Invoices
 *
 * @property \App\Controller\Component\LineComponent $Line
 */
class InvoicesController extends AppController
{

    /**
     * Initialisation - Load Component
     *
     * @return void
     *
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ];
        $this->set('invoices', $this->paginate($this->Invoices));
        $this->set('_serialize', ['invoices']);
    }

    /**
     * View method
     *
     * @param string|null $invoiceId Invoice id.
     *
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($invoiceId = null)
    {
        $this->viewBuilder()->setOptions([
               'pdfConfig' => [
                   'orientation' => 'portrait',
                   'filename' => 'Invoice #' . $invoiceId
               ]
           ]);

        $invoice = $this->Invoices->get($invoiceId, [
            'contain' => [
                'Users',
                'Payments',
                'InvoiceItems' => [
                    'conditions' => [
                        'visible' => true
                    ]
                ],
                'Applications' => [
                    'Events' => [
                        'EventTypes' => [
                            'LegalTexts', 'InvoiceTexts', 'Payable'
                        ],
                        'AdminUsers',
                    ],
                    'Sections.Scoutgroups.Districts',
                ],
                'Notes' => [
                    'conditions' => [
                        'visible' => true
                    ]
                ]
            ]
        ]);

        $this->set(compact('invoice'));
        $this->set('_serialize', ['invoice']);
    }

    /**
     * @param int $invoiceId The ID of the Invoice to be Viewed
     *
     * @return \Cake\Http\Response
     */
    public function pdfView($invoiceId = null)
    {
        // Insantiate Objects
        $this->viewBuilder()->setOptions([
            'pdfConfig' => [
                'orientation' => 'portrait',
                'filename' => 'Invoice #' . $invoiceId
            ]
        ]);

        // Insantiate Objects
        $invoice = $this->Invoices->get($invoiceId, [
            'contain' => [
                'Users',
                'Payments',
                'InvoiceItems' => [
                    'conditions' => [
                        'visible' => 1
                    ]
                ],
                'Applications' => [
                    'Events' => [
                        'EventTypes' => [
                            'LegalTexts', 'InvoiceTexts'
                        ],
                        'AdminUsers',
                    ],
                    'Sections.Scoutgroups.Districts',
                ],
                'Notes' => [
                    'conditions' => [
                        'visible' => true
                    ]
                ]
            ]
        ]);

        // Set Deadline Variable
        $invDeadline = $invoice->application->event->deposit_date;

        // Set Prefix Variable
        //$invSetPre = $event->invtext_id;
        //$invSetting = $settings->get($invSetPre);
        $invPrefix = 'INV #';

        // Set Payable Variable
        $invPayable = $invoice->application->event->event_type->invoice_text->text;
        //$invoice->application->event->event_type->legal_text->text;

        $this->set(compact('invoice', 'invPayable', 'invPrefix', 'invDeadline'));
        $this->set('_serialize', ['invoice']);

        $cakePDF = new \CakePdf\Pdf\CakePdf();
        $cakePDF->template('invoice', 'default');
        $cakePDF->viewVars($this->viewVars);
        // Or write it to file directly
        $cakePDF->write(FILES . DS . 'Event ' . $invoice->application->event->id . DS . 'Invoices' . DS . 'Invoice #' . $invoice->id . '.pdf');

        return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invoice->id, '_ext' => 'pdf']);
    }

    /**
     * @param int $invoiceID The Invoice to be Regenerated.
     *
     * @return \Cake\Http\Response|null
     *
     * @throws \Exception
     */
    public function regenerate($invoiceID = null)
    {
        $invoice = $this->Invoices->get($invoiceID, [
            'contain' => ['Applications.Events.AdminUsers']
        ]);

        if ($invoice->application->event->invoices_locked) {
            $errorMsg = 'This event has been LOCKED to prevent updates to invoices. Please contact ' . $invoice->application->event->admin_user->full_name . '.';
            $this->Flash->error(__($errorMsg));
            $this->log($errorMsg, 'info');
        } else {
            $this->loadComponent('Line');
            $parse = $this->Line->parseInvoice($invoiceID);

            if ($parse) {
                $this->Flash->success('Your Invoice has been updated from your Application.');

                return $this->redirect($this->referer(['controller' => 'Invoices', 'action' => 'view', 'prefix' => false, $invoiceID]));
            }

            $errorMsg = 'Issue Regenerating Invoice.';
            $this->Flash->error(__($errorMsg));
            $this->log($errorMsg, 'info');
        }

        return $this->redirect($this->referer(['controller' => 'Invoices', 'action' => 'view', 'prefix' => false, $invoiceID]));
    }

    /**

    public function discount($invId = null)
    {
        $disForm = new DiscountForm();
        $this->set(compact('disForm'));

        $ints = TableRegistry::get('InvoiceItems');
        $dics = TableRegistry::get('Discounts');

        if ($this->request->is('post')) {
            $disCode = $this->request->getData()['discount'];

            if (isset($disCode) && strlen($disCode) >= 5 && strlen($disCode) <= 45) {
            // Check the code and match to a discount
                $discount = $dics->find('all')->where(['code' => $disCode])->first();

                if (isset($discount) && isset($invId)) {
                    $disValue = $discount->discount_value;
                    $disDescription = $discount->text;
                    $disQty = $discount->discount_number;

                    $disData = ['invoice_id' => $invId, 'Value' => $disValue, 'Description' => $disDescription, 'Quantity' => $disQty, 'itemtype_id' => 6, 'visible' => 1];
                    $disItem = $this->$ints->newEntity();
                    $disItem = $this->$ints->patchEntity($disItem, $disData);

                    $disUse = $discount->uses + 1;
                    $uses = ['uses' => $disUse];
                    $discount = $this->$dics->patchEntity($discount, $uses);

                    if ($this->$dics->save($discount) && $this->$ints->save($disItem)) {
                        $this->Flash->success(__('The Discount has been added to the Invoice.'));

                        return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
                    } else {
                        $this->Flash->error(__('There was an error.'));
                    }
                } else {
                    $this->Flash->error(__('The Discount Code was not recognised, please try again.'));

                    return $this->redirect(['Controller' => 'Invoices', 'action' => 'discount', $invId]);
                }
            } else {
                $this->Flash->error(__('Please enter a valid discount code.'));

                return $this->redirect(['Controller' => 'Invoices', 'action' => 'discount', $invId]);
            }
        }
    }

    public function sendFile($id)
    {
        $file = $this->Invoices->getFile($id);
        $this->response->file($file['path']);
        // Return response object to prevent controller from trying to render
        // a view.
        return $this->response;
    } */

    /**
     * Determine Authorisation
     *
     * @param User $user the Logged In User
     *
     * @return bool - Can the User access the Invoice
     */
    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->request->action, ['generate', 'index'])) {
            return true;
        }

        if (in_array($this->request->action, ['delete', 'edit'])) {
            return false;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->request->action, ['regenerate', 'view', 'discount'])) {
            $invoiceId = (int)$this->request->params['pass'][0];
            if ($this->Invoices->isOwnedBy($invoiceId, $user['id'])) {
                return true;
            } else {
                return false;
            }
        }

        return parent::isAuthorized($user);
    }
}
