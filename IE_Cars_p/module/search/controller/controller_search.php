<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/new_c_php/IE_Cars_p/';
include($path . 'module/search/model/DAOsearch.php');
switch ($_GET['op']) {

    case 'type':
         /* echo json_encode("error controller search 1");
         exit; */

        try {
            $dao = new DAOSearch();
            $rdo = $dao->select_type();
        } catch (Exception $e) {
            echo json_encode("catch");
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

    case 'city':

        try {
            $dao = new DAOSearch();
            if (empty($_POST['type'])) {
                $rdo = $dao->select_city();
            } else {
                $rdo = $dao->select_type_city($_POST['type']);
            }
        } catch (Exception $e) {
            echo json_encode("catch city");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error city contrl");
            exit;
        } else {
            $dinfo = array();
            foreach ($rdo as $row) {
                array_push($dinfo, $row);
            }
            echo json_encode($dinfo);
        }
        break;

    case 'autocomplete':

        try {
            $dao = new DAOSearch();
            if (!empty($_POST['type']) && empty($_POST['city'])) {
                $rdo = $dao->select_auto_type($_POST['complete'], $_POST['type']);
                
            } else if (!empty($_POST['type']) && !empty($_POST['city'])) {
                $rdo = $dao->select_auto_type_city($_POST['complete'], $_POST['type'], $_POST['city']);

            } else if (empty($_POST['type']) && !empty($_POST['city'])) {
                $rdo = $dao->select_auto_city($_POST['city'], $_POST['complete']);
                
            } else {
                $rdo = $dao->select_auto($_POST['complete']);
            }
        } catch (Exception $e) {
            echo json_encode("catch autocomplete");
            exit;
        }
        if (!$rdo) {
            echo json_encode("error autocomplete");
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
