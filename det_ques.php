<?php require_once 'header.php'; ?>
<?php
$err="";
if(isset($_POST["ans"])){
    check_login();
    if(empty ($_POST["ans"])){
        $err= "Answer is required!";
    }
    else {
    $query = "INSERT INTO `ans` 
    (`qid`, `ans`, `email`) 
    VALUES ('$_POST[qid]', '$_POST[ans]', '$_SESSION[email]');";
    $r = run_sql($query);

    $query = "update `ques` 
    set status = 'answered' 
    where id = '$_POST[qid]';";
    $r = run_sql($query);
    }
}
?>
<?php
$ans="";
$query = "select * from ans where qid = $_REQUEST[id] order by likes desc";
$r = run_sql($query);
while($row=  mysql_fetch_array($r)){
            //like
            $no = 0;
            $is_liked = false;
            $query2 = "select * from user_like 
            where aid = '$row[id]' and email = '$_SESSION[email]'
            ;";
            $r2 = run_sql($query2);
            if(mysql_num_rows($r2)>0){
            $is_liked = true;                
            }
            $query2 = "select count(*) no from user_like where aid = '$row[id]'";
            $r2 = run_sql($query2);
            if($row2 = mysql_fetch_array($r2)){
                $no = $row2["no"];
            }
    
    if(strlen($ans)>0){
        $ans = $ans ."<hr>"; 
    }
    $ans = $ans . 
                "
                <h5>$row[email]</h5>
                <p>$row[ans]</p>";
    if(is_admin()){
        $ans = $ans ."<p><a href='del_ans.php?id=$row[id]'>Delete</a></p>"; 
    }
 $ans = $ans . "
    </br>Likes :: <a href='like_list.php?id=$row[id]&qid=$_REQUEST[id]'>$no</a></br> 
    ";        
    if(is_login()){
        if($is_liked){
        $ans = $ans .  " <a href='user_ulike.php?id=$row[id]&qid=$_REQUEST[id]'>Unlike </a>";                   
        }
        else {
        $ans = $ans . " <a href='user_like.php?id=$row[id]&qid=$_REQUEST[id]'>Like </a>";                               
        }
    }
}
$query = "select * from ques where id = $_REQUEST[id]";
$r = run_sql($query);
$row = mysql_fetch_array($r) or exit("No Question Found");;
?>
<h1>Questions</h1>
<table border="1"  style="width: 100%; border-collapse:collapse;">
    <tr>
        <td width="20%" >Category</td>
        <td width="80%" ><?php echo $row["category"]?></td>
    </tr>           
    <tr>
        <td width="20%" >Question</td>
        <td width="80%" ><?php echo $row["ques"]?></td>
    </tr>           
    <tr>
        <td width="20%" >Asker</td>
        <td width="80%" ><?php echo $row["asker"]?></td>
    </tr>           
    <tr>
        <td width="20%" >Status</td>
        <td width="80%" ><?php echo $row["status"]?></td>
    </tr>    
    <tr>
        <td width="20%" >Answers</td>
        <td width="80%" ><?php echo $ans ?></td>
    </tr>    
    <?php
    if(is_login()){
        echo "
    <form method='post'>        
    <tr>
        <td width='20%' >Your Answer</td>
        <td width='80%' >
        <textarea name='ans' rows='7' cols='60'></textarea></br>
        <input type ='hidden' name ='qid' value='$_REQUEST[id]'/>
         $err</br>
        <input type='submit' value='Answer'/>
        <input type='Reset'/> 
        </td>
    </tr>
    </form>
    ";
    }
    ?>
    <tr><td colspan="2"><a href="ques.php">Back</a></td></tr>    
</table>

</br>
</br>
<?php require_once 'footer.php'; ?>