<?php
/** @var \App\Core\IAuthenticator $auth */
/** @var Array $data */

?>


<form method="post" action="?c=review&a=store&food=<?php echo $data['food']?>&user=<?= $auth->getLoggedUserName() ?>" enctype="multipart/form-data">
    <div class="container justify-content-center">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                <h1 class="text-white mb-4">Write a review</h1>
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="row align-items-center pt-4 pb-3">
                            <div class="text-center text-danger mb-3">
                                <?php echo $data['fail'] ?>
                            </div>
                            <div class="col-md-3 ps-5">
                                <h6 class="mb-0">1-5 rating</h6>
                            </div>
                            <div class="col-md-9 pe-5">
                                <select type="int" name="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <hr class="mx-n3">
                        <div class="row align-items-center py-3">
                            <div class="col-md-3 ps-5">
                                <h6 class="mb-0">Comment</h6>
                            </div>
                            <div class="col-md-9 pe-5">
                                <input type="text" name = "comment" class="form-control form-control-lg" />
                            </div>
                        </div>
                        <hr class="mx-n3">
                        <div class="px-5 py-4">
                            <input type="submit" value = "Post review" class="btn btn-primary btn-lg"</input>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</form>