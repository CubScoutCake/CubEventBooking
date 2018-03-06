<?php
/**
 *
 * @var $numberOfInvoiceAssocs int
 * @var $invId int
 * @var $invDefault int|string
 *
 */
?>
<div class="row">
    <div class="col-md-12">
        <?php if (is_null($numberOfInvoiceAssocs) || $numberOfInvoiceAssocs < 1 || !isset($numberOfInvoiceAssocs) ): ?>
            <h2 class="page-header"><?= __('How many invoices are associated with this payment?') ?></h2>
	        <?= $this->Html->link(__('1 Invoice'), ['controller' => 'Payments', 'action' => 'add', 'prefix' => 'admin', 1, $invId], ['class' => 'btn button btn-warning']) ?>
	        <?= $this->Html->link(__('2 Invoices'), ['controller' => 'Payments', 'action' => 'add', 'prefix' => 'admin', 2, $invId], ['class' => 'btn button btn-warning']) ?>
	        <?= $this->Html->link(__('3 Invoices'), ['controller' => 'Payments', 'action' => 'add', 'prefix' => 'admin', 3, $invId], ['class' => 'btn button btn-warning']) ?>
	        <?= $this->Html->link(__('4 Invoices'), ['controller' => 'Payments', 'action' => 'add', 'prefix' => 'admin', 4, $invId], ['class' => 'btn button btn-warning']) ?>
	        <?= $this->Html->link(__('5 Invoices'), ['controller' => 'Payments', 'action' => 'add', 'prefix' => 'admin', 5, $invId], ['class' => 'btn button btn-warning']) ?>
            <br/>
            <hr/>
            <?= $this->Form->create($paymentAssociationForm) ?>
                <fieldset>
                    <?php echo $this->Form->input('payment_assoc_count', ['label' => 'Specify Number of Invoices on Cheque.']); ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-warning']) ?>
            <?= $this->Form->end() ?>
        <?php else : ?>
            <?= $this->Form->create($payment) ?>
                <fieldset>
                    <legend><?= __('Add Payment') ?></legend>
                    <?php
                    echo $this->Form->input('paid', ['label' => 'Date of Payment (date on cheque)']);
                    echo $this->Form->input('cheque_number');
                    echo $this->Form->input('name_on_cheque');
                    echo $this->Form->input('payment_notes');

                    for ($inv = 0; $inv < $numberOfInvoiceAssocs; $inv ++) {
                        echo '<table class="table table-hover"> <tr> <td>';
                        echo '<p>Invoice ' . ($inv + 1) . '</p>';
                        echo '</td> <td>';
                        echo $this->Form->input('invoices.' . $inv . '.id', ['options' => $invoices, 'type' => 'select', 'default' => $invDefault, 'empty' => true, 'label' => 'Invoice Associated']);
                        echo '</td> <td>';
                        echo $this->Form->input('invoices.' . $inv . '._joinData.x_value', ['label' => 'Value to Invoice']);
                        echo '</td></tr></table>';
                    }
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        <?php endif; ?>
    </div>
</div>
