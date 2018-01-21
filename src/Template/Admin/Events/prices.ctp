<?php if (!$event->team_price) : ?>
    <div class="row">
        <div class="col-md-12">
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
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h4><?= __('Application Pricing') ?></h4>
            <p><?= __('Remove all variable prices and set single price to application.') ?></p>
            <a href="<?php echo $this->Url->build([
		        'controller' => 'Events',
		        'action' => 'team_price',
		        'prefix' => 'admin']); ?>">
                <button type="button" class="btn btn-outline btn-lg btn-warning"><i class="fa fa-object-group fa-fw"></i> Convert to Application Pricing.</button>
            </a>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-list fa-5x"></i>
                        </div>
                        <div class="col-xs-7 text-right">
                            <div class="huge">List Book</div>
                        </div>
                        <div class="col-xs-2">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <br/>
                        <div class="col-lg-offset-1 col-lg-10">
							<?= $this->Form->create($attForm); ?>
                            <legend><?= __('Number of Attendees Being Registered') ?></legend>
                            <p>Please enter the number of attendees of each type you are booking for.</p>
							<?php
							//if ($cubsVis == 1) {
							echo $this->Form->input('section');
							//}
							//if ($ylsVis == 1) {
							echo $this->Form->input('non_section');
							//}
							//if ($leadersVis == 1) {
							echo $this->Form->input('leaders');
							//}
							?>
                            <br/>
                            <br/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-3">
                            Step 1 of 3
                        </div>
                        <div class="col-xs-9 pull-right">
							<?php echo $this->Form->submit(__('Submit'), ['class' => 'btn btn-primary']); ?>
							<?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endif; ?>
<?php if ($event->team_price) : ?>
    <div class="row">
        <div class="col-md-12">
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

                echo '<div class="table-responsive"> <table class="table table-hover"> <tr> <td>';
                echo '<p>Price ' . (1) . '</p>';
                echo '</td> <td>';
                echo $this->Form->input('prices.0.item_type_id', ['label' => 'Role or Item Type', 'options' => $itemTypeOptions, 'empty' => true]);
                echo '</td> <td>';
                echo $this->Form->input('prices.0.max_number');
                echo '</td> <td>';
                echo $this->Form->input('prices.0.value');
                echo '</td> <td>';
                echo $this->Form->input('prices.0.description');
                echo '</td></tr></table></div>';

				?>
            </fieldset>
			<?= $this->Form->button(__('Submit')) ?>
			<?= $this->Form->end() ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h4><?= __('Application Pricing') ?></h4>
            <p><?= __('Remove all variable prices and set single price to application.') ?></p>
            <button type="button" class="btn btn-outline btn-lg btn-warning"><i class="fa fa-object-group fa-fw"></i> Convert to Application Pricing.</button>
        </div>
    </div>
<?php endif; ?>