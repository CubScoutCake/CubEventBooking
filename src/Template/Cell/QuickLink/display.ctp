<li class="sidebar-search">
<!--    <div class="row">-->
<!--        <div class="col-xs-12 col-lg-12">-->
            <div class="form-group input-group">
                <?= $this->Form->create($adminFormLink, ['url' => ['controller' => 'Landing', 'action' => 'link'], 'class' => 'form-inline']); ?>
                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group form-group">
                                    <?php echo $this->Form->input('q', [
                                        'label' => false,
                                        'class' => 'form-control input-group',
                                        'placeholder' => 'Search...'
                                    ]); ?>
                                    <span class="input-group-btn input-group">
                                    <?= $this->Form->button(__('<i class="fal fa-search"></i>'),['class' => 'btn btn-default', 'escape' => false ]) ?>
                                </span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                <?= $this->Form->end() ?>
            </div>
<!--        </div>-->
<!--    </div>-->
</li>