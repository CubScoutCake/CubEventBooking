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

        $resettor = $this->Users->get($tokenRow->user_id);

        if (is_numeric($validated)) {
            $PasswordForm = new PasswordForm();
            $this->set(compact('PasswordForm'));

            if ($this->request->is('post')) {
                $fmPassword = $this->request->getData('newpw');
                $fmConfirm = $this->request->getData('confirm');

                if ($fmConfirm == $fmPassword) {
                    $fmPostcode = $this->request->getData('postcode');
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
