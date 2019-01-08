<?php
Class connectDBclass {

    function dbConnect(){
        $con = mysqli_connect('localhost', 'root', '', 'dohugi');
        mysqli_set_charset($con,'utf8');
        if (!$con) {
            die("Connection error: " . mysqli_connect_errno());
        }
        return $con;
    }

    function connectionClose($con){
        mysqli_close($con);
    }

    function applyQuery($query){
        $con = $this -> dbConnect();
        $result = mysqli_query($con, $query);
        $this -> connectionClose($con);
        return $result;
    }

}
?>
