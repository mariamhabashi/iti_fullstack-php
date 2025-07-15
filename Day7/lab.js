// //Q1
// function alpha(mystring){
//     return mystring.split('').sort().join('');
// }
// console.log(alpha("javascript"));

//=======================================
//Q2
// var arrlength=parseInt(prompt("Enter the length of the array: "));
// var arr=[];
// function getrandom(arrlength){
//     for (var x=0;x<arrlength;x++){
//     arr[x]= (Math.floor(Math.random() * 10) + 1);
//     }
// }
// getrandom(arrlength);
// console.log(arr);
//=========================================
//Q3
// var mystring=prompt("Enter a string: ");
// function cpitalization(str){
//    var words = str.split(' ');
//    for (let i = 0; i < words.length; i++) {
//         if (words[i]) {
//             var firstLetter = words[i].charAt(0).toUpperCase();
//             var rest = words[i].slice(1);
//             words[i] = firstLetter + rest;
//         }
//     }
//     return words.join(' ');
// }
// console.log(cpitalization(mystring));
//==========================================
//Q4
// var myString = prompt("Enter the string:");
// var charToFind = prompt("Enter the character to find:");
// var count = 0;      
// var indixes = []; 
// var repeatedChar="";
// function findChar(myString, charToFind) {
//     for (var i = 0; i < myString.length; i++) {
//         if (myString[i] === charToFind) {
//             count++;
//             indixes.push(i);
//             repeatedChar += myString[i]+",";
//         }
//     }
//     console.log("The letter repeated about " + repeatedChar + " and it's count is " + count + " it's index is " + indixes);
// }
// findChar(myString, charToFind);
    