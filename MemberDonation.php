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

<h3>Member Donation</h3>

<div class="container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <!--form action="hello.php" method="post" /-->

    <label for="ProjectID">Project ID </label>
    <input type="text" id="ProjectID" name="ProjectID" placeholder="ProjectID">

    <label for="amount">Amount</label>
    <input type="text" id="amount" name="amount" placeholder="amount">

    <label for="BankSlip">Bank Slip</label>
    <input type="text" id="BankSlip" name="BankSlip" placeholder="BankSlip">

    <label for="UserID">UserID</label>
    <input type="text" id="UserID" name="UserID" placeholder="UserID">

    <label for="fullname">Full Name</label>
    <input type="text" id="fullname" name="fullname" placeholder="fullname">

    <label for="NIC">NIC</label>
    <input type="text" id="NIC" name="NIC" placeholder="NIC">

    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="Email">

    <label for="pnumber">Phone Number</label>
    <input type="text" id="pnumber" name="pnumber" placeholder="pnumber">

    </select>

    
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$ProjectID=$_POST['ProjectID'];
echo "ProjectID: ".$ProjectID."<br>";
$amount=$_POST['amount'];
echo "Amount: ".$amount."<br>";
$BankSlip=$_POST['BankSlip'];
echo "Bank Slip: ".$BankSlip."<br>";
$UserID=$_POST['UserID'];
echo "UserID: ".$UserID."<br>";
$fullname=$_POST['fullname'];
echo "fullname: ".$fullname."<br>";
$NIC=$_POST['NIC'];
echo "NIC: ".$NIC."<br>";
$email=$_POST['email'];
echo "email: ".$email."<br>";
$pnumber=$_POST['pnumber'];
echo "pnumber: ".$pnumber."<br>";


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
//$date1=strval(date("Ymd"));
//$time1= strval(date("His"));
//$projectid= "project".$date1.$time1;

$sql = "INSERT INTO Donation(ProjectID,amount,submitdate,submittime,BankSlip,isMember,UserID,fullname,NIC,email,pnumber,approved) VALUES ('$ProjectID','$amount','$date','$time','$BankSlip',true,'$UserID','$fullname','$NIC','$email','$pnumber',false)"; // insert data to the created table

//$sql = "INSERT INTO Projects (completed ,createdate ,cratetime ,projectname ,estimatedprojectcost ,raised ,projectid) VALUES (false,'$date','$time','$projectname','$estimatedprojectcost','$raised','$projectid')"; // insert data to the created table
if ($conn->query($sql)===TRUE){
    echo "<h3>Donation has been sucessfully created";
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