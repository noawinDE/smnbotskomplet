<?php require 'vendor/autoload.php';
\smnbots\Auth::getInstance()->requireLogin();
$user = \smnbots\Auth::getInstance()->getCurrentUser();
$bot = new \smnbots\Bot();
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
    <title>Tickets | <?= $_LANG['BRAND_FULL'] ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet" />
    <link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <style>
        .container {
            border: 2px solid #1e1e27;
            background-color: #1e1e27;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            max-width: 100vw;
        }

        .darker {
            border-color: rgba(30, 30, 40, 0.5);
            background-color: rgba(30, 30, 40, 0.5);
        }

        .lighter {
            border-color: rgba(220, 220, 210, 0.5);
            background-color: rgba(220, 220, 210, 0.5);
        }

        .container::after {
            content: "";
            clear: both;
            display: table;
        }

        .time-right {
            float: right;
            color: #aaa;
        }

        .time-left {
            float: left;
            color: #999;
        }
        select option {
            background: #1e1e29;
            color: #fff;
            text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
        }
    </style>
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

        <?php
        if (isset($_GET['id'])){
            $ticket = \smnbots\ticket::getTicket($_GET['id']);
            if ($ticket !== false){ ?>
                <div class="content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header ">
                                    <h6 class="title d-inline"><?= $_LANG['TICKET'] ?> #<?= $_GET['id'] ?></h6>
                                </div>
                                <div class="card-body ">
                                    <div class="container lighter">
                                        <p><?= $ticket['message'] ?></p>
                                    </div>
                                    <?php
                                    $hlist = \smnbots\ticket::getAnswers($ticket['ticket_id']);

                                    foreach ($hlist as $answer){
                                        if ($answer['user_id'] == \smnbots\Auth::getInstance()->getCurrentUser()->id){
                                            $you = true;
                                        } else {
                                            $you = false;
                                        }
                                        ?>
                                        <div class="container <?php if (!$you){ echo "darker";} ?>">
                                            <p><?= $answer['message'] ?></p>
                                            <span class="<?php if ($you){ echo "time-right";} ?>"><?php if ($you){ echo "Du";} else { $user = \smnbots\User::findByID($answer['user_id']); echo $user->name; if ($user->is_admin){ echo " - ".$_LANG['EMPLOYEE'];} } ?></span>
                                        </div>
                                    <?php } ?>

                                    <?php if ($ticket['status'] != 3){ ?>
                                        <div class="container">
                                            <form method="post" id="addMessage">
                                                <input type="hidden" name="ticket_id" value="<?= $_GET['id'] ?>">
                                                <div class="form-group">
                                                    <textarea class="form-control pl-2 my-0" name="message" rows="3" placeholder="Deine Antwort"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-block btn-info float-right"><?= $_LANG['FORM_BUTTON_SEND'] ?></button>
                                            </form>
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-info" role="alert">
                                            <?= $_LANG['TICKET_CLOSED'] ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header ">
                                    <h6 class="title d-inline"><?= $_LANG['TICKET_OVERVIEW'] ?></h6>
                                </div>
                                <div class="card-body text-white">
                                    <table class="w-75 m-auto" id="ticketlist">
                                        <tr>
                                            <td class="float-left"><?= $_LANG['FORM_CATEGORY'] ?>:</td>
                                            <td class="float-right"><?= $_LANG['TICKET_CATEGORY'][$ticket['category']]; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="float-left"><?= $_LANG['FORM_DATE'] ?>:</td>
                                            <td class="float-right"><?= date($_LANG['DATE_FORMAT'],strtotime($ticket['datum'])) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="float-left"><?= $_LANG['FORM_MUSICBOT'] ?>:</td>
                                            <?php if ($ticket['bot_id'] != 0){ ?>
                                                <td class="float-right"><a href="mbot?id=<?= $ticket['bot_id'] ?>"><?= (new \smnbots\Bot())->getById($ticket['bot_id'])['name'] ?></a></td>
                                            <?php } else { ?>
                                                <td class="float-right"><?= $_LANG['TICKET_NOBOT'] ?></td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td class="float-left"><?= $_LANG['TICKET_AUTHOR'] ?>:</td>
                                            <td class="float-right"><?= \smnbots\User::findByID($ticket['user_id'])->name ?></td>
                                        </tr>
                                        <?php if ($ticket['smn_id'] != 0){ ?>
                                            <tr>
                                                <td class="float-left"><?= $_LANG['TICKET_EMPLOYEE'] ?>:</td>
                                                <td class="float-right"><?= \smnbots\User::findByID($ticket['smn_id'])->name ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4><?= $_LANG['TICKET_MANAGEMENT'] ?></h4>
                                </div>
                                <?php if ($ticket['status'] == 3){ ?>
                                    <div class="card-body" style="text-align: center;margin: auto;" data-ticket-id="<?= $_GET['id']; ?>">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-fill btn-danger" disabled><?= $_LANG['TICKET_CLOSED_SHORT'] ?></button>
											
                                        </div><br>
										<div class="btn-group">
                                            
											<button type="submit" class="btn btn-fill btn-danger do-open-ticket"><?= $_LANG['TICKET_SET_OPEN'] ?></button>
                                        </div><br>
                                    </div>
                                <?php } else { ?>
                                <div class="card-body" style="text-align: center;margin: auto;" data-ticket-id="<?= $_GET['id']; ?>">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-fill btn-danger do-close-ticket"><?= $_LANG['TICKET_SET_CLOSED'] ?></button>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else {
                header('Location: tickets');
            }} else {?>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title float-left"><?= $_LANG['MENU_TICKETS'] ?></h4>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#newticket"><?= $_LANG['TICKET_CREATE'] ?></button>
                            <!--a class="btn btn-primary float-right mr-3 add-filter">ALL</a>-->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ps ps--active-x">
                                <table class="table tablesorter " id="">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>#</th>
                                        <th><?= $_LANG['TICKET_STATUS'] ?></th>
                                        <th><?= $_LANG['FORM_CATEGORY'] ?></th>
                                        <th><?= $_LANG['TABLE_TITLE'] ?></th>
                                        <th><?= $_LANG['TABLE_BOT'] ?></th>
                                        <th><?= $_LANG['TICKET_MANAGEMENT'] ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $userid = \smnbots\Auth::getInstance()->getCurrentUser()->id;
                                    if (\smnbots\Auth::getInstance()->isAdmin()){
                                        if (!isset($_GET['filter'])){
                                            $_GET['filter'] = null;
                                        }
                                        switch (strtolower($_GET['filter'])){
                                            case 'all':
                                                $list = \smnbots\ticket::ticketlist();
                                                break;
                                            default:
                                                $list = \smnbots\ticket::ticketliststs(0);
                                               
					    break;
                                        }
                                    } else {
                                        $list = \smnbots\ticket::ticketlistUser($userid);
                                    }
                                    if (sizeof($list) == 0){
                                        echo '<td align="center" colspan="5">'.$_LANG['TABLE_NOTICKETS'].'</td>';
                                    } else {
                                    foreach ($list as $ticket){ ?>
                                        <tr>
                                            <td>
                                                JFT-<?= $ticket['ticket_id'] ?>
                                            </td>
                                            <td>
                                                <?php switch ($ticket['status']){
                                                    case 0;
                                                        echo $_LANG['TICKET_STATUSES'][0];
                                                        break;
                                                    case 1;
                                                        echo $_LANG['TICKET_STATUSES'][1];
                                                        break;
                                                    case 2:
                                                        echo $_LANG['TICKET_STATUSES'][2];
                                                        break;
                                                    case 3;
                                                        echo $_LANG['TICKET_STATUSES'][3];
                                                        break;
                                                }
                                                if ($userid !== $ticket['user_id']){
                                                    echo " [ADMIN]";
                                                }?>
                                            </td>
                                            <td>
                                                <?= $_LANG['TICKET_CATEGORY'][$ticket['category']]; ?>
                                            </td>
											<td>
                                                <?= $ticket['name'] ?>
                                            </td>
                                            <td>
                                                <?php if($ticket['bot_id'] != 0){ echo (new smnbots\Bot(1))->getById($ticket['bot_id'])['name'];} else { echo $_LANG['TICKET_NOBOT'];} ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="?id=<?= $ticket['ticket_id'] ?>"><?= $_LANG['TABLE_ACTION_SEE'] ?></a>
                                            </td>
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
        <?php } ?>
        <?php include 'assets/footer.php'?>
    </div>

    <div class="modal fade" id="newticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= $_LANG['TICKET_CREATE'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createTicket">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6  pr-md-1">
                                <div class="form-group">
                                    <label><?= $_LANG['TABLE_TITLE'] ?></label>
                                    <input type="text" class="form-control" name="title" required="required" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6  pr-md-1">
                                <div class="form-group">
                                    <label><?= $_LANG['TICKET_U_BOT'] ?></label>
                                    <select class="form-control" name="botid" required="required">
                                        <option value="0">Kein Bot betroffen</option>
                                        <?php foreach ((new \smnbots\Bot())->userbotlist(\smnbots\Auth::getInstance()->getCurrentUser()->id) as $bot){ ?>
                                            <option value="<?= $bot['id'] ?>"><?= $bot['name'] ?></option>
                                            
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12  pr-md-1">
                                <div class="form-group">
                                    <label><?= $_LANG['FORM_CATEGORY'] ?></label>
                                    <select class="form-control" name="category" required="required">
                                        <option value="0"><?= $_LANG['TICKET_CATEGORY'][0] ?></option>
                                        <option value="1"><?= $_LANG['TICKET_CATEGORY'][1] ?></option>
										<option value="2" selected><?= $_LANG['TICKET_CATEGORY'][2] ?></option>
										<option value="3" selected><?= $_LANG['TICKET_CATEGORY'][3] ?></option>
										<option value="4" selected><?= $_LANG['TICKET_CATEGORY'][4] ?></option>

                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-md-1">
                                <div class="form-group">
                                    <label><?= $_LANG['TICKET_MESSAGE'] ?></label>
                                    <textarea rows="4" class="form-control" placeholder="<?= $_LANG['TICKET_MESSAGE_PLACEHOLDER'] ?>" name="message" required="required"></textarea>
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
    <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/black-dashboard.min.js?v=1.0.0"></script>
    <script src="assets/js/smnbots.js"></script>
    <script>
        $('#addMessage').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'assets/add_ticket.php',
                method: 'POST',
                data: $('#addMessage').serialize()
            }).done(function(data){
                console.log(data);
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

        $('#createTicket').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'assets/create_ticket.php',
                method: 'POST',
                data: $('#createTicket').serialize()
            }).done(function(data){
                console.log(data);
                if (data === "success"){
                    window.location.reload();
                } else if (data === "tomuch") {
                    smnswal({
                        title: lang['TICKET_TO_MUCH'],
                        text: lang['TICKET_TO_MUCH_MESSAGE'],
                        type: "error"
                    });
                } else {
                    smnswal({
                        title: lang['ERROR'],
                        text: lang['ERROR_MESSAGE'],
                        type: "error"
                    });
                }
            });
        });

        $('.do-close-ticket').click(function (e) {
            e.preventDefault();
            var id = $(this).parent().parent().data('ticket-id');
            $.ajax({
                url: 'assets/close_ticket.php',
                method: 'POST',
                data: {tid: id}
            }).done(function(data){
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
		$('.do-open-ticket').click(function (e) {
            e.preventDefault();
            var id = $(this).parent().parent().data('ticket-id');
            $.ajax({
                url: 'assets/open_ticket.php',
                method: 'POST',
                data: {tid: id}
            }).done(function(data){
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
            window.location.href = '?filter=all';
        });
        $(document).ready(function() {
            $('#ticketlist').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/German.json"
                },
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [1,2,3] }
                ]
            });
        });
        <?php } ?>
    </script>
</body>

</html>