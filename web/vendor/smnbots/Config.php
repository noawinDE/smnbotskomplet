<?php

namespace smnbots;

define('NEW_SITENAME', 'NXTBOTS');
define('NEW_URLNAME', 'panel.nxtbots.de');
define('NEW_SITE_SHORT', 'NXT');


class Config
{
    const
        DEBUG = false,
        // TS3AB
        HOST = "",
        PORT = "58913",
        AUTH = ":ts3ab:",

        DB_HOST = "localhost",
        DB_NAME = "nxt",
        DB_USER = "nxt",
        DB_PSSWD = "",

        SITE_URL = "",
        PWRD = false,
        RC_SITEKEY = "**",
        RC_PRIVKEY = "**",
        PRIV_NODES = array(1);

    const nodes = array(
    1 => array(
            'host' => '',
            'port' => 58913,
            'key'  => ':ts3ab:'
		)		

    );
}