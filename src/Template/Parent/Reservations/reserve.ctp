<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 * @var array $events
 * @var array $users
 * @var array $attendees
 * @var array $reservationStatuses
 */

$this->assign('title', 'Reserve a place');
?>

<!-- Header -->
<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <h1 class="mx-auto my-0 text-uppercase">CWAD 2019</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5">County Water Activity Day</h2>
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

                <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                <h2 class="text-white mb-5">Book for Event</h2>

                <?= $this->Form->create($reservation, ['class' => 'form']) ?>
                <fieldset>
                    <?php
                    if (count($events) != 1) {
                        echo $this->Form->control('event_id', ['options' => $events, 'class' => 'form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0']);
                    }
                    ?><div class="form-row"><div class="col"><?php
                        echo $this->Form->control('user.firstname', ['label' => 'Parent or Guardian First Name']);
                    ?></div><div class="col"><?php
                        echo $this->Form->control('user.lastname', ['label' => 'Parent or Guardian Last Name']);
                    ?></div></div><?php
                    echo $this->Form->control('user.email', ['label' => 'Parent or Guardian Email']);
                    echo $this->Form->control('user.phone', ['label' => 'Parent or Guardian Emergency Contact Number']);

                    echo $this->Form->control('user.address_1');
                    echo $this->Form->control('user.address_2');
                    echo $this->Form->control('user.city');
                    echo $this->Form->control('user.country');
                    echo $this->Form->control('user.postcode');

	                ?><div class="form-row"><div class="col"><?php
                        echo $this->Form->control('attendee.firstname', ['label' => 'Young Person First Name']);
                    ?></div><div class="col"><?php
                        echo $this->Form->control('attendee.lastname', ['label' => 'Young Person Last Name']);
			        ?></div></div><?php
                    echo $this->Form->control('attendee.section', ['options' => $sections, 'empty' => true, 'class' => 'hierarchy-select form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section bg-black">
    <div class="container">

        <div class="row">
            <div class="col">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Address</h4>
                        <hr class="my-4">
                        <div class="small text-black-50">4923 Market Street, Orlando FL</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-envelope text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Email</h4>
                        <hr class="my-4">
                        <div class="small text-black-50">
                            <a href="#">hello@yourdomain.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="social d-flex justify-content-center">
            <a href="#" class="mx-2">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="mx-2">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="mx-2">
                <i class="fab fa-github"></i>
            </a>
        </div>

    </div>
</section>
