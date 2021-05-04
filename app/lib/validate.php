<?php
namespace PHPPROJECT\lib;
trait validate 
{
    // اتاكد من حقل البينانات انه
    // reqiured not empty 
    // int or alpha or email 
    // number between //
    //float 
    // url
    // date


    private $regexpattern = [

        'num'  => '/^[0-9]+(?:\.[0-9]+)?$/',
        'int'   => '/^[0-9]+$/',
        'float' =>  '/^[0-9]+\.[0-9]+$/',
        'alph'  =>  '/^[a-zA-Z\p{Arabic}]+$/u',
        'alpha_num' => '/^[a-zA-Z\p{Arabic}0-9]+$/u' ,
        'vdate'     => '/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9])(?:( [0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?(.[0-9]{1,6})?$/', // "2019-02-03 12:44:35.434344"
        'nupco' =>  '/^i[0-9]{5}$/',
        'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Z]{2,}$/i',
        'url'   =>  '/^(https?:\/\/)?([\w\-])+\.{1}([a-zA-Z]{2,63})([\/\w-]*)*\/?\??([^#\n\r]*)?#?([^\n\r]*)$/'
 
    ];

    public function num($value){
           return (bool) preg_match($this->regexpattern['num'],$value);
    }
    public function float($value){
           return (bool) preg_match($this->regexpattern['float'],$value);
    }
    public function int($value){
           return (bool) preg_match($this->regexpattern['int'],$value);
    }
    public function alpha($value){
           return (bool) preg_match($this->regexpattern['alph'],$value);
    }
    public function nupco($value){
           return (bool) preg_match($this->regexpattern['nupco'],$value);
    }
    public function alpha_num($value){
           return (bool) preg_match($this->regexpattern['alpha_num'],$value);
    }
    public function email($email){
           return (bool) preg_match($this->regexpattern['email'],$email);
    }
    public function url($url){
           return (bool) preg_match($this->regexpattern['url'],$url);
    }
    public function vdate($vdate){
           return (bool) preg_match($this->regexpattern['vdate'],$vdate);
    }


    //check empty input
    public function req($value)
    {
        if(!empty($value) || $value != "")
        {
            return true;
        }
        else 
        {
            return false;
        }

        // return "" != $value || empty($value);
    } 
 
    public function gt($value, $matchAgainst)
    {
        if(is_numeric($value))
        {
            return $value > $matchAgainst;
        }
        elseif(is_string($value))
        {
            return mb_strlen($value) > $matchAgainst;
        }
    }
    public function lt($value, $matchAgainst)
    {
        if(is_numeric($value))
        {
            return $value < $matchAgainst;
        }
        elseif(is_string($value))
        {
            return mb_strlen($value) < $matchAgainst;
        }
    }
    public function eq($value, $matchAgainst)
    {
        if(is_numeric($value))
        {
            return $value == $matchAgainst;
        }
        elseif(is_string($value))
        {
            return $value == $matchAgainst;
        }
    }
    public function eqfiled($value, $otherfield)
    {
            return $value == $otherfield;
    }

    public function min($value,$min)
    {
        if(is_numeric($value))
        {
           return $value >= $min ;
        }
        elseif(is_string($value))
        {
            return mb_strlen($value) >= $min;
          
        }

    }
    public function max($value,$max)
    {
        if(is_numeric($value))
        {
            return $value <= $max;
        }
        elseif(is_string($value))
        {
            return mb_strlen($value) <= $max;
        }
    }
    public function between($value,$min,$max)
    {
        if(is_numeric($value))
        {
            return $value < $max && $value > $min;
        }
        elseif(is_string($value))
        {
            return mb_strlen($value) < $max && mb_strlen($value) > $min;
        }
    }
    public function float_like($value ,$float_befor , $float_after)
    {
        if(! $this->float($value))
        {
            return false;
        }
        else
        {
            $pattern = '/^[0-9]{'.$float_befor.'}\.[0-9]{'.$float_after.'}$/';
            
            if(preg_match($pattern,$value))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

    }


    public function isvalid($roles,$input_tpye)
    {
        $errors = [];
        if(!empty($roles))
        {
            foreach($roles as $field_name => $validation_role)
            {
                $each_validation_role = explode("|",$validation_role);
                foreach($each_validation_role as $single_valdation_role)
                    if(array_key_exists($field_name,$errors))
                    {
                        continue;
                    }
                    {
                    if(preg_match_all("/(min)\((\d+)\)/",$single_valdation_role,$m))
                    {

                       if ($this->min($input_tpye[$field_name],$m[2][0]) === false )
                        
                       {
                        //   $this->messenger->add_message($this->language->get_dictionary()["text_".$field_name]." ".$this->language->get_dictionary()["user_error_".$m[1][0]]." ".$m[2][0],messenger::APP_MESSAGE_ERROR);
                        //   $this->messenger->add_message($this->language->get_value_from_dictionary("text_".$field_name)." ".$this->language->get_value_from_dictionary("user_error_".$m[1][0])." ".$m[2][0],messenger::APP_MESSAGE_ERROR);
                        // $new_str = sprintf($this->language->get_value_from_dictionary("user_error_".$m[1][0]),$this->language->get_value_from_dictionary("text_".$field_name),$m[2][0]);
                        // $this->messenger->add_message($new_str,messenger::APP_MESSAGE_ERROR);
                        $this->messenger->add_message(  
                              $this->language->feedkey("user_error_".$m[1][0], [$this->language->get_value_from_dictionary("text_".$field_name),$m[2][0] ]),
                              messenger::APP_MESSAGE_ERROR
                        );

                        //   var_dump( $this->messenger->get_messgaes());
                        // foreach($this->language->get_dictionary() as $key=>$filed)
                        // {
                            // echo "<pre>";
                            
                        //    var_dump($this->messenger->get_messgaes());
                            // var_dump( $this->messenger->get_messgaes());
                            // var_dump($this->language->get_dictionary()["user_error_".$single_valdation_role]);
                            // var_dump($m);
                        //     var_dump($key , $filed);
                        // var_dump( $this->messenger->get_messgaes());
                            // echo "</pre>";
                        // }
                        $errors[$field_name] = true;

                       }

                    }
                    elseif(preg_match_all("/(lt)\((\d+)\)/",$single_valdation_role,$m))
                    {

                       if ($this->lt($input_tpye[$field_name],$m[2][0]) === false )
                        
                       {
                        $this->messenger->add_message(  
                              $this->language->feedkey("user_error_".$m[1][0], [$this->language->get_value_from_dictionary("text_".$field_name),$m[2][0] ]),
                              messenger::APP_MESSAGE_ERROR
                        );

                        $errors[$field_name] = true;

                       }

                    }
                    elseif(preg_match_all("/(eq)\((\w+)\)/",$single_valdation_role,$m))
                    {

                       if ($this->eq($input_tpye[$field_name],$m[2][0]) === false )
                        
                       {
                        $this->messenger->add_message(  
                              $this->language->feedkey("user_error_".$m[1][0], [$this->language->get_value_from_dictionary("text_".$field_name),$m[2][0] ]),
                              messenger::APP_MESSAGE_ERROR
                        );

                        $errors[$field_name] = true;

                       }

                    }
                    // like eqfiled(password)
                    // $otherfield = $_post[password];
                    // check if $value == $otherfield;

                    elseif(preg_match_all("/(eqfiled)\((\w+)\)/",$single_valdation_role,$m))
                    {
                            $otherfield = $input_tpye[$m[2][0]];
                       if ($this->eqfiled($input_tpye[$field_name],$otherfield) === false )
                        
                       {
                        $this->messenger->add_message(  
                              $this->language->feedkey("user_error_".$m[1][0], [$this->language->get_value_from_dictionary("text_".$field_name),$this->language->get_value_from_dictionary("text_".$m[2][0])]),
                              messenger::APP_MESSAGE_ERROR
                        );

                        $errors[$field_name] = true;

                       }

                    }
                    // between(6,30)
                    elseif (preg_match_all("/(between)(\((\d+)\,(\d+)\))/",$single_valdation_role,$m))
                    {
                        if($this->between($input_tpye[$field_name],$m[3][0],$m[4][0]) === false)
                        {
                            $this->messenger->add_message( $this->language->feedkey("user_error_".$m[1][0], [ $this->language->get_value_from_dictionary("text_".$field_name),$m[3][0] ,$m[4][0] ] ),
                            messenger::APP_MESSAGE_ERROR);

                            // // $this->messenger->add_message("soory".$input_tpye[$field_name]." msut between ". $m[3][0]." and ". $m[4][0],messenger::APP_MESSAGE_ERROR);
                            // //   var_dump( $this->messenger->get_messgaes());
                            // var_dump($m);
                            $errors[$field_name] = true;
                        }

                    }
                    elseif (preg_match_all("/(float_like)(\((\d+)\,(\d+)\))/",$single_valdation_role,$m))
                    {
                        if($this->float_like($input_tpye[$field_name],$m[3][0],$m[4][0]) === false)
                        {
                            $this->messenger->add_message( $this->language->feedkey("user_error_".$m[1][0], [ $this->language->get_value_from_dictionary("text_".$field_name),$m[3][0] ,$m[4][0] ] ),
                            messenger::APP_MESSAGE_ERROR);

                            // // $this->messenger->add_message("soory".$input_tpye[$field_name]." msut between ". $m[3][0]." and ". $m[4][0],messenger::APP_MESSAGE_ERROR);
                            // //   var_dump( $this->messenger->get_messgaes());
                            // var_dump($m);
                            $errors[$field_name] = true;
                        }

                    }
                   
                    elseif($this->$single_valdation_role($input_tpye[$field_name]) === false )
                         {
                          $this->messenger->add_message(  
                            $this->language->feedkey("user_error_".$single_valdation_role, [$this->language->get_value_from_dictionary("text_".$field_name)]),
                            messenger::APP_MESSAGE_ERROR
                         );               
                         $errors[$field_name] = true;        
                       }

                }


            }
        }
       return empty($errors) ? true : false;
    }



 



    /*
In PHP, regular expressions are strings composed of 
delimiters, a pattern and optional modifiers.

$exp = "/w3schools/i";
In the example above, / is the delimiter, w3schools is the pattern that is being searched for,
 and i is a modifier that makes the search case-insensitive.
The delimiter can be any character that is not a letter, number, backslash or space.
 The most common delimiter is the forward slash (/), 
but when your pattern contains forward slashes it is convenient to choose other delimiters such as # or ~.

Regular Expression Functions
PHP provides a variety of functions that allow you to use regular expressions. 
The preg_match(), preg_match_all() and preg_replace()
 functions are some of the most commonly used ones:

Function	Description
preg_match()	Returns 1 if the pattern was found in the string and 0 if not
preg_match_all()	Returns the number of times the pattern was found in the string, which may also be 0
preg_replace()	Returns a new string where matched patterns have been replaced with another string

Example
Use a regular expression to do a case-insensitive search for "w3schools" in a string:

<?php
$str = "Visit W3Schools";
$pattern = "/w3schools/i";
echo preg_match($pattern, $str); // Outputs 1
?>

<?php
$str = "The rain in SPAIN falls mainly on the plains.";
$pattern = "/ain/i";
echo preg_match_all($pattern, $str); // Outputs 4
?>


Using preg_replace()
The preg_replace() function will replace all of the matches of the pattern in a string with another string.

Example
Use a case-insensitive regular expression to replace Microsoft with W3Schools in a string:

<?php
$str = "Visit Microsoft!";
$pattern = "/microsoft/i";
echo preg_replace($pattern, "W3Schools", $str); // Outputs "Visit W3Schools!"
?>

Regular Expression Modifiers
Modifiers can change how a search is performed.

Modifier	Description
i	Performs a case-insensitive search
m	Performs a multiline search (patterns that search for 
the beginning or end of a string will match the beginning or end of each line)
u	Enables correct matching of UTF-8 encoded patterns
 
Regular Expression Patterns
Brackets are used to find a range of characters:

Expression	Description
[abc]	Find one character from the options between the brackets
[^abc]	Find any character NOT between the brackets
[0-9]	Find one character from the range 0 to 9


Metacharacter	Description
|	Find a match for any one of the patterns separated by | as in: cat|dog|fish
.	Find just one instance of any character
^	Finds a match as the beginning of a string as in: ^Hello
$	Finds a match at the end of the string as in: World$
\d	Find a digit
\s	Find a whitespace character
\b	Find a match at the beginning of a word like this: \bWORD, or at the end of a word like this: WORD\b
\uxxxx	Find the Unicode character specified by the hexadecimal number xxxx


Quantifiers
Quantifiers define quantities:

Quantifier	Description
n+	Matches any string that contains at least one n
n*	Matches any string that contains zero or more occurrences of n
n?	Matches any string that contains zero or one occurrences of n
n{x}	Matches any string that contains a sequence of X n's
n{x,y}	Matches any string that contains a sequence of X to Y n's
n{x,}	Matches any string that contains a sequence of at least X n's


Note: If your expression needs to search for one of the special characters you can use a backslash ( \ ) to escape them. For example, 
to search for one or more question marks you can use the following expression: $pattern = '/\?+/';

Grouping
You can use parentheses ( ) to apply quantifiers to entire patterns. They also can be used to select parts of the pattern to be used as a match.

Example
Use grouping to search for the word "banana" by looking for ba followed by two instances of na:

<?php
$str = "Apples and bananas.";
$pattern = "/ba(na){2}/i";
echo preg_match($pattern, $str); // Outputs 1

https://www.w3schools.com/php/php_ref_regex.asp
?>





/*
PHP - Class Constants
Constants cannot be changed once it is declared.

Class constants can be useful if you need to define some constant data within a class.

A class constant is declared inside a class with the const keyword.

Class constants are case-sensitive. However, it is recommended to name the constants in all uppercase letters.

We can access a constant from outside the class by using the class name followed by the scope resolution operator (::) followed by the constant name, like here:

*/

}