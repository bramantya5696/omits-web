<!DOCTYPE html>
<html lang="id">
<?= $this->include('head', [$title]); ?>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                                    </div>
                                    <?php if($msg = session()->getFlashdata('msg')): ?>
                                    <div class="alert alert-danger">
                                        <?= $msg ?>
                                    </div>
                                    <?php endif; ?>
                                    <form class="user" action="auth/resetpassword" method="POST">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="id" id="id" value="<?= session()->get('reset_id') ?>">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                            name="password" id="password" placeholder="Password Baru">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Submit
                                        </button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>