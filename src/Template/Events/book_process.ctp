<div class="row">
    <div class="col-lg-12">
        <h1>Book onto Event</h1>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-exclamation-triangle fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">List Book (Step 1)</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <br/>
                        <div class="col-lg-offset-1 col-lg-10">
                            <?= $this->Form->create($attForm); ?>
                            <fieldset>
                                <legend><?= __('Number of Attendees Being Registered') ?></legend>
                                <p>Please enter the number of attendees of each type you are booking for.</p>
                                <?php
                                //if ($cubsVis == 1) {
                                echo $this->Form->input('section');
                                //}
                                //if ($ylsVis == 1) {
                                echo $this->Form->input('yls');
                                //}
                                //if ($leadersVis == 1) {
                                echo $this->Form->input('leaders');
                                //}
                                ?>
                            </fieldset>
                            <?= $this->Form->button(__('Submit')) ?>
                            <?= $this->Form->end() ?>
                            <br/>
                            <br/>
                        </div>
                    </div>
                    <div class='panel-footer'>
                        Step 1 of 3
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>