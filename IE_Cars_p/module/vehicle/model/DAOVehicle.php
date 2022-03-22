 <?php
 $path = $_SERVER['DOCUMENT_ROOT'] . '/new_c_php/IE_Cars_p/';
 include($path . "model/connect.php");
/* 	include_once("model/connect.php");
 */	/* $data = 'hola function DAO user';
			 die('script>console.log('.json_encode($data).');<script>'); */
	class DAOVehicle{

		function insert_vehicle($datos){
			/* $data = 'hola function DAO user';
			 die('script>console.log('.json_encode($data).');<script>'); */
			$id_vehicle = $datos['id_vehicle'];
			$marca = $datos['marca'];
			$modelo = $datos['modelo'];
			$HP = $datos['HP'];
			$Km = $datos['Km'];
			$Anyo_produccion = $datos['Anyo_produccion'];
			$color = $datos['color'];
			$precio = $datos['precio'];

			$sql = " INSERT INTO vehicles (id_vehicle, marca, modelo, HP, Km, Anyo_produccion, color, precio)"  //, '$comment'
				. " VALUES ('$id_vehicle', '$marca', '$modelo', '$HP', '$Km', '$Anyo_produccion',  '$color', '$precio')";

			$conexion = connect::con();
			$res = mysqli_query($conexion, $sql);
			connect::close($conexion);
			/* $data = 'hola function DAO user';
			 die('script>console.log('.json_encode($data).');<script>'); */
			return $res;
		}

		function select_all_vehicle(){

			$sql = "SELECT * FROM vehicles";

			$conexion = connect::con();
			$res = mysqli_query($conexion, $sql);
			connect::close($conexion);

			return $res;
		}

		function select_vehicle($vehicle){
			$sql = "SELECT * FROM vehicles WHERE id_vehicle='$vehicle'";

			$conexion = connect::con();
			$query = mysqli_query($conexion, $sql);
			$res = mysqli_fetch_object($query);
			connect::close($conexion);
			return $res;
		}

		function update_vehicle($datos){

			$id_vehicle = $datos['id_vehicle'];
			$marca = $datos['marca'];
			$modelo = $datos['modelo'];
			$HP = $datos['HP'];
			$Km = $datos['Km'];
			$Anyo_produccion = $datos['Anyo_produccion'];
			$color = $datos['color'];
			$precio = $datos['precio'];

			$sql = " UPDATE vehicles SET marca='$marca', modelo='$modelo', HP='$HP', Km='$Km', Anyo_produccion='$Anyo_produccion',"
				. " color='$color', precio='$precio'   WHERE id_vehicle='$id_vehicle'";

			$conexion = connect::con();
			$res = mysqli_query($conexion, $sql);
			connect::close($conexion);
			echo $sql;
			return $res;
		}

		function delete_Vehicle($vehicle){

			$sql = "DELETE FROM vehicles WHERE id_vehicle='$vehicle'";

			$conexion = connect::con();
			$res = mysqli_query($conexion, $sql);
			connect::close($conexion);
			return $res;
		}

		function delete_all_vehicle(){
			
			$sql = "DELETE  FROM vehicles ";

			$conexion = connect::con();
			$res = mysqli_query($conexion, $sql);
			connect::close($conexion);
			return $res;
		}

	function dummies(){

		$res = false;

			$sql1 ="INSERT INTO vehicles (id_vehicle, marca, modelo, HP, Km, Anyo_produccion, color, precio)"  //, '$comment'
			. " VALUES ('876jk', 'abarth', '500', '200', '0', '12/12/2021',  'griajo', '15000')";

			$sql2 ="INSERT INTO vehicles (id_vehicle, marca, modelo, HP, Km, Anyo_produccion, color, precio)"  //, '$comment'
			. " VALUES ('456gh', 'honda', 'civic', '170', '1400', '17/12/2021',  'rojo', '20000')";

			$sql3 ="INSERT INTO vehicles (id_vehicle, marca, modelo, HP, Km, Anyo_produccion, color, precio)"  //, '$comment'
			. " VALUES ('987fe', 'lotus', 'emira', '421', '0', '19/12/2021',  'grey', '60000')";
			/* 	$sql = "INSERT INTO vehicles (id_vehicle, marca, modelo, HP, Km, Anyo_produccion, color, precio) VALUES (\'456gh\', \'honda\', \'civic\', \'170\', \'1400\', \'57/12/2021\',  \'rojo\', \'20000\')"; */
			$sql4 ="INSERT INTO vehicles (id_vehicle, marca, modelo, HP, Km, Anyo_produccion, color, precio)"  //, '$comment'
			. " VALUES ('507mg', 'Ford', 'Gt40', '800', '30000', '19/12/1966',  'blue', '1200000')";

			$sql5 ="INSERT INTO vehicles (id_vehicle, marca, modelo, HP, Km, Anyo_produccion, color, precio)"  //, '$comment'
			. " VALUES ('766ug', 'BMW', 'M2Comp', '530', '3000', '17/10/2021', 'sattinwhite', '70000')";

			$sql6 ="INSERT INTO vehicles (id_vehicle, marca, modelo, HP, Km, Anyo_produccion, color, precio)"  //, '$comment'
			. " VALUES ('kuh90', 'Cadillac', 'cts v', '530', '3000', '17/10/2021', 'sattinwhite', '70000')";

			$sql7 = "INSERT INTO vehicles (id_vehicle, marca, modelo, HP, Km, Anyo_produccion, color, precio)"  //, '$comment'
			. " VALUES ('765jd', 'Dacia', 'Mansory', '400', '0', '17/10/2022', 'black', '50000')";

			$sql8 = "INSERT INTO vehicles (id_vehicle, marca, modelo, HP, Km, Anyo_produccion, color, precio)"  //, '$comment'
			. " VALUES ('465nj', 'Nissan', 'GTR', '1200', '40000', '17/10/2000', 'gris', '130000')";

			$sql9 = "INSERT INTO vehicles (id_vehicle, marca, modelo, HP, Km, Anyo_produccion, color, precio)"  //, '$comment'
			. " VALUES ('520fa', 'Ferrari', '812competizione', '900', '0', '17/10/2023', 'giallo', '70000')";

			$sql10 = "INSERT INTO vehicles (id_vehicle, marca, modelo, HP, Km, Anyo_produccion, color, precio)"  //, '$comment'
			. " VALUES ('550af', 'MercedesAMG', 'Gtc', '550', '0', '17/10/2020', 'DesignoMango', '150000')";

			$conexion = connect::con();
			$res1 = mysqli_query($conexion, $sql1);
			$res2 = mysqli_query($conexion, $sql2);
			$res3 = mysqli_query($conexion, $sql3);
			$res4 = mysqli_query($conexion, $sql4);
			$res5 = mysqli_query($conexion, $sql5);
			$res6 = mysqli_query($conexion, $sql6);
			$res7 = mysqli_query($conexion, $sql7);
			$res8 = mysqli_query($conexion, $sql8);
			$res9 = mysqli_query($conexion, $sql9);
			$res10 = mysqli_query($conexion, $sql10);


			connect::close($conexion);
			if ($res1 && $res2 && $res3 && $res4 && $res5 && $res6 && $res7 && $res8 && $res9 && $res10) {
				$res = true;
			}
			return $res;
		}
}
