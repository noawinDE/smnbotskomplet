<?php require 'vendor/autoload.php';
\smnbots\Auth::getInstance()->requireLogin();
$user = \smnbots\Auth::getInstance()->getCurrentUser();
$bot = new \smnbots\Bot(0);
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
    <title>Dashboard | <?= $_LANG['BRAND_FULL'] ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet" />
    <link href="assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                            <h4 class="card-title float-left"><?= $_LANG['BOT_LIST'] ?></h4>
                            <?php if (!\smnbots\Auth::getInstance()->isAdmin()){
                                if ( $bot->countBots($user->id) < $user->max_bots || $user->max_bots == -1){ ?>
                                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#newmb"><?= ($user->max_bots == -1)? $_LANG['BOT_CREATE_UNLIMITED'] : str_replace('%cur%',$bot->countBots($user->id),str_replace('%max%',$user->max_bots,$_LANG['BOT_CREATE'])); ?></button>
                                <?php } else { ?>
                                    <p class="btn btn-primary float-right" disabled><?= $_LANG['BOT_LIMIT_REACHED'] ?></p>
                                <?php }
                            } else { ?>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#newmb"><?= $_LANG['BOT_CREATE_UNLIMITED'] ?></button>
                                <!--a class="btn btn-primary float-right mr-3 add-filter">Filter</a-->
                            <?php } ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="botlist" class="table tablesorter">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>#</th>
                                        <th><?= $_LANG['FORM_NAME'] ?></th>
                                        <th><?= $_LANG['FORM_NICKNAME'] ?></th>
                                        <th><?= $_LANG['TABLE_SERVER'] ?></th>
                                        <th><?= $_LANG['TABLE_ACTIONS'] ?></th>
                                        <?php if (\smnbots\Auth::getInstance()->isAdmin()){ ?>
                                            <th>Besitzer</th>
                                        <?php } ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (\smnbots\Auth::getInstance()->isAdmin()){
                                        if (!isset($_GET['filter'])){
                                            $_GET['filter'] = null;
                                        }
                                        switch ($_GET['filter']){
                                            case 'member':
                                                $botlist = $bot->memberBots();
                                                break;
                                            case 'admin':
                                                $botlist = $bot->adminBots();
                                                break;
                                            case 'all':
                                                $botlist = $bot->botlist();
                                                break;
                                            default:
                                                if (is_numeric($_GET['filter'])){
                                                    $botlist = $bot->userbotlist($_GET['filter']);
                                                } else {
                                                    $botlist = $bot->userbotlist($user->id);
                                                }
                                                break;
                                        }
                                    } else {
                                        $botlist = $bot->userbotlist($user->id);
                                    }
                                    if (count($botlist) == 0){ ?>
                                        <tr>
                                            <td colspan="5" class="text-center"><?= $_LANG['TABLE_NOBOTS'] ?></td>
                                        </tr>
                                    <?php } else {foreach ($botlist as $bot){?>
                                        <tr>
                                            <td>ID-<?= $bot['id'] ?></td>
                                            <td><?= $bot['interface_name'] ?></td>
                                            <td><?= $bot['name'] ?></td>
                                            <td><?= $bot['server'] ?></td>
                                            <td>
                                                <a class="btn btn-primary" href="ts-bot?id=<?= $bot['id'] ?>"><?= $_LANG['TABLE_ACTION_SEE'] ?></a>
                                            </td>
                                            <?php if (\smnbots\Auth::getInstance()->isAdmin()){ ?>
                                                <td><?php $user = \smnbots\User::findByID($bot['owner']); if($user!==NULL){echo $user->name;} else { echo "Gelöschter Benutzer";} ?>[<?= $bot['owner'] ?>]</td>
                                            <?php } ?>
                                        </tr>
                                    <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'assets/footer.php'?>
    </div>
</div>

<div class="modal fade" id="newmb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= $_LANG['MODAL_BOT_CREATE'] ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createBot">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?= $_LANG['FORM_NAME'] ?></label>
                                <input type="text" minlength="3" maxlength="28" class="form-control" name="name" placeholder="NXTBOT">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  pr-md-1">
                            <div class="form-group">
                                <label><?= $_LANG['FORM_NICKNAME'] ?></label>
                                <input type="text" minlength="3" maxlength="28" class="form-control" name="nickname" required="required" placeholder="NXTBOT">
                            </div>
                        </div>
                        <div class="col-md-6  pr-md-1">
                            <div class="form-group">
                                <label><?= $_LANG['FORM_SERVER'] ?></label>
                                <input type="text" class="form-control" name="server" required="required" placeholder="domain.de">
                            </div>
                        </div>
						<div class="col-md-12  pr-md-1">
                            <div class="form-group">
                                <label><?= $_LANG['FORM_SERVER'] ?></label>
                                <select name="rand_node_id" class="form-control">
									<option value="1">DE#01</option>
									<option value="2">DE#02</option>
								</select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal"><?= $_LANG['FORM_BUTTON_CLOSE'] ?></button>
                    <button type="submit" class="btn btn-primary" id="createBotBTN"><?= $_LANG['FORM_BUTTON_CREATE'] ?></button>
                </div>
            </form>
        </div>
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
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script>
    $('#createBot').submit(function (e) {
        e.preventDefault();
        $('#createBotBTN').prop("disabled",true);
        $.ajax({
            url: 'assets/create_bot.php',
            method: 'POST',
            data: $('#createBot').serialize()
        }).done(function(data){
            console.log(data);
            $('#createBotBTN').prop("disabled",false);
            $('#createBot').trigger("reset");
            $('#newmb').modal('hide');
            if (data === "success"){
                smnswal({
                    title: lang['BOT_CREATED'],
                    text: lang['BOT_CREATED_MESSAGE'],
                    type: "success"
                }).then(function() {
                    window.location.reload();
                });
            } else {
                smnswal({
                    title: lang['ERROR'],
                    text: lang['ERROR_MESSAGE'],
                    type: "error"
                })
            }
        });
    });

    $('.do-botstart').click(function (e) {
        e.preventDefault();
        $(this).attr('disabled', 'disabled');
        var id = $(this).data('bot-id');
        $.ajax({
            url: 'assets/save_bot.php',
            method: 'POST',
            data: {method: 'start',botid: id}
        }).done(function(data){
            $(this).removeAttr("disabled");
            if (data === "success"){
                window.location.reload();
            } else {
                smnswal({
                    title: lang['ERROR'],
                    text: lang['ERROR_MESSAGE'],
                    type: "error"
                });
            }
        });
    });

    $('.do-botstop').click(function (e) {
        e.preventDefault();
        $(this).attr('disabled', 'disabled');
        var id = $(this).data('bot-id');
        $.ajax({
            url: 'assets/save_bot.php',
            method: 'POST',
            data: {method: 'stop',botid: id}
        }).done(function(data){
            $(this).removeAttr("disabled");
            if (data === "success"){
                window.location.reload();
            } else {
                smnswal({
                    title: lang['ERROR'],
                    text: lang['ERROR_MESSAGE'],
                    type: "error"
                });
            }
        });
    });
    <?php if (\smnbots\Auth::getInstance()->isAdmin()){ ?>
    $('.add-filter').click(function (event) {
        event.preventDefault();
        var filter = prompt("Filterkriterium\nMögliche Kriterien: 'admin', 'all', 'member', '<id>'", "");
        window.location.href = '?filter='+filter;
    });
    <?php } ?>
	$(document).ready(function() {
        $('#botlist').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/German.json"
            },
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [1,2,3] }
            ]
        });
    });
</script>
<?php if (isset($_SESSION['error'])){ ?>
    <script>
        smnswal({
            title: '<?= $_SESSION['error'][0] ?>',
            html: '<?= $_SESSION['error'][1] ?>',
            type: "error",
            timer: 1500,
        })
    </script>
    <?php unset($_SESSION['error']);
} ?>
</body>

</html>