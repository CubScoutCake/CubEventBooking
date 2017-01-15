<div class="row">
    <div class="col-sm-12">
        <br>
        <?= $this->Form->create($section) ?>
        <fieldset>
            <legend><?= __('Existing Sections Found - select one or choose to create a new one.') ?></legend>
            <?php
                echo '<span>There are existing sections which meet your criteria.</span><br>';
                echo $this->Form->input('ids', ['label' => false, 'type' => 'radio', 'empty' => false, 'options' => $existing]);
                echo '<br>';
            ?>
        </fieldset>

        <?= $this->Form->button('Use Existing Section', ['type' => 'submit', 'class' => 'success']) ?>
        <a href="<?php echo $this->Url->build([
            'controller' => 'Sections',
            'action' => 'add',
            'prefix' => 'register',
            $groupId,
            $typeId,
        ]); ?>">
            <?= $this->Form->button('Create a New Section', ['type' => 'button', 'class' => 'info', 'url' => ['controller' => 'Sections', 'action' => 'add']]) ?>
        </a>
        <?= $this->Form->end() ?>
    </div>
</div>
