
<div>
    <a href="?c=food&a=create" class="'btn btn-success">Create food</a>
</div>


<?php

use App\Models\Food;
/** @var Food[] $data */

foreach ($data as $food) {
?>
    <div class="card" style="width: 18rem;">
        <?php if ($food->getImage()) { ?>
  <img class="card-img-top" src="<?php echo $food->getImage()?>" alt="Card image cap">
  <?php } ?>
    <div class="card-body">
    <h5 class="card-title"><?php echo $food->getName()?></h5>
    <p class="card-text"><?php echo $food->getPrice()?>$</p>
    <a href="#" class="btn btn-primary">Add to cart</a>
    <a href="?c=food&a=delete&id=<?php echo $food->getId()?>" class="btn btn-danger">Delete</a>
  </div>
    </div>

<?php } ?>