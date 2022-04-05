<?php
   $path = $_SERVER['DOCUMENT_ROOT'] . '/new_c_php/IE_Cars_p/';
   include ($path . "module/login/model/DAOlogin.php");
   
   include ($path . "module/login/model/validate_register.php");
   include ($path . "view/inc/JWT.php");
   
    switch($_GET['op']){

        case 'login_view';
            include("module/login/view/login.html");
            break;

        case 'register_view';
            include("module/login/view/register.html");
            break;

        case 'login':
            try{
                $dao = new DAOLogin();
                $rdo = $dao->select_user($_POST['username']);

                $jwt = parse_ini_file("jwt.ini");
                $header = $jwt['header'];
                $secret = $jwt['secret'];
                $payload = '{"iat":"'.time().'","exp":"'.time() + (60*60).'","name":"'.$rdo["nombre"].'"}';

                $JWT = new JWT;
                $token = $JWT->encode($header, $payload, $secret);
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            if(!$rdo){
                echo json_encode("error");
                exit;
            }else{
                if (password_verify($_POST['password'],$rdo['password'])) {
					echo json_encode($token);
	                exit;
				}else {
                    echo json_encode("error");
                    exit;
				}
            }
            break;
        
        case 'register':
            $check = validate($_POST['email']);
            if ($check){ 
                try{
                    $dao = new DAOLogin();
                    $rdo = $dao->insert_user($_POST['username'], $_POST['email'], $_POST['password']);
                }catch (Exception $e){
                    echo json_encode("error");
                    exit;
                }
                if(!$rdo){
                    echo json_encode("error");
                    exit;
                }else{
                    echo json_encode("ok");//en teoria si
                    exit;
                }
            }else{ 
                echo json_encode("error");
                exit;
            }
            break;
            
        case 'logout':
                echo json_encode('Done');
            break;

        case 'data_user':
            
                $jwt = parse_ini_file("jwt.ini");
                $secret = $jwt['secret'];
                $token = $_POST['token'];

                $JWT = new JWT;
                $json = $JWT->decode($token, $secret);  
                $json = json_decode($json, TRUE);

                $dao = new DAOLogin();
                $rdo = $dao->select_data($json['name']);
                echo json_encode($rdo);
                exit;

            break;

        default;
            include("view/inc/error404.php");
            break;
    }

?>