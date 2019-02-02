<?php
namespace App\Controller;

use App\Form\PasswordForm;
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
     * @param string $token The Token for deciphering.
     *
     * @return \Cake\Http\Response|null
     */
    public function validate($token = null)
    {
        if (is_null($token)) {
            return $this->redirect($this->referer('/'));
        }

        $validated = $this->Tokens->validateToken($token);

        if (!is_numeric($validated) || (!$validated && is_bool($validated))) {
            return $this->redirect($this->referer('/'));
        }

        $tokenRow = $this->Tokens->get($validated);

        $resettor = $this->Tokens->Users->get($tokenRow->user_id);

        if (is_numeric($validated)) {
            $passwordForm = new PasswordForm();
            $this->set(compact('passwordForm'));

            if ($this->request->is('post')) {
                $fmPassword = $this->request->getData('newpw');
                $fmConfirm = $this->request->getData('confirm');

                if ($fmConfirm == $fmPassword) {
                    $fmPostcode = $this->request->getData('postcode');
                    $fmPostcode = str_replace(" ", "", strtoupper($fmPostcode));

                    $usPostcode = $resettor->postcode;
                    $usPostcode = str_replace(" ", "", strtoupper($usPostcode));

                    if ($usPostcode == $fmPostcode) {
                        $newPw = [
                            'password' => $fmPassword,
                            'reset' => 'No Longer Active'
                        ];

                        $resettor = $this->Tokens->Users->patchEntity($resettor, $newPw);

                        if ($this->Tokens->Users->save($resettor)) {
                            return $this->redirect(['prefix' => false, 'controller' => 'Users', 'action' => 'login']);
                        }
                        $this->Flash->error(__('The user could not be saved. Please, try again.'));
                    }
                }
            }
        }

        return $this->redirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'welcome']);
    }

    /**
     * Before Filter - Authorisation Permissions
     *
     * @param \Cake\Event\Event $event The CakeEvent to be Processed
     *
     * @return \Cake\Event\Event
     */
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['validate']);

        return $event;
    }
}
