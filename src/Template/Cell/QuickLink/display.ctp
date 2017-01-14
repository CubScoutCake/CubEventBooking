<li class="sidebar-search">
    <?= $this->Form->create($adminFormLink, ['url' => ['controller' => 'Landing', 'action' => 'link'], 'class' => 'custom-search-form input-group']); ?>
        <fieldset>
            <?php echo $this->Form->input('link', [
                'label' => false,
                'class' => 'input-group-form form-control',
                'placeholder' => 'Search...'
            ]); ?>
        </fieldset>
        <span class="input-group-btn">
        <?= $this->Form->button(__('<i class="fa fa-search"></i>'),['class' => 'btn btn-default', 'escape' => false ]) ?>
        </span>
    <?= $this->Form->end() ?>
    <!-- /input-group -->
</li>