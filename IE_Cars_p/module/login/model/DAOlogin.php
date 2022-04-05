<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/new_c_php/IE_Cars_p/';
include($path . "model/connect.php");

class DAOlogin
{

    function insert_user($username, $email, $password) {

        $hash_pass = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
        $hashavatar = md5(strtolower(trim($email)));
        $avatar = "https://robohash.org/$hashavatar";
        $sql = "INSERT INTO `users`(`nombre`, `email`, `password`, `type`, `avatar`)
        VALUES ('$username','$email','$hash_pass','client', '$avatar')";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function select_user($username) {

        $sql = "SELECT `nombre`, `email`, `password`, `type`, `avatar` FROM `users` WHERE nombre='$username'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);
        $value = get_object_vars($res);
        return $value;
    }

    function select_email($email) {

        $sql = "SELECT email FROM `users` WHERE email='$email'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);
        return $res;
    }

    function select_data($username) {
        
        $sql = "SELECT `nombre`, `email`, `type`, `avatar` FROM `users` WHERE nombre='$username'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);
        return $res;
    }
}
