<div class="events form large-10 medium-9 columns content">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Add Event') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('full_name');
            echo $this->Form->input('start');
            echo $this->Form->input('end');
            echo $this->Form->input('live', ['label' => 'Live (will show up on the site)']);
            echo $this->Form->input('new_apps', ['label' => 'Accepting New Applications']);
            echo $this->Form->input('max', ['label' => 'Limit Numbers (will enforce max numbers)']);
            echo $this->Form->input('allow_reductions', ['label' => 'Allow invoices to be reduced']);
            echo $this->Form->input('invoices_locked', ['label' => 'Lock Invoices (will prevent updates by users)']);
            echo $this->Form->input('parent_applications', ['label' => 'Allow parent applications']);
            echo $this->Form->input('available_apps', ['label' => 'Maximum Applications Available (Leave Blank for Infinite)']);
            echo $this->Form->input('available_cubs', ['label' => 'Maximum Cub Spaces Available (Leave Blank for Infinite)']);

            echo $this->Form->input('location');
            echo $this->Form->label('Descriptive Text for the Event');
            echo $this->Form->textarea('intro_text');
            echo $this->Form->input('tagline_text');
            echo $this->Form->input('logo');
            echo $this->Form->input('logo_ratio', ['label' => 'Logo Ratio (Height / Width)']);


            echo $this->Form->input('invtext_id', ['options' => $inv, 'empty' => true]);
            echo $this->Form->input('legaltext_id', ['options' => $legal, 'empty' => true]);
            echo $this->Form->input('discount_id', ['options' => $discounts, 'empty' => true]);

            echo $this->Form->input('admin_firstname');
            echo $this->Form->input('admin_lastname');
            echo $this->Form->input('admin_email');
            echo $this->Form->input('admin_user_id', ['options' => $users]);
            echo $this->Form->input('address');
            echo $this->Form->input('city');
            echo $this->Form->input('county');
            echo $this->Form->input('postcode');

            echo $this->Form->input('deposit');
            echo $this->Form->input('deposit_date');
            echo $this->Form->input('deposit_value');
            echo $this->Form->input('deposit_inc_leaders');
            echo $this->Form->input('deposit_text');

            echo $this->Form->input('cubs');
            echo $this->Form->input('cubs_value');
            echo $this->Form->input('cubs_text');
            echo $this->Form->input('max_cubs');

            echo $this->Form->input('yls');
            echo $this->Form->input('yls_value');
            echo $this->Form->input('yls_text');
            echo $this->Form->input('max_yls');

            echo $this->Form->input('leaders');
            echo $this->Form->input('leaders_value');
            echo $this->Form->input('leaders_text');
            echo $this->Form->input('max_leaders');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
