<?php /**
 * @var \App\Model\Entity\Application $application
 * @var \App\Model\Entity\Event $event
 * @var \App\Model\Entity\User $user
 *
 * @var array $sectionRoles
 * @var array $nonSectionRoles
 * @var array $leaderRoles
 *
 * @var int $attendees
 * @var int $nonSectionAtts
 * @var int $leaderAtts
 */ ?>


<div class="row">
    <div class="col-lg-12">
        <div class="panel-body">
            <?= $this->Form->create($application) ?>
            <fieldset>
                <legend><i class="fal fa-clipboard-list fa-fw" ></i><?= __(' Simple Event Booking') ?></legend>
                <?php
                    if ($event->event_type->permit_holder) {
                        echo $this->Form->input('permit_holder', ['label' => 'The Name of the Nights Away Permit Holder']);
                    }
                    if ($event->event_type->team_leader) {
                        echo $this->Form->input('team_leader', ['label' => 'The Name of the ' . $event->event_type->application_ref->text . ' Leader' ]);
                    }
                    echo '<div class="table-responsive"> <table class="table table-hover">';
                    for ($att = 0; $att < $attendees; $att ++) {
                        echo '<tr> <td>';
                        echo '<p> '. $user->section->section_type->singular_section_type . ' '  . ($att + 1) . '</p>';
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . $att . '.firstname');
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . $att . '.lastname');
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . $att . '.role_id', ['options' => $sectionRoles/*, 'disabled' => 'disabled'*/]);
                        echo '</td> <td>';
                        if ($event->event_type->dietary) {
                            echo $this->Form->input('attendees.' . $att . '.vegetarian', ['type' => 'checkbox', 'label' => 'Vegetarian']);
                        }
                        echo '</td></tr>';
                    }
                    $indent = $attendees;
                    for ($att = 0; $att < $nonSectionAtts; $att ++) {
                        echo '<tr class="success"> <td>';
                        echo '<p>Non ' . $user->section->section_type->singular_section_type . ' ' . ($att + 1) . '</p>';
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . ($att + $indent) . '.firstname');
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . ($att + $indent) . '.lastname');
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . ($att + $indent) . '.role_id', ['options' => $nonSectionRoles]);
                        echo '</td> <td>';
                        if ($event->event_type->dietary) {
                            echo $this->Form->input('attendees.' . ($att + $indent) . '.vegetarian', ['type' => 'checkbox', 'label' => 'Vegetarian']);
                        }
                        echo '</td></tr>';
                    }
                    $indent = $attendees + $nonSectionAtts;
                    for ($att = 0; $att < $leaderAtts; $att ++) {
                        echo '<tr class="info"> <td>';
                        echo '<p>Leader ' . ($att + 1) . '</p>';
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . ($att + $indent) . '.firstname');
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . ($att + $indent) . '.lastname');
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . ($att + $indent) . '.role_id', ['options' => $leaderRoles]);
                        echo '</td> <td>';
                        echo $this->Form->input('attendees.' . ($att + $indent) . '.nightsawaypermit', ['type' => 'checkbox', 'label' => 'Nights Away Permit']);
                        if ($event->event_type->dietary) {
                            echo $this->Form->input('attendees.' . ($att + $indent) . '.vegetarian', ['type' => 'checkbox', 'label' => 'Vegetarian']);
                        }
                        echo '</td></tr>';
                    }
                    echo '</table></div>';
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'),['class' => 'btn-success']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
