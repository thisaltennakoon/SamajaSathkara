<?php
$firstname=$_POST['firstname'];
echo "Your First Name: ".$firstname."<br>";
$lastname=$_POST['lastname'];
echo "Your Last Name: ".$lastname."<br>";
$email=$_POST['email'];
echo "Your Emali Address: ".$email."<br>";
$pnumber=$_POST['pnumber'];
echo "Your Phone Number: ".$pnumber."<br>";
$message=$_POST['message'];
echo "Your Message is : ".$message."<br>";

$servername = "localhost";                                    // host which has established our computer.If the database is on a sever, then this should change accordinly
$username = "root";                                           // username and the password of the mysql sever
$password = "";
$dbname = "SamajaSathkara";
$conn = new mysqli($servername,$username,$password,$dbname); // making the connection with mysql
if ($conn->connect_error){                                   // check whether the connection is correctly established or not
    die("Connection failed: " . $conn->connect_error);
}                                                            // upto here ,connection is established



$c="'";
$date=strval(date("Y-m-d"));
$time= strval(date("H:i:s"));

$sql = "INSERT INTO ContactForm(readed,submitdate,submittime,firstname,lastname,email,pnumber,messages) VALUES (false,'$date','$time','$firstname','$lastname','$email','$pnumber','$message')"; // insert data to the created table
if ($conn->query($sql)===TRUE){
    echo "<h3>Your Contact Form has been successfully submitted.</h3>"."<h3>We will contact you soon..</h3>";
}else{
    echo "Error: ". $sql ."<br>" . $conn->error;
}




/*$sql = "SELECT firstname,lastname,email,pnumber FROM ContactForm"; //reading things from the table
$result = $conn->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){       //while loop
        echo "firstname: ". $row["firstname"]."<br>"." lastname: " . $row["lastname"]."<br>"."email: ".$row["email"]."<br>"."pnumber: ".$row["pnumber"]."<br>"."<br>";
    }                       
}else{
    echo "0 results";
}*/

$conn->close();    //close the connection with database

?>



