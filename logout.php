<?php
session_destroy('login');
header('Location: index.php');
exit;
?>