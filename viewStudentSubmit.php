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

            $rollno="";
            $readonly="readonly";
            $disabled="disabled";
            if($_SERVER["REQUEST_METHOD"]=="GET")
            {
                $rollno=$_GET["rollno"];
                echo $rollno;
            }
            else if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                $rollno1=$_POST["rollno1"];
                $rollno=$rollno1;
                $pwd=$_POST["pwd"];
                $error="";
                if(strlen($pwd)!=8)
                {
                    $error="Wrong Password ".strlen($pwd);

                }
                else
                {
                    $sql="SELECT * FROM student
                    WHERE Passcode='$pwd' AND Rollno='$rollno1';";
                    $out=$conn->query($sql);
                    if($out->num_rows==0)
                    {
                        $error="Wrong Password".$pwd;
                    }
                    else
                    {
                        $row=$out->fetch_assoc();
                        $readonly="";
                        $disabled="";
                        $name=$row["Name"];
                        $dept=$row["Department"];
                        $email=$row["Email"];
                        $address=$row["Address"];
                        $aboutme=$row["Aboutme"];
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
            form textarea{
                border: 1px solid grey;
            }
        </style>
    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <input type="text" name="rollno1" value="<?php echo $rollno;?>" readonly="readonly"><br><br>
            Passcode:<input type="password" name="pwd"><span>*<?php echo $error;?></span><br><br>
            <input type="submit" value="Edit"><br><br>
            Name:
            <input type="text" name="name" value="<?php echo $name?>" <?php echo $readonly;?>><span> *<?php echo $Ename;?></span><br><br>
            Department:
            <select name="department" value="<?php echo $dept?>" <?php echo $disabled;?>>
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
            <input type="text" name="email" value="<?php echo $email?>" <?php echo $readonly;?>><span> *<?php echo $Eemail;?></span><br><br>
            Physical Address:
            <textarea name="address" rows="5" cols="40" <?php echo $readonly;?>><?php echo $address?></textarea><span>*<?php echo $Eaddress?></span><br><br>
            About me:
            <textarea name="aboutme" rows="6" cols="40" <?php echo $readonly;?>><?php echo $aboutme?></textarea><br><br>
            <input type="submit" formaction="finalChanges.php">
        </form>
        
        
    </body>
</html>
