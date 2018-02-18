<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 18/01/2018
 * Time: 22:30
 *
 * @var array $attendees
 * @var \App\Model\Entity\Application $application
 * @var int $attendeeCount
 * @var bool $permitHolderBool
 * @var bool $teamLeaderBool
 * @var string $term
 */

use \Cake\I18n\Date;

?>
<div class="row">
    <div class="col-lg-10 col-md-10">
        <h1><i class="fa fa-exchange fa-fw" ></i><?= __(' Sync Event Booking') ?></h1>
    </div>
    <div class="col-lg-2 col-md-2">
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-success dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="<?php echo $this->Url->build([
							'controller' => 'Applications',
							'action' => 'choose_osm_event',
							'prefix' => false,
							$application->event_id,
							$application->id
                        ],['_full']); ?>">Change Selected OSM Event</a>
                    </li>
                </ul>
            </div>
        </div>
        </br>
    </div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel-body">
			<?= $this->Form->create($application) ?>
			<fieldset>
				<legend></legend>
				<?php
				if ($permitHolderBool) {
					echo $this->Form->input('permit_holder', ['label' => 'The Name of the Nights Away Permit Holder']);
				}
				if ($teamLeaderBool) {
					echo $this->Form->input('team_leader', ['label' => 'The Name of the ' . $term . ' Leader' ]);
				} ?>
				<div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><?= h('First Name') ?></th>
                                <th><?= h('Last Name') ?></th>
                                <th><?= h('Date Of Birth') ?></th>
                                <th><?= h('Age') ?></th>
                                <th><?= h('Attendee Role') ?></th>
                            </tr>
                        </thead>
                        <?php for ($att = 0; $att < $attendeeCount; $att ++): ?>
                            <tr>
                                <td><?= h($application->attendees[$att]->firstname) ?></td>
                                <td><?= h($application->attendees[$att]->lastname) ?></td>
                                <td><?= $this->Time->i18nformat($application->attendees[$att]->dateofbirth,'dd-MMM-yyyy') ?></td>
                                <td><?php $age = date_diff($application->attendees[$att]->dateofbirth, Date::now()); echo '<strong>' . $age->y . '</strong>' . ' years & ' . $age->m . ' months'; ?></td>
                                <td><?= $this->Form->input('attendees.' . $att . '.role_id', ['options' => $roles, 'label' => '', /*, 'disabled' => 'disabled'*/])  ?></td>
                            </tr>
                        <?php endfor; ?>
                    </table>
                </div>
			</fieldset>

            <br/>
            <p>The above infomation will be used to generate your application - it has not been stored yet, please confirm submission.</p>
            <br/>
			<?= $this->Form->submit(__('Confirm'),['class' => 'btn-success']) ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>