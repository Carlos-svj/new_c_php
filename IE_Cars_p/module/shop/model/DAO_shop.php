<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/new_c_php/IE_Cars_p/';
include($path . "model/connect.php");

class DAOshoppage {

    function select_all_cars($items_page, $total_prod) {

        $sql = "SELECT * FROM cars ORDER BY brand LIMIT $items_page, $total_prod, ";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        return $res;
    }

    function select_car($id) {

        $sql = "SELECT * FROM cars WHERE id='$id'";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)-> fetch_object();

        connect::close($conexion);

        return $res;
    }

    function select_imgs($id) {
        
        $sql = "SELECT img_car FROM img WHERE id='$id'";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $saray = array();

        foreach ($res as $row) {
            array_push($saray, $row);
        }

        return $saray;

    }
    function select_maps(){

        $sql = "SELECT Lat, Lon FROM cars ";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function update_view($id){
        $sql = "UPDATE cars SET views = views + 1 WHERE id = '$id'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }
    
    function select_filters(){

        $array_filters = array('brand', 'hp', 'km', 'category', 'type', 'version', 'price');
        $array_return = array();

        foreach ($array_filters as $row) {

            $sql = 'SELECT DISTINCT ' . $row . ' FROM cars';

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            if (mysqli_num_rows($res) > 0) {
                
                while ($row_inner[] = mysqli_fetch_assoc($res)) {
                    $array_return[$row] = $row_inner;
                } // end_while
                unset($row_inner);
            } // end_if
        } //end_foreach
        return $array_return;
    }

    function sql_query($filters){
        $continue = "";
        $count = 0;
        $count1 = 0;
        $count2 = 0;
        $select = ' WHERE ';
        foreach ($filters as $key => $row) {
            foreach ( $row as $key => $row_inner) {
                if ($count == 0) {
                        foreach ( $row_inner as $value) {
                            if ($count1 == 0) {
                                $continue = $key . ' IN ("'. $value . '"';
                            }else {
                                $continue = $continue  . ', "' . $value . '"';
                            }
                            $count1++;
                        }
                        $continue = $continue . ')';
                }else {
                        foreach ($row_inner as $value)  {
                            if ($count2 == 0) {
                                $continue = ' AND ' . $key . ' IN ("' . $value . '"';
                            }else {
                                $continue = $continue . ', "' . $value . '"';
                            }
                            $count2++;
                        }
                        $continue = $continue . ')';
                }
            }
            $count++;
            $count2 = 0;
            $select = $select . $continue;
        }
        return $select;
    }
    function select_filters_search($query, $total_prod, $items_page){
        $sql = "SELECT * FROM cars $query LIMIT $total_prod, $items_page";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function select_count(){
        $sql = "SELECT COUNT(*) AS n_cars FROM cars";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    function select_count_filters($filters){
        $sql = "SELECT COUNT(*) AS n_cars FROM cars $filters";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }
}
