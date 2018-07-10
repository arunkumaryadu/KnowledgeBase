<?php
require_once 'const.php';
function is_login()
{
    return isset($_SESSION["email"]);
}

function is_admin()
{    
    return is_login() && ($_SESSION["role"]=="admin");
}

function check_admin()
{
    if(!is_admin())
    {
        redirect("login.php");
    }
}

function check_login()
{
    if(!isset($_SESSION["email"]))
    {
        redirect("login.php");
    }
}
function redirect($loc)
{
        header("location:$loc");    
}

function run_sql($query){
    global $db_name;
    $con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or exit(mysql_error());
    mysql_select_db("$db_name");
    $r = mysql_query($query, $con);
    if(!$r){
        exit(mysql_error());
    }
    return $r;
}
function check_password($pwd) {
    $err="";
    if (strlen($pwd) < 8) {
        $err = "Password too short!";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
       $err = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $err = "Password must include at least one letter!";
    }     
    return $err;
}

function mail_it($to, $subject, $body)
{
       require_once "Mail.php";
        $headers = array ('From' => "ec.smtp.test2@gmail.com",
          'To' => $to,
          'Subject' => $subject);
        $smtp = Mail::factory('smtp',
          array ('host' => "smtp.gmail.com",
            'port' => "587",
            'auth' => true,
            'username' => "ec.smtp.test2@gmail.com",
            'password' => "anandgupta"));
        $mail = $smtp->send($to, $headers, $body);
        if (PEAR::isError($mail)) {
          echo("<p>" . $mail->getMessage() . "</p>");
         } else {
            return true;
       }}

?>
