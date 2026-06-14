<?php
if (isset($_REQUEST["page"]) && !empty($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    switch ($page) {
        case "Users":
            require_once("./Users/index.php");
            break;




        default:
            require_once("bos.php");
            break;

    }

}





?>