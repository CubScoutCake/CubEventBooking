<?php if ($super): ?>
<li>
    <a href="<?php echo $this->Url->build([
    'controller' => 'Landing',
    'action' => 'super_user_home',
    'prefix' => 'super_user']); ?>"><i class="fab fa-ravelry fa-fw"></i> SuperUser Home</a>
</li>
<?php endif ?>
<?php if ($admin): ?>
    <li>
        <a href="<?php echo $this->Url->build([
            'controller' => 'Landing',
            'action' => 'admin_home',
            'prefix' => 'admin']); ?>"><i class="fal fa-rocket fa-fw"></i> Admin Home</a>
    </li>
<?php endif ?>
<?php if ($champion): ?>
    <li>
        <a href="<?php echo $this->Url->build([
            'controller' => 'Landing',
            'action' => 'champion_home',
            'prefix' => 'champion']); ?>"><i class="fal fa-life-ring fa-fw"></i> Champion Home</a>
    </li>
<?php endif ?>
<li>
    <a href="<?php echo $this->Url->build([
        'controller' => 'Landing',
        'action' => 'user_home',
        'prefix' => false]); ?>"><i class="fal fa-home fa-fw"></i> User Home</a>
</li>