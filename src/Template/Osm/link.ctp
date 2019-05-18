<div class="row">
    <div class="col-lg-12 col-md-12">
        <h1 class="page-header"><i class="fal fa-link fa-fw"></i> Create OSM Account Link</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?= $this->Form->create($linkForm); ?>
        <fieldset>
            <p>This link will be stored for the time you are on the site - there is no way for anyone other than you to access your OSM link</p>
            <?php
                echo $this->Form->input('osm_email',['label' => 'Online Scout Manager Email Address (User)']);
                echo $this->Form->label('Online Scout Manager Password');
                echo $this->Form->password('osm_password');
            ?>
        </fieldset>
        <br />   
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
