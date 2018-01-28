<div class="events form large-10 medium-10 columns content">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Edit Event') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('full_name');
            echo $this->Form->input('event_type_id', ['options' => $eventTypes]);
            echo $this->Form->input('section_type_id', ['options' => $sectionTypes]);
            echo '<div class="row"> <div class="col-lg-6">';
            echo $this->Form->input('start_date');
            echo $this->Form->input('deposit_date');
            echo '</div> <div class="col-lg-6>"';
            echo $this->Form->input('end_date');
            echo $this->Form->input('closing_date');
            echo '</div> </div>';

            echo '<div class="row"> <div class="col-lg-12">';
            echo '<div class="table-responsive"> <table class="table table-hover"> <tr> <td>';
            echo $this->Form->input('live', ['label' => 'Live (will show up on the site)']);
            echo '</td> <td>';
            echo $this->Form->input('new_apps', ['label' => 'Accepting New Applications']);
            echo '</td> <td>';
            echo $this->Form->input('allow_reductions', ['label' => 'Allow invoices to be reduced']);
            echo '</td> <td>';
            echo $this->Form->input('invoices_locked', ['label' => 'Lock Invoices (will prevent updates by users)']);
            echo '</td></tr></table></div>';
            echo '</div> </div>';

            echo $this->Form->input('location');
            echo $this->Form->label('Descriptive Text for the Event');
            echo $this->Form->textarea('intro_text');
            echo $this->Form->input('tagline_text');
            echo $this->Form->input('logo');

            echo '<div class="row"> <div class="col-lg-12">';
            echo '<div class="table-responsive"> <table class="table table-hover"> <tr> <td>';
            echo $this->Form->input('admin_firstname');
            echo '</td> <td>';
            echo $this->Form->input('admin_lastname');
            echo '</td> <td>';
            echo $this->Form->input('admin_email');
            echo '</td></tr></table></div>';
            echo '</div> </div>';
            echo $this->Form->input('admin_user_id', ['options' => $users]);
            echo $this->Form->input('address');
            echo $this->Form->input('city');
            echo $this->Form->input('county');
            echo $this->Form->input('postcode');

            echo '<div class="table-responsive"> <table class="table table-hover"> <tr> <td>';
            echo $this->Form->input('max', ['label' => 'Limit Numbers (will enforce limits to the left)']);
            echo '</td> <td>';
            echo $this->Form->input('max_apps', ['label' => 'Maximum Applications Available']);
            echo '<p>Leave Blank for Infinite</p>';
            echo '</td> <td>';
            echo $this->Form->input('max_section', ['label' => 'Maximum Young Person Spaces Available']);
            echo '<p>Leave Blank for Infinite, does not include young leaders</p>';
            echo '</td></tr></table></div>';

            echo $this->Form->input('discount_id', ['options' => $discounts, 'empty' => true]);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
