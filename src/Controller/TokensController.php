<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;

/**
 * Tokens Controller
 *
 * @property \App\Model\Table\TokensTable $Tokens
 */
class TokensController extends AppController
{
    /**
     * Validation of a Token
     *
     * @param null $token
     *
     * @return \Cake\Network\Response|null
     */
    public function validate($token = null)
    {
        // Token uses $userid = null, $decryptor = null

        if (is_null($token)) {
            return $this->redirect($this->referer('/'));
        }

        $token = base64_decode($token);
        $token = json_decode($token);

        $tokenId = $token['id'];
        $tokenDecrypter = $token['decrypter'];
        $randomNumber = $token['random_number'];

        $resettor = $this->Users->get($userid);

        $cipher = $resettor->reset;

        $now = Time::now();

        $string = 'Reset Success' . ( $resettor->id * $now->day ) . $decryptor . $now->year . $now->month;

        $test = Security::hash($string);

        if ($cipher == $test) {
            $PasswordForm = new PasswordForm();
            $this->set(compact('PasswordForm'));

            if ($this->request->is('post')) {
                $fmPassword = $this->request->data['newpw'];
                $fmConfirm = $this->request->data['confirm'];

                if ($fmConfirm == $fmPassword) {
                    $fmPostcode = $this->request->data['postcode'];
                    $fmPostcode = str_replace(" ", "", strtoupper($fmPostcode));

                    $usPostcode = $resettor->postcode;
                    $usPostcode = str_replace(" ", "", strtoupper($usPostcode));

                    if ($usPostcode == $fmPostcode) {
                        $newPw = ['password' => $fmPassword
                            , 'reset' => 'No Longer Active'];

                        $resettor = $this->Users->patchEntity($resettor, $newPw);

                        if ($this->Users->save($resettor)) {
                            return $this->redirect(['prefix' => false, 'controller' => 'Users', 'action' => 'login']);
                        } else {
                            $this->Flash->error(__('The user could not be saved. Please, try again.'));
                        }
                    } else {
                        $this->Flash->error(__('The user could not be saved. Please, try again.'));
                    }
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }
        } else {
            $this->Flash->success(__('The user has been saved.'));

            return $this->redirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'welcome']);
        }
    }

    /**
     * Before Filter - Authorisation Permissions
     *
     * @param \Cake\Event\Event $event
     *
     * @return null
     */
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['validate']);
    }
}
