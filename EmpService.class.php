<?php

    require_once 'SqlHelper.class.php';
    
    class EmpService
    {
        //一个函数可以获取共有多少页
        function getPageCount($pageSize)
        {
            $sql = "select count(id) from emp";
            $sqlHelper = new SqlHelper();
            $res = $sqlHelper->execute_dql($sql);
            //这样就可以计算$pageCount
            if ($row = mysqli_fetch_row($res))
            {
                $pageCount = ceil($row[0]/$pageSize);
        
            }
        
            //释放资源关闭连接
            mysqli_free_result($res);
            $sqlHelper->close_connect();
            return $pageCount;
        }
        
        
        //一个函数可以获取应当显示的雇员信息
        function getEmpListByPage($pageNow,$pageSize)
        {
            
            $sql = "select * from emp limit ".($pageNow - 1)*$pageSize.",$pageSize";
            $sqlHelper = new SqlHelper();
            $res = $sqlHelper->execute_dql2($sql);
            
            //释放资源和关闭连接
            $sqlHelper->close_connect();
            
            return $res;
            
        }
        
        //第二种使用封装的方式完成分页(业务逻辑)
        function getFenyePage($fenyePage)
        {
            $sqlHelper = new SqlHelper();
            $sql1 = "select * from emp limit "
            .($fenyePage->pageNow - 1) * $fenyePage->pageSize.",".$fenyePage->pageSize;
            $sql2 = "select count(id) from emp";//count和后面的()要紧密连在一起，否则报错
            $sqlHelper->execute_dql_fenye($sql1, $sql2, $fenyePage);
            $sqlHelper->close_connect();
        }
    }
    
?>