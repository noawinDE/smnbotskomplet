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
    <style>
        .faq .btn.btn-link{
            color: rgba(255, 255, 255, 0.8);
        }
        .faq .card-body{
            color: rgba(255, 255, 255, 0.7);
        }
/* The alert message box */
.error {
  padding: 20px;
  background-color: rgba(238, 16, 16, 0.71);
  color: white;
  margin-bottom: 15px;
  border-radius: 20px;
  
}
.wartung {
  padding: 20px;
  background-color: #DAA520; /* Red */
  color: white;
  margin-bottom: 15px;
  border-radius: 20px;
}
.info {
  padding: 20px;
  background-color: 	#1E90FF; /* Red */
  color: white;
  margin-bottom: 15px;
  border-radius: 20px;
}
.ok {
  padding: 20px;
  background-color: 	#32CD32; /* Red */
  color: white;
  margin-bottom: 15px;
  border-radius: 20px;
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
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card p-2">
                                <div class="card-body">
                                    <?php
                                    $cserv = count($bot->userbotlist($user->id));
                                    $cticket = count(\smnbots\ticket::ticketlistUser($user->id));
                                    $cbill = 0
                                    ?>
                                    <h2 class="card-title"><?= $cserv ?></h2>
                                    <a class="card-text" href="bots"><a style="color: aqua;">Musikbots</a>
                                </div>
                            </div>
                        </div>
				
                        <div class="col-sm-4">
                            <div class="card p-2">
                                <div class="card-body">
                                    <h2 class="card-title">
									
                                    <p class="card-text"><?php if ($user->is_admin){ ?> <p style="color: #cc0000;"> Administrator <?php } ?> <?php if ($user->is_headdev){ ?> <p style="color: #ff0000;"> H-Developer <?php } ?> <?php if ($user->is_dev){ ?> <p style="color: #009933;"> Developer <?php } ?> <?php if ($user->is_sup){ ?> <p style="color: #ff9900;"> Supporter <?php } ?> <?php if ($user->is_nutzer){ ?> <p style="color: green;"> Customer <?php } ?><?php if ($user->is_partner){ ?> <p style="color: yellow;"> <b>Partner</b> <?php } ?>
                                    </p>
								</h2>
                                    <a class="card-text" href="tickets"><a style="color: aqua;">Rang</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card p-2">
                                <div class="card-body">
                                    <h2 class="card-title"><?= count(\smnbots\Config::nodes) ?></h2>
                                    <a class="card-text" href="#"><a style="color: aqua;"><?= ($cbill == 1 ? $_LANG['DB_NODES'] : $_LANG['DB_NODES']) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php 
echo '<center><div class="error">!!!!old host offline da Wir neuen host und panel haben!!!!</div></center>';
#echo '<center><div class="wartung">Wir Sind Inwartung</div></center>';
#echo '<center><div class="info">Wir Suchen Noch Modis und DJ</div></center>';
#echo '<center><div class="ok">Wir sind Wieder komplett da</div></center>';

?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header">
                                    <h4 class="card-title float-left"><?= $_LANG['FAQ_NAME'] ?></h4>
                                </div>
                                <div class="card-body">
                                    <div id="accordion" class="faq">
                                        <?php foreach ($_LANG['FAQ'] as $i => $faq){ ?>
                                            <div class="card">
                                                <div class="card-header" id="heading<?= $i ?>">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $i ?>" aria-expanded="true" aria-controls="collapse<?= $i ?>">
                                                            <?= $faq['name'] ?>
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="collapse<?= $i ?>" class="collapse <?= ($i == 0)? '': '' ?>" aria-labelledby="heading<?= $i ?>" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <?= $faq['text'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title float-left"><?= $_LANG['PERSONAL_INFO'] ?></h4>
                        </div>
                        <div class="card-body">
                            <h4><?= $user->name ?></h4>
                            <p><?= ($user->addr_street !== null && $user->addr_number !== null)? $user->addr_street.' '.$user->addr_number : '' ?></p>
                            <p><?= ($user->addr_country !== null && $user->addr_plz !== null)? $user->addr_plz.' '.$user->addr_city : '' ?></p>
                            <p><?= ($user->addr_city !== null)? $user->addr_country : '' ?></p>
                            <p><?= $user->email ?></p>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title float-left">Statistiken</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            // eheren Config
                            try{
                                $pdo = \smnbots\Database::getDB();
                                $botsql = 'SELECT * FROM `bots`';
                                $botstmt = $pdo->prepare($botsql);
                                $botstmt->execute();
								$bots = $botstmt->rowCount();
                                //$bots = $botstmt->fetch()['id'];

                                $usersql = 'SELECT * FROM `users`';
                                $userstmt = $pdo->prepare($usersql);
                                $userstmt->execute();
								$users = $userstmt->rowCount();
                                //$users = $userstmt->fetch()['id'];
                            } catch (PDOException $e){
                                error_log($e->getMessage());
                            }
                            ?>

                            <p><b><?= round($users); ?></b> Registrierungen</p>
                            <p><b><?= round($bots); ?></b> Musikbots</p>
                            <p><b><?= count(\smnbots\Config::nodes) ?></b> Nodes</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" align="center">
                            <a style="color: white;" href="https://twitter.com/NXTBots" target="_blank">
                                <div class="card p-2">
                                    <div style="color: aqua;" class="card-body">
                                        <i style="color: white;" class="fab fa-twitter"></i>
                                        <?= $_LANG['SOCIAL_TWITTER'] ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    
                        <div class="col-md-6" align="center">
                            <a style="color: white;" href="https://discord.gg/vYGAscu">
                                <div class="card p-2">
                                    <div style="color: aqua;" class="card-body">
                                        <i style="color: white;" class="fab fa-discord"></i>
                                        <?= $_LANG['SOCIAL_DISCORD'] ?>
                                    </div>
                                </div>
                            </a>
                        </div>
						
						<div class="col-md-6" align="center">
                            <a style="color: white;" href="ts3server://nxtbots.net" >
                                <div class="card p-2">
                                    <div style="color: aqua;" class="card-body">
                                        <i style="color: white;" class="fab fa-teamspeak"></i>
                                        Support TS
                                    </div>
                                </div>
                            </a>
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
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
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