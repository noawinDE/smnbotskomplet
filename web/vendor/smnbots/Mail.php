<?php
/**
 * Created by PhpStorm.
 * User: janni
 * Date: 22.12.2018
 * Time: 02:07
 */

namespace smnbots;


use PHPMailer\PHPMailer\PHPMailer;

class Mail
{

    private static $_mailer;

    private function __construct() {}  // disallow creating a new object of the class with new Mail()

    private function __clone() {}  // disallow cloning the class

    /**
     * Send an email
     *
     * @param string $name     Name
     * @param string $email    Email address
     * @param string $subject  Subject
     * @param string $body     Body
     * @return boolean         true if the email was sent successfully, false otherwise
     */
    public static function send($name,$email,$subject,$body)
    {
        $mail = self::getMailer();
        $mail->addAddress($email,$name);
        $mail->Subject = $subject;
        $parsedbody = strtr($body,array('{username}'=>$name,'{useremail}'=>$email));
        $mail->Body = $parsedbody;
        $mail->isHTML(true);
        if ( ! $mail->send()) {
            error_log($mail->ErrorInfo);

            return false;

        } else {
            return true;

        }
    }

    /**
     * Get the singleton Mailer object
     *
     * @return mailer
     */
    private static function getMailer()
    {
        if (static::$_mailer === NULL) {

            static::$_mailer = new PHPMailer();

            static::$_mailer->isSMTP();
            static::$_mailer->Host = '**';
            static::$_mailer->SMTPAuth = true;
            static::$_mailer->Username = 'no-reply@**';
            static::$_mailer->Password = '********';
            static::$_mailer->SMTPSecure = 'tls';
            static::$_mailer->Port = '25';
            static::$_mailer->From = 'no-reply@**.de';
            static::$_mailer->FromName = '**';
        }

        return static::$_mailer;
    }
}