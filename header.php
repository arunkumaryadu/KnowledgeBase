<?php
ob_start();
session_start();
function e_hand($eno, $emsg){    
}
set_error_handler("e_hand");
require_once 'myfunc.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>KnowledgeBase, Ask, Get and Improve Answers!!</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css" />
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
		<div id="bg">
    <?php
    if(is_login()){
        echo "<p style='float: right; color:white; padding-Right:13px;'>Welcome $_SESSION[uname] ";   
      
        echo "<a href='chpass.php' style='padding-left:13px;'>Change Password</a></p>";
    }
    ?>                                            
			<div id="outer">
				<div id="header">
					<div id="logo">
						<h1 style="display: inline;">
							<a href="#">KnowledgeBase</a>
						</h1>
					</div>
					<div id="nav" >
            <ul >
              <li><a href="index.php">Home</a></li>
              <li><a href="ques.php">Questions</a></li>
              <?php 
              if(is_login())
              {
                  echo "<li><a href='logout.php'>Logout</a></li>";
                  
              }
              else{
                  echo "<li><a href='login.php'>Login</a></li>
                            <li><a href='reg.php'>Register Now</a></li>";
              }
              ?>
              
              <li><a href="about.php">About</a></li>
              <li class="last"><a href="contact.php">Contact</a></li>
            </ul>
						<br class="clear" />
					</div>
				</div>
				<div id="main">
					<div id="sidebar">
						<h3>
							Knowledge Base
						</h3>
                                            <p style="color: wheat;">
                                                    KnowledgeBase is a website where user can ask questions and answer other user questions and even search for existing answers. You dont need to login to search for answer, but you need login to ask and answer a question.
						</p>
						<h3>
							Links
						</h3>
						<ul class="linkedList">
							<li class="first">
								<a href="https://google.co.in">Google</a>
							</li>
							<li>
								<a href="http://yahoo.com">Yahoo</a>
							</li>
							<li class="last">
								<a href="https://www.wikipedia.org">wikipedia</a>
							</li>
						</ul>
					</div>
					<div id="content">
