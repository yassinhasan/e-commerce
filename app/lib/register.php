<?php
namespace PHPPROJECT\lib;

class register
{
    private static $instance;
    // الحركه دي بتمنع ان اي حد يعمل من بره  $t= new register();
    private function __construct(){}
    // كذلك هنا عشان اضمن محدش يعمل نسخه من الاوبجكت ده بره
    private function __clone(){}

    // عشان يرجع نفس الكائن بالظبط 
    // بدل ماعمل كل شويه  $t = new register()  ويعملي كائن جديد بخصائص جديده لا لا
    // لا انا عايز نفس الكائن ده بالظبط وحطلي فيه الاوبجكت التانيه كخواص فيه ثابته
    // 
    public static function getinstance()
    {
        if ( self::$instance === null)
            {
                 self::$instance = new self();
            }
            return  self::$instance;
    }

    public function __set($key, $object)
    {
         $this->$key = $object;
    }
    public function __get($key)
    {
        return $this->$key;
    }

}

// registery,php
// Static methods can be called directly - without creating an instance of the class first.

// Static methods are declared with the static keywor
// To access a static method use the class name, double colon (::), and the method name
// A class can have both static and non-static methods. A static method can be accessed from a method in the same class using the self keyword and double colon (::):
// Static methods can also be called from methods in other classes. To do this, the static method should be public:
// class greeting {
//     public static function welcome() {
//       echo "Hello World!";
//     }
//   }
  
//   class SomeOtherClass {
//     public function message() {
//       greeting::welcome();
//     }
//   }
// To call a static method from a child class, use the parent keyword inside the child class. Here, the static method can be public or protected.
// <?php
// class domain {
//   protected static function getWebsiteName() {
//     return "W3Schools.com";
//   }
// }

// class domainW3 extends domain {
//   public $websiteName;
//   public function __construct() {
//     $this->websiteName = parent::getWebsiteName();
//   }
// }

// $domainW3 = new domainW3;
// echo $domainW3 -> websiteName;
// 
// PHP - Static Properties
// Static properties can be called directly - without creating an instance of a class.

// Static properties are declared with the static keyword:
// To access a static property use the class name, double colon (::), and the property name:
// A class can have both static and non-static properties. A static property can be accessed from a method in the same class using the self keyword and double colon (::)
// To call a static property from a child class, use the parent keyword inside the child class:

