<?php include('inc/header.php'); ?>
<div class="service_header dark">
    <div class="c-sm-7">
        <h3>Service</h3>
        <p>The choice of courses, the highly qualified instructors, the latest technology, we at Oceanic Hospitality Training Centre provide our trainees with the finest ingredients for success. We aim for our trainees to become the crème de la crème on the field of the culinary and Hospitality Industry.
        Enroll now from our list of courses. Welcome aboard! </p>
    </div>
    <div class="c-sm-5">
    </div>
</div>
<div class="services_container">
    <?php
    for($i = 1; $i <= 48; $i++) {
        if(!in_array($i, array(12, 24, 44, 45))) {
            include("services/ohtc".str_pad($i, 2, "0", STR_PAD_LEFT).".php");
        }
    }
    ?>
</div>
<?php include('inc/footer.php'); ?>
