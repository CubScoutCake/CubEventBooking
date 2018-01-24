<?php

/*
 * Copyright (c) 2015 Syntax Era Development Studio
 *
 * Licensed under the MIT License (the "License"); you may not use this
 * file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 *      https://opensource.org/licenses/MIT
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace App\Mailer\Transport;

use Cake\Core\Configure;
use Cake\Http\Client;
use Cake\I18n\Time;
use Cake\Mailer\AbstractTransport;
use Cake\Mailer\Email;
use Cake\Network\Exception\BadRequestException;
use Cake\ORM\TableRegistry;
use SparkPost\SparkPost;
use SparkPost\SparkPostException;

/**
 * Spark Post Transport Class
 *
 * Provides an interface between the CakePHP Email functionality and the SparkPost API.
 *
 * @package SparkPost\Mailer\Transport
 */
class SparkPostTransport extends AbstractTransport
{
    /**
     * Send mail via SparkPost REST API
     *
     * @param \Cake\Mailer\Email $email Email message
     * @return void
     * @throws BadRequestException If the SparkPost API returns an error
     */
    public function send(Email $email)
    {
        // Load SparkPost configuration settings
        $apiKey = Configure::read('SparkPost.Api.key');

        // Set up HTTP request adapter
        $client = new Client([
            'host' => 'api.sparkpost.com',
            'scheme' => 'https'
        ]);
        $url = '/api/v1/transmissions';

        // Pre-process CakePHP email object fields
        $from = (array)$email->getFrom();
        $sender = sprintf('%s <%s>', array_values($from)[0], array_keys($from)[0]);
        $to = (array)$email->getTo();
        $recipients = [[ 'address' => [ 'name' => array_values($to)[0], 'email' => array_keys($to)[0] ]]];

        // Build message to send
        $message = [
            'from' => $sender,
            'html' => empty($email->message('html')) ? $email->message('text') : $email->message('html'),
            'text' => $email->message('text'),
            'subject' => $email->getSubject()
        ];

        $body = [
            'content' => $message,
            'recipients' => $recipients
        ];

        // Send message
        $response = $client->post($url, json_encode($body), [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => $apiKey,
            ]
        ]);

        /*$responseBody = json_decode($response->body());
        debug($responseBody);
        $results = $responseBody['results'];
        $transmissionID = $results['id'];

        $code = $response->getStatusCode();

        $eSends = TableRegistry::get('EmailSends');

        $emailLogData = [
            'sent' => Time::now(),
            'message_id' => $transmissionID,
            'subject' => $email->getSubject(),
            'from_address' => $sender,
        ];

        $send = $eSends->newEntity($emailLogData);
        $eSends->save($send);*/
    }
}
