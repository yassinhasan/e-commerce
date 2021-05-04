<?php
namespace PHPPROJECT\models;

class usersgroupprivilegesmodel  extends abstractmodel
{
    public $id;
    public $group_id; 
    public	$privilege_id;	


    protected static $tablename = " app_users_group_privileges";
    protected static $primary_key = "id";
    protected static $table_columns = array(
        "id" => self::FILTER_INT,
        "group_id" => self::FILTER_INT,
        "privilege_id"  => self::FILTER_INT

    );
    // public function __construct($group_id,$privilege_id)
    // {
    //     $this->group_id =$group_id;
    //     $this->privilege_id =$privilege_id;
    // }
    public function __set($name, $value)
    {
         $this->$name = $value;
    }
    public function __get($name)
    {
        return $this->$name;
    }
    public static function get_priviliages(usersgroupmodel $group)
    {
        // $selectd_privileges = usersgroupprivilegesmodel::getby(['group_id' => $groups->group_id]);
        $selectd_privileges = self::getone('group_id', $group->group_id);
        $extracted_privaliegs= [];
        if(! $selectd_privileges == false )
        { 
            foreach($selectd_privileges as $selectd_privilege)
            {
                $extracted_privaliegs[]= $selectd_privilege->privilege_id;
            }
            
        }
        return  $extracted_privaliegs;
    }
    public static function getby_specific_sql($group_id)
    {
        global $conn;
       $sql ='SELECT augp.* , aup.privileges_url FROM app_users_group_privileges  augp INNER JOIN app_users_privileges aup
        on aup.privilege_id = augp.privilege_id';
        $sql .= ' WHERE group_id = '.$group_id;

        $stmt =$conn->prepare($sql); 
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class() ) ;
        if  ( is_array($result) && !empty($result) )
        {
            $priviege_obj = [];
            foreach($result as $single)
            {
                 $priviege_obj[] = $single->privileges_url;
            }
            return $priviege_obj;
        }
    }

}