# OctopusBIPracticalTest
Practical Test - Senior Software Engineer (PHP)

1 . Clone the repo `https://github.com/sasitha999/OctopusBIPracticalTest`

2 . Create  mysql database named "highchart"

3 . Create  student table  using this SQL Query


      `CREATE TABLE students (
          id int(11) NOT NULL AUTO_INCREMENT,
          studentId varchar(128) NOT NULL,
          subject varchar(128) NOT NULL,
          marks int(11) NOT NULL,
          semester varchar(128) NOT NULL,
          year varchar(128) NOT NULL,
          grade varchar(128) NOT NULL,
          PRIMARY KEY (id),
          KEY subject (subject)
      );
      
4 . In `OctupusBIPracticalTest/highchart` run `composer install` to install packages.

5 . Copy `env` to `.env` and update database settings.


6 . Create seed data using `php spark db:seed StudentSeeder`, (This will take some considerable time amount)

7 . Run development server `php  spark serve`

`
