<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF49;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a048;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f1;
  padding: 20px;
}
</style>
</head>
<body>

<h3>Contact Form</h3>

<div class="container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <!--form action="hello.php" method="post" /-->

    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Kumar">

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Sangakkara">

    <label for="email">Email Address</label>
    <input type="text" id="email" name="email" placeholder="computer@gmail.com">

    <label for="pnumber">Phone Number</label>
    <input type="text" id="pnumber" name="pnumber" placeholder="0717303215">

    <label for="message">Message</label>
    <input type="text" id="message" name="message" placeholder="Enter Your Message">

    </select>

    
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
}
?>