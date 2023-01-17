
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

<div class = "container content-align-center" style="margin: auto">
    <div class="row justify-content-center" >
        <div class="col " style="background-color: white;" align="center" id="foodColumn"> <a href="?c=food&type=burger" class="btn btn-primary"> Burgers</a>
        </div>
        <div class="col " style="background-color: white;" align="center" id="foodColumn"> <a href="?c=food&type=pizza" class="btn btn-primary"> Pizza</a>
        </div>
        <div class="col " style="background-color: white;" align="center" id="foodColumn"> <a href="?c=food&type=drink" class="btn btn-primary"> Drinks</a>
        </div>
    </div>
    <?php
    for ($x = 0; $x < sizeof($data); $x++) {
        ?>
    <div class="row justify-content-center no-gutters" >
        <div class="col" style="background-color: dimgray;" id="foodColumn">
        <div class="card" style="width: 25vw;margin-left: auto;margin-right: auto" id="<?php echo $data[$x]->getId()?>">
            <?php if ($data[$x]->getImage()) { ?>
                <img class="card-img-top" src="<?php echo $data[$x]->getImage()?>" alt="Card image cap">
            <?php } ?>
            <div class="card-body">
                <h5 class="card-title"><?php echo $data[$x]->getName()?></h5>
                <h6 class="card-subtitle"><?php echo $data[$x]->getPrice()?>$</h6>

                <a href="?c=review&food=<?php echo $data[$x]->getId()?>" class="btn btn-primary">reviews</a>
                <?php if ($auth->isLogged()) { ?>
                    <a href="#" class="btn btn-primary" onclick="addItem('<?php echo $data[$x]->getId()?>','<?php echo $auth->getLoggedUserName()?>','<?php echo $data[$x]->getName()?>','<?php echo $data[$x]->getPrice()?>')">Add to cart</a>
                    <a href="?c=review&a=create&food=<?php echo $data[$x]->getId()?>" class="btn btn-primary">write review</a>
                    <?php if ($auth->getLoggedUserName() == "admin") { ?>
                        <a href="?c=food&a=delete&id=<?php echo $data[$x]->getId()?>" class="btn btn-danger">Delete</a>
                        <a href="?c=food&a=edit&id=<?php echo $data[$x]->getId()?>" class="btn btn-danger">Update</a>

                    <?php } ?>
                <?php } ?>
            </div>
            </div>
        </div>
        <?php if ($x+1 < sizeof($data)) { ?>
        <div class="col" style="background-color: dimgray;" id="foodColumn">
            <div class="card" style="width: 25vw;margin-left: auto;margin-right: auto" id="<?php echo $data[$x+1]->getId()?>">
                <?php if ($data[$x+1]->getImage()) { ?>
                    <img class="card-img-top" src="<?php echo $data[$x+1]->getImage()?>" alt="Card image cap">
                <?php } ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data[$x+1]->getName()?></h5>
                    <h6 class="card-subtitle"><?php echo $data[$x+1]->getPrice()?>$</h6>

                    <a href="?c=review&food=<?php echo $data[$x+1]->getId()?>" class="btn btn-primary">reviews</a>
                    <?php if ($auth->isLogged()) { ?>
                        <a href="#" class="btn btn-primary" onclick="addItem('<?php echo $data[$x+1]->getId()?>','<?php echo $auth->getLoggedUserName()?>','<?php echo $data[$x+1]->getName()?>','<?php echo $data[$x+1]->getPrice()?>')">Add to cart</a>
                        <a href="?c=review&a=create&food=<?php echo $data[$x+1]->getId()?>" class="btn btn-primary">write review</a>
                        <?php if ($auth->getLoggedUserName() == "admin") { ?>
                            <a href="?c=food&a=delete&id=<?php echo $data[$x+1]->getId()?>" class="btn btn-danger">Delete</a>
                            <a href="?c=food&a=edit&id=<?php echo $data[$x+1]->getId()?>" class="btn btn-danger">Update</a>

                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php $x++; } ?>

    </div>
    <?php } ?>
</div>

