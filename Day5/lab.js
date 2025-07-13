//JavaScript - What is the output? (20 Questions)

//1.
var result = '5' - '2' + '3';
console.log(result); //5-2 =3 >> '3' +'3' =33

//2.
var x = null;
console.log(typeof x); //object

//3.
var value = !!(null || 0 || ""); 
console.log(value); //!!("") >> false

//4.
var result = '10' - 5 + true;
console.log(result); //10-5=5 >> 5+true(1) =6

//5.
console.log(typeof NaN === 'number'); //Number ??? true

//6.
var x = undefined;
console.log(x + 1); // NaN

//7.
var a = 5;
var b = a++;
//b=a
//a=6
console.log(a, b);//6,5

//8.
console.log(Number('123abc'));//NaN

//9.
console.log(parseInt('123.45') + parseFloat('123.45')); // 123 +123.45=246.45

//10.
var x = +'20.5';
var y = parseInt('20.5');//20
console.log(x - y); //0.5

//11.
var result = 0 || false && true; //false
console.log(result);

//12.
var result = Math.floor(Math.random() * 5) + 1; //0.1 to 4.99 
console.log(result > 0 && result <= 5);//true

//13.
var x = 2;
var y = '2';
console.log(x + y);//22

//14.
var x;
console.log(typeof x);//undefined

//15.
console.log(null == undefined);//true

//16.
var x = '';
console.log(Boolean(x));//false

//17.
console.log(NaN == NaN);//false

//18.
var x = Math.ceil(1.2);//2
var y = Math.floor(1.8);//1
console.log(x + y); //3

//19.
var x = 'omar' || 0 || false;
console.log(x);//omar

//20.
var x = 5;
x *= 2;
x -= 3;
console.log(x);//7
