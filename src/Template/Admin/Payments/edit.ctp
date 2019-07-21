<?php
/**
 * @var \App\Model\Entity\Payment $payment
 * @var array $invoices
 * @var \App\View\AppView $this
 */
?>
<div class="payments form large-10 medium-10 columns content">
	<?= $this->Form->create($payment) ?>
    <fieldset>
        <legend><?= __('Add Payment') ?></legend>
		<?php
		echo $this->Form->control('paid', ['label' => 'Date of Payment (date on cheque)']);
		echo $this->Form->control('cheque_number');
		echo $this->Form->control('name_on_cheque');
		echo $this->Form->control('payment_notes');
		?>
        <?php foreach ($payment->invoices as $idx => $invoice) : ?>
			<table class="table table-hover">
                <tr>
                    <td><?= 'Invoice ' . ($idx + 1) ?></td>
                    <td><?= $this->Form->control('invoices.' . $idx . '.id', ['options' => $invoices, 'type' => 'select', 'empty' => true, 'label' => 'Invoice Associated']) ?></td>
                    <td><?= $this->Form->control('invoices.' . $idx . '._joinData.x_value', ['label' => 'Value to Invoice']) ?></td>
                </tr>
            </table>
		<?php endforeach; ?>
    </fieldset>
	<?= $this->Form->button(__('Submit')) ?>
	<?= $this->Form->end() ?>
</div>
