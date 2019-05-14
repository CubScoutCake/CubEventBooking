<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-edit fa-fw"></i> All Notes</h3>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('note_text') ?></th>
                        <th><?= $this->Paginator->sort('application_id') ?></th>
                        <th><?= $this->Paginator->sort('invoice_id') ?></th>
                        <th><?= $this->Paginator->sort('user_id') ?></th>
                        <th><?= $this->Paginator->sort('visible') ?></th>
                        <th><?= $this->Paginator->sort('modified') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notes as $note): ?>
                        <tr>
                            <td><?= $this->Number->format($note->id) ?></td>
                            <td class="actions">
                                <div class="dropdown btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fal fa-cog"></i>  <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " role="menu">
                                        <li><?= $this->Html->link(__('View'), ['action' => 'view', $note->id]) ?></li>
                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $note->id]) ?></li>
                                        <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $note->id], ['confirm' => __('Are you sure you want to delete # {0}?', $note->id)]) ?></li>
                                    </ul>
                                </div>
                            </td>
                            <td><?= $this->Text->autoParagraph($note->note_text) ?></td>
                            <td><?= $note->has('application') ? $this->Html->link($note->application->display_code, ['controller' => 'Applications', 'action' => 'view', $note->application->id]) : '' ?></td>
                            <td><?= $note->has('invoice') ? $this->Html->link($note->invoice->id, ['controller' => 'Invoices', 'action' => 'view', $note->invoice->id]) : '' ?></td>
                            <td><?= $note->has('user') ? $this->Html->link($note->user->full_name, ['controller' => 'Users', 'action' => 'view', $note->user->id]) : '' ?></td>
                            <td><?= $note->visible ? __('Yes') : __('No'); ?></td>
                            <td><?= $this->Time->i18nFormat($note->modified,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
        </div>
    </div>
</div>
