<?php require 'vendor/autoload.php';
\smnbots\Auth::getInstance()->requireLogin();
$user = \smnbots\Auth::getInstance()->getCurrentUser();
$_LANG = \smnbots\translation::getPHP();
?>
<!DOCTYPE html>
<html lang="<?= $_LANG['HTML'] ?>">

<head>
	<script src="https://wchat.freshchat.com/js/widget.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>Account | <?= $_LANG['BRAND_FULL'] ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet" />
    <link href="assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
</head>

<body class="">
<div class="wrapper">
    <!--<div class="sidebar" data-color="red">
        <div class="sidebar-wrapper">
            <?php include 'assets/header.php'?>
            <ul class="nav">
                <li>
                    <a href="./dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <p><?= $_LANG['MENU_DASHBOARD'] ?></p>
                    </a>
                </li>
                <li>
                    <a href="./bots">
                        <i class="fas fa-hdd"></i>
                        <p><?= $_LANG['MENU_MUSICBOTS'] ?></p>
                    </a>
                </li>
                <li class="active">
                    <a href="./tickets">
                        <i class="fas fa-ticket-alt"></i>
                        <p><?= $_LANG['MENU_TICKETS'] ?></p>
                    </a>
                </li>
                <li>
                    <a href="./account">
                        <i class="far fa-user"></i>
                        <p><?= $_LANG['MENU_PROFILE'] ?></p>
                    </a>
                </li>
                <?php if (\smnbots\Auth::getInstance()->isAdmin()){ ?>
                    <li><hr></li>
                    <li>
                        <a href="./admin">
                            <i class="fas fa-cog"></i>
                            <p>Administration</p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>-->
	
	<?php include 'assets/nav.php'?>
    
        <!-- End Navbar -->
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title"><?= $_LANG['PROFILE_INFO'] ?></h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_NAME'] ?></label>
                                            <input type="text" class="form-control" readonly="readonly" placeholder="<?= $_LANG['FORM_NAME'] ?>" value="<?= $user->name ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-md-1">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_EMAIL'] ?></label>
                                            <input type="text" class="form-control" readonly="readonly" placeholder="<?= $_LANG['FORM_EMAIL'] ?>" value="<?= $user->email ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   <!--<div class="card">
                        <div class="card-header">
                            <h5 class="title"><?= $_LANG['EDIT_ADDRESS'] ?></h5>
                        </div>
                        <form id="address_info">
                            <div class="card-body">
                                <input type="hidden" name="method" value="adress">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_STREET'] ?></label>
                                            <input type="text" class="form-control" name="street" value="<?= $user->addr_street ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-md-1">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_STREET_NUMBER'] ?></label>
                                            <input type="text" class="form-control" name="street_number" value="<?= $user->addr_number ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 pr-md-1">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_ZIP'] ?></label>
                                            <input type="text" class="form-control" name="zip" value="<?= $user->addr_plz ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-8 pl-md-1">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_CITY'] ?></label>
                                            <input type="text" class="form-control" name="city" value="<?= $user->addr_city ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12  px-md-3">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_COUNTRY'] ?></label>
                                            <input type="text" class="form-control" name="country" value="<?= $user->addr_country?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary float-right" id="address_infobtn"><?= $_LANG['FORM_BUTTON_SAVE'] ?></button>
                            </div>
                        </form>
                    </div>-->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="title"><?= $_LANG['EDIT_PASSWORD'] ?></h5>
                        </div>
                        <form id="password_reset">
                            <input type="hidden" name="method" value="password">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_PASSWORD'] ?></label>
                                            <input type="password" name="password" required class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-md-1">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_PASSWORD_REPEAT'] ?></label>
                                            <input type="password" name="password_repeat" required class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary float-right" id="password_resetbtn"><?= $_LANG['FORM_BUTTON_SAVE'] ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="card-body">
                            <p class="card-text">
                            </p><div class="author">
                                <div class="block block-one"></div>
                                <div class="block block-two"></div>
                                <div class="block block-three"></div>
                                <div class="block block-four"></div>
                                <a href="javascript:void(0)">
                                    <img class="avatar" src="assets/img/<?= $user->profile_img ?>" alt="...">
                                    <h5 class="title"><?= $user->name ?></h5>
                                </a>
                                <?php if ($user->is_admin){ ?>
                                    <p class="description">
                                        Administrator
                                    </p>
                                <?php } ?>
								
								<?php if ($user->is_headdev){ ?>
                                    <p class="description">
                                        Head-Developer
                                    </p>
                                <?php } ?>
								
								<?php if ($user->is_dev){ ?>
                                    <p class="description">
                                        Developer
                                    </p>
                                <?php } ?>
								
								<?php if ($user->is_sup){ ?>
                                    <p class="description">
                                        Supporter
                                    </p>
                                <?php } ?>
								
								<?php if ($user->is_nutzer){ ?>
                                    <p class="description">
                                        Nutzer
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= $_LANG['DELETE_USER'] ?></h4>
                        </div>
                        <div class="card-footer row" style="text-align: center;margin: auto;" data-bot-id="<?= $_GET['id']; ?>">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-fill btn-danger float-right do-deleteme"><?= $_LANG['DELETE_USER'] ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'assets/footer.php'?>
    </div>
</div>

<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<?= \smnbots\translation::getJS(); ?>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/js/plugins/sweetalert2.min.js"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/black-dashboard.min.js?v=1.0.0"></script>
<script src="assets/js/smnbots.js"></script>
<script>
    $('#password_reset').submit(function (e) {
        e.preventDefault();
        $('#password_resetbtn').prop('disabled',true);
        $.ajax({
            url: 'assets/save_profile.php',
            method: 'POST',
            data: $('#password_reset').serialize()
        }).done(function(data){
            $('#password_reset').trigger('reset');
            $('#password_resetbtn').prop('disabled',false);
            if (data === "success") {
                window.location.href = 'logout.php';
            } else if(data === "nomatch"){
                smnswal({
                    title: lang['ERROR'],
                    text: lang['PASSWORD_CHANGED_EMESSAGE'],
                    type: "warning"
                })
            } else {
                smnswal({
                    title: lang['ERROR'],
                    text: lang['ERROR_MESSAGE'],
                    type: "error"
                })
            }
        });
    });
    $('#address_info').submit(function (e) {
        e.preventDefault();
        $('#address_infobtn').prop('disabled',true);
        $.ajax({
            url: 'assets/save_profile.php',
            method: 'POST',
            data: $('#address_info').serialize()
        }).done(function(data){
            $('#address_infobtn').prop('disabled',false);
            if (data === "success") {
                smnswal({
                    title: lang['ADDRESS_CHANGED'],
                    text: lang['ADDRESS_CHANGED_MESSAGE'],
                    type: "success"
                })
            } else {
                $('#address_info').trigger('reset');
                smnswal({
                    title: lang['ERROR'],
                    text: lang['ERROR_MESSAGE'],
                    type: "error"
                })
            }
        });
    });
    $('.do-deleteme').click(function (e) {
        e.preventDefault();
        smnswal({
            title: lang['DELETE_USER'],
            text: lang['DELETE_USER_SURE'],
            showCancelButton: true,
            confirmButtonText: 'Löschen',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                $.ajax({
                    url: 'assets/delete_me.php',
                    method: 'POST',
                    data: {method: 'delete'}
                }).done(function(data){
                    if (data === "success"){
                        window.location.href = 'logout.php';
                    } else {
                        smnswal({
                            title: lang['ERROR'],
                            text: lang['ERROR_MESSAGE'],
                            type: "error"
                        });
                    }
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    });
</script>
</body>

</html>