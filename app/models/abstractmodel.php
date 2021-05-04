<?php
namespace PHPPROJECT\models;

use PDO;
use PDOStatement;
class abstractmodel 
{

    const FILTER_STR = PDO::PARAM_STR;
    const FILTER_INT = PDO::PARAM_INT;
    const FILTER_BOOL = PDO::PARAM_BOOL;
    const FILTER_DECIMAL = 4;
    protected static function bindparams()
    {
        $output = "";
        foreach( static::$table_columns as $column => $type)
        {
            $output .= $column ." = :".$column." , ";
        }
        return trim($output, " , ");
    }


    private function prepareparams(PDOStatement &$stmt)
    {
        foreach( static::$table_columns as $column => $type)
        {
            if( $type == 4)
            {
                $filter_decimal = filter_var($this->$column, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
               $stmt->bindValue( ":{$column}" , $filter_decimal);
            }
            else{
                 $stmt->bindValue( ":{$column}" , $this-> {$column} , $type);
            } 
        }  
    }


    public function create()
    {
        global $conn;
        $sql = " insert into ". static::$tablename. " set ".self::bindparams();
        $stmt = $conn->prepare($sql);
        $this->prepareparams($stmt);
        if ($stmt->execute()) {
            $this->last_id = $conn->lastInsertId();
            return true;
        }
        else{
           return false;
        }

    }
    private function update()
    {
        global $conn;
        $sql = " update  ". static::$tablename. " set ".self::bindparams(). " WHERE ".static::$primary_key." = ".$this->{static::$primary_key};
        $stmt = $conn->prepare($sql);
        $this->prepareparams($stmt);
        return $stmt->execute();
    }
    public function save($primary_key_check = true)
    {
        if(false === $primary_key_check)
        {
            return $this->create();
        }
        if($this->{static::$primary_key} === null)
        {
           return $this->create();
        }
        else
        {
            return $this->update();
        }
    }
    public function delete()
    {
        global $conn;
        $sql = " delete from  ". static::$tablename. " WHERE ".static::$primary_key." = ".$this->{static::$primary_key};
        $stmt = $conn->prepare($sql);
        $this->prepareparams($stmt);
       if ($stmt->execute())
       {
           return true;
       }
       else
       {
           return false;
       }
    }
    public static function get_all()
    {
        global $conn;
        $sql ="select * from ".static::$tablename;
        $stmt = $conn->prepare($sql);
         $stmt->execute();
      
        //  $result = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , get_called_class() , array_keys(static::$table_columns));
         $result = $stmt->fetchAll(PDO::FETCH_CLASS);
         (is_array($result) && !empty($result)) ? $result : false;
         return $result;
     
    }


    public static function get_by_primary_key($pk)
    {
        global $conn;
        $sql ="select * from ".static::$tablename." WHERE ".static::$primary_key." = ".$pk;
        $stmt = $conn->prepare($sql);
         $stmt->execute();
      
         $objects = $stmt->fetchAll(PDO::FETCH_CLASS , get_called_class());
         (is_array($objects) && !empty($objects)) ? $objects : false;
         return $object = array_shift($objects);
        
    }

    // public static function get($sql)

    // {
    //     global $conn;
    //     $stmt =$conn->prepare($sql);
    //     // exmaple $option = array( 'age' => array(PDO::PARAM_INT , 32))
    //     // if (!empty($option)){
    //     //         foreach ($option as $colmn_name => $type){

    //     //         $stmt->bindValue( ":{$colmn_name}",$type[1] , $type[0]);
    //     //     }
    //     // }
    //     $stmt->execute();

    //     $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE , get_called_class() , array_keys(static::$table_columns) ) ;
    //     return  ( is_array($result) && !empty($result) ) ?  $result : false;
    // }
    public static function getby($columns= array())
    {
        global $conn;
        $where_columns_name = array_keys($columns);
        $where_columns_value = array_values($columns);
        $where = [];
        for($i = 0 ; $i < count( $where_columns_name) ; $i++)
            {
              $where[] = $where_columns_name[$i].' = "'.$where_columns_value[$i]. '"';
            }
            $wherecluse = implode(' AND ' , $where);
        $sql = 'SELECT * FROM '.static::$tablename. ' WHERE '.$wherecluse;
        $stmt =$conn->prepare($sql); 
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS , get_called_class() ) ;
        return  ( is_array($result) && !empty($result) ) ?  $result : false; 
    }
    public static function getone($columns , $where_value)
    {
        global $conn;
        $sql = 'SELECT * FROM '.static::$tablename. ' WHERE '.$columns.' = '."'".$where_value."'";
        $stmt =$conn->prepare($sql); 
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class() ) ;
        return  ( is_array($result) && !empty($result) ) ?  $result : false; 
    }
    public static function get_by_sql($another_table_name,$common_key)
    {
        global $conn;
        //select * from app_users left join app_users_group on app_users.group_id = app_users_group.group_id;
        $sql = 'SELECT * FROM '.static::$tablename. ' inner join '.$another_table_name.'  on  '.static::$tablename.'.'.$common_key.'  = '.$another_table_name.'.'.$common_key;
        $stmt =$conn->prepare($sql); 
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class() ) ;
        return  ( is_array($result) && !empty($result) ) ?  $result : false; 
    }
    public static function inner_join($another_table_name,$common_key,$primary_key)
    {
        global $conn;
        //select * from app_users left join app_users_group on app_users.group_id = app_users_group.group_id;
        $sql = 'SELECT * FROM '.static::$tablename. ' inner join '.$another_table_name.'  on  '.static::$tablename.'.'.$common_key.'  = '.$another_table_name.'.'.$common_key.' WHERE '.static::$primary_key.' = '.$primary_key;;
        $stmt =$conn->prepare($sql); 
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class() ) ;
       return  ( is_array($result) && !empty($result) ) ?  $result : false; 
   
    }
    //select all except admin users or logein in users
    public static function get_all_except_loged_user($another_table_name,$common_key,$user_key)
    {
        global $conn;
        //select * from app_users left join app_users_group on app_users.group_id = app_users_group.group_id;
        $sql = 'SELECT * FROM '.static::$tablename. ' inner join '.$another_table_name.'  on  '.static::$tablename.'.'.$common_key.'  = '.$another_table_name.'.'.$common_key.' WHERE '.static::$primary_key.' != '.$user_key;;
        $stmt =$conn->prepare($sql); 
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class() ) ;
       return  ( is_array($result) && !empty($result) ) ?  $result : false; 
   
    }




}