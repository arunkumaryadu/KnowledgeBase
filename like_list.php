 <?php require_once 'header.php'; ?>    
<h1>Liked By</h1>
<?php echo "<a href='det_ques.php?id=$_REQUEST[qid]'>Back</a>"?>
<ol>
<?php 
            if(!empty($_REQUEST[id]))
            {
            $query = "select  *  from user_like where aid = '$_REQUEST[id]' order by id desc";
            $r = run_sql($query);
            while($row = mysql_fetch_array($r)){
                echo "<li>$row[email]</li>";
            }
            }
?>
</ol>

 <?php require_once 'footer.php'; ?>    