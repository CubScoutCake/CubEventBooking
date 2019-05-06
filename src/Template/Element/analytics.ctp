<?php

use Cake\Core\Configure;

?>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];
        a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    <?php
    // New Google Analytics code to set User ID.
    $GACode = Configure::read('GA.ua');
    $GAUser = Configure::read('GA.userCode');
    // $userId is a unique, persistent, and non-personally identifiable string ID.
    if (!is_null($this->request->getSession()->read('Auth.User.id'))) {
        $gaucode = "ga('create', '" . $GACode . "', 'auto', {'userId': '" . $GAUser . $this->request->getSession()->read('Auth.User.id') . "'});";
        echo sprintf($gaucode);
    } else {
        $gacode = "ga('create', '" . $GACode . "', 'auto');";
        echo sprintf($gacode);
    }?>

    ga('require', 'linkid');

    ga('send', 'pageview');
</script>