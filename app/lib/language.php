<?php
namespace PHPPROJECT\lib;
class language 

{
    protected $dictionary = [];
    public function load_dictionary_path($path)
    {
        $lang_path = explode(".",$path);
        if (isset($_SESSION['lang']))
        {
            $defulat_language = $_SESSION['lang']; 
        }
       
        if(!empty($lang_path) && is_array($lang_path))
        {
            require_once LANG_PATH.$defulat_language.DS.$lang_path[0].DS.$lang_path[1].".lang.php";
            if(!empty($_) && is_array($_))
            {
                foreach($_ as $data_name => $data_value) 
                {
                    $this->dictionary[$data_name] = $data_value;
                }
            }
        }
    }

    public function get_dictionary()
    {
        return $this->dictionary;
    }

    public function feedkey($key,$data)
    {
        if(array_key_exists($key,$this->dictionary))
        {
            // بص الفنكشن الي اسمها
            // sprintf 
            // دي همرر جواها الداتا
            // طيب الداتا دي عباره عن الحاجه الي انا هبدلها
            // فين الحاجه اللي هتتبدل اساسا 
            // يبقي هحط الحاجه اللي هتتبدل داخل الدااتا دي وهحطها اول عنصر خالص
            array_unshift($data,$this->get_value_from_dictionary($key));
            // كده الداتا عباره عن 
            // array($key, $params1,$params2,$params3,,,,)
            // كده مهما كان هدد الحاجات الي هبدلها مش هتفرق معايا
            // هروح انا عي الداله الغريبه دي
            // دي بتقبل اسم الداله الام
            // والبارامز الي هتمرر مهمها كان عددها
            // call_user_func_array
            // /The parameters to be passed to the function, as an indexed array.
           return call_user_func_array("sprintf",$data);
        }
    }
    public function get_value_from_dictionary($key)
    {
        if(array_key_exists($key,$this->dictionary))
        {
            return $this->dictionary[$key];
        }
    }


}
