<?php
function validate($email) {
    
    $dao = new DAOLogin();
    if ($dao->select_email($email)) {
        $check = false;
    } else {
        $check = true;
    }
    return $check;
}
