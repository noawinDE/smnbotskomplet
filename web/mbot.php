<?php require 'vendor/autoload.php';
\smnbots\Auth::getInstance()->requireLogin();
$user = \smnbots\Auth::getInstance()->getCurrentUser();
$botsys = new \smnbots\Bot();
$_LANG = \smnbots\translation::getPHP();
if (isset($_GET['id'])){
    $error = false;
    $online = false;
    $botdb = $botsys->getById($_GET['id']);
    if (empty($botdb)){
        $_SESSION['error'] = array($_LANG['BOT_NOT_FOUND'],$_LANG['BOT_NOT_FOUND_MESSAGE']);
        header('Location: dashboard');
    } elseif($botdb['owner'] !== $user->id && !\smnbots\Auth::getInstance()->isAdmin()){
        $_SESSION['error'] = array($_LANG['BOT_NOT_FOUND'],$_LANG['BOT_NOT_FOUND_MESSAGE']);
        header('Location: dashboard');
    } else {
        if ($botdb['node'] !== 1){
            $botsys = new \smnbots\Bot($botdb['node']);
        }
        if ($botdb['botid'] == null){
            $error = true;
            if (\smnbots\Config::DEBUG){
                echo "BotID nicht vorhanden: In Botliste nach template suchen";
            }
        } else {
            $bot = $botsys->getBot();
            $bot->getCommandExecutor()->use($botdb['botid']);
            $botinfo = $bot->getCommandExecutor()->info();
            if (isset($botinfo['ErrorCode'])){
                $error = true;
                if (\smnbots\Config::DEBUG){
                    echo "Bot ist nicht vorhanden oder anderer error";
                    var_dump($botinfo);
                }
            } elseif ($botinfo['Name'] !== $botdb['template']){
                $error = true;
                if (\smnbots\Config::DEBUG){
                    echo "Bot wurde gefunden aber stimmt nicht mit der DB überein";
                }
            } else {
                $online = true;
                $botsettings['connect'] = $bot->getCommandExecutor()->getBotSettings($botinfo['Name'],'connect');
                $botsettings['song'] = $botdb['audio.stream'];
                $botsettings['volume'] = $botdb['audio.volume'];
                $botsettings['channel_commander'] = $botdb['channel_commander'];
            }
        }
        if ($error){
            $list = $botsys->getBot()->getCommandExecutor()->listBots();
            $key = array_search($botdb['template'],array_column($list,'Name'));
            if ($key !== false){
                if($list[$key]['Status'] === 2){
                    $online = true;
                    $botsys->updateBId($list[$key]['Id'],$botdb['template']);
                    $bot->getCommandExecutor()->use($list[$key]['Id']);
                    $botsettings['connect'] = $bot->getCommandExecutor()->getBotSettings($botdb['template'],'connect');
                    $botsettings['song'] = $botdb['audio.stream'];
                    $botsettings['volume'] = $botdb['audio.volume'];
                    $botsettings['channel_commander'] = $botdb['channel_commander'];
                    if (\smnbots\Config::DEBUG){
                        echo "<pre>Bot ist Online und wird vom System und DB geholt</pre>";
                    }
                } else {
                    $online = false;
                    $botsys->setOffline($botdb['template']);
                    $bot = $botsys->getByTemplate($botdb['template']);
                    $botsettings['connect'] = array('name' => $bot['name'], 'address' => $bot['server'],"server_password" => array("pw" => $bot['host_password']),'channel' => $bot['default_channel']);
                    $botsettings['QueryConnection'] = array('DefaultChannel' => $bot['default_channel']);
                    $botsettings['song'] = $bot['audio.stream'];
                    $botsettings['volume'] = $bot['audio.volume'];
                    $botsettings['channel_commander'] = $bot['channel_commander'];
                    if (\smnbots\Config::DEBUG){
                        echo "<pre>Bot ist Offline und wird aus DB geladen</pre>";
                    }
                }
            } else {
                $online = false;
                $botsys->setOffline($botdb['template']);
                $bot = $botsys->getByTemplate($botdb['template']);
                $botsettings['connect'] = array('name' => $bot['name'], 'address' => $bot['server'],"server_password" => array("pw" => $bot['host_password']),'channel' => $bot['default_channel']);
                $botsettings['QueryConnection'] = array('DefaultChannel' => $bot['default_channel']);
                $botsettings['song'] = $bot['audio.stream'];
                $botsettings['volume'] = $bot['audio.volume'];
                $botsettings['channel_commander'] = $bot['channel_commander'];
                if (\smnbots\Config::DEBUG){
                    echo "<pre>Bot ist Offline und wird aus DB geladen</pre>";
                }
            }
        }
    }
} else {
    header('Location: dashboard');
}
?>
<!DOCTYPE html>
<html lang="<?= $_LANG['HTML'] ?>">

<head>
	<script src="https://wchat.freshchat.com/js/widget.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>Control | NXTBOTS</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet" />
    <link href="assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <style>
        #ownerchange option {
            margin: 40px;
            background: #1e1e2f;
            color: rgba(255, 255, 255, 0.8);
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
    
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="card pb-3">
                        <div class="card-header">
                            <h4><?= $_LANG['MBOT_CONNECTION'] ?></h4>
                        </div>
                        <form id="connectionsettings">
                            <input type="hidden" name="botid" value="<?= $_GET['id'] ?>">
                            <input type="hidden" name="method" value="connection">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6  pr-md-1">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_NICKNAME'] ?></label>
                                            <input type="text" class="form-control" name="nickname" required="required" placeholder="<?= $botsettings['connect']['name'] ?>" value="<?= $botsettings['connect']['name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6  pr-md-1">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_SERVER'] ?></label>
                                            <input type="text" class="form-control" name="server" required="required" placeholder="<?= $botsettings['connect']['address'] ?>" value="<?= $botsettings['connect']['address'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6  pr-md-1">
                                        <div class="form-group">
                                            <label><?= $_LANG['FROM_HOST_PASSWORD'] ?></label>
                                            <input type="text" class="form-control" name="hostpassword" placeholder="<?= $botsettings['connect']['server_password']['pw'] ?>" value="<?= $botsettings['connect']['server_password']['pw'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6  pr-md-1">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_DEFAULT_CHANNEL'] ?></label>
                                            <?php if (strpos($botsettings['connect']['channel'], '/') === 0) {
                                                $botsettings['connect']['channel'] = ltrim($botsettings['connect']['channel'],'/');
                                            } ?>
                                            <input type="text" class="form-control" name="default_channel" placeholder="<?= $botsettings['connect']['channel'] ?>" value="<?= $botsettings['connect']['channel'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_CURRENT_SONG'] ?></label>
                                            <?php
                                            if ($online){
                                                $req = $botsettings['song'];
                                                if (isset($req['ErrorName'])){
                                                    $song = $_LANG['BOT_NOT_PLAYING'];
                                                } else {
                                                    $song = $req;
                                                }
                                            } else {
                                                $song = $_LANG['BOT_OFFLINE'];
                                            } ?>
                                            <input type="text" class="form-control" id="currentsong" readonly="readonly" value="<?= $song ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary float-right"><?= $_LANG['FORM_BUTTON_SAVE'] ?></button>
                            </div>
                        </form>
                    </div>
                    <div class="card pb-3">
                        <div class="card-header">
                            <h4><?= $_LANG['MBOT_MUSIC'] ?></h4>
                        </div>
                        <form id="audiosettings">
                            <input type="hidden" name="botid" value="<?= $_GET['id'] ?>">
                            <input type="hidden" name="method" value="audio">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_STREAM_URL'] ?></label>
                                            <?php
                                            if ($online){
                                                $req = $botsettings['song'];
                                                if (isset($req['ErrorName'])){
                                                    $stream = 'value="'.$_LANG['ERROR_RELOAD'].'" readonly';
                                                } else {
                                                    $stream = 'value='.$req;
                                                }
                                            } else {
                                                $stream = 'value="'.$_LANG['BOT_OFFLINE'].'" readonly';
                                            } ?>
                                            <input type="text" class="form-control" name="streamurl" required="required" placeholder="STREAM LINK EINTRAGEN" <?= $stream ?>>
                                            <input type="hidden" name="oldstream" <?= $stream ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?= $_LANG['FORM_VOLUME'] ?></label>
                                            <?php if ($online){ ?>
                                                <input type="range" min="0" max="100" value="<?= $botsettings['volume'] ?>" class="volume-slider" id="myRange" name="volume">
                                                <small id="volume-display"><?= $_LANG['FORM_VOLUME'] ?>: <?= $botsettings['volume'] ?>%</small>
                                            <?php } else { ?>
                                                <br>
                                                <small id="volume-display"><?= $_LANG['BOT_VOLUME_NEED_START'] ?></small>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="checkbox" value="true" name="channelcommander" id="cccb" <?php if ($botsettings['channel_commander']){echo "checked";} ?>>
                                            <label for="cccb"><?= $_LANG['FORM_CHANNEL_COMMANDER'] ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-left"  data-bot-id="<?= $_GET['id']; ?>">
                                    <button class="btn btn-fill btn-primary do-playmusic"><i class="fas fa-play"></i></button>
                                    <button class="btn btn-fill btn-primary do-pausemusic"><i class="fas fa-pause"></i></button>
                                </div>
                                <button type="submit" class="btn btn-fill btn-primary float-right"><?= $_LANG['FORM_BUTTON_SAVE'] ?></button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="float-left"><?= $_LANG['MBOT_QUICKPLAY'] ?></h4>
                            <button type="button" class="btn btn-dark float-right do-customquickplay"><?= $_LANG['FORM_BUTTON_CUSTOM'] ?></button>
                        </div>
                        <form id="audiosettings">
                            <div class="card-body text-white">
                                <div id="accordion">
                                    <?php $iqp = 0; foreach (\smnbots\Bot::getQuickPlay() as $name => $items){ ?>
                                        <div class="card">
                                            <div class="card-header p-0" id="heading<?= $iqp ?>">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link text-white qp-button" data-toggle="collapse" data-target="#qp<?= $iqp ?>" aria-expanded="true" aria-controls="qp<?= $iqp ?>">
                                                        <?= $name ?>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="qp<?= $iqp ?>" class="collapse" aria-labelledby="qp<?= $iqp ?>" data-parent="#accordion">
                                                <div class="card-body">
                                                    <table class="w-100 m-auto" data-bot-id="<?= $_GET['id'] ?>">
                                                        <?php foreach ($items as $sname => $stream){ ?>
                                                            <tr>
                                                                <td class="float-left m-2" style="height: 21px;line-height: 40px;"><?= $sname ?></td>
                                                                <td class="float-right m-2"><button data-stream-url="<?= $stream ?>" class="btn btn-fill btn-primary float-right do-quickplay"><?= $_LANG['FORM_PLAY'] ?></button></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $iqp++; } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4><?= $_LANG['MBOT_INFORMATION'] ?></h4>
                        </div>
                        <div class="card-body text-white">
                            <table class="w-75 m-auto">
                                <tr>
                                    <td class="float-left"><?= $_LANG['MBOT_ONLINE'] ?>:</td>
                                    <?php if ($online){ ?>
                                        <td class="float-right" style="color: green;"><?= $_LANG['YES'] ?></td>
                                    <?php } else { ?>
                                        <td class="float-right" style="color: red"><?= $_LANG['NO'] ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td class="float-left"><?= $_LANG['FORM_NICKNAME'] ?>:</td>
                                    <td class="float-right"><?= strip_tags($botsettings['connect']['name']) ?></td>
                                </tr>
                                <tr>
                                    <td class="float-left"><?= $_LANG['FORM_SERVER'] ?>:</td>
                                    <td class="float-right"><?= strip_tags($botsettings['connect']['address']) ?></td>
                                </tr>
                                <tr>
                                    <td class="float-left"><?= $_LANG['FORM_ID'] ?>:</td>
                                    <td class="float-right"><?= strip_tags($_GET['id']) ?></td>
                                </tr>
                                <tr>
                                    <td class="float-left"><?= $_LANG['FORM_NODE'] ?>:</td>
                                    <td class="float-right"><?= strip_tags($botdb['node']) ?></td>
                                </tr>
								<?php if (\smnbots\Auth::getInstance()->isAdmin()){ ?>
								<tr>
                                    <td class="float-left">Template:</td>
                                    <td class="float-right"><?= strip_tags($botdb['template']) ?></td>
                                </tr>
								
								<?php } ?>
                            </table>
                        </div>
                        <div class="card-footer row" style="text-align: center;margin: auto" data-bot-id="<?= $_GET['id']; ?>">
                            <div class="btn-group">
							<?php if($online){ ?>
								<button type="submit" class="btn btn-fill btn-warning float-right do-botstop" id="bot-stop"><?= $_LANG['MBOT_STOP'] ?></button>
							<?php } else { ?>
								<button type="submit" class="btn btn-fill btn-success float-right do-botstart" id="bot-start"><?= $_LANG['MBOT_START'] ?></button>
							<?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4><?= $_LANG['DELETE_BOT'] ?></h4>
                        </div>
                        <div class="card-footer row" style="text-align: center;margin: auto;" data-bot-id="<?= $_GET['id']; ?>">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-fill btn-danger float-right do-botdelete"><?= $_LANG['DELETE_BOT_BUTTON'] ?></button>
                            </div>
                        </div>
                    </div>
                    <?php if (\smnbots\Auth::getInstance()->isAdmin()){ ?>
                        <div class="card pb-3">
                            <div class="card-header">
                                <h4>[Admin] Bot neuzuweisen</h4>
                            </div>
                            <form id="adminsettings">
                                <input type="hidden" name="method" value="owner">
                                <input type="hidden" name="botid" value="<?= $_GET['id'] ?>">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Benutzer</label>
                                                <select class="form-control" id="ownerchange" name="userid">
                                                    <?php foreach (\smnbots\User::listUsers() as $user){ ?>
                                                        <option value="<?= $user['id'] ?>" <?php if ($user['id'] == $botdb['owner']){ echo "selected";} ?>><?= $user['name'] ?>[<?= $user['id'] ?>]</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill btn-primary float-right">Speichern</button>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php include 'assets/footer.php'?>
    </div>
    <div class="modal fade" id="quickplaycustom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="quickplaycustomcontent">
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
    <script src="assets/js/musicbot.js"></script>
    <script>
        $('.qp-button').click(function (event) {
            event.preventDefault();
        });
    </script>
    <?php if (\smnbots\Auth::getInstance()->isAdmin()){?>
        <script>
            $('#adminsettings').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'assets/save_bot.php',
                    method: 'POST',
                    data: $('#adminsettings').serialize()
                }).done(function(data){
                    if (data === "success"){
                        smnswal({
                            title: "Einstellungen geändert",
                            text: "Die Einstellungen wurden geändert",
                            type: "success"
                        }).then(function () {
                            window.location.reload()
                        })
                    } else {
                        smnswal({
                            title: "Verarbeitungsfehler",
                            text: "Leider gab es einen Fehler beim aktualisieren deines Bots",
                            type: "error"
                        })
                    }
                });
            });
        </script>
    <?php } ?>
</body>

</html>