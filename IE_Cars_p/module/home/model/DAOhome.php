<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/new_c_php/IE_Cars_p/';
include($path . "model/connect.php");

class DAOhomepage {

	function select_type($loaded, $items) {

		$sql = "SELECT * FROM type LIMIT '$loaded', '$items'";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		return $res;
	}

	function select_count_type() {

		$sql = "SELECT COUNT(*) as 'count' FROM `type`";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);
		return $res;
	}
	function select_category() {
		$sql = "SELECT * FROM categories LIMIT 4";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		return $res;
	}
	function select_brand() {
		$sql = "SELECT * FROM brands";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		return $res;
	}
	
}
