<?php require_once 'header.php'; ?>
<?php
$err="";
$msg = "";
if(isset($_REQUEST["msg"])){
    if($_REQUEST["msg"]==1){
        $msg = "Your password has been changed!!";
    }
    else if($_REQUEST["msg"]==2){
        $msg = "Registration Successful!!";
    }
    else if($_REQUEST["msg"]==3){
        $msg = "Password has been sent!!";
    }
}
if(isset($_POST["email"])){
    $email = filter_var($_POST["email"], FILTER_SANITIZE_MAGIC_QUOTES);
    $pass = filter_var($_POST["pass"], FILTER_SANITIZE_MAGIC_QUOTES);
    $query = "select * from app_users 
    where email = '$email'
    and pass = '$pass'
    ";
    $r = run_sql($query);
    if($row = mysql_fetch_array($r)){
        $_SESSION["email"] = $row["email"];
        $_SESSION["uname"] = $row["user_name"];
        $_SESSION["role"] = $row["role"];
        redirect("ques.php");
    }
    else {
        $err ="Username or password is incorrect!!";
    }
}
?>
<?php
echo "<h3>$msg</h3>";
?>
<h1>Login</h1>
<form method="post">
<table>
    <tr>
        <td>E Mail</td> 
        <td><input type="text" name="email"/></td> 
    </tr>
    <tr>
        <td>Password</td> 
        <td><input type="password" name="pass"/></td> 
    </tr>
    <tr>
        <td colspan="2"><?php echo $err; ?></td> 
    </tr>
    <tr>
        <td><input type="submit" value="Login"/></td> 
        <td><input type="reset" /></td> 
    </tr>
    <tr>
        <td colspan="2"><a href="forgot.php">Forgot Password</a></td> 
    </tr>
</table>
</form>
<?php require_once 'footer.php'; ?>