<div class="row">
    <div class="col-lg-12 col-md-12">
        <h1 class="page-header"><i class="fal fa-paw fa-fw"></i> <?= h($scoutgroup->scoutgroup); ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fal fa-key fa-fw"></i> Scout Group Info
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <h5 class="subheader"><?= __('Scout Group') ?></h5>
                <p><?= h($scoutgroup->scoutgroup) ?></p>
                <h5 class="subheader"><?= __('District') ?></h5>
                <p><?= $scoutgroup->has('district') ? $this->Html->link($scoutgroup->district->district, ['controller' => 'Districts', 'action' => 'view', $scoutgroup->district->id]) : '' ?></p>               
            </div>
            <div class="panel-footer">          
                <h5 class="subheader"><?= __('Id') ?></h5>
                <p><?= $this->Number->format($scoutgroup->id) ?></p>
            </div>
        </div>
    </div>
</div>