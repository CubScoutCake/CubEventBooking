<div class="applications index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= __('Application') ?></th>
            <th><?= __('User') ?></th>
            <th><?= __('Scoutgroup') ?></th>
            <th><?= __('Section') ?></th>
            <th><?= __('permitholder') ?></th>
            <th><?= __('modified') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($applications as $application): ?>
        <tr>
            <td><?= h($application->display_code) ?></td>
            <td><?= $application->has('user') ? $this->Html->link($application->user->full_name, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></td>
            <td><?= $application->has('scoutgroup') ? $this->Html->link($this->Text->truncate($application->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroups', 'action' => 'view', $application->scoutgroup->id]) : '' ?></td>
            <td><?= h($application->section) ?></td>
            <td><?= $this->Text->truncate($application->permitholder,18) ?></td>
            <td><?= $this->Time->i18nFormat($application->modified, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $application->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $application->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $application->id], ['confirm' => __('Are you sure you want to delete # {0}?', $application->id)]) ?>
            </td>
        </tr>

        <?php foreach ($applications->invoices as $invoice): ?>
            <tr>
                <td><?= h($invoice->balance) ?></td>
            </tr>

        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
    </table>
</div>
