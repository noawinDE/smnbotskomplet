
<div class="sidebar" data-color="blue">
<?php include 'assets/header.php'?>
 <div class="sidebar-wrapper">
            <ul class="nav">
                <li>
                    <a href="./dashboard">
                        <i class="fab fa-accusoft"></i></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="./bots">
                        <i class="fas fa-play"></i>
                        <p>Bots</p>
                    </a>
                </li>
				<li>
					<a href="./tickets">
                        <i class="fas fa-question-circle"></i>
                        <p>Support</p>
                    </a>
                </li>
                <li>
                    <a href="./account">
                        <i class="fas fa-user-alt"></i>
                        <p>Account</p>
                    </a>
                </li>

				                <?php if (\smnbots\Auth::getInstance()->isAdmin()) { ?>
                    <li><hr><br><center>Administration</li>
                    <li>
                        <a href="./admin">
                            <i class="fas fa-address-card"></i></i>
                            <p>Nutzer</p>
                        </a>
                    </li>
					<li>
                    <a href="./admintickets?filter=all">
						<i class="fas fa-headset"></i>
                        <p>TICKETS</p>
                    </a>
                </li>
					<li>
                    <a href="./admin_bots?filter=all">
                        <i class="fas fa-hdd"></i>
                        <p>Bot Verwaltung</p>
                    </a>
                </li>
					
				
				
                <?php } ?>
                
				
            </ul>
        </div>
    </div>
	<div class="main-panel" data-color="blue">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
		 <img src="assets/img/auth-logo.png" width="auto" height="50">
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
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <div class="photo">
                                    <img src="assets/img/<?= $user->profile_img ?>" alt="Profile Photo">
                                </div>
                                <b class="caret d-none d-lg-block d-xl-block"></b>
                                <p class="d-lg-none">
                                    <?= $_LANG['USER_LOGOUT'] ?>
                                </p>
                            </a>
                            <ul class="dropdown-menu dropdown-navbar">
                                <li class="nav-link">
                                    <a href="account" class="nav-item dropdown-item"><?= ucfirst($user->name) ?></a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li class="nav-link">
                                    <a href="logout" class="nav-item dropdown-item"><?= $_LANG['USER_LOGOUT'] ?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="separator d-lg-none"></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->