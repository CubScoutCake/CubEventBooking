<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-search fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">Search & Quick Link</div>
                        <hr/>
                        <div>Search will find entities you need from their attributes. Quick link will get you to the entity you need quickly.</div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="form-group">
                        <?= $this->Form->create($adminFormLink, ['url' => ['controller' => 'Landing', 'action' => 'link']]); ?>
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <?php echo $this->Form->input('q', [
                                            'label' => false,
                                            'class' => 'form-control input-lg input-group',
                                            'placeholder' => 'Search...'
                                        ]); ?>
                                        <span class="input-group-btn input-group">
                                            <?= $this->Form->button(__('<i class="fa fa-search"></i> Quick Search'),['class' => 'btn input-lg btn-default', 'escape' => false ]) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
            <br/>
        </div>
    </div>
</div>