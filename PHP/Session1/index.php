<?php

//Variable
echo "Variables";
echo "<br>";
$name = "Mariam";
echo $name;
echo "<br>";
$age =22;
echo $age;
echo "<br>";
$salary =12000.50;
echo $salary;
echo "<br>";
$gender = "F";
echo $gender;
echo "<br>";
$stuent = true;
echo $stuent;
echo "<br>";
echo "<hr>";

//Type
echo "Types";
echo "<br>";
echo gettype($name);
echo "<br>";
echo gettype($age);
echo "<br>";
echo gettype($salary);
echo "<br>";
echo gettype($gender);
echo "<br>";
echo gettype($stuent);
echo "<br>";
echo "<hr>";

//Casting
echo "Casting";
echo "<br>";
$age = (string)$age;
echo gettype($age);
echo "<br>";
echo "<hr>";

//array
$students = array("Mariam", "Ahmed", "Ali");
print_r($students);
echo "<br> <pre>";
var_dump($students);
echo "<br> <pre>";
echo "<hr>";

$a = "Mariam";
$b =&$a;
$b="Mahmoud";
echo "a ==> $a <br>b ==> $b";
echo "<hr>";