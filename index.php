<?php

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            body{
                font-family: "Comic Sans MS";
            }
            button{
            background-color: lightgrey;
            border: 1px solid grey;
            border-radius: 5px;
            padding: 5px;
            outline: none;
            font-size: 20px;
            box-shadow:1px 1px 0 grey;
            cursor: pointer;
            margin-right: 80px;
            width: 200px;
            }
            button:active{
                box-shadow:0px 0px 0 grey;
                transform: translateY(1px);
                transform:translateX(1px);
            }
        </style>
    </head>
    <body>
        <p>This is the index page.</p>
        <p>The "Add Student" Button directs you to a page where you can add an student to our database.</p>
        <p>The "View Student" Button allows you to view any student if you know the roll number.</p>
        <p>The "EDIT" button on the "viewStudent" page directs you to a page where you can change the credentials of the student if you know the passcode.</p>
        <p>Please READ the README.md also.</p>
       <a href="addStudent.php"><button>Add Student</button></a>
        <a href="viewStudent.php"><button>View Student</button></a>
    </body>
</html>
