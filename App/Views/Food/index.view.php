
<?php
use App\Models\Food;
/** @var Food[] $data */
/** @var \App\Core\IAuthenticator $auth */
?>
<?php if ($auth->isLogged()) { ?>
<?php if ($auth->getLoggedUserName() == "admin") { ?>
<div>
    <a href="?c=food&a=create" class="'btn btn-success">Create food</a>
</div>
<?php } ?>
<?php } ?>
<div id="txtHint">Customer info will be listed here...</div>
<div class = "container content-align-center" style="margin: auto">
<?php
foreach ($data as $food) {
?>
    <div class="card" style="width: 30rem;margin-left: auto;margin-right: auto" id="<?php echo $food->getId()?>">
        <?php if ($food->getImage()) { ?>
  <img class="card-img-top" src="<?php echo $food->getImage()?>" alt="Card image cap">
  <?php } ?>
    <div class="card-body">
    <h5 class="card-title"><?php echo $food->getName()?></h5>
    <h6 class="card-subtitle"><?php echo $food->getPrice()?>$</h6>

        <a href="?c=review&food=<?php echo $food->getId()?>" class="btn btn-primary">reviews</a>
        <?php if ($auth->isLogged()) { ?>
            <a href="#" class="btn btn-primary" onclick="addItem(<?php echo $food->getId()?>,<?php echo $auth->getLoggedUserName()?>)">Add to cart</a>
        <a href="?c=review&a=create&food=<?php echo $food->getId()?>" class="btn btn-primary">write review</a>
        <?php if ($auth->getLoggedUserName() == "admin") { ?>
        <a href="?c=food&a=delete&id=<?php echo $food->getId()?>" class="btn btn-danger">Delete</a>
                <a href="?c=food&a=edit&id=<?php echo $food->getId()?>" class="btn btn-danger">Update</a>

        <?php } ?>
        <?php } ?>
  </div>
    </div>
<?php } ?>
</div>

