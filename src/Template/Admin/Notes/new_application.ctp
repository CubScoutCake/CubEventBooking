</br>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-pencil-square-o fa-fw"></i> Create Note
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <?= $this->Form->create($note) ?>
            <fieldset>
                <legend><?= __('Add Invoice Note') ?></legend>
                <?php
                    echo $this->Form->input('note_text');
                    echo $this->Form->input('visible');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
