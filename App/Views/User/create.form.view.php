<?php
/** @var Array $data */

?>


<div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <h4 class="text-uppercase text-center mb-5">Create an account</h4>
                        <div class="text-center text-danger mb-3">
                            <?php echo $data['fail'] ?>
                        </div>
                        <form id="registrationForm" action="?c=user&a=store" enctype="multipart/form-data" method="post">
                            <div class="form-outline mb-4">
                                <input id="nameInput" type="text" name="username" class="form-control form-control-lg" required maxlength="10" minlength="5" autocomplete="off"/>
                                <label class="form-label">Your Name</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input id="passwordInput" type="password" name="password" class="form-control form-control-lg" required maxlength="14" minlength="6" autocomplete="off"/>
                                <label class="form-label" for="form3Example3cg">Your password</label>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input id ="registerButton" type="submit" value ="Register"
                                        class="btn btn-success btn-block btn-lg gradient-custom-4 text-body"</input>
                            </div>
                            <p class="text-center text-muted mt-5 mb-0">Already have an account? <a href="?c=auth&a=login"
                                                                                                    class="fw-bold text-body"><u>Login here</u></a></p>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

