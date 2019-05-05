<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 *
 * @var \App\Model\Entity\Event $event
 *
 * @var array $users
 * @var array $attendees
 * @var array $reservationStatuses
 * @var array $sections
 * @var array $sessions
 */

$this->assign('title', 'Reserve a place');

$this->append('parent-nav', '<li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">Event Info</a>
                </li>');

$this->append('parent-nav', '<li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#book">Book</a>
                </li>');
?>

<!-- Header -->
<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <h1 class="mx-auto my-0 text-uppercase"><?= $event->name ?></h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5"><?= $event->full_name ?></h2>
            <a href="#book" class="btn btn-primary js-scroll-trigger">Book Now</a>
        </div>
    </div>
</header>

<!-- About Section -->
<section id="about" class="about-section text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-white mb-4">Canoeing, Kayaking & Dragon Boating</h2>
                <p class="text-white-50">2 - 3 badges and 3 hours on the water.</p>
            </div>
        </div>
    </div>
</section>

<!-- Signup Section -->
<section id="book" class="signup-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto text-center">

                <i class="far fa-ticket-alt fa-3x mb-2 text-white"></i>
                <h2 class="text-white mb-5">Book for Event</h2>

                <?= $this->Form->create($reservation, ['class' => 'form']) ?>
                <fieldset>
                    <div class="form-row">
                        <div class="col"><?= $this->Form->control('user.firstname', ['label' => 'Parent or Guardian First Name']) ?></div>
                        <div class="col"><?= $this->Form->control('user.lastname', ['label' => 'Parent or Guardian Last Name']) ?></div>
                    </div>
                    <?php
                    echo $this->Form->control('user.email', ['label' => 'Parent or Guardian Email']);
                    echo $this->Form->control('user.phone', ['label' => 'Parent or Guardian Emergency Contact Number']);

                    echo $this->Form->control('user.address_1');
                    echo $this->Form->control('user.address_2');
                    echo $this->Form->control('user.city');
                    echo $this->Form->control('user.county', ['default' => 'Hertfordshire']);
                    echo $this->Form->control('user.country', ['default' => 'United Kingdom']);
                    echo $this->Form->control('user.postcode');

	                ?>
                    <div class="form-row">
                        <div class="col"><?= $this->Form->control('attendee.firstname', ['label' => 'Young Person First Name']) ?></div>
                        <div class="col"><?= $this->Form->control('attendee.lastname', ['label' => 'Young Person Last Name']) ?></div>
                    </div>
                    <?= $this->Form->control('attendee.section_id', ['options' => $sections, 'empty' => true, 'class' => 'hierarchy-select form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0']); ?>

                    <?php foreach ($event->logistics as $idx => $logistic) : ?>

                        <?= $this->Form->control('logistics_item.' . $idx . '.logistic_id', ['value' => $logistic->id, 'type' => 'hidden']); ?>
                        <?= $this->Form->control('logistics_item.' . $idx . '.param_id', ['options' => $sessions, 'type' => 'radio', 'label' => 'Session']); ?>

                    <?php endforeach; ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>
