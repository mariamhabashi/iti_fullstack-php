-- DDL (Create - Alter- Truncate - Drop)
-- create
create database php_portsaid;
use php_portsaid;
create table dept
(dept_num int primary key,
dname varchar(50)
);

create table emp
(eid int primary key auto_increment,
ename varchar(20) not null,
gender enum('M','F'),
age tinyint check(age>17),
city varchar(20) default 'Cairo',
Dnum int,
foreign key (Dnum) references dept(dept_num)
on update cascade
on delete cascade
);
select * from emp;

-- Alter
alter table emp add salary int;
alter table emp modify salary bigint;
alter table emp drop salary;

alter table emp
add constraint fk_emp_dept
foreign key (Dnum) references dept(dept_num);

-- Truncate
truncate table emp;

-- Drop
Drop table emp;
-- -------------------------
-- DML (insert - update - delete)
-- insert
insert into dept
values (10, 'SD');

insert into emp
values (1, 'khaled', 'M', 20, 'alex', 10);
select * from emp;

insert into emp (ename, eid)
values ('Ahmed', 9);

insert into emp (ename, eid)
values ('Ahmed', 4), ('Eslam', 2), ('Nour',3);

-- Update
update emp
set ename = 'Omar'
where eid = 4;

set sql_safe_updates = 0;

-- Delete row by row
delete from emp
where eid = 3;

delete from emp;

delete from dept
where dept_num = 10;

-- ----------------------
-- DQL (select)
-- select
use iti;
select * 
from student;

select st_id, st_fname as 'First Name'
from student;

select distinct st_fname from student;
select First Name from student; -- XXX

Select * from student
where st_age > 25;

Select * from student
where st_age > 25 and st_age < 30;

Select * from student
where st_age between 25 and 30;

Select * from student
where St_Address ='cairo' or St_Address ='alex'; 

Select * from student
where St_Address in ('cairo', 'alex');

Select * from student
order by st_fname desc;

Select * from student
order by st_age desc
limit 3;

-- _ one char, % set of characters
Select * from student
where st_fname like 'a%';

Select * from student
where st_fname like 'a__';

select st_id, St_Fname from student
where St_Address = 'cairo'
union 
select st_lname, st_address from student
where st_age = 25;