<div class="row">
    <div class="col-lg-1 col-md-2">
        <?= $this->Html->image('Logos/osmlogo.png', ['alt' => 'CakePHP', 'class' => 'img-responsive']); ?>
    </div>
    <div class="col-lg-9 col-md-7">
        <h1 class="page-header"><i class="fa fa-refresh fa-fw"></i> Granting Read Access to Herts Cubs</h1>
    </div>
    <div class="col-lg-2 col-md-3">
        <?php echo $this->Html->link('Return to OSM Dashboard.', ['controller' => 'Osm', 'action' => 'home'],['class' => 'btn btn-default']); ?>
    </div>
</div>
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
