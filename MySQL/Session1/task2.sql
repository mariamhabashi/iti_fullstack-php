use company;
-- Q1
SELECT * from employee;

-- Q2
SELECT SSN,Fname from employee 
where salary >1000;

-- Q3
SELECT Pnumber , Pname from project 
where Dnum=10;

-- Q4
SELECT concat(Fname," ",Lname) from employee
where Gender="F";

-- Q5
SELECT Pnumber , Pname , Plocation from project 
where city in ('cairo', 'alex');

-- Q6
SELECT * from project 
where Pname like 'a%';

-- Q7
Select * from employee 
where DNO=30 AND salary between 1000 and 3000;

-- Q8
select concat(Fname," ",Lname),Bdate from employee
where month(Bdate)= 3;

 