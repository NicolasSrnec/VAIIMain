

<div class = "container content-align-center" style="margin: auto">
<?php

use App\Models\Review;
/** @var Review[] $data */

foreach ($data as $review) {
    ?>
    <div class="col" style="background-color: dimgray">
    <div class="card" style="width: 30rem;margin-left: auto;margin-right: auto">
        <div class="card-body">
            <h5 class="card-title ">Posted by: <?php echo $review->getuserName()?></h5>
            <p class="card-text"style="padding-top: 0;padding-left: 0;padding-right: 0;">Rating: <?php echo $review->getRating()?></p>
            <p class="card-text"style="padding-top: 0;padding-left: 0;padding-right: 0;">Comment: <?php echo $review->getComment()?></p>
        </div>
    </div>
    </div>

<?php } ?>
</div>
