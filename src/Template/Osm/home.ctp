<div class="row">
    <div class="col-lg-1 col-md-2">
        <?= $this->Html->image('Logos/osmlogo.png', ['alt' => 'CakePHP', 'class' => 'img-responsive']); ?>
    </div>
    <div class="col-lg-11 col-md-10">
        <h1 class="page-header"><i class="fa fa-refresh fa-fw"></i> Online Scout Manager Sync</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-<?= $linked ? 'success' : 'warning' ; ?>">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-<?= $linked ? 'link' : 'chain-broken' ; ?> fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $linked ? 'Yes' : 'No' ; ?></div>
                        <div>Linked to Account</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo $this->Url->build([
                'controller' => 'Osm',
                'action' => 'link',
                'prefix' => false],['_full']); ?>">
                <div class='panel-footer'>
                    <span class='pull-left'>Link Your Account</span>
                    <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                    <div class='clearfix'></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-<?= $sectionSet ? 'success' : 'warning' ; ?>">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-<?= $sectionSet ? 'paw' : 'question' ; ?> fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $sectionSet ? 'Yes' : 'No' ; ?></div>
                        <div>OSM Section Set</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo $this->Url->build([
                'controller' => 'Osm',
                'action' => 'section',
                'prefix' => false],['_full']); ?>">
                <div class="panel-footer">
                    <span class="pull-left">Choose Your Section</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-<?= $termCurrent ? 'success' : 'warning' ; ?>">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa <?= $termCurrent ? 'fa-calendar-check-o' : 'fa-calendar-times-o' ; ?> fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $termCurrent ? 'Yes' : 'No' ; ?></div>
                        <div>Current Term Set</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo $this->Url->build([
                'controller' => 'Osm',
                'action' => 'term',
                'prefix' => false],['_full']); ?>">
                <div class="panel-footer">
                    <span class="pull-left">Set The Current Term</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!--<div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-refresh fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?/*= $this->Number->format($synced); */?></div>
                        <div>Attendees Synced</div>
                    </div>
                </div>
            </div>
            <a href="<?php /*echo $this->Url->build([
                'controller' => 'Osm',
                'action' => 'sync',
                'prefix' => false],['_full']); */?>">
                <div class="panel-footer">
                    <span class="pull-left">Sync Your Attendees with OSM</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>-->
</div>
<?php if($linked) : ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>OSM Authorisation Instructions - To Enable System Data Access.</h4>
            </div>
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-unlock fa-fw"></i> Step 1
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?= $this->Html->image('OSM/Step1.png', ['alt' => 'CakePHP', 'class' => 'img-responsive']); ?>
                            </div>
                            <div class="panel-footer">
                                <p>Login to <a href="https://www.onlinescoutmanager.co.uk/login.php">Online Scout Manager</a>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-unlock fa-fw"></i> Step 2
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?= $this->Html->image('OSM/Step2.png', ['alt' => 'CakePHP', 'class' => 'img-responsive']); ?>
                            </div>
                            <div class="panel-footer">
                                <p>Under the 'Account' option in the top right select 'Account Preferences'.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-unlock fa-fw"></i> Step 3
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?= $this->Html->image('OSM/Step3.png', ['alt' => 'CakePHP', 'class' => 'img-responsive']); ?>
                            </div>
                            <div class="panel-footer">
                                <p>Select the 'External Access' Tab.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-unlock fa-fw"></i> Step 4
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?= $this->Html->image('OSM/Step4.png', ['alt' => 'CakePHP', 'class' => 'img-responsive']); ?>
                            </div>
                            <div class="panel-footer">
                                <p>Set 'Personal Details' box to 'Read' or 'Read &amp Write' for 'Jacob's event booking system'.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php endif; ?>
