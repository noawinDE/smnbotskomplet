<?php require 'vendor/autoload.php';
\smnbots\Auth::getInstance()->requireAdmin();
$user = \smnbots\Auth::getInstance()->getCurrentUser();
$_LANG = \smnbots\translation::getPHP();
?>
<!DOCTYPE html>
<html lang="de">

<head>
	<script src="https://wchat.freshchat.com/js/widget.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>Admin | <?= $_LANG['BRAND_FULL'] ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet" />
    <link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title"> Nutzerverwaltung</h4>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#newuser">Nutzer hinzufügen</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ps">
                                <table class="table" id="userlist">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email </th>
										<th>Max Bots</th>
										<th>Aktiviert</th>
										<th>Rang</th>
										<th></th>
                                        <th>Aktionen</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach (\smnbots\User::listUsers() as $user){ ?>
                                        <tr>
                                            <td><?= $user['id'] ?></td>
                                            <td><?= $user['name'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= $user['max_bots'] ?></td>
                                            <td><?= $user['is_active'] ?></td>
											<td><?= $_LANG['USER_N'][$user['is_nutzer']]; ?><?= $_LANG['USER_P'][$user['is_partner']]; ?><?= $_LANG['USER_H'][$user['is_headdev']]; ?><?= $_LANG['USER_D'][$user['is_dev']]; ?><?= $_LANG['USER_S'][$user['is_sup']]; ?><?= $_LANG['USER_A'][$user['is_admin']]; ?></td>
											<td><?= $user['info@NXTBOTS.de'] ?></td>
											
                                            <td><button type="button" class="btn btn-primary do-edituser" data-user-id="<?= $user['id'] ?>">Verwalten</button></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<!--
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Changelog</h4>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#newchangelog">Changelog hinzufügen</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ps">
                                <table class="table" id="userlist">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Titel</th>
                                        <th>Datum</th>
                                        <th>Aktionen</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach (\smnbots\changelog::getChangelogs() as $changelog){ ?>
                                        <tr>
                                            <td><?= $changelog['id'] ?></td>
                                            <td><?= $changelog['title'] ?></td>
                                            <td><?= date('d.m.y H:i',strtotime($changelog['date'])) ?></td>
                                            <td><button type="button" class="btn btn-primary do-deletecl" data-cl-id="<?= $changelog['id'] ?>">Löschen</button></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			-->
        </div>
        <?php include 'assets/footer.php'?>
    </div>
</div>
<div class="modal fade" id="newuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nutzer anlegen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createUser">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6  pr-md-1">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required="required" placeholder="Max Mustermann">
                            </div>
                        </div>
                        <div class="col-md-6  pr-md-1">
                            <div class="form-group">
                                <label>E-Mail</label>
                                <input type="email" class="form-control" name="email" required="required" placeholder="Max@Mustermann.de">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-primary" id="createUserBTN">Erstellen</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="userinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="userinfocontent">
        </div>
    </div>
</div>
<div class="modal fade" id="newchangelog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Changelog anlegen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createCL" method="post" autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12  pr-md-1">
                            <div class="form-group">
                                <label>Titel</label>
                                <input type="text" class="form-control" name="name" required="required" placeholder="Titel">
                            </div>
                        </div>
                        <div class="col-md-12  pr-md-1">
                            <div class="form-group">
                                <label>Nachricht</label>
                                <textarea name="message" required class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-primary" id="createCLBTN">Erstellen</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/js/plugins/sweetalert2.min.js"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/black-dashboard.min.js?v=1.0.0"></script>
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/smnbots.js"></script>
<script src="assets/js/admin.js"></script>
</body>

</html>