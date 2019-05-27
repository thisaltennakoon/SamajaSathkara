<?php
$read=$_POST['read'];

$servername = "localhost";                                    // host which has established our computer.If the database is on a sever, then this should change accordinly
$username = "root";                                           // username and the password of the mysql sever
$password = "";
$dbname = "SamajaSathkara";
$conn = new mysqli($servername,$username,$password,$dbname); // making the connection with mysql
if ($conn->connect_error){                                   // check whether the connection is correctly established or not
    die("Connection failed: " . $conn->connect_error);
}  


$sql = 'SELECT ProjectID,amount FROM Donation Where id='.$read; //reading things from the table
$result = $conn->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $projectid=$row["ProjectID"];
        $amount=$row["amount"];
    }
}

$sql = 'SELECT completed,estimatedprojectcost,raised FROM Projects Where projectid="'.$projectid.'"'; //reading things from the table
$result = $conn->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $completed=$row["completed"];
        $estimatedprojectcost=$row["estimatedprojectcost"];
        $raised=$row["raised"];
    }
}

echo 'completed='.$completed;
echo '<br>';
echo 'estimatedprojectcost='.$estimatedprojectcost;
echo '<br>';
echo 'raised='.$raised;echo '<br>';

$raised=$raised+$amount;
if ($estimatedprojectcost<=$raised){
    $completed=1;
}
echo 'newraised='.$raised;echo '<br>';
echo 'new completed='.$completed;

$sql ='UPDATE Projects SET raised='.$raised.' Where projectid="'.$projectid.'"';
$conn->query($sql);
$sql ='UPDATE Projects SET completed='.$completed.' Where projectid="'.$projectid.'"';
$conn->query($sql);
$sql ='UPDATE Donation SET approved=true WHERE id='.$read;
$conn->query($sql);
$conn->close();


?>