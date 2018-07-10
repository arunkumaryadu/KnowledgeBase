<?php
require_once 'header.php';
check_admin();

$query = "select * from ans where id = $_REQUEST[id];";
$r = run_sql($query);
$row = mysql_fetch_array($r);
$qid = $row["qid"];

$query = "delete from ans where id = $_REQUEST[id];";
$r = run_sql($query);

$query = "delete from user_like where aid = $_REQUEST[id];";
$r = run_sql($query);

$query = "select * from ans where qid = $qid;";
$r = run_sql($query);
if(mysql_num_rows($r)==0){
     $query = "update `ques` 
    set status = 'new' 
    where id = '$qid';";
    $r = run_sql($query);
}

redirect("det_ques.php?id=$qid");
?>
