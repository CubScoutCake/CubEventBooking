<?php
/**
 * @var \App\View\AppView $this
 * @var \DatabaseLog\Model\Entity\DatabaseLog[] $logs
 * @var string|null $currentType
 * @var array $types
 */

use DatabaseLog\Model\Table\DatabaseLogsTable;

?>

<div class="row">
    <div class="col-lg-12">
        <h1><i class="fal fa-tree fa-fw"></i> <?php echo $currentType ? ucwords($currentType) : 'All'; ?> Logs</h1>
        <br/>
        <?php
        if (DatabaseLogsTable::isSearchEnabled()) {
            echo $this->element('log_search');
        }
        ?>
        <div class="panel panel-primary">
            <div class="panel-body">
                <ul class="list-inline">
                    <a href="<?php echo $this->Url->build([
                        'controller' => 'Logs',
                        'action' => 'index',
                        'prefix' => 'super_user'
                    ]); ?>"><li class="btn btn-default">ALL</li></a>
                    <?php foreach ($types as $type) : ?>
                        <?php $typeStyle = $type;

                        if ($type == 'error') {
                            $typeStyle = 'danger';
                        }
                        if ($type == 'notice') {
                            $typeStyle = 'warning';
                        } ?>

                        <a href="<?php echo $this->Url->build([
                                'controller' => 'Logs',
                                'action' => 'index',
                                'prefix' => 'super_user',
                                '?' => ['type' => $type]
                            ]); ?>"><li class="btn btn-<?= $typeStyle ?> <?= $currentType == $type ? 'active' : '' ?>"><?= strtoupper($type) ?> <span class="badge"><?= $currentType == $type ? 'CURRENT' : '' ?></span></li></a>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php //echo $this->element('DatabaseLog.admin_filter'); ?>
        <div class="table-responsive">
	        <table class="table list">
                <tr>
                    <th><?php echo $this->Paginator->sort('created');?></th>
                    <th><?php echo $this->Paginator->sort('type');?></th>
                    <th><?php echo $this->Paginator->sort('count');?></th>
                    <th><?php echo $this->Paginator->sort('message');?></th>
                    <th class="actions"><?php echo __('Actions');?></th>
                </tr>
                <?php
                foreach ($logs as $log):
                    $message = $log['message'];
                    $pos = strpos($message, 'Stack Trace:');
                    if ($pos) {
                        $message = trim(substr($message, 0, $pos));
                    }
                    $pos = strpos($message, 'Trace:');
                    if ($pos) {
                        $message = trim(substr($message, 0, $pos));
                    }
                    ?>
                    <tr>
                        <td><?php echo $this->Time->nice($log['created']); ?>&nbsp;</td>
                        <td><?php echo $this->Log->typeLabel($log['type']); ?>&nbsp;</td>
                        <td><?php echo h($log['count']); ?>x</td>
                        <td><?php echo nl2br($this->Text->truncate($message,100)); ?>&nbsp;</td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $log->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['action' => 'delete', $log->id], ['confirm' => __('Are you sure you want to delete # {0}?', $log->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
	        </table>
        </div>
	    <?php echo $this->element('DatabaseLog.paging'); ?>
    </div>
</div>
