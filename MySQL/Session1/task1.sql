CREATE TABLE Level (
    lvl_id INT PRIMARY KEY AUTO_INCREMENT,
    lvl_name VARCHAR(100) UNIQUE
);

CREATE TABLE student (
    stud_id INT PRIMARY KEY ,
    stu_name VARCHAR(50),
    email VARCHAR(100),
    phone VARCHAR(15),
    total_score DECIMAL(5,2),
    level_id INT,
    FOREIGN KEY (level_id) REFERENCES Level(lvl_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

INSERT INTO Level (lvl_name) VALUES 
('Foundation'),
('Intermediate'),
('Advanced');

INSERT INTO student (stud_id,stu_name,email,phone,total_score,level_id) VALUES (22010394,"Mariam","mariam@gmail.com",'010123344566',98,2);


update student
set total_score = (1.1*student.total_score)
where stud_id = 22010394;

SELECT *from student
-- ===============================================================



