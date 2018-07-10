<?php require_once 'header.php'; ?>
<?php
check_login();
$err="";
if(isset($_POST["opass"])){
    if(empty ($_POST["opass"])){
        $err= "Old password is required!";
    }
    else if(empty ($_POST["npass"])){
        $err= "New password is required!";        
    }
    else if(empty ($_POST["cpass"])){
        $err= "Confirm password is required!";        
    }
    else if($_POST["npass"]!=$_POST["cpass"]){
        $err= "Password does not match!";        
    }
    else {
        $query = "update app_users 
                set pass= '$_POST[npass]'
                where 
                email = '$_SESSION[email]'
                and pass = '$_POST[opass]'
        ";
        $r = run_sql($query);
        if(mysql_affected_rows()>0){            
            redirect("login.php?msg=1");
        }
        else {
            $err = "Old password is incorrect!!"; 
        }
    }
}
?>
<h1>Change Password</h1>
<form method="post">
<table>
    <tr>
        <td>Old Password</td> 
        <td><input type="password" name="opass"/></td> 
    </tr>
    <tr>
        <td>New Password</td> 
        <td><input type="password" name="npass"/></td> 
    </tr>
    <tr>
        <td>Confirm Password</td> 
        <td><input type="password" name="cpass"/></td> 
    </tr>
    <tr>
        <td colspan="2"><?php echo $err; ?></td> 
    </tr>
    <tr>
        <td><input type="submit" value="Change Password"/></td> 
        <td><input type="reset" /></td> 
    </tr>
</table>
</form>
<?php require_once 'footer.php'; ?>