<?php 
    include "inc/admin.php";
    if($_POST){
        $admins = new Admins();
        $action = $_POST["action"];
    }

    if($action == "register"){
        $result = $admins->register_admin($_POST);
        echo $result;
    }

    if($action == "login"){
        $result = $admins->login_admin($_POST);
        echo $result;
    }

    if($action == "getClientData"){
        $result = $admins->getClientData($_POST);
        echo $result;
    }
    
    if($action == "edit_clientdata"){
        $result = $admins->editClientData($_POST);
        echo $result;
    }

    if($action == "deleteClientData"){
        $result = $admins->deleteClientData($_POST);
        echo $result;
    }
    
    
?>