<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="tokens form large-9 medium-8 columns content">
    <?= $this->Form->create($token) ?>
    <fieldset>
        <legend><i class="fal fa-ticket fa-fw"></i> <?= __('Add Token') ?></legend>
        <?php
            echo $this->Form->input('token');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('email_send_id', ['options' => $emailSends]);
            echo $this->Form->input('expires');
            echo $this->Form->input('utilised');
            echo $this->Form->input('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
