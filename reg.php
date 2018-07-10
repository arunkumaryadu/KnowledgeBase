<?php require_once 'header.php'; ?>
<?php
$err="";
if(isset($_POST["uname"])){
    if(empty ($_POST["uname"])){
        $err= "User name is required!";
    }
    else if(empty ($_POST["npass"])){
        $err= "Password is required!";        
    }
    else if(empty ($_POST["cpass"])){
        $err= "Confirm password is required!";        
    }
    else if($_POST["npass"]!=$_POST["cpass"]){
        $err= "Password does not match!";        
    }
    else if(check_password($_POST["npass"])){
        $err = check_password($_POST["npass"]);
    }
    else if(empty ($_POST["email"])){
        $err= "E Mail is required!";        
    }    
    else if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)==false){
        $err= "E Mail is incorrect!";        
    }    
    else if(empty ($_POST["sq"])){
        $err= "Security Questions is required!";        
    }    
    else if(empty ($_POST["sa"])){
        $err= "Security Answer is required!";        
    }    
    else if(empty ($_POST["pn"])==false && 
            preg_match("/^0?[7-9]{1}\d{9}$/", $_POST["pn"])==false){
        $err= "Phone no is incorrect!!";        
    }    
    else {
    $query = "select * from app_users where email = '$_POST[email]'";
    $r = run_sql($query);
    if($row = mysql_fetch_array($r)){
        $err = "Already Exists!"; 
    }    
    else {
    $query = "INSERT INTO `app_users` 
    (`user_name`, `email`, `pass`, `sec_q`, `sec_a`, `role`, `status`, phone_no) 
    VALUES ('$_POST[uname]', '$_POST[email]', '$_POST[npass]', 
        '$_POST[sq]', '$_POST[sa]', 'student', 'approved', '$_POST[pn]');";
    $r = run_sql($query);
    redirect("login.php?msg=2");
    }
    }
}
?>
<h1>Register</h1>
<form method="post">
<table>
    <tr>
        <td>User Name</td> 
        <td><input type="text" value="<?php echo "$_POST[uname]"?>" name="uname"/>*</td> 
    </tr>
    <tr>
        <td>New Password</td> 
        <td><input type="password" name="npass"/>*</td> 
    </tr>
    <tr>
        <td>Confirm Password</td> 
        <td><input type="password" name="cpass"/>*</td> 
    </tr>
    <tr>
        <td>E Mail</td> 
        <td><input type="text" value="<?php echo "$_POST[email]"?>" name="email"/>*</td> 
    </tr>
    <tr>
        <td>Security Questions</td> 
        <td><input type="text" value="<?php echo "$_POST[sq]"?>" name="sq"/>*</td> 
    </tr>
    <tr>
        <td>Security Answer</td> 
        <td><input type="text" value="<?php echo "$_POST[sa]"?>" name="sa"/>*</td> 
    </tr>
    <tr>
        <td>Phone No</td> 
        <td><input type="text" value="<?php echo "$_POST[pn]"?>" name="pn"/></td> 
    </tr>
    <tr>
        <td colspan="2"><?php echo $err; ?></td> 
    </tr>
    <tr>
        <td><input type="submit" value="Register"/></td> 
        <td><input type="reset" /></td> 
    </tr>
</table>
</form>
<?php require_once 'footer.php'; ?>