<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="metismenu">
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
            <li>
                <a href="<?php echo $this->Url->build([
                    'controller' => 'Landing',
                    'action' => 'user_home',
                    'prefix' => false]); ?>"><i class="fal fa-home fa-fw"></i> User Home</a>
            </li>
            <li>
                <a href="#"><i class="fal fa-calendar-star fa-fw"></i> Events<span class="fal fa-chevron-left"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo $this->Url->build([
                    'controller' => 'Events',
                    'action' => 'index',
                    'prefix' => false]); ?>">View Events</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fal fa-clipboard-list fa-fw"></i> Applications<span class="fal fa-chevron-left"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo $this->Url->build([
                    'controller' => 'Applications',
                    'action' => 'index',
                    'prefix' => false]); ?>">View Applications</a>
                    </li>
                    <li>
                        <a href="<?php echo $this->Url->build([
                    'controller' => 'Applications',
                    'action' => 'index',
                    'prefix' => false]); ?>">Add New Application</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fal fa-poll-people fa-fw"></i> Attendees<span class="fal fa-chevron-left"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo $this->Url->build([
                    'controller' => 'Attendees',
                    'action' => 'index',
                    'prefix' => false]); ?>">View Attendees</a>
                    </li>
                    <li>
                        <a href="<?php echo $this->Url->build([
                    'controller' => 'Attendees',
                    'action' => 'cub',
                    'prefix' => false]); ?>">Add New Young Person</a>
                    </li>
                    <li>
                        <a href="<?php echo $this->Url->build([
                    'controller' => 'Attendees',
                    'action' => 'adult',
                    'prefix' => false]); ?>">Add New Adult</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fal fa-file-invoice-dollar fa-fw"></i> Invoices<span class="fal fa-chevron-left"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo $this->Url->build([
                    'controller' => 'Invoices',
                    'action' => 'index',
                    'prefix' => false]); ?>">View Invoices</a>
                    </li>
                    <li>
                        <a href="<?php echo $this->Url->build([
                    'controller' => 'Invoices',
                    'action' => 'generate',
                    'prefix' => false]); ?>">Generate New Invoice</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fal fa-receipt fa-fw"></i> Payments<span class="fal fa-chevron-left"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo $this->Url->build([
                    'controller' => 'Payments',
                    'action' => 'index',
                    'prefix' => false]); ?>">View Payments</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fal fa-sitemap fa-fw"></i> More<span class="fal fa-chevron-left"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">View Scout Groups</a>
                    </li>
                    <li>
                        <a href="#">View Champions</a>
                    </li>
                    <li>
                        <a href="#">View Districts</a>
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
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->