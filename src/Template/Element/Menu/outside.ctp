
<?= $this->Html->link('Start', ['controller' => 'Landing', 'action' => 'welcome', 'prefix' => false], ['class' => 'button']) ?>
<?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'Login', 'prefix' => false], ['class' => 'button']);?>
<?= $this->Html->link('Register', ['controller' => 'Users', 'action' => 'Register', 'prefix' => 'register'], ['class' => 'button']);?>
