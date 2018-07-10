<?php require_once 'header.php'; ?>
<?php
$err="";

if(isset($_POST["email"])){
     if(empty ($_POST["email"])){
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
    else {
     $email = filter_var($_POST["email"], FILTER_SANITIZE_MAGIC_QUOTES);
     $sq = filter_var($_POST["sq"], FILTER_SANITIZE_MAGIC_QUOTES);
     $sa = filter_var($_POST["sa"], FILTER_SANITIZE_MAGIC_QUOTES);
    $query = "select * from app_users 
    where email = '$email'
    and sec_q = '$sq'
    and sec_a = '$sa'
    ";
    $r = run_sql($query);
    if($row = mysql_fetch_array($r)){
        mail_it($email, "KnowledgeBase Password!!", "Your password is $row[pass]");
        redirect("login.php?msg=3");
    }
    else {
        $err ="Information incorrect!!";
    }
    }
}
?>
<h1>Forgot Password</h1>
<form method="post">
<table>
    <tr>
        <td>E Mail</td> 
        <td><input type="text" name="email"/></td> 
    </tr>
    <tr>
        <td>Security Question</td> 
        <td><input type="text" name="sq"/></td> 
    </tr>
    <tr>
        <td>Security Answer</td> 
        <td><input type="text" name="sa"/></td> 
    </tr>
    <tr>
        <td colspan="2"><?php echo $err; ?></td> 
    </tr>
    <tr>
        <td><input type="submit" value="Submit"/></td> 
        <td><input type="reset" /></td> 
    </tr>
</table>
</form>
<?php require_once 'footer.php'; ?>