
<?php
/* anar a base de dades i comprobar si esta en la db i tornar true o flase
    select from cars where id siga igual a id i 
        buscara el id i si el troba tornara false i si no pues passa la validacio
*/
/* aci esta el fet de comprobar si esta en base de dates repedia */
function validate_id_vehicle($vehicle)
{

    /*     $sql = "SELECT * FROM vehicles WHERE id_vehicle='$vehicle'";
 */
    $sql = "SELECT * FROM vehicles WHERE id_vehicle='$vehicle'";
    $conexion = connect::con();

    if (mysqli_query($conexion, $sql)->fetch_object() == null) {
        connect::close($conexion);
        return true;
    } else {
        return false;
    }
}

function validate(){
    /*  $data = 'hola validate php';
    die('<script>console.log(' . json_encode($data) . ');</script>');*/
    $check = true;

    $v_id_vehicle = $_POST['id_vehicle'];

    $r_id_vehicle = validate_id_vehicle($v_id_vehicle);

    if (!$r_id_vehicle) { //SI ES FALSA truquillo fullero
      /*   $error_id_vehicle = " * "; */
        $check = false;
   /*  } else {
        $error_id_vehicle = ""; */
    }

    return $check;
}
