<div class="invoiceItems form large-10 medium-9 columns content">
    <?= $this->Form->create($invPop); ?>
    <fieldset>
        <legend><?= __('Number of Attendees Being Registered') ?></legend>
        <p>Please enter the total amount of Attendees.</p>
        <?php
            if ($CubsVis == 1) { 
                echo $this->Form->input('cubs'); 
            }
            if ($YlsVis == 1) {
                echo $this->Form->input('yls'); 
            }
            if ($LeadersVis == 1) {
                echo $this->Form->input('leaders');
            }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

</div>