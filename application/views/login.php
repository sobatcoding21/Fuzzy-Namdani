
<!DOCTYPE html>
<html lang="en">

    <head>
            <title>Login | BPBD Kota Kediri</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <!-- Favicon icon -->

            <link rel="icon" href="<?= base_url() ?>assets/images/logo-bpbd-kediri.png" type="image/png">
            <!-- Google font-->     
            <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
            <!-- Required Fremwork -->
            <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap/css/bootstrap.min.css">
            <!-- waves.css -->
            <link rel="stylesheet" href="<?= base_url() ?>assets/pages/waves/css/waves.min.css" type="text/css" media="all">
            <!-- themify-icons line icon -->
            <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/icon/themify-icons/themify-icons.css">
            <!-- ico font -->
            <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/icon/icofont/css/icofont.css">
            <!-- Font Awesome -->
            <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/icon/font-awesome/css/font-awesome.min.css">
            <!-- Style.css -->
            <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
    </head>

    <body themebg-pattern="theme1">
        <!-- Pre-loader start -->
        <div class="theme-loader">
            <div class="loader-track">
                <div class="preloader-wrapper">
                    <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="spinner-layer spinner-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    
                    <div class="spinner-layer spinner-yellow">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    
                    <div class="spinner-layer spinner-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pre-loader end -->

        <section class="login-block">
            <!-- Container-fluid starts -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Authentication card start -->
                        
                            <form class="md-float-material form-material" action="<?= base_url('login') ?>" method="POST">
                                <div class="text-center">
                                    <img src="<?= base_url() ?>assets/images/logo-bpbd-kediri.png" alt="Logo BPBD Kota Kediri" width="150">
                                </div>
                                
                                <div class="auth-box card">
                                    <div class="card-block">
                                        <?php if( $this->session->userdata('_message') ) { ?>
                                        <div class="alert bg-danger mb-4">
                                            <strong>Login Gagal!</strong> <?= $this->session->userdata('_message') ?>
                                        </div>
                                        <?php } ?>
                                        <div class="row m-b-20">
                                            <div class="col-md-12">
                                                <h3 class="text-center">Log In</h3>
                                            </div>
                                        </div>
                                        <div class="form-group form-primary">
                                            <input type="text" name="username" class="form-control" required="" autocomplete="off">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Your Username</label>
                                        </div>
                                        <div class="form-group form-primary">
                                            <input type="password" name="password" class="form-control" required="" autocomplete="off">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Password</label>
                                        </div>
                                        
                                        <div class="row m-t-30">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Log in</button>
                                            </div>
                                        </div>
                                        <hr/>
                                        
                                    </div>
                                </div>
                            </form>
                            <!-- end of form -->
                    </div>
                    <!-- end of col-sm-12 -->
                </div>
                <!-- end of row -->
            </div>
            <!-- end of container-fluid -->
        </section>
    
        <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery/jquery.min.js"></script>     
        <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-ui/jquery-ui.min.js "></script>     
        <script type="text/javascript" src="<?= base_url() ?>assets/js/popper.js/popper.min.js"></script>     
        <script type="text/javascript" src="<?= base_url() ?>assets/js/bootstrap/js/bootstrap.min.js "></script>
        <!-- waves js -->
        <script src="<?= base_url() ?>assets/pages/waves/js/waves.min.js"></script>
        <!-- jquery slimscroll js -->
        <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
        <!-- modernizr js -->
        <script type="text/javascript" src="<?= base_url() ?>assets/js/SmoothScroll.js"></script>
        <script src="<?= base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/common-pages.js"></script>
    </body>

</html>
