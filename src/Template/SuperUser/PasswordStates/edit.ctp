<div class="passwordStates form large-9 medium-8 columns content">
    <?= $this->Form->create($passwordState) ?>
    <fieldset>
        <legend><i class="fa fa-unlock fa-fw"></i> <?= __('Edit Password State') ?></legend>
        <?php
            echo $this->Form->input('password_state');
            echo $this->Form->input('active');
            echo $this->Form->input('expired');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
