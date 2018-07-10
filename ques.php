<?php require_once 'header.php'; ?>
<?php
$msg = "";
$whr ="";
if(isset($_REQUEST["msg"])){
    if($_REQUEST["msg"]==1){
        $msg = "Your question has been submited!!";
    }
}
if(!empty($_REQUEST["si"])){
    $whr = " where ques like '%$_REQUEST[si]%' ";
}
$query = "select * from ques $whr order by id desc";
$r = run_sql($query);
?>
<?php
echo "<h3>$msg</h3>";
?>
<h1>Questions</h1>
<?php
if(is_login()){
    echo "<a href='sub_que.php'>Ask a question!</a>";
}
?>
<table width="100%">
   <tr><td> 
<form>
    <input style="width: 53%;" type="text" name="si"/> 
    <input type="submit" value="search"/>
</form>
      </td></tr>
   <tr><td>
<table border="1"  style="width: 100%; border-collapse:collapse;">
    <tr>
        <td width="10%" >Category</td>
        <td width="70%">Question</td>
        <td width="10%">Status</td>
        <td width="10%">Action</td>
    </tr>   
    <?php
    while($row=  mysql_fetch_array($r)){
        if(strlen($row[ques])>60)
        {
        $qn = substr($row[ques], 0, 55) . ".....";            
        }
        else {
        $qn = $row[ques];                        
        }
        $link ="";
        if(is_admin()){
            $link  = "<a href='del_ques.php?id=$row[id]'>Delete</a>";
        }
        echo "<tr>
        <td>$row[category]</td>
        <td><a href='det_ques.php?id=$row[id]'>$qn</a></td>
        <td>$row[status]</td>
        <td>$link</td>
    </tr>";
    }
    ?>
        
</table>
           </td></tr></table>
</br>
</br>
<?php require_once 'footer.php'; ?>