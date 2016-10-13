<?php
    //这是一个工具类
    class SqlHelper
    {
        public $conn;
        public $dbname = "emymanage";
        public $username = "root";
        public $password = "";
        public $host = "localhost";
        
        public function __construct()
        {
            $this->conn = mysqli_connect($this->host,$this->username,$this->password);
            if (!$this->conn)
            {
                die("连接失败:".mysqli_error($this->conn));
            }
            mysqli_select_db($this->conn, $this->dbname);
        }
        
        //执行dql(数据库查询)语句
        public function execute_dql($sql)
        {
            $res = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
            return $res;
        }
        
        //执行dql语句，但是返回的是一个数组
        public function execute_dql2($sql)
        {
            $arr = array();
            $res = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
            //把$res=>$arr
            $i = 0;
            while ($row = mysqli_fetch_assoc($res))
            {
                $arr[$i ++] = $row;
            }
            //这里就可以马上把$res关闭。
            mysqli_free_result($res);
            return $arr;
        }
        
        //考虑分页情况的查询
        public function execute_dql_fenye($sql1,$sql2,$fenyePage)
        {
            //查询要分页显示的数据
            $res = mysqli_query($this->conn, $sql1) or die(mysqli_error($this->conn));
            //将结果集转移到数组中
            $arr = array();
            while ($row = mysqli_fetch_assoc($res))
            {
                $arr[] = $row;
            }
            mysqli_free_result($res);
            
            $res2 = mysqli_query($this->conn, $sql2) or die(mysqli_error($this->conn));
            if ($row = mysqli_fetch_row($res2))
            {
                $fenyePage->pageCount = ceil($row[0] / $fenyePage->pageSize);
                $fenyePage->rouCount = $row[0];
            }
            
            mysqli_free_result($res2);
            
            //把导航信息也封装到fenyePage对象中
            
            $navigate = "";
            if ($fenyePage->pageNow > 1)
            {
                $prePage = $fenyePage->pageNow  - 1;
                $navigate = "<a href = 'empList.php?pageNow=$prePage'>上一页</a>&nbsp";
            }
            
            if ($fenyePage->pageNow  < $fenyePage->pageCount)
            {
                $nextPage = $fenyePage->pageNow  + 1;
                $navigate .= "<a href = 'empList.php?pageNow=$nextPage'>下一页</a>&nbsp";
            
            }
            
            $fenyePage->res_array = $arr;
            $fenyePage->navigate = $navigate;
        }
        
        //执行dml(数据库执行)语句
        public function execute_dml($sql)
        {
            $b = mysqli_query($this->conn, $sql);
            if (!$b)
            {
                return 0;
            }
            else 
            {
                if (mysqli_affected_rows($this->conn) > 0)
                {
                    return 1;//执行OK
                }
                else 
                {
                    return 2;//没有行受到影响
                }
            }
        }
        
        //关闭连接的方法
        public function close_connect()
        {
            if (!empty($this->conn))
            {
                mysqli_close($this->conn);
            }  
        }
        
    }
?>
