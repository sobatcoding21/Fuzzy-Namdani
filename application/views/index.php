<!DOCTYPE html>
<html lang="en">

    <head>
        <title><?= $title ?></title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        
        <link rel="icon" href="<?= base_url() ?>assets/images/logo-bpbd-kediri.png" type="image/png">
        <!-- Google font-->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
        <?php $this->load->view('inc/css') ?>
        <style>
            .pcoded .pcoded-navbar .pcoded-item > li > a {
                min-height: 57px;
                width: 220px;
            }
        </style>
    </head>

  <body>
    <!-- Pre-loader start -->
    <?php $this->load->view('inc/preload') ?>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <?php $this->load->view('inc/nav') ?>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    
                    <?php $this->load->view('inc/sidebar') ?>

                    <div class="pcoded-content">

                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10"><?= $subtitle ? $subtitle : '' ?></h5>
                                            <p class="m-b-0">BPBD Kota Kediri</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!"><?= $subtitle ? $subtitle : '' ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <?= $content ?>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php $this->load->view('inc/js') ?>

</body>

</html>
