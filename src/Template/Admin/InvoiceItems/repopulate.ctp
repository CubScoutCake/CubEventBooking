<div class="invoiceItems form large-10 medium-9 columns content">
    <?= $this->Form->create($invPop); ?>
    <fieldset>
        <legend><?= __('Number of Attendees') ?></legend>
        <p><strong>WARNING</strong> - There is <strong>no lock</strong> on the admin regenerate, it will allow you to reduce invoice numbers even if the event is set to prevent it!</p>

        <p>The number of cancellations should be manually subtracted from the actual totals. This is so the system doesn't guess and get it wrong.</p>

        <?php
            echo $this->Form->input('cubs');
            echo $this->Form->input('yls');
            echo $this->Form->input('leaders');

            echo $this->Form->input('cancelled_cubs');
            echo $this->Form->input('cancelled_yls');
            echo $this->Form->input('cancelled_leaders');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

</div>
