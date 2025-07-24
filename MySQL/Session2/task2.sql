use company;
-- Q1 Display the name of the departments and the name of the projects under its control. 
SELECT Dname, Pname
FROM departments AS d
JOIN project AS p ON d.Dnum = p.Dnum;

-- Q2 Display the full data about all the dependence associated with the name of the employee
-- they depend on him/her
SELECT Fname, Lname, depen.*
FROM employee AS e
JOIN dependent AS depen ON e.Ssn = depen.Essn;

-- Q3 Find the names of the employees who directly supervised with Kamel Mohamed. 
SELECT E.Fname, E.Lname
FROM employee AS E
JOIN employee AS S ON E.SuperSSN = S.SSN
WHERE S.Fname = 'Kamel' AND S.Lname = 'Mohamed';

-- Q4 Display All Employees data and the data of their dependents even if they have no
-- dependents 
SELECT e.*, depen.*
FROM employee AS e
LEFT JOIN dependent AS depen ON e.SSN = depen.Essn;

-- Q5 Retrieve the names of all employees in department 10 who works more than or equal10
-- hours per week on "AL Rabwah" project. 
SELECT e.Fname, e.Lname
FROM employee AS e
JOIN works_for AS wf ON e.SSN = wf.Essn
JOIN project AS p ON wf.Pno = p.Pnumber
WHERE e.DNO = 10 AND p.Pname = 'AL Rabwah' AND wf.Hours >= 10;

-- Q6 Retrieve the names of all employees and the names of the projects they are working on,
-- sorted by the project name.
SELECT e.Fname, e.Lname, p.Pname
FROM employee AS e
JOIN works_for AS wf ON e.SSN = wf.Essn
JOIN project AS p ON wf.Pno = p.Pnumber
ORDER BY p.Pname;

-- Q7  highest salary
SELECT MAX(Salary)
FROM employee;

-- Q8  top 3 highest salaries
SELECT DISTINCT Salary
FROM employee
ORDER BY Salary DESC
LIMIT 3;

-- Q9 number of employees in department 10
SELECT COUNT(*)
FROM employee 
WHERE DNO = 10;