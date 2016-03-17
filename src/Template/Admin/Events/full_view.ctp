<div class="row">
    <div class="col-lg-9 col-md-8">
        <h1 class="page-header"><i class="fa fa-calendar-o fa-fw"></i> <?= h($event->name) ?></h1>
    </div>
    <div class="col-lg-1 col-md-2">
        <!--</br>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-success dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o fa-fw"></i>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="<?php /*echo $this->Url->build([
                        'controller' => 'Notifications',
                        'action' => 'welcome',
                        'prefix' => 'admin',
                        $event->id],['_full']); */?>">Send Welcome Email</a>
                    </li>
                    <li><a href="<?php /*echo $this->Url->build([
                        'controller' => 'Users',
                        'action' => 'reset',
                        'prefix' => 'admin'],['_full']); */?>">++ Trigger Password Reset</a>
                    </li>
                </ul>
            </div>
        </div>
        </br>-->
    </div>
    <div class="col-lg-2 col-md-2">
        </br>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><?= $this->Html->link(__('Preview - User View'), ['action' => 'view', $event->id]) ?></li>
                    <li class="divider"></li>
                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->id]) ?></li>
                </ul>
            </div>
        </div>
        </br>
    </div> 
</div>

<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-key fa-fw"></i> Key Event Information
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Full Name') ?></th>
                            <td><?= h($event->full_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Location') ?></th>
                            <td><?= h($event->location) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Event Start') ?></th>
                            <th><?= __('Event End') ?></th>
                        </tr>
                        <tr>
                            <td><?= $this->Time->i18nFormat($event->start, 'dd-MMM-yy HH:mm') ?></td>
                            <td><?= $this->Time->i18nFormat($event->end, 'dd-MMM-yy HH:mm') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope-o fa-fw"></i> Event Organiser Contact
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Contact Person') ?></th>
                            <td><?= h($event->admin_full_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Contact Email') ?></th>
                            <td><?= $this->Text->autoLink($event->admin_email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Address') ?></th>
                            <td><?= h($event->address) ?> </br>
                                <?= h($event->city) ?> </br>
                                <?= h($event->county) ?> </br>
                                <?= h($event->postcode) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-body">
            <?= $this->Html->image($event->logo, ['alt' => $event->alt_text, 'height' => $logoHeight, 'width' => $logoWidth]); ?>
            </div>
            <div class="panel-footer">
                <p><?= h($event->intro_text) ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
        	<div class="panel-heading">
                <i class="fa fa-cog fa-fw"></i> Event Settings
            </div>
            <div class="panel-body">
	            <div class="table-responsive">
	            	<table class="table table-hover">
	            		<tr>
	            		    <td><?= $event->live ? __('Event is Live') : __('Event is Hidden'); ?></td>
	            		</tr>
            		    <tr>
	            		    <td><?= $event->max ? __('Numbers Limited') : __('Numbers Not Limited'); ?></td>
            		    </tr>
            		    <tr>
	            		    <td><?= $event->allow_reductions ? __('Invoices can be Reduced') : __('Invoices can only be Increased'); ?></td>
	            		</tr>
            		    <tr>
	            			<td><?= $event->invoices_locked ? __('Invoices are Locked') : __('Invoices can be Updated'); ?></td>
	            		</tr>
            		    <tr>
	            			<td><?= $event->parent_applications ? __('Parent Applications Available') : __('Parent Applications Unavailable'); ?></td>
	            		</tr>
	            		<tr>
	            		    <td><?php if (isset($event->available_apps) && isset($event->available_cubs)) {
	            		            echo 'Available Cubs & Apps Limited';
	            		        } elseif (isset($event->available_cubs)) {
	            		            echo 'Available Cubs Limited';
	            		        } elseif (isset($event->available_apps)) {
	            		            echo 'Available Apps Limited';
	            		        } else {
	            		           echo 'Available Cubs & Apps Unlimited'; 
	            		        }  ?></td>
	            		</tr>
	            	</table>
            	</div>
	        </div>  
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-gbp fa-fw"></i> Prices
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Attendee Type'); ?></th>
                            <th><?= __('Booking Permited'); ?></th>
                            <th><?= __('Max Number'); ?></th>
                            <th><?= __('Price'); ?></th>
                            <th><?= __('Invoice Text'); ?></th>
                        </tr>
                        <tr>
                            <td><?= __('Cubs'); ?></td>
                            <td><?= $event->cubs ? __('Yes') : __('No'); ?></td>
                            <td><?php if (isset($event->max_cubs) && $event->max_cubs > 0) {
                                    $this->Number->format($event->max_cubs);
                                } else {
                                    echo 'Not Limited';
                                } ?></td>
                            <td><?= $this->Number->currency($event->cubs_value,'GBP') ?></td>
                            <td><?= h($event->cubs_text) ?></td>
                        </tr>
                        <tr>
                            <td><?= __('Young Leaders'); ?></td>
                            <td><?= $event->yls ? __('Yes') : __('No'); ?></td>
                            <td><?php if (isset($event->max_yls) && $event->max_yls > 0) {
                                    $this->Number->format($event->max_yls);
                                } else {
                                    echo 'Not Limited';
                                } ?></td>
                            <td><?= $this->Number->currency($event->yls_value,'GBP') ?></td>
                            <td><?= h($event->yls_text) ?></td>
                        </tr>
                        <tr>
                            <td><?= __('Leaders'); ?></td>
                            <td><?= $event->leaders ? __('Yes') : __('No'); ?></td>
                            <td><?php if (isset($event->max_leaders) && $event->max_leaders > 0) {
                                    $this->Number->format($event->max_leaders);
                                } else {
                                    echo 'Not Limited';
                                } ?></td>
                            <td><?= $this->Number->currency($event->leaders_value,'GBP') ?></td>
                            <td><?= h($event->leaders_text) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th><?= __('Deposit Required') ?></th>
                            <th><?= __('Deposit Inc Leaders') ?></th>
                            <th><?= __('Deposit Date') ?></th>
                            <th><?= __('Deposit Value') ?></th>
                            <th><?= __('Deposit Invoice Text') ?></th>
                        </tr>
                        <tr>
                            <td><?= $event->deposit ? __('Yes') : __('No'); ?></td>
                            <td><?= $event->deposit_inc_leaders ? __('Yes') : __('No'); ?></td>
                            <td><?= $this->Time->i18nFormat($event->deposit_date, 'dd-MMM-yy HH:mm') ?></td>
                            <td><?= $this->Number->currency($event->deposit_value,'GBP') ?></td>
                            <td><?= h($event->deposit_text) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th><?= __('Discount Available') ?></th>
                            <th><?= __('Nature of Discount') ?></th>
                            <th><?= __('Discount Ratio') ?></th>
                            <th><?= __('Discount Value') ?></th>
                            <th><?= __('Deposit Invoice Text') ?></th>
                        </tr>
                        <tr>
                            <td><?= $event->has('discount') ? __('Yes') : __('No'); ?></td>
                            <td><?= $event->has('discount') ? $this->Html->link($event->discount->discount, ['controller' => 'Discounts', 'action' => 'view', $event->discount->id]) : 'None' ?></td>
                            <td><?= $event->has('discount') ? __('1 : ') . $this->Number->format($event->discount->discount_number) : '' ?></td>
                            <td><?= $event->has('discount') ? __('(') . $this->Number->currency($event->discount->discount_value,'GBP') . __(')') : '' ?></td>
                            <td><?= $event->has('discount') ? $this->Html->link($event->discount->text, ['controller' => 'Discounts', 'action' => 'view', $event->discount->id]) : '' ?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Above is the same as the View Action Template - Bar Settings Information -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-level-down fa-fw"></i> Related Items
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills">
                    <li class="active"><a href="#suma-pills" data-toggle="tab"><i class="fa fa-bar-chart fa-fw"></i> Summary Numbers</a></li>
                    <?php if (!empty($event->applications)): ?>
	                    <li><a href="#appl-pills" data-toggle="tab"><i class="fa fa-tasks fa-fw"></i> Applications</a></li>
	                <?php endif; ?>
	                <?php if (!empty($invoices)): ?>
	                    <li><a href="#invo-pills" data-toggle="tab"><i class="fa fa-files-o fa-fw"></i> Invoices</a></li>
	                <?php endif; ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="suma-pills">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                            	        <th><?= __('Property') ?></th>
                            	        <th><?= __('Applications') ?></th>
                            	        <th><?= __('Invoices') ?></th>
                            	    </tr>
                            	</thead>
                            	<tbody>
                            	    <tr>
                            	        <th><?= __('Count') ?></th>
                            	        <td><?= $this->Number->format($cntApplications) ?></td>
                            	        <td><?= $this->Number->format($cntInvoices) ?></td>
                            	    </tr>
	                            	<?php if ($cntInvoices > 1 || $cntApplications > 1) : ?>
	                            	    <tr>
	                            	        <th><?= __('Total Income') ?></th>
	                            	        <td></td>
	                            	        <td><?= $this->Number->currency($sumValues,'GBP') ?></td>
	                            	    </tr>
	                            	    <tr>
	                            	        <th><?= __('Total Payments') ?></th>
	                            	        <td></td>
	                            	        <td><?= $this->Number->currency($sumPayments,'GBP') ?></td>
	                            	    </tr>
	                            	    <tr>
	                            	        <th><?= __('Total Outstanding Balances') ?></th>
	                            	        <td></td>
	                            	        <td><?= $this->Number->currency($sumBalances,'GBP') ?></td>
	                            	    </tr>
	                            	    <tr>
	                            	        <th><?= __('Total Number of Cubs') ?></th>
	                            	        <td><?= $this->Number->format($appCubs) ?></td>
	                            	        <td><?= $this->Number->format($invCubs) ?></td>
	                            	    </tr>
	                            	    <tr>
	                            	        <th><?= __('Total Number of Young Leaders') ?></th>
	                            	        <td><?= $this->Number->format($appYls) ?></td>
	                            	        <td><?= $this->Number->format($invYls) ?></td>
	                            	    </tr>
	                            	    <tr>
	                            	        <th><?= __('Total Number of Leaders') ?></th>
	                            	        <td><?= $this->Number->format($appLeaders) ?></td>
	                            	        <td><?= $this->Number->format($invLeaders) ?></td>
	                            	    </tr>
	                            	<?php endif; ?>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	                <?php if (!empty($event->applications)): ?>
                    <div class="tab-pane fade" id="appl-pills">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
	                                <tr>
	                                    <th><?= __('Id') ?></th>
	                                    <th class="actions"><?= __('Actions') ?></th>
	                                    <th><?= __('User') ?></th>
	                                    <th><?= __('Scoutgroup') ?></th>
	                                    <th><?= __('Section') ?></th>
	                                    <th><?= __('Permitholder') ?></th>
	                                    <th><?= __('Created') ?></th>
	                                    <th><?= __('Modified') ?></th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <?php foreach ($event->applications as $applications): ?>
	                    	            <tr>
	                    	                <td><?= h($applications->display_code) ?></td>
	                    	                <td class="actions">
	                    	                	<div class="dropdown btn-group">
	                    	                	    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
	                    	                	        <i class="fa fa-gear"></i>  <span class="caret"></span>
	                    	                	    </button>
	                    	                	    <ul class="dropdown-menu " role="menu">
	                    	                	        <li><?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $applications->id]) ?></li>
	                    	                	        <li><?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $applications->id]) ?></li>
	                    	                	        <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Applications', 'action' => 'delete', $applications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applications->id)]) ?></li>
	                    	                	    </ul>
	                    	                	</div>
	                    	                </td>
	                    	                <td><?= $applications->has('user') ? $this->Html->link($this->Text->truncate($applications->user->full_name,12), ['controller' => 'Users', 'action' => 'view','prefix' => 'admin', $applications->user->id]) : '' ?></td>
	                    	                <td><?= $applications->has('scoutgroup') ? $this->Html->link($this->Text->truncate($applications->scoutgroup->scoutgroup,12), ['controller' => 'Scoutgroup', 'action' => 'view','prefix' => 'admin', $applications->scoutgroup->id]) : '' ?></td>
	                    	                <td><?= h($applications->section) ?></td>
	                    	                <td><?= $this->Text->truncate($applications->permitholder,12) ?></td>
	                    	                <td><?= h($applications->created) ?></td>
	                    	                <td><?= h($applications->modified) ?></td>
	                    	            </tr>
	                                <?php endforeach; ?>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
		            <?php endif; ?>
                    <?php if (!empty($invoices)): ?>
                        <div class="tab-pane fade" id="invo-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= __('Application') ?></th>
                                            <th><?= __('Sum Value') ?></th>
                                            <th><?= __('Received') ?></th>
                                            <th><?= __('Balance') ?></th>
                                            <th><?= __('Date Created') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($invoices as $invoice): ?>
	                                        <tr>
	                                            <td><?= h($invoice->id) ?></td>
	                                            <td class="actions">
	                                            	<div class="dropdown btn-group">
	                                            	    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
	                                            	        <i class="fa fa-gear"></i>  <span class="caret"></span>
	                                            	    </button>
	                                            	    <ul class="dropdown-menu " role="menu">
	                                            	        <li><?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoice->id]) ?></li>
	                                            	        <li><?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoice->id]) ?></li>
	                                            	        <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?></li>
	                                            	    </ul>
	                                            	</div>
	                                            </td>
	                                            <td><?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></td>
	                                            <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
	                                            <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
	                                            <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
	                                            <td><?= $this->Time->i18nformat($invoice->created,'dd-MMM-yy HH:mm') ?></td>
	                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>