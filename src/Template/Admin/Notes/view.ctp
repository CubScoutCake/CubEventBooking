<div class="row">
    <div class="col-lg-10 col-md-10">
        <h1 class="page-header"><i class="fa fa-pencil-square-o fa-fw"></i> Note #<?= h($note->id); ?></h1>
    </div>
    <div class="pull-right">
        <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                Actions
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a href="<?php echo $this->Url->build([
                    'controller' => 'Notes',
                    'action' => 'edit',
                    'prefix' => 'admin',
                    $note->id],['_full']); ?>">Edit Note</a>
                </li>
                <li><?= $this->Form->postLink(__('Delete Note'), ['action' => 'delete', $note->id], ['confirm' => __('Are you sure you want to delete note # {0}?', $note->id)]) ?> </li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <i class="fa fa-font 2x fa-fw"></i> Note Text
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <p><?= $this->Text->autoParagraph($note->note_text) ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <i class="fa fa-key 2x fa-fw"></i> Link
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <?php if (!is_null($note->application_id)) : ?>
                            <tr>
                                <th><?= __('Application') ?></th>
                                <td><?= $note->has('application') ? $this->Html->link($note->application->display_code, ['controller' => 'Applications', 'action' => 'view', $note->application->id]) : '' ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (!is_null($note->invoice_id)) : ?>
                            <tr>
                                <th><?= __('Invoice') ?></th>
                                <td><?= $note->has('invoice') ? $this->Html->link($note->invoice->display_code, ['controller' => 'Invoices', 'action' => 'view', $note->invoice->id]) : '' ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (!is_null($note->user_id)) : ?>
                            <tr>
                                <th><?= __('User') ?></th>
                                <td><?= $note->has('user') ? $this->Html->link($note->user->full_name, ['controller' => 'Users', 'action' => 'view', $note->user->id]) : '' ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th><?= __('Visible') ?></th>
                            <td><?= $note->visible ? __('Yes') : __('No'); ?></td>
                         </tr>
                         <tr>
                            <th><?= __('Date Created') ?></th>
                            <td><?= $this->Time->i18nformat($note->created,'dd-MMM-yy HH:mm') ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Last Modified') ?></th>
                            <td><?= $this->Time->i18nformat($note->modified,'dd-MMM-yy HH:mm') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
