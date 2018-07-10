<?php
require_once 'header.php';
check_login();
$query = "select * from user_like where aid = '$_REQUEST[id]' and email = '$_SESSION[email]';";
$r = run_sql($query);
if(mysql_num_rows($r)==0){
$query = "insert into user_like (aid, email)
values ($_REQUEST[id],  '$_SESSION[email]')    
";
run_sql($query);
$query = "update ans set likes = likes + 1
where id =   $_REQUEST[id];  
";
run_sql($query);
}
redirect("det_ques.php?id=$_REQUEST[qid]");
require_once 'footer.php';
?>
