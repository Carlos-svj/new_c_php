<?php
//////
/* if ((isset($_GET['page'])) && ($_GET['page']==="controller_home") ){
	include("view/inc/top_page_home.html");
}else if ((isset($_GET['page'])) && ($_GET['page']==="controller_shop") ){
	include("view/inc/top_page_shop.html");

}else{
	include("view/inc/top_page.html");
} */
//////
if ((isset($_GET['page'])) && ($_GET['page'] === "shop")) {
	include_once("view/inc/top_page_shop.html");
}
if ((isset($_GET['page'])) && ($_GET['page'] === "homepage")) { //comentar las tres lineas para que cargue de una yau 
	include_once("view/inc/top_page_home.html");
} else {
	include_once("view/inc/top_page.html");
}
session_start();
?>
<div id="header">
	<?php
	include_once("view/inc/header.html");
	?>
</div>
<div id="menu">
	<?php
	include_once("view/inc/menu.html");
	?>
</div>
<div id="pages">
	<?php
	include_once("view/inc/pages.php"); //entrar en cada u dels moduls i carregar cada controlador
	?>
	<br style="clear:both;" />
</div>
<div id="footer">
	<?php
	include_once("view/inc/footer.html");
	?>
</div>

<?php
include_once("view/inc/bottom_page.html");
?>