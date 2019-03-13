<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Register User') ?></legend>
        <?php
            echo $this->Form->control('role_id', ['options' => $roles, 'class' => 'hierarchy-select']);
            echo $this->Form->control('section_id', ['options' => $sections, 'disabled' => 'disabled', 'class' => 'hierarchy-select']);
            echo $this->Form->control('firstname');
            echo $this->Form->control('lastname');
            echo $this->Form->control('email');
            echo $this->Form->control('membership_number');
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('phone');
            echo $this->Form->control('address_1');
            echo $this->Form->control('address_2');
            echo $this->Form->control('city');
            echo $this->Form->control('county');
            echo $this->Form->control('postcode');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
