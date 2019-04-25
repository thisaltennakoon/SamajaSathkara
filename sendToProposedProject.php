<?php
$servername = "localhost"; 
$username = "root";                                            
$password = "";
$dbname = "SamajaSathkara";
$conn = new mysqli($servername,$username,$password,$dbname); // making the connection with mysql
if ($conn->connect_error){                       
    die("Connection failed: " . $conn->connect_error);
}                                                           
$name=$_POST['name'];
echo "Name: ".$name."<br>";
$pnumber=$_POST['pnumber'];
echo "Your Phone Number: ".$pnumber."<br>";
$email=$_POST['email'];
echo "Your Emali Address: ".$email."<br>";
$description=$_POST['description'];
echo "Description: ".$description."<br>";



$sql = "INSERT INTO proposedprojects(proposername,pnumber,email,description) VALUES ('$name','$pnumber','$email','$description')";
if ($conn->query($sql)===TRUE){
    echo "<h3>The project you proposed has been recorded successfully</h3>"."<h3>We will contact you soon..</h3>";
}else{
    echo "Error: ". $sql ."<br>" . $conn->error;
}

    
?>