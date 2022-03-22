<?php
include_once("model/connect.php");
class DAOexcept
{

    function select_except(){

/*         $sql = "SELECT * FROM exceptions ";
 */        $sql = "SELECT * FROM `exceptions` ORDER BY created_at DESC";


        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }
    function insert_error_404(){

        $sql = "INSERT INTO exceptions(error, type) VALUES ('404', 'not exist'";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function insert_error_503_list(){

        $sql = "INSERT INTO exceptions(error, type) VALUES ('503', 'List')";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }
    function insert_error_503_create(){

        $sql = "INSERT INTO exceptions(error, type) VALUES ('503', 'Create')";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }
    function insert_error_503_update(){

        $sql = "INSERT INTO exceptions(error, type) VALUES ('503', 'Update')";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }
    function insert_error_503_delete(){

        $sql = "INSERT INTO exceptions(error, type) VALUES ('503', 'Delete')";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }
    function insert_error_503_read(){

        $sql = "INSERT INTO exceptions(error, type) VALUES ('503', 'Read')";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }
}
