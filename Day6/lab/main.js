var number = prompt("Enter a number: ");
if (number%3 == 0 && number%5 == 0) {
    document.write("Q1 result: FizzBuzz");

}else if(number%3 == 0){
    document.write("Q1 result: Fizz");
}else if(number%5 == 0){
    document.write("Q1 result: Buzz");
}else{
    document.write("Q1 result: none");
}
//Q2
var Q1=prompt("Do I fly? (Y/N)");
if (Q1 == "Y" || Q1 == "y" || Q1 == "Yes" || Q1 == "yes" || Q1 == "YES") {
    var yQ2=prompt("Are You Wild? (Y/N)");
    if (yQ2 == "Y" || yQ2 == "y" || yQ2 == "Yes" || yQ2 == "yes" || yQ2 == "YES") {
        document.write("Q2 result: Eagle");
    }else{
        document.write("Q2 result: Parrot");
    }
}else {
    //confirm
    var nQ2=prompt("Do You Live under sea? (Y/N)");
    if (nQ2 == "Y" || nQ2 == "y" || nQ2 == "Yes" || nQ2 == "yes" || nQ2 == "YES") {
        nYQ2=prompt("Are you wild? (Y/N)");
        if (nYQ2 == "Y" || nYQ2 == "y" || nYQ2 == "Yes" || nYQ2 == "yes" || nYQ2 == "YES") {
            document.write("Q2 result: Shark");
        }else{
            document.write("Q2 result: Dolphin");
        }
    }else{
        nYQ2=prompt("Are you wild? (Y/N)");
        if (nYQ2 == "Y" || nYQ2 == "y" || nYQ2 == "Yes" || nYQ2 == "yes" || nYQ2 == "YES") {
            document.write("Q2 result: Lion");
        }else{
            document.write("Q2 result: Cat");
        }
    }
}

