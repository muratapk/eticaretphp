<?php
if (isset($_REQUEST["page"]) && !empty($_REQUEST["page"])) {
    $page = $_REQUEST["page"];

    if (isset($_REQUEST["action"])) {
        $action = $_REQUEST["action"];
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $yol = "./" . $page . "/" . $action . ".php";
            require_once($yol);
        } else {
            $yol = "./" . $page . "/" . $action . ".php";
            require_once($yol);
        }


    } else {
        $yol = "./" . $page . "/index.php";
        require_once($yol);
    }

    //     switch ($page) {
//         case "Users":
//             require_once("./Users/index.php");
//             break;




    //         default:
//             require_once("bos.php");
//             break;

    //     }

    // }

    //ctrl+k ctrl+c bunu açıklama yap
//ctrl+k ctrl+u açıklamayı kapat


} else {
    require_once("bos.php");
}
?>