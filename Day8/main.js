//Function
//function functionName(){
 //code here
 //return
// }
//functionName(); //calling the function
//=====================================
//1)function decleration 
// var data=prompt("Enter your name");
// var age=prompt("Enter your age");
// function uname(x,y){
//     alert("Welcome ${x} \n your age is ${y}");
// }
// uname(data,age);
//======================================
//function expression
// var x=5,y=10;
// var sum=function(x,y){
//     return x+y;
// }
// console.log(sum(x,y));
//======================================
// var x=10 ,y=20,z=30;
// var fun=function(x,y){
//     if (arguments.callee.length!=2){
//         alert("function only accept 2 arguments");
//     }else{
//         return console.log(x+y);
//     }
// }
// fun(x,y,z);
// //=====================================
// function greetings(username){
//     username = username || "Mariam";
//     while (isFinite(username)){
//         username = prompt("Enter your name");
//     }
//     return alert("Hello, "+username);
// }
// greetings();
//========================================
// var printname =function(name){
//     return function(){
//         console.log("welcome "+name);
//     }
// }
// console.log(printname("mariam")());
//=======================================
// var printname =function(name){
//     return function(name2){
//         console.log(name," and ",name2);
//     }
// }
// console.log(printname("mariam")("ahmed"));
//=======================================
// function teacher(){
//     return 'teacher';
// }
// function student(){
//     return 'student';
// }
// function welcome(user){
//     return console.log('welcome '+user);
// }
// welcome(teacher());
//=======================================
//var , let , const 
//var => can be redeclared
//let => cannot be redeclared
//const => cannot be redeclared and cannot be modified
// var x=10;
// var x=20;
// console.log(x);
// let x=10;
// let x=20;
// console.log(x);
// const x=10;
// const x=20;
// console.log(x);
//=======================================
function sum(x,y){
    return x+y;
}
console.log(um(10,20));
// console.log(z);//not defined 
