<?php

namespace smnbots\ts3ab;

class Ts3AudioBot {


    private $ip;
    private $port;
    private $token;

    private $username;
    private $realm;
    private $accesstoken;
    private $commandExecutor;

    public $botid = 0;

    /**
     * Ts3AudioBot constructor.
     * @param string $ip
     * @param int $port
     */
    public function __construct($ip, int $port = 8180) {
        $this->ip = $ip;
        $this->port = $port;
        $this->commandExecutor = new Ts3CommandCaller($this);
    }

    /**
     * @param $token
     */
    public function basicAuth($token) {
        $this->token = $token;
        $token = explode(":", $token);
        $this->username =  $token[0];
        $this->realm = $token[1];
        $this->accesstoken = $token[2];
    }

    /**
     * @return string
     */
    private function generateHeader(): string {
        return "Authorization: Basic " . base64_encode($this->username . ":" . $this->accesstoken);
    }

    /**
     * @param $path
     * @return mixed
     */
    public function request($path) {
        $ch = curl_init();
        $requestpath = "http://" . $this->ip . ":" . $this->port . "/api/bot/use/" . $this->botid . "/(/" . $path.")";
	    curl_setopt($ch, CURLOPT_URL, $requestpath);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($this->generateHeader()));
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $output = curl_exec($ch);
        if(curl_errno($ch))
        {
            error_log('Curl error: ' . curl_error($ch));
            return false;
        }
        curl_close($ch);
        return json_decode($output,true);
    }


    /**
     * @param $path
     * @return mixed
     */
    public function rawRequest($path) {
        $ch = curl_init();
        $requestpath = "http://" . $this->ip . ":" . $this->port . "/api/" . $path;
        curl_setopt($ch, CURLOPT_URL, $requestpath);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($this->generateHeader()));
        $output = curl_exec($ch);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        if(curl_errno($ch))
        {
            error_log('Curl error: ' . curl_error($ch));
            return false;
        }
        curl_close($ch);
        return json_decode($output,true);
    }


    /**
     * @return Ts3CommandCaller
     */
    public function getCommandExecutor() {
        return $this->commandExecutor;
    }
}