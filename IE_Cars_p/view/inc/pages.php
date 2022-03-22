<?php

switch ($_GET['page']) {
	case "homepage";
		include("menu.html");
		include("module/home/controller/controller_home.php");
		break;
	case "shop";
		include("menu.html");
		include("module/shop/controller/controller_" . $_GET['page'] . ".php");
		break;
	case "exception";
		include("module/exceptions/controller/controller_exc.php");
		break;
	default;
		include("module/home/view/home.html");
		break;
}
/* <?php
    if(!isset($_GET['page'])){
        include("module/home/view/home.html");
    }else{
        switch($_GET['page']){
            case "controller_home";
			    include("module/home/controller/".$_GET['page'].".php");
                break;
            case "controller_shop";
                include("module/shop/controller/".$_GET['page'].".php");
                break;
            default;
                include("module/home/view/home.html");
                break;
        }
    }
?>
 */