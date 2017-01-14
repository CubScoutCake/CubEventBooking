<?php if (empty($kill)): ?>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="<?php

                    echo $this->Url->build([
                        'controller' => 'Users',
                        'action' => 'view',
                        'prefix' => $prefix,
                        $userId
                        ]); ?>"><i class="fa fa-user fa-fw"></i> <?php echo $name; ?> Profile</a>
            </li>
            <li class="divider"></li>
            <li><a href="<?php echo $this->Url->build([
                    'controller' => 'Users',
                    'action' => 'logout',
                    'prefix' => false]); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
<?php endif; ?>