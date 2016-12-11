<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

$cakeDescription = 'Booking System: Coming Soon!';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('hertscubs100.css') ?>

    <link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">

</head>
<body >
    <header class="maintainance_head">
        <div class="maintainance_header-image">
            <h1 class="maintainance_title">Hertfordshire Cubs 100<sup>th</sup> Birthday Party</h1>
        </div>
    </header>

    <div class="maintainance_home">

        <div id="maintainance_subhead">
            <div id="headpic">        
                <?= $this->Html->image('Monkey.png') ?>
            </div>
            <h1>Welcome to the Booking System for the Hertfordshire Cubs 100<sup>th</sup> Birthday Camp</h1>
        </div>
        
        <div>
            <h2>We are just putting final touches to the system to ensure that it runs smoothly first time!</h2>
            

            <div>
                <div id="mc_embed_signup">
                <form action="//hertscubs100.us11.list-manage.com/subscribe/post?u=f55c3bd89a389d6bc53f45732&amp;id=84e36a5268" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <div id="mc_embed_signup_scroll">
                    <h2>Be notified when the system goes live</h2>
                <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                <div class="mc-field-group">
                    <label for="mce-FNAME">First Name  <span class="asterisk">*</span>
                </label>
                    <input type="text" value="" name="FNAME" class="required" id="mce-FNAME">
                </div>
                <div class="mc-field-group">
                    <label for="mce-LNAME">Last Name  <span class="asterisk">*</span>
                </label>
                    <input type="text" value="" name="LNAME" class="required" id="mce-LNAME">
                </div>
                <div class="mc-field-group">
                    <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
                </label>
                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                </div>
                <div class="mc-field-group">
                    <label for="mce-GROUP">Scout Group  <span class="asterisk">*</span>
                </label>
                    <input type="text" value="" name="GROUP" class="required" id="mce-GROUP">
                </div>
                <div class="mc-field-group">
                    <label for="mce-APPT">Scouting Appointment  <span class="asterisk">*</span>
                </label>
                    <select name="APPT" class="required" id="mce-APPT">
                    <option value=""></option>
                    <option value="CSL - Cub Scout Leader">CSL - Cub Scout Leader</option>
                <option value="ACSL - Assistant Cub Scout Leader">ACSL - Assistant Cub Scout Leader</option>
                <option value="Section Assistant">Section Assistant</option>
                <option value="DC - District Commissioner">DC - District Commissioner</option>
                <option value="ADC - Assistant District Commissioner">ADC - Assistant District Commissioner</option>
                <option value="District Champion">District Champion</option>
                <option value="District Cub Scout Leader">District Cub Scout Leader</option>
                <option value="Other">Other</option>

                    </select>
                </div>
                <div class="mc-field-group input-group">
                    <strong>I would like to be contacted... </strong>
                    <ul><li><input type="radio" value="only when booking is available and no other information." name="MMERGE6" id="mce-MMERGE6-0"><label for="mce-MMERGE6-0">only when booking is available and no other information.</label></li>
                <li><input type="radio" value="only with any information regarding the Herts Cubs 100 birthday camp." name="MMERGE6" id="mce-MMERGE6-1"><label for="mce-MMERGE6-1">only with any information regarding the Herts Cubs 100 birthday camp.</label></li>
                <li><input type="radio" value="with any events &amp; information from the county Cub team" name="MMERGE6" id="mce-MMERGE6-2"><label for="mce-MMERGE6-2">with any events &amp; information from the county Cub team</label></li>
                </ul>
                </div>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;"><input type="text" name="b_f55c3bd89a389d6bc53f45732_84e36a5268" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                    </div>
                </form>
                </div>
                <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[0]='EMAIL';ftypes[0]='email';fnames[3]='GROUP';ftypes[3]='text';fnames[4]='APPT';ftypes[4]='dropdown';fnames[5]='USER_ID';ftypes[5]='number';fnames[6]='MMERGE6';ftypes[6]='radio';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                <!--End mc_embed_signup-->
            </div>
        </div>
    </div>

    <footer>
    </footer>
</body>
</html>
