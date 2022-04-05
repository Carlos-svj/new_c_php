<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/new_c_php/IE_Cars_p/';
include($path . 'module/shop/model/DAO_shop.php');

switch ($_GET['op']) {

    case 'view';

        include('view/inc/top_page_shop.html');
        /* include('view/inc/menu.html'); */
        include('module/shop/view/shop.html');
        /*$data = 'hola validate php';
        die('<script>console.log(' . json_encode($data) . ');</script>'); */
        break;

    case 'list_shop';

        try {
            $daocar = new DAOshoppage();
            $rdo = $daocar->select_all_cars($_GET['items_page'],$_POST['total_prod']);
            /* echo json_encode($rdo);
            exit; */
        } catch (Exception $e) {
            echo json_encode("error list ");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error list");
            exit;
        } else {
            $info = array();
            foreach ($rdo as $row) {
                array_push($info, $row);
            }
            echo json_encode($info);
        }
        break;

    case 'details_s';
        /*  echo json_encode($_GET['id']);
        exit; */ 
        $array = array();

        try {
            $daocar = new DAOshoppage();
            $rdo = $daocar->select_car($_GET['id']);
         
        } catch (Exception $e) {
            echo json_encode("error1rcatch_details");
            exit;
        }
        try {
            $daocar = new DAOshoppage();
         
            $array[1][] = $daocar->select_imgs($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error2rcatch_details");
            exit;
        }

        if (!$rdo) {
            echo json_encode("errordelif details car");
            exit;
        } else {

            $array[0] = $rdo;
        }

        echo json_encode($array);
        
        break;

    case 'g_maps';
        try {
            $dao = new DAOshoppage();
            $rdo = $dao->select_maps();
        } catch (Exception $e) {
            echo json_encode("error maps");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error rdo g_maps contr");
            exit;
        } else {
            $info = array();
            foreach ($rdo as $row) {
                array_push($info, $row);
            }
            echo json_encode($info);
        }
        break;

    case 'filters';

        try {
            $dao = new DAOshoppage();
            $rdo = $dao->select_filters();
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error");
            exit;
        } else {
            echo json_encode($rdo);
        }
        break;

    case 'filters_search';
        try {
            $dao = new DAOshoppage();
            $filters = json_decode($_GET['filters']);
            $query = $dao->sql_query($filters);
            $rdo = $dao->select_filters_search($query, $_POST['items_page'],$_POST['total_prod']);
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        if (!$rdo) {
            echo json_encode($rdo);
            exit;
        } else {
            $dinfo = array();
            foreach ($rdo as $row) {
                array_push($dinfo, $row);
            }
            echo json_encode($dinfo);
        }
        break;

    case 'most_visit';
        try {
            $dao = new DAOshoppage();
            $rdo = $dao->update_view($_POST['id']);
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        break;

    case 'count';
        try {
            $dao = new DAOshoppage();
            $rdo = $dao->select_count();
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error");
            exit;
        } else {
            $dinfo = array();
            foreach ($rdo as $row) {
                array_push($dinfo, $row);
            }
            echo json_encode($dinfo);
        }
        break;

    case 'count_filters';
        try {
            $dao = new DAOshoppage();
            $filters = json_decode($_GET['filters']);
            $query = $dao->sql_query($filters);
            $rdo = $dao->select_count_filters($query);
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error");
            exit;
        } else {
            $dinfo = array();
            foreach ($rdo as $row) {
                array_push($dinfo, $row);
            }
            echo json_encode($dinfo);
        }
        break;

    default;

        include("module/exceptions/view/error404.php");
        $callback = 'index.php?page=exception&op=404';
        die('<script>window.location.href="' . $callback . '";</script>');
        break;
}
