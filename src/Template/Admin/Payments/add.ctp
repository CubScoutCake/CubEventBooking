<div class="payments form large-10 medium-10 columns content">
    <?= $this->Form->create($payment) ?>
    <fieldset>
        <legend><?= __('Add Payment') ?></legend>
        <?php
            echo $this->Form->input('paid', ['label' => 'Date of Payment (date on cheque)']);
            echo $this->Form->input('cheque_number');
            echo $this->Form->input('name_on_cheque');
            echo $this->Form->input('payment_notes');

            for ($inv = 0; $inv < $invs; $inv ++) {
                echo '<table class="table table-hover"> <tr> <td>';
                echo '<p>Invoice ' . ($inv + 1) . '</p>';
                echo '</td> <td>';
                echo $this->Form->input('invoices.' . $inv . '.id', ['options' => $invoices, 'type' => 'select', 'empty' => true, 'label' => 'Invoice Associated']);
                echo '</td> <td>';
                echo $this->Form->input('invoices.' . $inv . '._joinData.x_value', ['label' => 'Value to Invoice']);
                echo '</td></tr></table>';
            }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
