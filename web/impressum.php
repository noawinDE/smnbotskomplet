<?php require 'vendor/autoload.php';
//\smnbots\Auth::getInstance()->requireLogin();
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
    <title>DSGVO | <?= $_LANG['BRAND_FULL'] ?></title>
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
		a{
			color: #0000FF;
		}
    </style>
</head>

<body class="">
<div class="wrapper">
    <div class="sidebar" data-color="blue">
        <div class="sidebar-wrapper">
            <?php include 'assets/header.php'?>
            <ul class="nav">
				<li>
                    <a href="./dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Zum Panel</p>
                    </a>
                </li>
				
                <li class="active">
                    <a href="./impressum">
                        <i class="fas fa-info-circle"></i>
                        <p>Impressum</p>
                    </a>
                </li>
                <li>
                    <a href="./datenschutz">
                        <i class="fas fa-info-circle"></i>
                        <p>Datenschutz</p>
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
    </div>
    <div class="main-panel" data-color="blue">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle d-inline">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                             
                                <div class="card-body">
                                    <div id="accordion" class="imprint">
									<h2>Impressum</h2>
									<p>Max Mustermann<br />
									Musterstraße 17<br />
									12345 Musterstadt</p>
									
									<p>Telefon: Auf anfrage
									<br />E-Mail: <a href="mailto:recht@Muster.de">recht@Muster.de</a><br />
									</p><br /><h2>Hinweis gemäß Online-Streitbeilegungs-Verordnung</h2>
									<p>Nach geltendem Recht sind wir verpflichtet, Verbraucher auf die Existenz der Europäischen 
									Online-Streitbeilegungs-Plattform hinzuweisen, die für die Beilegung von Streitigkeiten genutzt 
									werden kann, ohne dass ein Gericht eingeschaltet werden muss. Für die Einrichtung der Plattform 
									ist die Europäische Kommission zuständig. Die Europäische Online-Streitbeilegungs-Plattform ist
									hier zu finden: <a href="http://ec.europa.eu/odr" target="_blank" rel="nofollow">http://ec.europa.eu/odr</a>.
									Unsere E-Mail lautet: <a href="mailto:recht@Muster.de">recht@Muster.de</a></p><p>Wir weisen aber darauf 
									hin, dass wir nicht bereit sind, uns am Streitbeilegungsverfahren im Rahmen der Europäischen Online-Streitbeilegungs-Plattform 
									zu beteiligen. Nutzen Sie zur Kontaktaufnahme bitte unsere obige E-Mail und Telefonnummer.</p><br />
									<br /><h2>Disclaimer – rechtliche Hinweise</h2>
									§ 1 Warnhinweis zu Inhalten<br />
									Die kostenlosen und frei zugänglichen Inhalte dieser Webseite wurden mit größtmöglicher Sorgfalt erstellt. 
									Der Anbieter dieser Webseite übernimmt jedoch keine Gewähr für die Richtigkeit und Aktualität der bereitgestellten
									kostenlosen und frei zugänglichen journalistischen Ratgeber und Nachrichten. Namentlich gekennzeichnete Beiträge geben 
									die Meinung des jeweiligen Autors und nicht immer die Meinung des Anbieters wieder. Allein durch den Aufruf der kostenlosen 
									und frei zugänglichen Inhalte kommt keinerlei Vertragsverhältnis zwischen dem Nutzer und dem Anbieter zustande, insoweit fehlt 
									es am Rechtsbindungswillen des Anbieters.<br /><br />§ 2 Externe Links<br />Diese Website enthält Verknüpfungen zu Websites 
									Dritter ("externe Links"). Diese Websites unterliegen der Haftung der jeweiligen Betreiber. Der Anbieter hat bei der erstmaligen 
									Verknüpfung der externen Links die fremden Inhalte daraufhin überprüft, ob etwaige Rechtsverstöße bestehen. Zu dem Zeitpunkt waren 
									keine Rechtsverstöße ersichtlich. Der Anbieter hat keinerlei Einfluss auf die aktuelle und zukünftige Gestaltung und auf die Inhalte 
									der verknüpften Seiten. Das Setzen von externen Links bedeutet nicht, dass sich der Anbieter die hinter dem Verweis oder Link liegenden 
									Inhalte zu Eigen macht. Eine ständige Kontrolle der externen Links ist für den Anbieter ohne konkrete Hinweise auf Rechtsverstöße nicht 
									zumutbar. Bei Kenntnis von Rechtsverstößen werden jedoch derartige externe Links unverzüglich gelöscht.<br /><br />§ 3 Urheber- und 
									Leistungsschutzrechte<br />Die auf dieser Website veröffentlichten Inhalte unterliegen dem deutschen Urheber- und Leistungsschutzrecht. 
									Jede vom deutschen Urheber- und Leistungsschutzrecht nicht zugelassene Verwertung bedarf der vorherigen schriftlichen Zustimmung des 
									Anbieters oder jeweiligen Rechteinhabers. Dies gilt insbesondere für Vervielfältigung, Bearbeitung, Übersetzung, Einspeicherung, 
									Verarbeitung bzw. Wiedergabe von Inhalten in Datenbanken oder anderen elektronischen Medien und Systemen. Inhalte und Rechte Dritter 
									sind dabei als solche gekennzeichnet. Die unerlaubte Vervielfältigung oder Weitergabe einzelner Inhalte oder kompletter Seiten ist nicht 
									gestattet und strafbar. Lediglich die Herstellung von Kopien und Downloads für den persönlichen, privaten und nicht kommerziellen Gebrauch 
									ist erlaubt.<br /><br />Die Darstellung dieser Website in fremden Frames ist nur mit schriftlicher Erlaubnis zulässig.
									<br />
									<br />§ 4 Besondere Nutzungsbedingungen<br>
									Soweit besondere Bedingungen für einzelne Nutzungen dieser Website von den vorgenannten Paragraphen abweichen, wird an entsprechender Stelle ausdrücklich  
									darauf hingewiesen. In diesem Falle gelten im jeweiligen Einzelfall die besonderen Nutzungsbedingungen.
									<p>Quelle: <a href="https://www.juraforum.de/impressum-generator/">Impressum Muster von JuraForum.de</a></p>
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

                                $usersql = 'SELECT id FROM `users` ORDER by id DESC LIMIT 1';
                                $userstmt = $pdo->prepare($usersql);
                                $userstmt->execute();
                                $users = $userstmt->fetch()['id'];
                            } catch (PDOException $e){
                                error_log($e->getMessage());
                            }
                            ?>

                            <p><b><?= round($users); ?></b> Registrierungen</p>
                            <p><b><?= round($bots); ?></b> Musikbots</p>
                            <p><b><?= count(\smnbots\Config::nodes) ?></b> Nodes</p>
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
