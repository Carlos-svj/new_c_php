<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/new_c_php/IE_Cars_p/';
include($path . "module/vehicle/model/DAOVehicle.php");
/* session_start();
 *//* include("module/vehicle/model/DAOVehicle.php");
 */
switch ($_GET['op']) {

    case 'list';
        try {
            $daovehicle = new DAOVehicle();
            $rdo = $daovehicle->select_all_vehicle();
        } catch (Exception $e) {

            $callback = 'index.php?page=exception&op=503&list';

            die('<script>window.location.href="' . $callback . '";</script>');
        }
        /*  echo $rdo; */

        if ($rdo) { //fer que pete en el !
            include_once("module/vehicle/view/list_vehicle.php");
        } else {

            $callback = 'index.php?page=exception&op=503&list';
            die('<script>window.location.href="' . $callback . '";</script>');
        }
        break;
        /*  $data = 'hola DAO user';
             die('script>console.log('.json_encode($data).');<script>'); */

    case 'create';

        include("module/vehicle/model/validate.php");

        $check = true;

        if ($_POST) {
            /* $data = 'hola validate php';
    die('<script>console.log(' . json_encode($data) . ');</script>'); */
            $check = validate();
            /*  $check = true; */
            /* die('<script>console.log(' . json_encode($check) . ');</script>');  */

            if ($check) {

                $_SESSION['vehicle'] = $_POST;
                try {
                    $daovehicle = new DAOVehicle();
                    $rdo = $daovehicle->insert_vehicle($_POST);
                } catch (Exception $e) {
                    //aci_en conte de un callback sera un jsonencode
                    $callback = 'index.php?page=exception&op=503&create';
                    die('<script>window.location.href="' . $callback . '";</script>');
                }
                if ($rdo) {
                    echo '<script language="javascript">alert("Registrado en la base de datos correctamente")</script>';
                    $callback = 'index.php?page=controller_vehicle&op=list'; /////////////
                    die('<script>window.location.href="' . $callback . '";</script>');
                } else {
                    echo '<script language="javascript">alert("error DAO")</script>';

                    $callback = 'index.php?page=exception&op=503&create';
                    die('<script>window.location.href="' . $callback . '";</script>');
                }
            } /* else {
                $data = 'hola validate php';
                die('<script>console.log(' . json_encode($data) . ');</script>');
            } */
        }
        include("module/vehicle/view/create_vehicle.php"); // con el one peta y no sigue
        break;

    case 'update';
        //primer el echo dollar get  id, el formulari, fer validacio en javascript despres php
        $check = true;
        //antes de validar ho te que entrar al php
        if ($_POST) {
            include("module/vehicle/model/validate.php");
            // $check = validate(); //dins del validate echo hola vore si el torna true/false.
            $check = validate();
            // echo "<script>alert('".json_encode($check)."')</script>";
            if ($check == false) {
                // echo "<script>alert('ye klkuouou')</script>";
                $_SESSION['vehicle'] = $_POST;
                try {
                    // echo "<script>alert('ye klk')</script>";
                    $daovehicle = new DAOVehicle();
                    $rdo = $daovehicle->update_vehicle($_POST);
                    // echo $rdo;
                    // exit;
                } catch (Exception $e) {
                    $callback = 'index.php?page=exception&op=503&update';
                    die('<script>window.location.href="' . $callback . '";</script>');
                    // $callback = 'index.php?page=controller_vehicle&op=list';
                    // die('<script>window.location.href="'.$callback .'";</script>');
                }

                if ($rdo) {
                    echo '<script language="javascript">alert("Actualizado en la base de datos correctamente")</script>';

                    $callback = 'index.php?page=controller_vehicle&op=list'; //redirecció& ficar toaster(nombre de la funcion)
                    die('<script>window.location.href="' . $callback . '";</script>');
                } else {
                    // $data = 'hola hola aci pete'; 
                    // die('<script<console.log(' . json_encode($data) . ');</script>');
                    $callback = 'index.php?page=exception&op=503&update'; //&funcion toaster incorrecto
                    die('<script>window.location.href="' . $callback . '";</script>');
                }
            }
        } else {

            try {
                $daovehicle = new DAOVehicle();
                $rdo = $daovehicle->select_vehicle($_GET['id']);
                $vehicle = get_object_vars($rdo);
                //i si tens el objecte 
                // echo '<script language="javascript">alert("Hola controller update, tens el objecte ")</script>';

            } catch (Exception $e) {
                $callback = 'index.php?page=exception&op=503&update';
                die('<script>window.location.href="' . $callback . '";</script>');
            }

            if (!$rdo) {
                $callback = 'index.php?page=exception&op=503&update';
                die('<script>window.location.href="' . $callback . '";</script>');
            } else {
                include("module/vehicle/view/update_vehicle.php");
            }
        }
        break;

    case 'read';
        /* $data = 'hola read user';
             die('script>console.log('.json_encode($data).');<script>'); */
        try {
            $daovehicle = new DAOVehicle();
            $rdo = $daovehicle->select_vehicle($_GET['id']);
            $vehicle = get_object_vars($rdo);
        } catch (Exception $e) {
            $callback = 'index.php?page=exception&op=503&read';
            die('<script>window.location.href="' . $callback . '";</script>');
        }
        if (!$rdo) {
            $callback = 'index.php?page=exception&op=503&read';
            die('<script>window.location.href="' . $callback . '";</script>');
        } else {
            include("module/vehicle/view/read_vehicle.php");
        }
        break;

    case 'delete';
        if (isset($_POST['delete'])) {
            try {
                $daovehicle = new DAOvehicle();

                $rdo = $daovehicle->delete_vehicle($_GET['id']);
            } catch (Exception $e) {
                $callback = 'index.php?page=exception&op=503&delete';
                die('<script>window.location.href="' . $callback . '";</script>');
            }

            if ($rdo) {
                echo '<script language="javascript">alert("Borrado en la base de datos correctamente")</script>';
                $callback = 'index.php?page=controller_vehicle&op=list';
                die('<script>window.location.href="' . $callback . '";</script>');
            } else {
                $callback = 'index.php?page=exception&op=503&delete';
                die('<script>window.location.href="' . $callback . '";</script>');
            }
        }
        $daodelete = new DAOvehicle();
        $rdo = $daodelete->select_vehicle($_GET['id']);
        $vehicle = get_object_vars($rdo);

        include("module/vehicle/view/delete_vehicle.php");
        break;

    case 'dummies';
        try {
            $daovehicle = new DAOVehicle();
            $rdo = $daovehicle->dummies();
        } catch (Exception $e) {
            $callback = 'index.php?page=exception&op=503&list';
            die('<script>window.location.href="' . $callback . '";</script>');
        }
        /*  echo $rdo; */
        if ($rdo) { //fer que pete en el !
            /*             include_once("module/vehicle/view/list_vehicle.php");*/
            $callback = 'index.php?page=controller_vehicle&op=list'; /////////////
            die('<script>window.location.href="' . $callback . '";</script>');
        } else {
            $callback = 'index.php?page=exception&op=503&list';
            die('<script>window.location.href="' . $callback . '";</script>');
        }
        break;

    case 'delete_all';

        try {
            $daovehicle = new DAOvehicle();
            $rdo = $daovehicle->delete_all_vehicle();
        } catch (Exception $e) {

            $callback = 'index.php?page=exception&op=503&delete';
            die('<script>window.location.href="' . $callback . '";</script>');
        }

        if ($rdo) {
            //script oosater.info("msg")script
            /*             echo '<script language="javascript">alert("Se han borrado todos los vehiculos")</script>';
 */
            echo '<script language="javascript">alert("Se han borrado todos los vehiculos")</script>';

            $callback = 'index.php?page=controller_vehicle&op=list';
            die('<script>window.location.href="' . $callback . '";</script>');
        } else {

            $callback = 'index.php?page=exception&op=503&delete';
            die('<script>window.location.href="' . $callback . '";</script>');
        }

        break;

    case 'read_modal';
        /*echo  "hola"; 
        exit; */
        try {
            $daovehicle = new DAOvehicle();
            $rdo = $daovehicle->select_vehicle($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error");
            exit;
        } else {
            $vehicle = get_object_vars($rdo);
            echo json_encode($vehicle);
            exit;
        }
        break;

    default;
        //este include seria= 'index.php?page=exception&op=404&id=select_exceptions;';
        include("module/exceptions/view/error404.php");
        $callback = 'index.php?page=exception&op=404';
        die('<script>window.location.href="' . $callback . '";</script>');

        break;
}
