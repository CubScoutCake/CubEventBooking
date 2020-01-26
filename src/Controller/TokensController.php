<?php
declare(strict_types=1);

namespace App\Controller;

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
        // Kick if no Token
        if (is_null($token)) {
            return $this->redirect($this->referer('/'));
        }

        // Validate Token
        $validated = $this->Tokens->validateToken($token);

        if (!is_numeric($validated) || (!$validated && is_bool($validated))) {
            $this->Flash->error('This Token is Invalid');

            return $this->redirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'welcome']);
        }

        if (is_numeric($validated)) {
            $tokenRow = $this->Tokens->get($validated, ['contain' => 'EmailSends']);
            $header = $tokenRow->get('token_header');

            if (key_exists('authenticate', $header) && $header['authenticate']) {
                $transactor = $this->Tokens->EmailSends->Users->get($tokenRow->email_send->user_id);
                $this->Auth->setUser($transactor->toArray());
            }

            if (key_exists('redirect', $header)) {
                $location = $header['redirect'];
                $tokenReData = [
                    '?' => [
                        'token_id' => $validated,
                        'token' => urldecode($token),
                    ],
                ];
                $redirect = array_merge($location, $tokenReData);

                return $this->redirect($redirect);
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
