<?php
require_once 'header.php';
check_admin();
$query = "delete from ques where id = $_REQUEST[id];";
$r = run_sql($query);
$query = "delete from ans where qid = $_REQUEST[id];";
$r = run_sql($query);
$query = "delete from user_like where aid in (select id from ans where qid = $_REQUEST[id] );";
$r = run_sql($query);
redirect("ques.php");
?>
