<?php foreach ($tasks as $app): ?>
    <li>
        <a href="<?php echo $this->Url->build([
                        'controller' => 'Applications',
                        'action' => 'view',
                        'prefix' => false,
                        1]); ?>">
            <div>
                <i class="fal fa-clipboard-list fa-fw"></i> App Number <?= $app->done ?>
                <span class="pull-right text-muted small">80%</span>
            </div>
        </a>
    </li>
    <li class="divider"></li>
<?php endforeach; ?>