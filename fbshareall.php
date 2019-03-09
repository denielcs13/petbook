<?php
session_start();
require 'dbcon.php';
$simg=$_GET['im'];
?>
<html>
<head>
<meta property="fb:app_id" content="1369234256522197" />
<meta property="og:type" content="article" />
<meta property="og:url" content="http://petbooq.com/fbshareall.php?im=<?= $_GET['im'] ?>" />
<meta property="og:title" content="Petbooq" />
<meta property="og:description" content="A Social Network For Pets" />
<meta property="og:image" content="http://petbooq.com/<?= rawurldecode($_GET['im']) ?>" />
</head>
</html>