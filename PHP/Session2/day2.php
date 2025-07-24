<?php
// Pre Defined var:
//=================
//echo "<pre>";
//var_dump($_SERVER);
//var_dump($_GET);
//var_dump($_POST);
//echo "<pre>";
?>
<!--<form action="" method="post">-->
<!--    <input type="hidden" name="id" value="5">-->
<!--    <input name="username" type="text">-->
<!--    <input type="submit">-->
<!--</form>-->
<?php
// CURD => create - update - read -delete

// Constant
//==========
//    define("DB_NAME","new_db");
//    echo DB_NAME;
//$v = "kmkk";
//    const DB_NAME = "new_db";
//    echo "$v  ".DB_NAME;

// معلومات نظام التشغيل
//================

//echo php_uname();

// Pre Defined Constant (magic const)
// payment - customer - posts
//================================
//    echo __LINE__;
//    echo "<br>";
//    echo __FILE__;
//    echo "<br>";
//    echo __DIR__;
//
//search ( Defined Constant - compile time vs runtime - list of reserved words)
//============================================================================
// OPERATORS ( +   -   *   /    %)
//=================================
//echo 10 + 20;
//echo gettype(10 + 20);
//    echo 9.5 + 20.5 ;
//    echo gettype(9.5 + 20.5);
//    echo 23 % 10;
//=================================
// Exponentiation
//================
//        echo 2**4;
//=================================
// identity -> +$a
// Negation -> -$a
//================
//    echo -"-100";
//    echo gettype(-"100");
//=================================
// Assignment Operator: ( += , -= , *= ,/= , **=)
//=================================
//$a = 10;
////$a = $a +20;
//$a *= 20;
//echo $a;
//=======================================
// Comparison Operator: ( ==, !=, <>, ===, !==)
//=========================
//var_dump(100 === 100.0);
// ( < , > , <= , >= , <=> )
//var_dump(100 <=> 80);

//POST Increment - Decrement
//$likes = 5;
//$likes--;
//$likes--;
//echo $likes;
//PRE Increment - Decrement
// =============================
//$a = 0;
//echo $a++;
//echo "<BR>";
//echo ++$a;
//echo "<BR>";
//echo $a;
//===================================================
// Logical Operators: ( and, &&, or, || ,xor ,!)
//==============================================
//$a = 10 or false;
//echo $a;

//var_dump(100>50 && 100>80);
//var_dump(100>50 or 100>180);
//var_dump(100>20 xor 100>180);
//===================================================
// String Operators:
//==================
//$a = "Ahmed";
//$b = "Ali";
//$c = "mostafa";
//const DB_TEST = "mysql";
//// Concat
// echo $a." ".DB_TEST." ".$c;
//
//function test()
//{
//    return 1;
//}
//echo $a." ".test()." ".$c;

//$fn = "islam";
//$ln = " ibrahim";
//$fn .= $ln;
//echo $fn;
//====================================================================
// Array Operators:
//==================
//+ => ( Union )
//==
//!=
//<>
//===
//!===
//    $arr1 = [1=>"A",2=>"B"];
//    $arr2 = [3=>"C",4=>"D"];
//    echo "<pre>";
//    var_dump($arr1+$arr2);
//    echo "</pre>";

//$arr4 = [1=>"10",2=>"20"];
//$arr5 = [2=>20,1=>10];
//echo "<pre>";
//var_dump($arr4 === $arr5);
//echo "</pre>";
//====================================================================
// Error Control Operator
//============================

//    $a = 10;
//    $b = @$a or die("Variable Not Found");
//    echo $b;
//var_dump( (@include("tesxt.php")));

//@include("tesst.php");


//====================================================================
// If , Elseif , else
//    if(10>5)
//        echo "yes";
//    else
//        echo "no";
//$page = "home";
//if ($page == "test"){
//    header("location:test.php");
//}else{
//    echo "Iam here";
//}

//    $a=10;
//    $b = $a > 8 ? "selected":"";
//
//    echo $b;

// Swith
//$day = "Friday";
//switch ($day) {
//    case 'sat':
//    case 'sun':
//        echo "Hello This Work";
//        break;q
//    case 'Friday':
//        echo "Hello This Friday = $day";
//        break;
//    default:
//        echo "Unkown day";
//}

// While
//$i=4;
//while ($i<=3):
//    echo $i."<br>";
//    $i++;
//endwhile;

// do while
//$i=4;
//do{
//    echo $i."<br>";
//    $i++;
//}while ($i<=3);

// for
//for ($i = 1; $i <= 3; $i++) {
//    echo $i."<br>";
//}

// foreach
//=========
//Array ( Indexed - Associative - multidimentional)
function myFun()
{
    echo "Iam MYFun";
}
$countries = [
    "KSA",
    "CAN",
    "Sy",
    "myFun"
];
//$countries[]="PP";
//array_push($countries,"Amrica","southAfrica");
//$countries += ["Amrica","ffffffff","kk","ii","pp"];
////$countries[3]();
//echo "<pre>";
//print_r(array_chunk($countries,2));
//echo "</pre>";
////exit();
$countries_discount = ["EG",
    "KSA",
    "CAN",
    "Sy",
//    ["apple","banana"]
];
foreach ($countries_discount as $k=>$v) {
    echo $k ."  :  ".$v."<br>";
}
// array chunk === foreach
