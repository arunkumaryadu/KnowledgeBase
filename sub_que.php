<?php require_once 'header.php'; ?>
<?php
check_login();
$err="";
if(isset($_POST["ques"])){
     if($_POST["cate"]=="Select"){
        $err= "Category is required!";        
    }
    else if(empty ($_POST["ques"])){
        $err= "Question is required!";
    }
    else {
    $query = "INSERT INTO `ques` 
    (`ques`, `asker`, `status`, `category`) 
    VALUES ('$_POST[ques]', '$_SESSION[email]', 'new', 
        '$_POST[cate]');";
    $r = run_sql($query);
    redirect("ques.php?msg=1");
    }
}
?>

<h1>Question</h1>
<form method="post">
<table>
    <tr>
        <td>Category</td> 
        <td>
            <select name="cate">
                <option>Select</option>
                <option <?php if($_POST["cate"]=="PHP") echo 'selected="selected"'?>>PHP</option>
                <option <?php if($_POST["cate"]=="Java") echo 'selected="selected"'?>>Java</option>
                <option <?php if($_POST["cate"]=="Android") echo 'selected="selected"'?>>Android</option>
                <option <?php if($_POST["cate"]=="Other") echo 'selected="selected"'?>>Other</option>
            </select>            
        </td> 
    </tr>
    <tr>
        <td>Question</td> 
        <td><textarea name="ques" rows="7" cols="60"></textarea>>*</td> 
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