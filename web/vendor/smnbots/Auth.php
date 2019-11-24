<?php

namespace smnbots;


class Auth
{
    private static $_instance; //singleton instance

    private $currentUser; //current signed in user object

    private function __construct() {} //disallow creating of new object of class with new Auth()

    private function __clone() {} //disallow cloning the class

    /**
     * Initialisation
     *
     * @return void
     */
    public static function init()
    {
        session_start();
    }

    /**
     * Get the singleton instance
     *
     * To access rest of non-static methods of class
     * @return Auth
     */
    public static function getInstance()
    {
        if (self::$_instance === NULL) {
            self::$_instance = new Auth();
        }
        return self::$_instance;
    }

    /**
     * Login a user
     *
     * @param string $email     Email address
     * @param string $password  Password
     * @return boolean          true if the new user record was saved successfully, false otherwise
     */
    public function login($email,$password,$remember_me)
    {
        $user = User::authenticate($email,$password);

        // to store ID in Session when user authentication passes
        if ($user !== NULL) {
            //Cached the Details of current user object in currentUser property of Auth class
            $this->currentUser = $user;

            //Save the current user to SESSION
            $this->loginUserSession($user);

            //Remember the login
            if ($remember_me) {

                $expiry = time() + 60*60*24*7;
                $token = $user->rememberMyLogin($expiry);
                if ($token !== false) {
                    setcookie('remember_token',$token,$expiry);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Login the user to the SESSION
     *
     * @param User $user  User object
     * @return void
     */
    private function loginUserSession($user)
    {
        // Store the user ID in the session
        $_SESSION['user_id'] = $user->id;

        // Regenerate the session ID to prevent session hijacking
        session_regenerate_id();
    }

    /**
     * Get the current logged in user
     *
     * @return mixed  User object if logged in, null otherwise
     */
    public function getCurrentUser()
    {
        if ($this->currentUser === NULL) {

            //Login from SESSION if set
            if (isset($_SESSION['user_id'])) {
                $this->currentUser = User::findbyID($_SESSION['user_id']);
            } else {
                //Login from the remember me cookie if set
                $this->currentUser = $this->loginFromCookie();
            }
        }

        return $this->currentUser;
    }

    /**
     * Log the user in from the remember me cookie
     *
     * @return mixed  User object if logged in correctly from the cookie, or null otherwise
     */
    public function loginFromCookie()
    {
        if (isset($_COOKIE['remember_token'])) {
            //Find user that has the token set (the token is hashed in the database)
            $user = User::findByRememberToken(sha1($_COOKIE['remember_token']));

            if ($user !== null) {
                //Set the User SESSION so that next login occurs via SESSION
                $this->loginUserSession($user);

                return $user;
            }
        }
    }

    /**
     * Boolean indicator of whether the user is logged in or not
     *
     * @return boolean
     */
    public function isLoggedIn()
    {
        return $this->getCurrentUser() !== null;
    }

    /**
     * Boolean indicator of whether the user is logged in and is an admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->isLoggedIn() && $this->getCurrentUser()->is_admin;
    }
	public function isSup()
    {
        return $this->isLoggedIn() && $this->getCurrentUser()->is_sup;
    }
	public function isDev()
    {
        return $this->isLoggedIn() && $this->getCurrentUser()->is_dev;
    }

    /**
     * Restrict access only to admin
     *
     * @return void
     */
    public function requireAdmin()
    {
        if (!Bot::hostOnline()){
            header('Location: offline');
            return NULL;
        }
        if (! $this->isAdmin() ) {
            header('Location: dashboard');
            die();
        }
    }

    /**
     * Redirect to the login page if no user is logged in.
     *
     * @return void
     */
    public function requireLogin()
    {
        if (!Bot::hostOnline()){
            header('Location: offline');
            return NULL;
        }
        if (!$this->isLoggedIn()) {

            //Save the requested page to return_to in the SESSION after logging in
            $url_base = $_SERVER['PHP_SELF'];

            //if the requested page alse has a query string
            if (!empty($_SERVER['QUERY_STRING'])) {
                $url_base .= "?".$_SERVER['QUERY_STRING'];
            }

            if (!empty($url_base)) {
                $_SESSION['return_to'] = $url_base;
            }
            header('Location: login');
        }
    }
    /**
     * Redirect to the home page if a user is logged in.
     *
     * @return void
     */
    public function requireGuest()
    {
        if ($this->isLoggedIn()) {
            header('Location: dashboard');
        }
    }

    /**
     * Logout the User and Destroy the Session
     *
     * @return void
     */
    public function logout()
    {
        //Forget the remembered login,if set
        if (isset($_COOKIE['remember_token'])) {

            //Delete the record from the database - note the hash
            $this->getCurrentUser()->forgetLogin(sha1($_COOKIE['remember_token']));

            //Delete the cookie with the value of the token.Setting the expiration date to
            //a time in the past (in this case,one hour ago) will cause the browser to delete
            //the cookie
            setcookie('remember_token','',time() - 3600);
        }
        //Remove all session variables and destroy the session
        $_SESSION = array();
        session_destroy();
    }
}
