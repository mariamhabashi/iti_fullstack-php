//Losely type language
// 5=> number //"Omar" =>string
//<non script>please allow cookies</non script>
//reserve keywords
// ==>for /if/break/continue/delete
//automatic garbage collection
//name="Omar"; // and then i didn't use it >>> so it will be deleted (garbage collection)
// Data type
// number ==>5
// string ==>"Omar"
// boolean ==>true/false
// null ==>null
// float ==>5.5
// undefined ==>undefined
//========================================
var name ="Omar"; //string
var age = 26; //number
var isMale = true; //boolean
var student = null; //null
var grade = undefined; //undefined
//========================================
//premitive data type
//Number  /String /Boolean /Null /Undefined
//non premitive data type
//Array /Object
//========================================
var x =null //varaiable without value
var y //undefinded => variable just initialized 
//========================================
//arthmetic operator
// (+,-,*,/,%)
//prefix operator
// ++x --x
//postfix operator
// x++ x--
//========================================
//logical operator
// &&(and) , ||(or) , !(not)
// && => search for first false
// || => search for first true
// ! => opposite
//'omar' || 1 || true ==> 'omar'
//1 && 0 && 5 ==> 0
//false && 0 && ('') ==>false
//=======================================
// comparison operator
// ( < , > , <= , >= )
//equality operation
// (== , ===)
// 2 == '2' ==> true
// 2 === '2' ==> false
// 2 != '2' ==> false
// 2 !== '2' ==> true
//=======================================
//toFixed => float to fixed number
var x=10.68;
console.log(x.toFixed(2));
//toprecision => float to precision number
console.log(x.toPrecision(2));
//toString => convert to string
var x=10.68;
console.log(typeof(x.toString()));
//parseInt => convert to integer
console.log(parseInt(x));
console.log(Math.floor(x));
console.log(Math.ceil(x));
console.log(Math.round(x));
