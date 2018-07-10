<?php
require_once 'header.php';
check_login();
$query = "delete from user_like where
    aid = $_REQUEST[id] and 
    email=  '$_SESSION[email]'   
";
run_sql($query);
$query = "update ans set likes = likes - 1
where id =   $_REQUEST[id];  
";
run_sql($query);
redirect("det_ques.php?id=$_REQUEST[qid]");
require_once 'footer.php';
?>
