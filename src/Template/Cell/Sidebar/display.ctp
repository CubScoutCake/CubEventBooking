<?php
/**
 * @var \App\Model\Entity\AuthRole $auth_role
 * @var string|bool $prefix
 */
?>
<!--<div class="navbar-default sidebar" role="navigation">-->
<!--    <div class="sidebar-nav navbar-collapse">-->
<!--        <ul class="nav" id="metismenu">-->
<?php if ($auth_role->admin_access): ?>
    <li class="sidebar-search">
        <div class="input-group custom-search-form">
            <input type="text" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <i class="fal fa-search"></i>
                </button>
            </span>
        </div>
        <!-- /input-group -->
    </li>
<?php endif ?>
<?php if ($auth_role->super_user): ?>
    <li>
        <a href="<?php echo $this->Url->build([
            'controller' => 'Landing',
            'action' => 'super_user_home',
            'prefix' => 'super_user']); ?>"><i class="fab fa-ravelry fa-fw"></i> SuperUser Home</a>
    </li>
<?php endif ?>
<?php if ($auth_role->admin_access): ?>
    <li>
        <a href="<?php echo $this->Url->build([
            'controller' => 'Landing',
            'action' => 'admin_home',
            'prefix' => 'admin']); ?>"><i class="fal fa-rocket fa-fw"></i> Admin Home</a>
    </li>
<?php endif ?>
<?php if ($auth_role->champion_access): ?>
    <li>
        <a href="<?php echo $this->Url->build([
            'controller' => 'Landing',
            'action' => 'champion_home',
            'prefix' => 'champion']); ?>"><i class="fal fa-life-ring fa-fw"></i> Champion Home</a>
    </li>
<?php endif ?>
<?php if ($auth_role->user_access): ?>
    <li>
        <a href="<?php echo $this->Url->build([
            'controller' => 'Landing',
            'action' => 'user_home',
            'prefix' => false]); ?>"><i class="fal fa-home fa-fw"></i> User Home</a>
    </li>
    <li>
        <a href="<?php echo $this->Url->build([
            'controller' => 'Events',
            'action' => 'index',
            'prefix' => false]); ?>">
            <i class="fal fa-calendar-star fa-fw"></i> Events</a>
        <!-- /.nav-second-level -->
    </li>
    <li>
        <a href="<?php echo $this->Url->build([
            'controller' => 'Applications',
            'action' => 'index',
            'prefix' => false]); ?>">
            <i class="fal fa-clipboard-list fa-fw"></i> Applications</a>
        <!-- /.nav-second-level -->
    </li>
    <!--<li>
    <a href="#"><i class="fal fa-poll-people fa-fw"></i> Attendees<span class="fal fa-chevron-left"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="<?php /*echo $this->Url->build([
        'controller' => 'Attendees',
        'action' => 'index',
        'prefix' => false]); */?>">View Attendees</a>
        </li>
        <li>
            <a href="<?php /*echo $this->Url->build([
        'controller' => 'Attendees',
        'action' => 'cub',
        'prefix' => false]); */?>">Add New Young Person</a>
        </li>
        <li>
            <a href="<?php /*echo $this->Url->build([
        'controller' => 'Attendees',
        'action' => 'adult',
        'prefix' => false]); */?>">Add New Adult</a>
        </li>
        <li>
        <a href="#"><i class="fal fa-allergies fa-fw"></i> Allergies <span class="fal fa-chevron-left"></span></a>
        <ul class="nav nav-third-level">
            <li>
                <a href="<?php /*echo $this->Url->build([
            'controller' => 'Allergies',
            'action' => 'index',
            'prefix' => false]); */?>">View Allergies</a>
            </li>
            <li>
                <a href="<?php /*echo $this->Url->build([
            'controller' => 'Allergies',
            'action' => 'add',
            'prefix' => false]); */?>">Add an Allergy</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="fal fa-child fa-fw"></i> Roles <span class="fal fa-chevron-left"></span></a>
        <ul class="nav nav-third-level">
            <li>
                <a href="<?php /*echo $this->Url->build([
            'controller' => 'Roles',
            'action' => 'index',
            'prefix' => false]); */?>">View Roles</a>
            </li>
        </ul>
    </li>
</ul>
</li>-->
<li>
    <a href="<?php echo $this->Url->build([
        'controller' => 'Osm',
        'action' => 'home',
        'prefix' => false]); ?>">
        <i class="fal fa-sync fa-fw"></i> OSM Sync</a>
    <!-- /.nav-second-level -->
</li>
<?php endif ?>
<?php if ($auth_role->parent_access): ?>
    <li>
        <a href="<?php echo $this->Url->build([
                'controller' => 'Reservations',
                'action' => 'index',
                'prefix' => false,
            ]); ?>">
            <i class="fal fa-ticket-alt fa-fw"></i> Reservations</a>
        <!-- /.nav-second-level -->
    </li>
<?php endif ?>
<li>
    <a href="<?php echo $this->Url->build([
        'controller' => 'Invoices',
        'action' => 'index',
        'prefix' => false]); ?>">
        <i class="fal fa-file-invoice-dollar fa-fw"></i> Invoices</a>
    <!-- /.nav-second-level -->
</li>
<?php if ($auth_role->user_access): ?>
    <li>
        <a href="<?php echo $this->Url->build([
            'controller' => 'Payments',
            'action' => 'index',
            'prefix' => false]); ?>">
            <i class="fal fa-receipt fa-fw"></i> Payments</a>
        <!-- /.nav-second-level -->
    </li>
<!--    <li>-->
<!--        <a href="--><?php //echo $this->Url->build([
//            'controller' => 'Tasks',
//            'action' => 'index',
//            'prefix' => false]); ?><!--">-->
<!--            <i class="fal fa-check-circle fa-fw"></i> Tasks</a>-->
       <!-- /.nav-second-level -->
<!--    </li>-->
    <li>
        <a class="has-arrow" href="#"><i class="fal fa-sitemap fa-fw"></i> More</a>
        <ul class="nav nav-second-level">
            <li>
                <a href="<?php echo $this->Url->build([
                    'controller' => 'Scoutgroups',
                    'action' => 'index',
                    'prefix' => false]); ?>">View Scout Groups</a>
            </li>
            <li>
                <a href="<?php echo $this->Url->build([
                    'controller' => 'Champions',
                    'action' => 'index',
                    'prefix' => false]); ?>">View Champions</a>
            </li>
            <li>
                <a href="<?php echo $this->Url->build([
                    'controller' => 'Districts',
                    'action' => 'index',
                    'prefix' => false]); ?>">View Districts</a>
            </li>
            <!--<li>
                <a href="#">Third Level <span class="fal fa-chevron-left"></span></a>
                <ul class="nav nav-third-level">
                    <li>
                        <a href="#">Third Level Item</a>
                    </li>
                    <li>
                        <a href="#">Third Level Item</a>
                    </li>
                    <li>
                        <a href="#">Third Level Item</a>
                    </li>
                    <li>
                        <a href="#">Third Level Item</a>
                    </li>
                </ul> -->
            <!-- /.nav-third-level -->
        </ul>
        <!-- /.nav-second-level -->
    </li>
<?php endif ?>