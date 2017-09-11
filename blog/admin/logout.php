<?php
require_once('startsession.php');
unset($_SESSION['user']);
unset($_SESSION['id']);
session_destroy();
header('Location:login.php');
?>