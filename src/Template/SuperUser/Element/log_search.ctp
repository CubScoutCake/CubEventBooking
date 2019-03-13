<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="databaselog-search-logs">
    <div class="row">
        <div class="col-md-12">
            <?= $this->Form->create(null, ['valueSources' => 'query', 'role' => 'search']) ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <?= $this->Form->control('search', ['placeholder' => 'Auto-wildcard mode', 'label' => 'Search (Message)', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $this->Form->control('type', ['empty' => ' - no filter - ']) ?>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <?=  $this->Form->button('Filter', ['type' => 'submit', 'class' => 'btn btn-success btn-outline']) ?>
                    <?= !empty($_isSearch) ? $this->Html->link('Reset', ['action' => 'index'], ['class' => 'btn btn-danger btn-outline']) : '' ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
