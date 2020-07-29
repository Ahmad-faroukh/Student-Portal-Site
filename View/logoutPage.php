<?php
session_start();
//setcookie("student", "", time() - 3600,"/");
session_destroy();
session_unset();
//unset($_COOKIE['student']);
header('Location: http://localhost:82/html/StudentPortal/view/loginPage.php');
?>