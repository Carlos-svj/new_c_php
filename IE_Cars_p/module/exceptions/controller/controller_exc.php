<?php
//lo que maneja el case es quan fees $callback ='index.php?page=503';
include("module/exceptions/model/DAO_except.php");

switch ($_GET['op']) {
    case '404';
          /* $data = 'hola crtl except 404';
         die('<script>console.log('.json_encode( $data ) .');</script>'); */

        include("module/exceptions/view/error404.php");
        $daoexcept = new DAOexcept();
        $rdo = $daoexcept->insert_error_404($_POST);
        break;

    case '503';
        // $data = 'hola crtl except 503';
        // die('<script>console.log('.json_encode( $data ) .');</script>');
        include("module/exceptions/view/error503.php");
        if (isset($_GET['list'])) {
            $daoexcept = new DAOexcept();
            $rdo = $daoexcept->insert_error_503_list($_POST);
        }
        if (isset($_GET['create'])) {
            $daoexcept = new DAOexcept();
            $rdo = $daoexcept->insert_error_503_create($_POST);
        }
        if (isset($_GET['update'])) {
            $daoexcept = new DAOexcept();
            $rdo = $daoexcept->insert_error_503_update($_POST);
        }
        if (isset($_GET['delete'])) {
            $daoexcept = new DAOexcept();
            $rdo = $daoexcept->insert_error_503_delete($_POST);
        }
        if (isset($_GET['read'])) {
            $daoexcept = new DAOexcept();
            $rdo = $daoexcept->insert_error_503_read($_POST);
        }
        break;

    case 'exception';
        try {
            $daoerrors = new DAOexcept();
            $rdo = $daoerrors->select_except();
        } catch (Exception $e) {
            $callback = 'index.php?module=exceptions&op=503&list';
            die('<script>window.location.href="' . $callback . '";</script>');
        }
        if (!$rdo) {
            $callback = 'index.php?module=exceptions&op=503&list';
            die('<script>window.location.href="' . $callback . '";</script>');
        } else {
            include("module/vehicle/view/logs.php");
        }
        break;
}
