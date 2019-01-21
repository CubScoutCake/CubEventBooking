</br>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fal fa-edit fa-fw"></i> Edit Note
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <?= $this->Form->create($note) ?>
            <fieldset>
                <?php
                    echo $this->Form->input('note_text', ['type' => 'textarea']);
                    echo $this->Form->input('visible');
                    echo $this->Form->input('application_id', ['options' => $applications, 'empty' => true]);
                    echo $this->Form->input('invoice_id', ['options' => $invoices, 'empty' => true]);
                    echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
