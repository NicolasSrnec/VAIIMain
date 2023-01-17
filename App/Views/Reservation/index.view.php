<div class = "container content-align-center" style="margin: auto">
    <?php

    use App\Models\Reservation;
    /** @var Reservation[] $data */
    /** @var \App\Core\IAuthenticator $auth */
    for ($x = 0; $x < sizeof($data); $x++) {
        ?>
    <div class="row justify-content-center no-gutters" >
        <div class="col" style="background-color: dimgray" id="foodColumn">
            <div class="card" style="width: 25vw;margin-left: auto;margin-right: auto;height: 100%">
                <div class="card-body">
                    <h5 class="card-title ">Table number: <?php echo $data[$x]->getid()?></h5>
                    <p class="card-text" style="padding-top: 0;padding-left: 0;padding-right: 0;">Reserved by: <?php echo $data[$x]->getResUsername()?></p>
                    <p class="card-text" style="padding-top: 0;padding-left: 0;padding-right: 0;"> <?php if ($data[$x]->getReserved() == 0 & $auth->isLogged()) {?>
                        <a href="?c=reservation&a=reserve&res_id=<?php echo $data[$x]->getid()?>&res_username=<?php echo $auth->getLoggedUserName() ?>" class="btn btn-success">Reserve</a>
                       <?php } else { ?>
                        Reserved
                        <?php }?></p>
                    <p class="card-text" style="padding-top: 0;padding-left: 0;padding-right: 0;"> <?php if ($auth->getLoggedUserName() == "admin") {?>
                            <a href="?c=reservation&a=unreserve&res_id=<?php echo $data[$x]->getid()?>" class="btn btn-warning">Unreserve</a>
                        <?php }?></p>
                </div>
            </div>
        </div>
    <?php if ($x+1 < sizeof($data)) { ?>
        <div class="col" style="background-color: dimgray" id="foodColumn">
            <div class="card" style="width: 25vw;margin-left: auto;margin-right: auto;height: 100%">
                <div class="card-body">
                    <h5 class="card-title ">Table number: <?php echo $data[$x+1]->getid()?></h5>
                    <p class="card-text"style="padding-top: 0;padding-left: 0;padding-right: 0;">Reserved by: <?php echo $data[$x+1]->getResUsername()?></p>
                    <p class="card-text"style="padding-top: 0;padding-left: 0;padding-right: 0;"> <?php if ($data[$x+1]->getReserved() == 0 & $auth->isLogged()) {?>
                            <a href="?c=reservation&a=reserve&res_id=<?php echo $data[$x+1]->getid()?>&res_username=<?php echo $auth->getLoggedUserName() ?>" class="btn btn-success">Reserve</a>
                        <?php } else { ?>
                            Reserved
                        <?php }?></p>
                </div>
            </div>
        </div>
            </div>
            <?php $x++; } ?>
    <?php } ?>
</div>
