<?php
namespace PHPPROJECT\models;

class usersmodel  extends abstractmodel
{
    public $users_id;
    public $username ;
    public $password;
    public $email;
    public $phonenumber;
    public $subscriptiondate; 
    public $lastlogin; 
    public $group_id; 
    public $status; 
    public $profile;
    public $privileges;


    public static $tablename = "app_users";
    protected static $primary_key = "users_id";
    protected static $table_columns = array(
        "users_id" => self::FILTER_INT,
        "username" => self::FILTER_STR,
        "password"   => self::FILTER_STR,
        "email"   => self::FILTER_STR,
        "phonenumber" => self::FILTER_STR,
        "subscriptiondate"    => self::FILTER_STR,
        "lastlogin"  => self::FILTER_STR,
        "group_id"  => self::FILTER_INT,
        "status"  => self::FILTER_INT,

    );
    // public function __construct($username , $password ,$email ,$phonenumber , $subscriptiondate,$lastlogin,$group_id,$status)
    // {
    //     $this->username = $username;
    //     $this->password = $password ;
    //     $this->email = $email;
    //     $this->phonenumber    =$phonenumber;
    //     $this->subscriptiondate =$subscriptiondate;
    //     $this->lastlogin =$lastlogin;
    //     $this->group_id =$group_id;
    //     $this->status =$status;
    // }
    public function __set($name, $value)
    {
         $this->$name = $value;
    }
    public function __get($name)
    {
        return $this->$name;
    }

    public  function cryptpassword($password)
    {
        // عايز اعمل رشه الملح هعملها عن طريق الهاش
        // وفيه حاجه اسمها هاش باسورد جاهز
        // هستخدم crypt_blowfish
        //CRYPT_BLOWFISH - Blowfish hashing with a salt as follows: "$2a$", "$2x$" or "$2y$", a two digit cost parameter, "$", and 22 characters from the alphabet "./0-9A-Za-z". Using characters outside of this range in the salt will cause crypt() to return a zero-length string. The two digit cost parameter is the base-2 logarithm of the iteration count for the underlying Blowfish-based hashing algorithm and must be in range 04-31, values outside this range will cause crypt() to fail. "$2x$" hashes are potentially weak; "$2a$" hashes are compatible and mitigate this weakness. For new hashes, "$2y$" should be used. Please refer to » this document for full details of the related security fix.
        // $salt = '$2a$07$aghijlkmnsadhdsadwqeqwe$$';  
        // $key = substr($salt,7,22);
        // $enc_salt = '$2a$07$'.$key.'$';
        return crypt($password,APP_SALT);
    }


    public static function userexists($column,$where)
    {
   
        if(self::getone($column,$where) != false)
        {
           return true; 
        }
        else
        {
            return false;
        }
        
   
    }
    public static function emailexists($column,$where)
    {
   
        if(self::getone($column,$where) != false)
        {
           return true; 
        }
        else
        {
            return false;
        }
        
   
    }

    public static function authentication($username,$password,$seesion)
    {
        global $conn;
        $password = crypt($password,APP_SALT);
        $sql = "SELECT * FROM ".self::$tablename." WHERE username = "."'".$username ."'"." AND password = '". $password."'";
        $stsmt = $conn->prepare($sql);
        $stsmt->bindParam(":username",$username,SELF::FILTER_STR);
        $stsmt->bindParam(":password",$password,SELF::FILTER_STR);
        $stsmt->execute();
       $result = $stsmt->fetchAll(\PDO::FETCH_CLASS,get_called_class());
       $founduser = array_shift($result);

        if(!empty($founduser) && $founduser != null)
        {
            if($founduser->status == 2)
            {
                return 2;
            }
            elseif($founduser->status == 1)
            {
            $founduser->lastlogin = date("Y-m-d H-i-s");
            $founduser->save();
            $founduser->profile = userprofilemodel::get_by_primary_key($founduser->users_id);
            $founduser->group  = usersgroupmodel::get_by_primary_key($founduser->group_id);
           // var_dump(userprofilemodel::get_by_primary_key($founduser->users_id));
            $founduser->privileges = usersgroupprivilegesmodel::getby_specific_sql($founduser->group_id);
             $seesion->u = $founduser;
              
             
             return 1;                 
            }

        }
        else
        {
            return false;
        }
       
    }



}

/*
crypt
(PHP 4, PHP 5, PHP 7, PHP 8)

crypt — One-way string hashing

Warning
This function is not (yet) binary safe!

Description ¶
crypt ( string $string , string $salt ) : string
crypt() will return a hashed string using the standard Unix DES-based algorithm or alternative algorithms.

The salt parameter is optional. However, crypt() creates a weak hash without the salt, and raises an E_NOTICE error without it. Make sure to specify a strong enough salt for better security.

password_hash() uses a strong hash, generates a strong salt, and applies proper rounds automatically. password_hash() is a simple crypt() wrapper and compatible with existing password hashes. Use of password_hash() is encouraged.

The hash type is triggered by the salt argument. If no salt is provided, PHP will auto-generate either a standard two character (DES) salt, or a twelve character (MD5), depending on the availability of MD5 crypt(). PHP sets a constant named CRYPT_SALT_LENGTH which indicates the longest valid salt allowed by the available hashes.

The standard DES-based crypt() returns the salt as the first two characters of the output. It also only uses the first eight characters of string, so longer strings that start with the same eight characters will generate the same result (when the same salt is used).

The following hash types are supported:

CRYPT_STD_DES - Standard DES-based hash with a two character salt from the alphabet "./0-9A-Za-z". Using invalid characters in the salt will cause crypt() to fail.
CRYPT_EXT_DES - Extended DES-based hash. The "salt" is a 9-character string consisting of an underscore followed by 4 bytes of iteration count and 4 bytes of salt. These are encoded as printable characters, 6 bits per character, least significant character first. The values 0 to 63 are encoded as "./0-9A-Za-z". Using invalid characters in the salt will cause crypt() to fail.
CRYPT_MD5 - MD5 hashing with a twelve character salt starting with $1$
CRYPT_BLOWFISH - Blowfish hashing with a salt as follows: "$2a$", "$2x$" or "$2y$", a two digit cost parameter, "$", and 22 characters from the alphabet "./0-9A-Za-z". Using characters outside of this range in the salt will cause crypt() to return a zero-length string. The two digit cost parameter is the base-2 logarithm of the iteration count for the underlying Blowfish-based hashing algorithm and must be in range 04-31, values outside this range will cause crypt() to fail. "$2x$" hashes are potentially weak; "$2a$" hashes are compatible and mitigate this weakness. For new hashes, "$2y$" should be used. Please refer to » this document for full details of the related security fix.
CRYPT_SHA256 - SHA-256 hash with a sixteen character salt prefixed with $5$. If the salt string starts with 'rounds=<N>$', the numeric value of N is used to indicate how many times the hashing loop should be executed, much like the cost parameter on Blowfish. The default number of rounds is 5000, there is a minimum of 1000 and a maximum of 999,999,999. Any selection of N outside this range will be truncated to the nearest limit.
CRYPT_SHA512 - SHA-512 hash with a sixteen character salt prefixed with $6$. If the salt string starts with 'rounds=<N>$', the numeric value of N is used to indicate how many times the hashing loop should be executed, much like the cost parameter on Blowfish. The default number of rounds is 5000, there is a minimum of 1000 and a maximum of 999,999,999. Any selection of N outside this range will be truncated to the nearest limit.
Parameters ¶
string
The string to be hashed.

Caution
Using the CRYPT_BLOWFISH algorithm, will result in the string parameter being truncated to a maximum length of 72 characters.

salt
An optional salt string to base the hashing on. If not provided, the behaviour is defined by the algorithm implementation and can lead to unexpected results.

Return Values ¶
Returns the hashed string or a string that is shorter than 13 characters and is guaranteed to differ from the salt on failure.

Warning
When validating passwords, a string comparison function that isn't vulnerable to timing attacks should be used to compare the output of crypt() to the previously known hash. PHP provides hash_equals() for this purpose.

*/