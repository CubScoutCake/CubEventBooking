<div class="events form large-10 medium-10 columns content">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><i class="fa fa-gbp fa-fw"></i><?= __(' Edit Event Prices') ?></legend>
        <p><strong>WARNING</strong> - Changes in monetary value will not propagate to invoices created before the edit.</p>
        <?php
            echo $this->Form->input('name', ['disabled' => 'disabled']);
            echo '<div class="row"><div class="col-lg-6">';
            echo $this->Form->input('start_date', ['disabled' => 'disabled']);
            echo '</div><div class="col-lg-6">';
            echo $this->Form->input('end_date', ['disabled' => 'disabled']);
            echo '</div></div>';

            echo '<div class="table-responsive"> <table class="table table-hover"> <tr> <td>';
            echo $this->Form->input('deposit');
            echo '</td> <td>';
            echo $this->Form->input('deposit_inc_leaders');
            echo '</td> <td>';
            echo $this->Form->input('deposit_value');
            echo '</td> <td>';
            echo $this->Form->input('deposit_text');
            echo '</td></tr></table></div>';

            for ($priceNum = 0; $priceNum < $prices; $priceNum ++) {
                echo '<div class="table-responsive"> <table class="table table-hover"> <tr> <td>';
                echo '<p>Price ' . ($priceNum + 1) . '</p>';
                echo '</td> <td>';
                echo $this->Form->input('prices.' . $priceNum . '.item_type_id', ['label' => 'Role or Item Type', 'options' => $itemTypeOptions, 'empty' => true]);
                echo '</td> <td>';
                echo $this->Form->input('prices.' . $priceNum . '.max_number');
                echo '</td> <td>';
                echo $this->Form->input('prices.' . $priceNum . '.value');
                echo '</td> <td>';
                echo $this->Form->input('prices.' . $priceNum . '.description');
                echo '</td></tr></table></div>';
            }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
