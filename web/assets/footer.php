<?php
$version = file_get_contents("./version");
$_LANG = \smnbots\translation::getPHP();
?>


<footer class="footer">
    <div class="container-fluid">
        <ul class="nav">
            <li class="nav-item">
                <a href="impressum" target="_blank" class="nav-link">Impressum</a>
            </li>
            <li class="nav-item">
                <a href="datenschutz" target="_blank" class="nav-link">Datenschutz</a>
            </li>
        </ul>
        <div class="copyright">
		
           <a href="#" target="_blank" class="nav-link">(<?php echo $version; ?>) © 2019 - <script>
                document.write(new Date().getFullYear())
            </script> <?= $_LANG['BRAND_FULL'] ?></a>
        </div>
    </div>
</footer>