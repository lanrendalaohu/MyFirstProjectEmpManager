<!-- 管理员表 id:100 password:admin
            id:200 password:123  -->
<html>
<head>
<meta http-equiv = "content-type" content = "text/html; charset = utf-8">
</head>
<body>
<h1>管理员登陆</h1>
<form action="loginProcess.php" method = "post">
<table>
<tr>
<td>用户id</td>
<td><input type = "text" name = "id" ></td>
</tr>

<tr>
<td>密码</td>
<td><input type = "password" name = "password"></td>
</tr>

<tr>
<td><input type = "submit" name = "submit" value = "用户登录"></td>
<td><input type = "reset" name = "reset" value = "重新填写"></td>
</tr>
</table>
</form>
<?php 
    if (!empty($_GET['errno']))
    {
        $errno = $_GET['errno'];
        if ($errno == 1)
        {
            echo "<font color = 'red' size = '3'> 用户id或密码错误 </font> </br>";
        }
    }
?>
</body>
</html>