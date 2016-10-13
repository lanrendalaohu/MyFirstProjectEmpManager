<html>
<head>
<meta http-equiv = "content-type" content = "text/html;charset = utf-8">
<title>雇员信息列表</title>
</head>

<?php 
    
    require_once 'EmpService.class.php';
    require_once 'FenyePage.class.php';
    
    //创建一个FenyePage对象实例
    $fenyePage = new FenyePage();
    $fenyePage->pageNow = 1;
    $fenyePage->pageSize = 6;
    
   
    if (!empty($_GET['pageNow']))//empty()判断是否为空，为空返回true，不为空返回false
    {
        $fenyePage->pageNow = $_GET['pageNow'];
    }
    
    $empService = new EmpService();
    $empService->getFenyePage($fenyePage);
    
    echo "<table border = '1' border = '1' cellspacing = '0' bordercolor = '#FF0000' width = 700px>";
    echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>";

    for ($i = 0;$i < count($fenyePage->res_array);$i++)
    {
        $row = $fenyePage->res_array[$i];
        echo "<tr><th>{$row['id']}</th><th>{$row['name']}</th><th>{$row['grade']}</th><th>{$row['email']}</th>"."
        <th>{$row['salary']}</th><th><a href = '#'>删除用户</a></th><th><a href = '#'>修改用户</a></th></tr>";
        
    }
    echo "<h1>雇员信息列表</h1>";
    echo "</table>";
        
    
    echo $fenyePage->navigate;
    
    
    /* //可以使用for循环打印超链接
    $page_whole = 10;
    $start = floor(($pageNow - 1) / $page_whole) * $page_whole + 1;
    $index = $start;
    //整体每10页向前翻动
    //如果当前pageNow在1-10页数，就没有向前翻动的超链接
    if ($pageNow > $page_whole)
    {
        echo "&nbsp;&nbsp;<a href = 'empList.php?pageNow=".($start-1)."'>&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
        
    }
    
    for (;$start < $index + $page_whole;$start ++)
    {
        echo "<a href = 'empList.php?pageNow = $start'>[$start]</a>&nbsp;&nbsp;";
    }
    
    //整体每10页向后翻动
    echo "&nbsp;&nbsp;<a href = 'empList.php?pageNow=$start'>&nbsp;&nbsp;>>&nbsp;&nbsp;</a>";
    
    //显示当前页和共有多少页
    echo "当前页{$pageNow}/共有{$pageCount}页";
    
    //指定跳转到哪一页
    echo "</br></br>";
    ?> */
    ?>
    <form action="empList.php?">
    跳转到：<input type = "text" name = "pageNow">
    <input type = "submit" value = "GO">
    </form>


</html>