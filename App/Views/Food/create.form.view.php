<?php
/** @var Food $data */
use App\Models\Food;
?>


<?php if ($data == null) { ?>
<form name="registration" method="post" action="?c=food&a=store" enctype="multipart/form-data">
<div class="container justify-content-center">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-9">
            <h1 class="text-white mb-4">Create food</h1>
            <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="row align-items-center pt-4 pb-3">
                        <div class="col-md-3 ps-5">
                            <h6 class="mb-0">Food name</h6>
                        </div>
                        <div class="col-md-9 pe-5">
                            <input type="text" name = "name" class="form-control form-control-lg" />
                        </div>
                    </div>
                    <hr class="mx-n3">
                    <div class="row align-items-center py-3">
                        <div class="col-md-3 ps-5">
                            <h6 class="mb-0">Food Price</h6>
                        </div>
                        <div class="col-md-9 pe-5">
                            <input type="double" name = "price" class="form-control form-control-lg" />
                        </div>
                    </div>
                    <hr class="mx-n3">
                    <div class="row align-items-center py-3">
                        <div class="col-md-3 ps-5">
                            <h6 class="mb-0">Upload Food Image</h6>
                        </div>
                        <div class="col-md-9 pe-5">
                            <input class="form-control form-control-lg" name="image" type="file" />
                        </div>
                    </div>
                    <hr class="mx-n3">
                    <div class="row align-items-center py-3">
                        <div class="col-md-3 ps-5">
                            <h6 class="mb-0">Select food type</h6>
                        </div>
                        <div class="col-md-9 pe-5">
                            <select type="string" name="type">
                                <option value="burger">burger</option>
                                <option value="pizza">pizza</option>
                                <option value="drink">drink</option>
                            </select>
                        </div>
                    </div>
                    <hr class="mx-n3">
                    <div class="px-5 py-4">
                        <input type="submit" value = "Create food" class="btn btn-primary btn-lg"</input>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

<?php } else { ?>
    <form method="post" action="?c=food&a=update&id=<?php echo $data->getId() ?>" enctype="multipart/form-data">
        <div class="container justify-content-center">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-9">
                    <h1 class="text-white mb-4">Update food</h1>
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">
                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Food name</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input type="text"name = "name" class="form-control form-control-lg" />
                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Food Price</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input type="double" name = "price" class="form-control form-control-lg" />
                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Upload Food Image</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input class="form-control form-control-lg" name="image" type="file" />
                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="px-5 py-4">
                                <input type="submit" value = "Update food" class="btn btn-primary btn-lg"</input>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </form>



<?php } ?>