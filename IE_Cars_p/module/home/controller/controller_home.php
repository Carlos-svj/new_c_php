<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/new_c_php/IE_Cars_p/';
include($path . 'module/home/model/DAOhome.php');

switch ($_GET['op']) {
    case 'list';
        include('view/inc/top_page.html');
        include('view/inc/menu.html');
        include('module/home/view/home.html');
        break;

    case 'brand';
        /* $data = 'hola validate php';
    die('<script>console.log(' . json_encode($data) . ');</script>'); */
        try {
            $daocar = new DAOhomepage();
            $rdo = $daocar->select_brand();
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error");
            exit;
        } else {
            $info = array();
            foreach ($rdo as $row) {
                array_push($info, $row);
            }
            echo json_encode($info);
        }
        break;

    case 'type';
    /*    $data = 'hola validate php';
    die('<script>console.log(' . json_encode($data) . ');</script>');   */
     echo json_encode($_POST['loaded'], $_POST['items']);
        exit;
     /*    try {
            $daocar = new DAOhomepage();
            $rdo = $daocar->select_type($_POST['items'],$_POST['loaded']);
        } catch (Exception $e) {
            echo json_encode("error s");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error rdo");
            exit;
        } else {
            $info = array();
            foreach ($rdo as $row) {
                array_push($info, $row);
            }
            echo json_encode($info);
        } */
        break;

        case 'count_type':
            try{
                $dao = new DAOhomepage();
                $rdo = $dao->select_count_type();
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            if(!$rdo){
                echo json_encode($rdo);
                exit;
            }else{
                $dinfo = array();
                foreach ($rdo as $row) {
                    array_push($dinfo, $row);
                }
                echo json_encode($dinfo);
            }
            break;

    case 'categories';
        /* $data = 'hola validate php';
    die('<script>console.log(' . json_encode($data) . ');</script>'); */
        try {
            $daocar = new DAOhomepage();
            $rdo = $daocar->select_category();
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error");
            exit;
        } else {
            $info = array();
            foreach ($rdo as $row) {
                array_push($info, $row);
            }
            echo json_encode($info);
        }
        break;

        /* default;
        include("module/exceptions/view/error404.php");
        $callback = 'index.php?page=exception&op=404';
        die('<script>window.location.href="' . $callback . '";</script>');
        break; */
}
