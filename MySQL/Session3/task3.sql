use company;

-- Q1 Female dependents of female employees
SELECT d.dependent_name, d.Sex
FROM dependent d
JOIN employee e ON d.essn = e.ssn
WHERE d.Sex = 'F' AND e.gender = 'F'
UNION
SELECT d.dependent_name, d.Sex
FROM dependent d
JOIN employee e ON d.essn = e.ssn
WHERE d.Sex = 'M' AND e.gender = 'M';

-- Q2 . For each project, list the project name and the total hours per week (for all
-- employees) spent on that project.
SELECT p.pname, SUM(w.hours) AS total_hours_per_week
FROM project p
JOIN works_for w ON p.pnumber = w.pno
GROUP BY p.pname;

-- Q3 Display the data of the department which has the smallest employee ID over all
-- employees' ID. 
SELECT d.*
FROM departments d
JOIN employee e ON d.Dnum = e.DNO
WHERE e.ssn = (SELECT MIN(ssn) FROM employee);

-- Q4 . For each department, retrieve the department name and the maximum, minimum and
-- average salary of its employees
SELECT d.dname, MAX(e.Salary), MIN(e.Salary), AVG(e.Salary)
FROM departments d
JOIN employee e ON d.Dnum = e.DNO
GROUP BY d.Dname;

-- Q5 List the last name of all managers who have no dependents. 
SELECT e.Lname 
FROM employee e
JOIN departments d ON e.ssn = d.MGRSSN
LEFT JOIN dependent dep ON e.ssn = dep.ESSN
WHERE dep.essn IS NULL;

-- Q6 For each department-- if its average salary is less than the average salary of all
-- employees-- display its number, name and number of its employees. 
SELECT d.Dnum, d.Dname, COUNT(e.ssn) AS num_employees
FROM departments d
JOIN employee e ON d.Dnum = e.DNO
GROUP BY d.Dnum, d.Dname
HAVING AVG(e.salary) < (SELECT AVG(salary) FROM employee);

-- Q7 
SELECT d.Dname, e.Lname, e.Fname, p.Pname
FROM employee e
JOIN works_for w ON e.SSN = w.Essn
JOIN project p ON w.Pno = p.Pnumber
JOIN departments d ON e.DNO = d.Dnum
ORDER BY d.Dname, e.Lname, e.Fname;

-- Q8
SELECT d.Dname
FROM departments d
JOIN employee e ON d.Dnum = e.DNO
GROUP BY d.Dname
HAVING COUNT(e.SSN) > 2;