<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 * 
 * @var array $eventTypes
 * @var array $sectionTypes
 * @var array $users
 * @var array $discounts
 */
?>
<div class="events form large-10 medium-10 columns content">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Edit Event') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('full_name');
            echo $this->Form->control('event_type_id', ['options' => $eventTypes]);
            echo $this->Form->control('section_type_id', ['options' => $sectionTypes]);
            echo '<div class="row"> <div class="col-lg-6">';
            echo $this->Form->control('start_date');
            echo $this->Form->control('opening_date');
            echo '</div> <div class="col-lg-6>"';
            echo $this->Form->control('end_date');
            echo $this->Form->control('closing_date');
            echo '</div> </div>';

            echo '<div class="table-responsive"> <table class="table table-hover"> <tr> <td>';
            echo $this->Form->control('max', ['label' => 'Limit Numbers (will enforce limits to the left)']);
            echo '</td> <td>';
            echo $this->Form->control('max_apps', ['label' => 'Maximum Applications Available']);
            echo '<p>Leave Blank for Infinite</p>';
            echo '</td> <td>';
            echo $this->Form->control('max_section', ['label' => 'Maximum Young Person Spaces Available']);
            echo '<p>Leave Blank for Infinite, does not include young leaders</p>';
            echo '</td></tr></table></div>';

            echo '<div class="row"> <div class="col-lg-12">';
            echo '<div class="table-responsive"> <table class="table table-hover"> <tr> <td>';
            echo $this->Form->control('force_full', ['label' => 'Override Event to Full']);
            echo '</td> <td>';
            echo $this->Form->control('allow_reductions', ['label' => 'Allow invoices to be reduced']);
            echo '</td> <td>';
            echo $this->Form->control('invoices_locked', ['label' => 'Lock Invoices (will prevent updates by users)']);
            echo '</td></tr></table></div>';
            echo '</div> </div>';

            echo $this->Form->control('location');
            echo $this->Form->label('Descriptive Text for the Event');
            echo $this->Form->textarea('intro_text');
            echo $this->Form->control('logo');

            echo $this->Form->control('admin_user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
