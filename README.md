# Spider-Webdev-2
WebDev task 2

Before you start using the pages on localhost,
 grant the user "joy" all permissions(or the required ones, as you please)
 on the database "mydb".
 You can use the query:

 GRANT ALL PRIVILEGES ON mydb.* TO 'joy'@'localhost' IDENTIFIED BY 'password';

 Then add the files to 'www' folder and open localhost in browser.
adStudent.php adds students to the database.
viewStudent.php lets you view students on the database.
vieStudentSubmit.php verifies the password and lets you make changes the students' data in the database.
finalChanges.php confirms changes and redirects you to the index page.
