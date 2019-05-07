<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 *
 * @var \App\Model\Entity\Event[] $events
 *
 * @var array $users
 * @var array $attendees
 * @var array $reservationStatuses
 * @var array $sections
 * @var array $sessions
 */

$this->assign('title', 'Reserve a place');

$this->append('parent-nav', '<li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#events">County Events</a>
                </li>');

$this->append('parent-nav', '<li class="nav-item">' . $this->Html->link('Register', [
        'controller' => 'Users',
        'action' => 'register',
        'prefix' => 'register'
    ], ['class' => 'nav-link']) . '</li>');


$this->append('parent-nav', '<li class="nav-item">' . $this->Html->link('Sign Up for Emails', [
        'controller' => 'Mailchimp',
        'action' => 'mailchimp',
        'prefix' => false
    ], ['class' => 'nav-link']) . '</li>');



$this->append('parent-nav', '<li class="nav-item">' . $this->Html->link('Login', [
        'controller' => 'Users',
        'action' => 'login',
        ], ['class' => 'nav-link']) . '</li>');
?>

<!-- Header -->
<header class="welcome">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <h1 class="mx-auto my-0 text-uppercase">County Cub Scout Team</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5">Activity Events in Hertfordshire</h2>
            <a href="#events" class="btn btn-primary js-scroll-trigger">View our Events</a>
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

<!-- About Section -->
<section id="events" class="contact-section text-center">
    <?php foreach ($events as $event) : ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fal fa-3x <?= $event->event_type->parent_applications ? 'fa-ticket-alt' : 'fa-clipboard-list' ?> mb-2"></i>
                        <br/>
                        <h1 class="display-4 text-uppercase"><?= h($event->full_name) ?></h1>
                        <h2 class="text-black-50"><?= $this->Time->i18nformat($event->start_date,'dd-MMM-yy')  ?></h2>
                        <hr class="my-4">
                        <?php if ($event->event_status->accepting_applications && !$event->event_status->spaces_full && $event->event_type->parent_applications) : ?>
                            <div><?= $this->Html->link('Book as a Parent', ['prefix' => 'parent', 'controller' => 'Reservations', 'action' => 'reserve', $event->id], ['class' => 'btn btn-primary'])  ?></div>
                            <br/>
                            <div><h1 class="text-black-50"><?= h($event->event_status->event_status) ?></h1></div>
                            <p>This event is available for Parents to book for individual Cubs.</p>
                        <?php elseif ($event->event_status->accepting_applications && !$event->event_status->spaces_full && !$event->event_type->parent_applications) : ?>
                            <div><?= $this->Html->link('Book as a Leader', ['controller' => 'Events', 'action' => 'book', $event->id], ['class' => 'btn btn-primary'])  ?></div>
                            <br/>
                            <div><h1 class="text-black-50"><?= h($event->event_status->event_status) ?></h1></div>
                            <p>This event is currently only available to book as group by a leader.</p>
                        <?php endif; ?>

                        <?php if ($event->event_status->pending_date) : ?>
                            <div><h1 class="text-black-50">Booking opens: <?= $this->Time->i18nformat($event->opening_date,'dd-MMM-yy HH:mm') ?></h1></div>
                        <?php endif; ?>

                        <?php if ($event->event_status->spaces_full) : ?>
                            <div><h1 class="text-black-50">Event is Currently Full.</h1></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
    <?php endforeach; ?>
</section>