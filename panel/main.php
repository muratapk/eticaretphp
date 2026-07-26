<?php
session_start();
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("Location:../index.php");
}
require_once("../config/settings.php");

require_once("ust.php"); ?>

<!-- / Boş Sayfa -->
<?php require_once("blank.php"); ?>
<!-- / Boş Sayfa-->
<?php
require_once("alt.php"); ?>