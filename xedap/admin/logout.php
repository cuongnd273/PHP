<?php
session_start();
ob_start();
unset($_SESSION['adminEmail']);
unset($_SESSION['adminName']);
header("Location: /xedap/admin/index.php");
?>