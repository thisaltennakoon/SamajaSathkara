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
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
</head>
<body>

<h3>Propose a project</h3>

<div class="container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <!--form action="sendToProposedProject.php" method="post" /-->

    <label for="fname">Your Name</label>
    <input type="text" id="name" name="name" placeholder="Kumar">

    <label for="pnumber">Contact No</label>
    <input type="text" id="pnumber" name="pnumber" placeholder="0773608701">

    <label for="email">Email Address</label>
    <input type="text" id="email" name="email" placeholder="computer@gmail.com">

    <label for="Description">Project Description</label><br>
    <textarea name="description" placeholder="Please give a brief description about the project" rows="10" cols="30"></textarea>
    

    </select>

  
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>

<?php
if(isset($_POST['submit'])){
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
}
    
?>