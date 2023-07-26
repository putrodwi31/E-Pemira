<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- SEO Meta Tags -->
    <meta name="description" content="Your description" />
    <meta name="author" content="Your name" />

    <meta property="og:site_name" content="" />
    <!-- website name -->
    <meta property="og:site" content="" />
    <!-- website link -->
    <meta property="og:title" content="" />
    <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" />
    <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" />
    <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" />
    <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image" />

    <!-- Webpage Title -->
    <title> PEMIRA BEM BIU </title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet" />

    <link href="<?= base_url('old_assets/'); ?>vendors/css/bootstrap.css" rel="stylesheet" />
    <link href="<?= base_url('old_assets/'); ?>vendors/css/fontawesome-all.css" rel="stylesheet" />
    <link href="<?= base_url('old_assets/'); ?>vendors/css/swiper.css" rel="stylesheet" />
    <link href="<?= base_url('old_assets/'); ?>vendors/css/magnific-popup.css" rel="stylesheet" />
    <link href="<?= base_url('old_assets/'); ?>vendors/css/styleslogin.css" rel="stylesheet" />


    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="<?= base_url('old_assets/'); ?>login/css/style.css" />

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="<?= base_url('old_assets/'); ?>vendors/css/swiper-bundle.min.css">

    <!-- Favicon  -->
    <link rel="icon" href="<?= base_url('old_assets/'); ?>vendors/images/klogo2.png" />
</head>

<body data-spy="scroll" data-target=".fixed-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <div class="container">
            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="index.php"><img src="<?= base_url('old_assets/'); ?>vendors/images/klogo2.png" alt="" class="i-home__img">
            </a>

            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="<?= base_url(); ?>"> Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="<?= base_url(); ?>#ketua"> Ketua </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="<?= base_url(); ?>#paslon"> Paslon </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="<?= base_url('auth'); ?>"> Voting </a>
                    </li>
                </ul>
            </div>
            <!-- end of navbar-collapse -->
        </div>
        <!-- end of container -->
    </nav>

    <!--    -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        <div class="img" style="background-image: url(<?= base_url('old_assets/'); ?>vendors/images/blue.png)"></div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3><strong>Masuk</strong></h3>
                                </div>
                            </div>
                            <?= $this->session->flashdata('message'); ?>
                            <form action="<?= base_url('auth'); ?>" method="post" class="signin-form mt-4">
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" name="nim" id="nim" autocomplete="off" required />
                                    <label class="form-control-placeholder" for="username">NIM</label>
                                </div>
                                <div class="form-group" style="margin-top: 30px;">
                                    <input id="password-field" type="password" class="form-control" name="kode_akses" autocomplete="off" required required />
                                    <label class="form-control-placeholder" for="password">Kode Akses</label>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>

                                <div class="form-group d-flex">
                                    <div class="text-left">
                                        <input type="text" class="form-control" name="captcha" id="captcha" autocomplete="off" required />
                                    </div>
                                    <div class="text-right">
                                        <img class="captcha" src="<?= base_url('auth/captcha') ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3" name="login" id="login" style="color:#093d77">
                                        Masuk
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
<script src="<?= base_url('old_assets/'); ?>vendor/tilt/tilt.jquery.min.js"></script>
<script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>

<!--=============== SCROLL REVEAL ===============-->
<script src="<?= base_url('old_assets/'); ?>assets/js/scrollreveal.min.js"></script>

<!--=============== SWIPER JS ===============-->
<script src="<?= base_url('old_assets/'); ?>assets/js/swiper-bundle.min.js"></script>

<!--=============== MAIN JS ===============-->
<script src="<?= base_url('old_assets/'); ?>assets/js/main.js"></script>

<script src="<?= base_url('old_assets/'); ?>js/validator.min.js"></script>
<!-- Validator.js - Bootstrap plugin that validates forms -->
<script src="<?= base_url('old_assets/'); ?>js/scripts.js"></script>

<!-- Scripts -->
<script src="<?= base_url('old_assets/'); ?>vendors/js/jquery.min.js"></script>
<!-- jQuery for Bootstrap's JavaScript plugins -->
<script src="<?= base_url('old_assets/'); ?>vendors/js/bootstrap.min.js"></script>
<!-- Bootstrap framework -->
<script src="<?= base_url('old_assets/'); ?>vendors/js/jquery.easing.min.js"></script>
<!-- jQuery Easing for smooth scrolling between anchors -->
<script src="<?= base_url('old_assets/'); ?>vendors/js/swiper.min.js"></script>
<!-- Swiper for image and text sliders -->
<script src="<?= base_url('old_assets/'); ?>vendors/js/jquery.magnific-popup.js"></script>
<!-- Magnific Popup for lightboxes -->
<script src="<?= base_url('old_assets/'); ?>vendors/js/scripts2.js"></script>

<!--=============== SWIPER JS ===============-->
<script src="<?= base_url('old_assets/'); ?>vendors/js/swiper-bundle.min.js"></script>
<!--=============== MAIN JS ===============-->
<script src="<?= base_url('old_assets/'); ?>vendors/js/main.js"></script>
<script src="<?= base_url('old_assets/'); ?>login/js/main.js"></script>
<!-- Custom scripts -->

</html>