<?php
require_once 'const.php';
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or exit(mysql_error());

$query = "drop schema if exists `$db_name`";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "DB Drop!!</br>";

$query = "CREATE SCHEMA `$db_name` ;";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "DB Created!!</br>";

mysql_select_db("$db_name");

$query = "CREATE  TABLE `app_users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_name` VARCHAR(45) NULL ,
  `email` VARCHAR(100) NULL ,
  `pass` VARCHAR(45) NULL ,
  `phone_no` VARCHAR(45) NULL ,
  `sec_q` VARCHAR(100) NULL ,
  `sec_a` VARCHAR(100) NULL ,
  `role` VARCHAR(45) NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) );";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "table Created!!</br>";

$query = "INSERT INTO `app_users` 
    (`user_name`, `email`, `pass`, `sec_q`, `sec_a`, `role`, `status`) 
    VALUES ('admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'approved');";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "admin inserted!!</br>";

$query = "CREATE  TABLE `ques` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `ques` TEXT NULL ,
  `asker` VARCHAR(100) NULL ,
  `status` VARCHAR(45) NULL ,
  `category` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) );";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "table Created!!</br>";

$query = "CREATE  TABLE `ans` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `qid` INT NULL ,
  `email` VARCHAR(100) NULL ,
  `admin_rating` INT NULL ,
  `likes` INT DEFAULT 0 ,
  `ans` TEXT NULL ,
  PRIMARY KEY (`id`) );";
$r = mysql_query($query, $con);
if(!$r){
    exit(mysql_error());
}
echo "table Created!!</br>";

$query = "CREATE  TABLE `user_like` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `aid` INT NULL ,
  `email` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) );
";
$r = mysql_query($query);
if(!$r){
    exit(mysql_error());
}
echo "created<br>";

?>
