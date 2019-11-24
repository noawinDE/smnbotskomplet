<?php
/**
 * Created by PhpStorm.
 * User: janni
 * Date: 22.12.2018
 * Time: 02:02
 */

namespace smnbots;


use PDO;
use PDOException;

class User
{

    public $errors;

    /**
     * Magic getter - read data from a property that isn't set yet
     *
     * @param  string $name Property name
     * @return mixed
     */
    public function __get($name) {}


    /**
     * Signup a new user
     *
     * @param  array $data POST data
     * @return USer
     */
    public static function signup($name,$email)
    {
        $user = new static();
        $user->name  = strip_tags($name);
        $user->email = $email;
        $user->password = Bot::generateRandomString(16);
        if ($user->isValid()) {
            try {
                $dbconn = Database::getDB();
                $stmt = $dbconn->prepare('INSERT INTO users (name,email,password,is_active,profile_img,private_streamurl) VALUES (:name,:email,:password,TRUE,:img,:url)');
                $bindings= array(
                    'name'    => $user->name,
                    'email'   => $user->email,
                    'img'     => 'anime3.png',
                    'password'=> Hash::make($user->password),
                    'url'     => "{}"
                );
                $stmt->execute($bindings);
                $user->sendActivationEmail($user->password);
            } catch (\PDOException $e) {
                error_log($e->getMessage());
            }
        }
        return $user;
    }

    public static function register($name,$email,$password)
    {
        $user = new static();
        $user->name  = strip_tags($name);
        $user->email = $email;
        $user->password = $password;
        if ($user->isValid()) {
            try {
                $token = base64_encode(uniqid(rand(),true));
                $hashed_token = sha1($token);
                $dbconn = Database::getDB();
                $stmt = $dbconn->prepare('INSERT INTO users (name,email,password,activation_token,is_active,profile_img,private_streamurl) VALUES (:name,:email,:password,:act,FALSE,:img,:url)');
                $bindings= array(
                    'name'    => $user->name,
                    'email'   => $user->email,
                    'img'     => 'anime3.png',
                    'act'     => $hashed_token,
                    'password'=> Hash::make($user->password),
                    'url'     => "{}"
                );
                $stmt->execute($bindings);
                $user->sendActivationToken($hashed_token);
            } catch (\PDOException $e) {
                error_log($e->getMessage());
            }
        }
        return $user;
    }

    /**
     * Send activation email to the user based on the token
     *
     * @param null $password
     * @return mixed         User object if authenticated correctly, null otherwise
     */
    public function sendActivationEmail($password = null)
    {
        $hiuser = ucfirst($this->name);
        $email = $this->email;
        $body =<<<EOT
<div style="padding: 60px 70px; border-top: 1px solid rgba(0,0,0,0.05);">
            <h1 style="margin-top: 0px;">
               Moin $hiuser,
            </h1>
            <div style="color: #636363; font-size: 14px;">
               
			   	  <p>Es wurde f&uuml;r dich ein Benutzerkonto angelegt.</p>
                  <p>Verwenden Sie die folgenden Anmeldeinformationen, um sich anzumelden.</p>
				  <p>E-Mail: $email </p>
				  <p>Passwort: Das Passwort wurde seperat per E-Mail zugeschickt.</p>
            </div>
			<p></p>
            <h4 style="margin-bottom: 10px;">
                Hast du eine Frage oder ben&ouml;tigst du Hilfe?
            </h4>
            <div style="color: #A5A5A5; font-size: 12px;">
               <p>
                  Erstelle ein <a href="https://nxtbots.de/tickets" style="text-decoration: underline; color: #4B72FA;">Ticket</a> oder schreiben uns eine Mail <a href="mailto:support@nxtbots.de" style="text-decoration: underline; color: #4B72FA;">support@nxtbots.de</a>
               </p>
            </div>
         </div>
EOT;
        if(Mail::send($this->name,$this->email,'Registrierung bei NXTBots (Manuell)',$body)){
            return true;
        }else{
            return false;
        }
    }

    public function sendActivationToken($token){
        $hiuser = ucfirst($this->name);
        $email = $this->email;
        $url = "https://panel.nxtbots.de/activate.php?token=$token";
        $body =<<<EOT
<div style="padding: 60px 70px; border-top: 1px solid rgba(0,0,0,0.05);">
            <h1 style="margin-top: 0px;">
               Moin $hiuser,
            </h1>
            <div style="color: #636363; font-size: 14px;">
               <p>
			   	  Vielen Dank f&uuml;r die Registrierung bei panel.nxtbots.de.</p>
                  <p>Klicke auf den folgenden Button um deinen Account zu best&auml;tigen.</p>
            </div>
            <a href="$url"" style="padding: 8px 20px; background-color: #4B72FA; color: #fff; font-weight: bolder; font-size: 16px; display: inline-block; margin: 20px 0px; margin-right: 20px; text-decoration: none;">Account aktivieren</a>
            <h4 style="margin-bottom: 10px;">
                Hast du eine Frage oder ben&ouml;tigst du Hilfe?
            </h4>
			<p>
                  Wenn das nicht Geht dan benutze bitte diesen link <a href="$url" >Account aktivieren</a>
               </p>
            <div style="color: #A5A5A5; font-size: 12px;">
               <p>
                  Erstelle ein <a href="https://panel.nxtbots.de/tickets" style="text-decoration: underline; color: #4B72FA;">Ticket</a> oder schreiben uns eine Mail <a href="mailto:support@panel.nxtbots.de" style="text-decoration: underline; color: #4B72FA;">support@panel.nxtbots.de</a>
               </p>
            </div>
         </div>
EOT;
        if(Mail::send($this->name,$this->email,'Registrierung bei NXTBots',$body)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Activate the user account, nullifying the activation token and setting the is_active flag
     *
     * @param string $token  Activation token
     * @return boolean
     */
    public static function activateAccount($token)
    {
        try {
            $dbconn = Database::getDB();

            $stmt = $dbconn->prepare('UPDATE users SET activation_token = NULL, is_active = TRUE WHERE activation_token = :token');
            $stmt->execute([':token' => $token]);
            if ($stmt->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $exception) {
            error_log($exception->getMessage());
        }

        return false;
    }

    /**
     * Validate the properties and set $this->errors if any are invalid
     *
     * @return boolean  true if valid, false otherwise
     */
    public function isValid()
    {
        $this->errors=[];
        //
        //name
        //
        if ($this->name == '') {
            $this->errors['name'] = 'Bitte gebe einen Namen ein.';
        }

        if (strlen($this->name) < 6){
            $this->errors['name'] = 'Dein Name muss länger als 6 zeichen sein.';
        }

        //
        //email address
        //
        if (filter_var($this->email,FILTER_VALIDATE_EMAIL) === false) {
            $this->errors['email'] = 'Bitte gebe eine E-Mail ein.';
        }

        if ($this->email_spam($this->email)) {
            $this->errors['email'] = 'Die E-Mail-Adresse ist Bei Uns Als Gefährlich Eingestuft.';
        }
        //
        //check if email already exists
        //
        if ($this->emailTaken($this->email)) {
            $this->errors['email'] = 'Die E-Mail-Adresse ist bereits vergeben.';
        }

        //
        // password
        //
        $password_error = $this->validatePassword();
        if ($password_error !== null) {
            $this->errors['password'] = $password_error;
        }
        return empty($this->errors);
    }

    /**
     * See if the email address is taken (already exists), ignoring the current user if already saved.
     *
     * @param string $email  Email address
     * @return boolean       True if the email is taken, false otherwise
     */
    private function emailTaken($email)
    {
        $isTaken = false;
        $user = $this->findByEmail($email);
        if ($user !== null) {
            if (isset($this->id)) {
                if ($this->id != $user->id) {
                    $isTaken = true;
                }
            } else {
                $isTaken = true;
            }
        }
        return $isTaken;
    }

    /**
     * Validate the password
     *
     * @return mixed  The first error message if invalid, null otherwise
     */
    private function validatePassword()
    {
        if (isset($this->password) && (strlen($this->password) < 6)) {
            return 'Dein Passwort muss länger als 6 zeichen sein.';
        }

        if (isset($this->password_confirmation) && ($this->password != $this->password_confirmation)) {
            return 'Bitte gebe ein Passwort ein.';
        }

        if (isset($this->currentpassword) && Hash::check($this->currentpassword,$this->getpassword) == false) {
            return 'Bitte gebe ein Passwort ein.';
        }
    }

    /**
     * Autheticate a user by email and password
     *
     * @param  string $email Email Address
     * @param  $password string
     * @return mixed  User object if authenticated correctly,null otherwise
     */
    public static function authenticate($email,$password)
    {
        $user = self::findbyEmail($email); // Grab the user object by email provided

        if ($user !== null) {
            //Check if user is activated
            if ($user->is_active) {
                //Check the hased password stored in the user record matches the supplied password
                if (Hash::check($password,$user->password)) {
                    return $user;
                }
            }
        }
    }

    /**
     * Find the user with specified ID
     *
     * This Function is used for getting Username from Stored user-id in SESSION
     * @param  string $id ID
     * @return mixed  User object if found,null otherwise
     */
    public static function findByID($id)
    {
        try {
            $dbconn = Database::getDB();

            $stmt = $dbconn->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
            $stmt->execute(array('id' => $id));
            $user = $stmt->fetchObject('\smnbots\User');
            if ($user !== false) {
                return $user;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }

    /**
     * Find the user with specified Email
     *
     * This function is used to get User Object for authentication while logging in
     * @param  string $email Email Address
     * @return mixed  User object if found,null otherwise
     */
    public static function findByEmail($email)
    {
        try {
            $dbconn = Database::getDB();

            $stmt = $dbconn->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
            $stmt->execute(array('email' => $email));
            $user = $stmt->fetchObject('\smnbots\User');
            if ($user !== false) {
                return $user;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }

    /**
     * Remember the login by storing a unique token associated with the user ID
     *
     * @param integer $expiry  Expiry timestamp
     * @return mixed           The token if remembered successfully, false otherwise
     */
    public function rememberMyLogin($expiry)
    {
        $token = uniqid($this->email,true);
        try {
            $dbconn = Database::getDB();
            $stmt = $dbconn->prepare('INSERT INTO remembered_logins
                                    (token,user_id,expires_at)
                                    VALUES
                                    (:token,:user_id,:expires_at)
                                    ');
            $stmt->bindValue(':token', sha1($token));  // store a hash of the token
            $stmt->bindParam(':user_id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':expires_at', date('Y-m-d H:i:s', $expiry));
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                return $token;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return false;
    }

    /**
     * Find the user by remember token
     *
     * @param  string $token  token
     * @return mixed         User object if found, null otherwise
     */
    public static function findByRememberToken($token)
    {
        try {
            $dbconn = Database::getDB();
            $stmt = $dbconn->prepare('SELECT u.* FROM users u JOIN remembered_logins r ON u.id=r.user_id WHERE token = :token');
            $stmt->execute(array(':token' => $token));
            $user = $stmt->fetchObject('\smnbots\User');

            if ($user !== false) {
                return $user;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }

    /**
     * Delete Remembered Login
     * @param  string $token
     * @return void
     */
    public function forgetLogin($token)
    {
        if ($token !== null) {

            try {
                $dbconn = Database::getDB();
                $stmt = $dbconn->prepare('DELETE FROM remembered_logins WHERE token = :token');
                $stmt->bindParam(':token',$token);
                $stmt->execute();

            } catch (PDOException $e) {
                //Log the detailed exception
                error_log($e->getMessage());
            }
        }
    }

    /**
     * Deleted expired remember me tokens
     *
     * @return integer  Number of tokens deleted
     */
    public static function deleteExpiredTokens()
    {
        try {

            $dbconn = Database::getDB();

            $stmt = $dbconn->prepare("DELETE FROM remembered_logins WHERE expires_at < '" . date('Y-m-d H:i:s') . "'");
            $stmt->execute();

            return $stmt->rowCount();

        } catch (PDOException $exception) {

            // Log the detailed exception
            error_log($exception->getMessage());
        }

        return 0;
    }

    /**
     * Change Password
     *
     * @return boolean
     */
    public static function changePassword($password)
    {
        try {
            $dbconn = Database::getDB();
            $stmt = $dbconn->prepare('UPDATE users SET password = :password WHERE id = :id');
            $stmt->bindValue(':password',Hash::make($password));
            $stmt->bindParam(':id',Auth::getInstance()->getCurrentUser()->id,PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }


    public static function listUsers(){
        try {
            $dbconn = Database::getDB();
            $sql = 'SELECT * FROM `users` ORDER BY id ASC';
            $stmt = $dbconn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public static function resetPassword($id){
        $user = User::findByID($id);
        if ($user == null){
            return false;
        }

        $password = Bot::generateRandomString(16);

        try {
            $dbconn = Database::getDB();
            $stmt = $dbconn->prepare('UPDATE users SET password = :password WHERE id = :id');
            $stmt->bindValue(':password',Hash::make($password));
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $hiuser = ucfirst($user->name);
                $email = $user->email;
                $body =<<<EOT
<div style="padding: 60px 70px; border-top: 1px solid rgba(0,0,0,0.05);">
            <h1 style="margin-top: 0px;">
               Moin $hiuser,
            </h1>
            <div style="color: #636363; font-size: 14px;">
               
			   	  <p>Es wurde f&uuml;r dich ein Benutzerkonto angelegt.</p>
                  <p>Hier findest du das vom System generiert Passwort f&uuml;r dich.</p>
				  <p>Bitte &auml;ndere nach erfolgreichen Login das Passwort unter <a href="https://panel.nxtbots.de/account" style="text-decoration: underline; color: #4B72FA;">Profil</a>.</p>
				  <p>Dein Passwort lautet: $password </p>
            </div>
			<p></p>
            <h4 style="margin-bottom: 10px;">
                Hast du eine Frage oder ben&ouml;tigst du Hilfe?
            </h4>
            <div style="color: #A5A5A5; font-size: 12px;">
               <p>
                  Erstelle ein <a href="https://panel.nxtbots.de/tickets" style="text-decoration: underline; color: #4B72FA;">Ticket</a> oder schreiben uns eine Mail <a href="mailto:support@panel.nxtbots.de" style="text-decoration: underline; color: #4B72FA;">support@panel.nxtbots.de</a>
               </p>
            </div>
         </div>
EOT;
                if(Mail::send($user->name,$email,'NXTBots Passwort',$body)){
                    return true;
                }else{
                    return false;
                }
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function updateUser($id,$name,$maxbots,$email){
        try {
            $dbconn = Database::getDB();
            $stmt = $dbconn->prepare('UPDATE users SET `name` = :name, `max_bots` = :maxbots, `email` = :email WHERE id = :id');
            $stmt->bindValue(':name', strip_tags($name));
            $stmt->bindValue(':maxbots',$maxbots);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':email',$email);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function saveAdress($street,$number,$zip,$city,$country){
        try {
            $dbconn = Database::getDB();
            $stmt = $dbconn->prepare('UPDATE `users` SET `addr_street` = :street, `addr_number` = :number, `addr_city` = :city, `addr_country` = :country, `addr_plz` = :zip WHERE `id` = :id;');
            $stmt->bindValue(':street',$street);
            $stmt->bindValue(':number',$number);
            $stmt->bindValue(':city',$city);
            $stmt->bindValue(':country',$country);
            $stmt->bindValue(':zip',$zip);
            $stmt->bindParam(':id',Auth::getInstance()->getCurrentUser()->id,PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function saveLang($langcode){
        try {
            $dbconn = Database::getDB();
            $stmt = $dbconn->prepare('UPDATE `users` SET `language` = :lang WHERE `id` = :id;');
            $stmt->bindValue(':lang',$langcode);
            $stmt->bindParam(':id',Auth::getInstance()->getCurrentUser()->id,PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function saveTwoFactor($sectet){
        try {
            $dbconn = Database::getDB();
            $stmt = $dbconn->prepare('UPDATE `users` SET `twofactor` = :twofactor WHERE `id` = :id;');
            $stmt->bindValue(':twofactor',$sectet);
            $stmt->bindParam(':id',Auth::getInstance()->getCurrentUser()->id,PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function saveUserQP($array){
        try {
            $dbconn = Database::getDB();
            $stmt = $dbconn->prepare('UPDATE users SET `private_streamurl` = :private_streamurl WHERE id = :id');
            $stmt->bindValue(':private_streamurl',json_encode($array));
            $stmt->bindParam(':id',Auth::getInstance()->getCurrentUser()->id,PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function remove($id){
        $systems = array();
        foreach (Config::nodes as $nodec => $config){
            $systems[$nodec] = new Bot($nodec);
        }
        $list = $systems[1]->userbotlist($id);
        foreach ($list as $bot){
            $botsys = $systems[$bot['node']];
            $botsys->deleteBot($bot['id']);
        }
        return self::deleteUser($id);
    }

    private static function deleteUser($id){
        try {
            $dbconn = Database::getDB();
            $stmt = $dbconn->prepare('DELETE FROM `users` WHERE `users`.`id` = :id');
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function email_spam($str){
        $arr = array(
            '@byom.de','@trash-mail.com','@zwoho.com','@phaantm.de','@fyii.de','@mailbox92.biz','@webtempmail.online','@virtual-email.com','@click-mail.net',
    	'@globaleuro.net','@nextemail.net','@quick-mail.online','@mailgen.biz','@mail-pro.info','@desoz.com','@mail4.online','@re-gister.com','@techgroup.top',
    '@freeweb.email','@alpha-web.net','@givmail.com','@tempr.email','@yourweb.email','@proeasyweb.com','@weave.email','@mailboxy.fun','@xn--hotmail-tc7d.com',
    '@web-experts.net','@20minutemail.it','@techgroup.top','@mail-cart.com','@net-list.com','@tmpmail.org','@moakt.ws','@disbox.net','@tmpmail.net',
    '@tmails.net','@disbox.org','@moakt.co','@tmail.ws','@bareed.ws','@zoqqa.com','@next-mail.info','@live.ca','@japanyn7ys.com','@easyemail.info','@zinmail.gq',
    '@squizzy.net','@hartbot.de','@EU.DLink.gq','@nwytg.net','@ventaro.net.tr','@byom.de','@trash-mail.com','@zwoho.com','@phaantm.de','@fyii.de',
    '@mailbox92.biz','@webtempmail.online','@virtual-email.com','@click-mail.net','@globaleuro.net','@nextemail.net','@quick-mail.online','@mailgen.biz',
    '@mail-pro.info','@desoz.com','@mail4.online','@re-gister.com','@techgroup.top','@freeweb.email','@alpha-web.net','@givmail.com','@tempr.email',
    '@yourweb.email','@proeasyweb.com','@weave.email','@mailboxy.fun','@xn--hotmail-tc7d.com','@web-experts.net','@20minutemail.it','@techgroup.top',
    '@mail-cart.com','@net-list.com','@tmpmail.org','@moakt.ws','@disbox.net','@tmpmail.net','@tmails.net','@disbox.org','@moakt.co','@tmail.ws','@bareed.ws',
    '@zoqqa.com','@next-mail.info','@live.ca','@japanyn7ys.com','@easyemail.info','@emailgenerator.de','@network-source.com','@gift-link.com','@postemail.net',
    '@mailfavorite.com','@my10minutemail.com','@vmani.com','bcaoo.com','@sellcow.net','@spam.care','@existiert.net','@muellmail.com','@muellemail.com','@muell.icu',
	'@magspam.net','@oida.icu','@papierkorb.me','@tonne.to','@ultra.fyi','@0815.ru',
'@10minutemail.com', 
'@1chuan.com',
'@1zhuan.com',
'@21cn.com',
'@2prong.com', 
'@4warding.com',
'@4warding.net',
'@4warding.org',
'@6url.com',
'@aberdeenwashingtonways.com',
'@afrobacon.com',
'@anonymousspeech.com',
'@antichef.net',
'@binkmail.com',
'@bk.ru',
'@bluebottle.com',
'@bodhi.lawlita.com',
'@bugmenot.com',
'@bumpymail.com',
'@cashette.com',
'@cashette.ru',
'@centermail.com',
'@centermail.de',
'@centermail.net',
'@chogmail.com',
'@deadspam.com',
'@devnullmail.com',
'@dialupispaccess.com',
'@directbox.com',
'@discardmail.com',
'@discardmail.de',
'@dodgeit.com',
'@dodgit.com',
'@dontreg.com', 
'@dontsendmespam.de',
'@downloadanything.net',
'@dumpmail.de',
'@e4ward.com',
'@eintagsmail.de',
'@emaildienst.de',
'@emailias.com',
'@emailmiser.com',
'@emailto.de',
'@emailwarden.com',
'@example.com',
'@fastacura.com',
'@fastchevy.com',
'@fastchrysler.com',
'@fastkawasaki.com',
'@fastmazda.com',
'@fastmitsubishi.com',
'@fastnissan.com',
'@fastsubaru.com',
'@fastsuzuki.com',
'@fasttoyota.com',
'@fastyamaha.com',
'@frapmail.com',
'@freenet6.de',
'@front14.org',
'@gawab.com',
'@getonemail.com',
'@ghosttexter.de',
'@gishpuppy.com',
'@gmx-nospam.de',
'@gold-profits.info',
'@golfilla.info',
'@greensloth.com',
'@guerillamail.com',
'@guerrillamail.com',
'@guerrillamail.de',
'@haltospam.com',
'@hotpop.com',
'@imstations.com',
'@inbox.ru',
'@strahlbar',
'@jetable.com',
'@jetable.net',
'@jetable.org',
'@jetfix.ee',
'@kasmail.com',
'@killmail.net',
'@klassmaster.com',
'@lawlita.com',
'@mail.htl22.at',
'@mail.misterpinball.de',
'@mail.ru',
'@mail.svenz.eu',
'@mail2rss.org',
'@mailbucket.org',
'@maileater.com',
'@maileater.com', 
'@mailexpire.com', 
'@mail-filter.com',
'@mailin8r.com',
'@mailinator.com', 
'@mailinator.net',
'@mailinator2.com',
'@mailme.lv',
'@mailmoat.com',
'@mailnull.com',
'@mailsiphon.com',
'@megabox.ru',
'@messagebeamer.de',
'@mierdamail.com',
'@mintemail.com',
'@mns.ru',
'@modmailcom.com',
'@mx0.wwwnew.eu',
'@mymail-in.net',
'@mytrashmail.com',
'@my-trashmail.com',
'@mytrashmail.com', 
'@nervmich.net',
'@nervtmich.net',
'@netmails.com',
'@netmails.net',
'@netzidiot.de',
'@nobulk.com',
'@nospamfor.us',
'@nospammail.net',
'@nurfuerspam.de',
'@obobbo.com',
'@pookmail.com',
'@privacy.net',
'@privy-mail.de',
'@punkass.com',
'@put2.net',
'@putthisinyourspamdatabase.com',
'@qv7.info',
'@rootprompt.org',
'@sendspamhere.com',
'@senseless-entertainment.com',
'@shieldedmail.com',
'@shortmail.net',
'@skorpmax.info',
'@slaskpost.se',
'@slopsbox.com',
'@sneakemail.com',
'@snelmail.zzn.com',
'@sofort-mail.de',
'@sogetthis.com',
'@spam.la',
'@spamavert.com',
'@spambob.com',
'@spambob.net',
'@spambob.org',
'@spambog.com',
'@spambog.com',
'@spambog.de',
'@spambox.us',
'@spamcorptastic.com',
'@spamday.com',
'@spamex.com',
'@spamfree24.org',
'@spamgourmet.com',
'@spamherelots.com',
'@spamhereplease.com',
'@spamhole.com', 
'@spamify.com',
'@spaminator.de',
'@spaml.com',
'@spammotel.com', 
'@spamsalot.com',
'@spamslicer.com',
'@spamspot.com',
'@spamthisplease.com',
'@spamtrail.com',
'@sriaus.com',
'@teen-xxx-art.com',
'@tempemail.net ',
'@tempinbox.com',
'@temp-mail.org',
'@tempomail.fr ',
'@vorübergehend.de',
'@temporaryforwarding.com',
'@temporaryinbox.com', 
'@test.com',
'@test.de',
'@thisisnotmyrealemail.com',
'@trashmail.com',
'@trash-mail.com',
'@trashmail.de',
'@trash-mail.de',
'@trashmail.net',
'@trash-mail.net',
'@trashmail.org',
'@trashymail.com',
'@ukr.net',
'@walala.org',
'@wegwerfadresse.de',
'@wh4f.org',
'@willhackforfood.biz',
'@wuzup.net',
'@wuzupmail.net',
'@yandex.ru',
'@zipzaps.de',
'@zipzaps.de', 
'@zoemail.com',
'@zoemail.net',
'@urhen.com',
'@puppetmail.de',
'@schreib-mir.tk',
'@doublemail.de',
'@coin-host.net',
'@247web.net',
'@4nextmail.com',
'@doc-mail.net'	        ); 
	foreach($arr as $a) {
            if (stripos($str,$a) !== false) return true;
        }
        return false;
    }
}