<?php
            $name=$rollno=$dept=$email=$address=$aboutme="";
            $Ename=$Edept=$Eemail=$Erollno=$Eaddress="";
            $pwd="";
            $servername="localhost";
            $username="joy";
            $password="password";
            $dbname="mydb";
            $conn=new mysqli($servername,$username,$password,$dbname);
            if($conn->connect_error)
            {
                die("Connection Failed: ".$conn->connect_error)."<br>";
            }
            else
            {
                echo "Connected!<br>";
            }

            $disabled="disabled";
            $rollno="";
            if($_SERVER["REQUEST_METHOD"]=="GET")
            {
                $rollno=$_GET["rollno"];
                $error="";
                $length=strlen($rollno);
                if(!preg_match("/^[0-9]*$/",$rollno) || strlen($rollno)!=9)
                {
                    $error="Wrong rollno";
                }
                else
                {
                    $sql="SELECT * FROM student
                    WHERE Rollno='$rollno';";
                    $out=$conn->query($sql);
                    if($out->num_rows==0)
                    {
                        $error="NO such entry";
                    }
                    else
                    {
                        $disabled="";
                        $row=$out->fetch_assoc();
                        echo "Name:".$row["Name"]."<br>Rollno: ".$row["Rollno"]."<br>Department: ".$row["Department"]."<br>Email:".$row["Email"]."<br>Address: ".$row["Address"]."<br>About me:".$row["Aboutme"];
                    }
                }
            }            
            $conn->close();
        ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            body{
                font-family: "Comic Sans MS";
            }
            form input{
                border: 1px solid grey;
            }
            span{
                color: red;
            }
        </style>
    </head>
    <body>
        <br><br><form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
            RollNo:<input type="text" name="rollno" value="<?php echo $rollno;?>"><span>*<?php echo $error;?></span><br><br>
           <input type="submit"><br><br>
        <button type="submit" formaction="viewStudentSubmit.php" <?php echo $disabled;?>>EDIT</button>
        </form>
    </body>
</html>
