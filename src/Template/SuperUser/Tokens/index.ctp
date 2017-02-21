<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-ticket fa-fw"></i> Tokens</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('email_send_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('expires') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('utilised') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($tokens as $token): ?>
                    <tr>
                        <td><?= $this->Number->format($token->id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('', ['action' => 'view', $token->id], ['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['action' => 'edit', $token->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['action' => 'delete', $token->id], ['confirm' => __('Are you sure you want to delete # {0}?', $token->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash-o']) ?>
                        </td>
                        <td><?= $token->has('user') ? $this->Html->link($token->user->full_name, ['controller' => 'Users', 'action' => 'view', $token->user->id]) : '' ?></td>
                        <td><?= $token->has('email_send') ? $this->Html->link($token->email_send->id, ['controller' => 'EmailSends', 'action' => 'view', $token->email_send->id]) : '' ?></td>
                        <td><?= $this->Time->i18nformat($token->created,'dd-MMM-yy HH:mm') ?></td>
                        <td><?= $this->Time->i18nformat($token->modified,'dd-MMM-yy HH:mm') ?></td>
                        <td><?= $this->Time->i18nformat($token->expires,'dd-MMM-yy HH:mm') ?></td>
                        <td><?= $token->utilised ? '<i class="fa fa-check fa-fw"></i>' : '' ?></td>
                        <td><?= $token->active ? '<i class="fa fa-check fa-fw"></i>' : '' ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>
