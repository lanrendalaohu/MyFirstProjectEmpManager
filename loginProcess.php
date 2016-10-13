<?php
    require_once 'AdminService.class.php';
    
    $id = $_POST['id'];
    $password = $_POST['password'];
    
    //实例化一个AdminService方法
    $adminService = new AdminService();
    $name = $adminService->checkAdmin($id, $password);
    if ($name != "")
    {
        header("Location:empManage.php?name=$name");
        exit();
    }
    else 
    {
        header("Location:login.php?errno=1");
        exit();
    }
    
?>
