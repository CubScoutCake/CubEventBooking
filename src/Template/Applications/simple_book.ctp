<div class="row">
    <div class="col-lg-12">
        <div class="panel-body">
            <?= $this->Form->create($application) ?>
            <fieldset>
                <legend><i class="fa fa-tasks fa-fw" ></i><?= __(' Simple Event Booking') ?></legend>
                <?php
                    echo $this->Form->input('permitholder', ['label' => 'The Name of the Permitholder (or Leader In Charge)']);

                    for ($att = 0; $att < $attendees; $att ++) {
                        echo '<table class="table table-hover"> <tr> <td>';
                        echo '<p>Attendee ' . ($att + 1) . '</p>';
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . $att . '.firstname');
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . $att . '.lastname');
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . $att . '.role_id');
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . $att . '.nightsawaypermit', ['type' => 'checkbox', 'label' => 'Nights Away Permit']);
                        echo $this->Form->input('attendees.' . $att . '.vegetarian', ['type' => 'checkbox', 'label' => 'Vegetarian']);
                        echo '</td></tr></table>';
                    }
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'),['class' => 'btn-success']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
