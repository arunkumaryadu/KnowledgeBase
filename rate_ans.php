<?php
require_once 'header.php';
check_admin();
     $query = "update `ans` 
    set admin_rating = '$_REQUEST[ratting]' 
    where id = '$_REQUEST[aid]';";
    $r = run_sql($query);
    redirect("det_ques.php?id=$_REQUEST[qid]");
?>
