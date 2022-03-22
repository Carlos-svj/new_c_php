<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/new_c_php/IE_cars_p/';
include($path . "model/connect.php");

class DAOSearch {

    function select_type() {

        $sql = "SELECT DISTINCT type FROM cars";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function select_city()  {

        $sql = "SELECT DISTINCT city FROM cars";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function select_type_city($type)  {

        $sql = "SELECT DISTINCT city FROM cars WHERE type='$type'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function select_auto_type($auto, $type) {

        $sql = "SELECT brand FROM cars WHERE type='$type' AND brand LIKE '$auto%'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function select_auto_type_city($auto, $type, $city) {

        $sql = "SELECT brand FROM cars WHERE type='$type' AND city='$city' AND brand LIKE '$auto%'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function select_auto_city($auto, $city) {

        $sql = "SELECT brand FROM cars WHERE city='$city' AND brand LIKE '$auto%'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function select_auto($auto) {

        $sql = "SELECT brand FROM cars WHERE brand LIKE '$auto%'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }
}
