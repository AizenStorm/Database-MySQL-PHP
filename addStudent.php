<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            body{
                font-family: "Comic Sans MS";
            }
            span{
                color:red;
                font-family: "Times New Roman";
            }
           input[type=text]{
                border: 1px solid grey;
                border-radius: 5px;
                padding: 5px;
            }
            form textarea{
                border: 1px solid grey;
                border-radius: 5px;
                font-family: 'Comic Sans MS';
            }
            select{
                padding: 5px;
                border-radius:5px;
                font-size: 15px;
            }
            input[type=submit]{
                padding: 5px;
                border-radius:5px;
                font-size: 20px;
                cursor: pointer;
                outline: none;
            }
        </style>
    </head>
    <body>
        <?php
            $name=$rollno=$dept=$email=$address=$aboutme="";
            $Ename=$Edept=$Eemail=$Erollno=$Eaddress="";
            $pwd="";
            $error=TRUE;
            $servername="localhost";
            $username="joy";
            $password="password";
            $dbname="mydb";
            $conn=new mysqli($servername,$username,$password,$dbname);
            if($conn->connect_error)
            {
                die("Connection Failed: ".$conn->connect_error);
            }
            else
                echo "Connected!<br>";

            $sql="CREATE TABLE student(
                Name VARCHAR(30) NOT NULL,
                Rollno CHAR(9) PRIMARY KEY,
                Department VARCHAR(10) NOT NULL,
                Email VARCHAR(40) NOT NULL,
                Address VARCHAR(100) NOT NULL,
                Aboutme VARCHAR(120),
                Passcode CHAR(8) NOT NULL UNIQUE
                )";

            if($conn->query($sql)===TRUE)
            {
                echo "Table Created<br>";
            }
            

            $stmt=$conn->prepare("INSERT INTO student VALUES(?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssss",$name,$rollno,$dept,$email,$address,$aboutme,$pwd);

            

            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                if(empty($_POST["name"]))
                {
                    $Ename="Name can't be empty";
                    $error=TRUE;
                }
                else
                {
                    $name=validate($_POST["name"]);
                    if(!preg_match("/^[a-zA-Z ]*$/",$name))
                    {
                        $Ename="Only alphabets and spaces allowed in name";
                        $error=TRUE;
                    }
                    else
                    {
                        $error=FALSE;
                    }
                }
                if(empty($_POST["rollno"]))
                {
                    $Erollno="Rollno can't be empty";
                    $error=TRUE;
                }
                else
                {
                    $rollno=$_POST["rollno"];
                    if(!preg_match("/^[0-9]*$/",$rollno) || strlen($rollno)!=9)
                    {
                        $Erollno="RollNO. should be a 9-digit long number";
                        $error=TRUE;
                    }
                    else
                    {
                        $error=FALSE;
                    }
                }
                $dept=$_POST["department"];
                if(empty($_POST["email"]))
                {
                    $Eemail="Email can't be empty";
                    $error=TRUE;
                }
                else
                {
                    $email=validate($_POST["email"]);
                    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                    {
                        $Eemail="Improper email format";
                        $error=TRUE;
                    }
                    else
                    {
                        $error=FALSE;   
                    }
                }
                if(empty($_POST["address"]))
                {
                    $Eaddress="Address can't be empty";
                    $error=TRUE;
                }
                else
                {
                    $address=htmlspecialchars($_POST["address"]);
                    $error=FALSE;
                }

                $aboutme=htmlspecialchars($_POST["aboutme"]);
                

            }
            if(!$error)
                {
                    $pwd=random_string();
                    echo "PASSCODE: ".$pwd;
                    if($stmt->execute())
                    {
                        echo "<br>successful";
                    }
                    else
                    {
                        print_r(mysqli_error_list($conn));
                    }
                }
            function validate($data)
            {
                $data=trim($data);
                $data=stripslashes($data);
                $data=htmlspecialchars($data);
                return $data;
            }
            function random_string()
            {
                $halfstr=openssl_random_pseudo_bytes(4);
                $str=bin2hex($halfstr);
                return $str;
            }
            $conn->close();
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            Name:
            <input type="text" name="name"><span> *<?php echo $Ename;?></span><br><br>
            Roll No.:
            <input type="text" name="rollno"><span> *<?php echo $Erollno?></span><br><br>
            Department:
            <select name="department">
                <option value="Chemical">Chemical</option>
                <option value="Civil">Civil</option>
                <option value="CSE">CSE</option>
                <option value="ECE">ECE</option>
                <option value="EEE">EEE</option>
                <option value="Mechanical">Mechanical</option>
                <option value="Production">Production</option>
                <option value="MME">MME</option>
            </select><span> *</span><br><br>
            Email:
            <input type="text" name="email"><span> *<?php echo $Eemail;?></span><br><br>
            Physical Address:
            <textarea name="address" rows="5" cols="40"></textarea><span>*<?php echo $Eaddress?></span><br><br>
            About me:
            <textarea name="aboutme" rows="6" cols="40"></textarea><br><br>
            <input type="submit">
            
        </form>
    </body>
</html>
