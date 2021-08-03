<?php

include ('Connection.php');

class query extends Database
{
    public function getData($table, $field = '*', $condition_arr = '', $order_by_field = '', $order_by_type = 'desc', $limit = '')
    {
        $sql = " select $field from $table ";
        if ($condition_arr != '') {
            $sql .= ' where ';
            $c = count($condition_arr);
            $i = 1;
            foreach ($condition_arr as $key => $val) {
                if ($i == $c) {
                    $sql .= " $key= '$val' ";
                } else {
                    $sql .= " $key= '$val' and ";
                }
                $i++;
            }
        }

        if ($order_by_field != '') {
            $sql .= " order by $order_by_field $order_by_type ";
        }

        if ($limit != '') {
            $sql .= " limit $limit ";
        }
//        die($sql);

        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            $arr = array();
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return 0;
        }
    }

    //select $field from $table where $condition like $like order by $order_by_field $order_by_type limit $limit;


    public function insertData($table, $condition_arr)
    {
        if ($condition_arr != '') {
            foreach ($condition_arr as $key => $val) {
                $filedArr[] = $key;
                $valueArr[] = $val;
            }
            $field = implode(",", $filedArr);
            $value = implode("','", $valueArr);
            $value="'".$value."'";
            $sql = " insert into $table($field) values($value) ";
//            die($sql);
            $result = $this->connect()->query($sql);
        } else {
            return 0;
        }
        //        print_r($result);
    }

    public function deleteData($table, $condition_arr)
    {
        var_dump($condition_arr);
        if ($condition_arr != '') {
            $sql = " delete from $table where ";

            $c = count($condition_arr);
            $i = 1;
            foreach ($condition_arr as $key => $val) {
                if ($i == $c) {
                    $sql .= " $key= '$val' ";
                } else {
                    $sql .= " $key= '$val' and ";
                }
                $i++;
            }
//            die($sql);
            $result = $this->connect()->query($sql);
        } else {
            return 0;
        }
        //        print_r($result);
    }

    public function updateData($table, $condition_arr, $where_field, $where_value)
    {
        if ($condition_arr != '') {
            $sql = " update $table set ";

            $c = count($condition_arr);
            $i = 1;
            foreach ($condition_arr as $key => $val) {
                if ($i == $c) {
                    $sql .= " $key= '$val' ";
                } else {
                    $sql .= " $key= '$val', ";
                }
                $i++;
            }
            $sql.= " where $where_field='$where_value' ";
            die($sql);
            $result = $this->connect()->query($sql);
        } else {
            return 0;
        }
        //        print_r($result);
    }

    public function get_safe_str($str)
    {
        if($str!='')
        {
            return mysqli_real_escape_string($this->connect(),$str);
        }
    }


}
?>