<?php
$read="3";//$_POST['read'];

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

$sql = 'SELECT completed,estimatedprojectcost,raised FROM Projects Where id='.$projectid; //reading things from the table
$result = $conn->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $completed=$row["completed"];
        $estimatedprojectcost=$row["estimatedprojectcost"];
        $raised=$row["raised"];
    }
}
$newraised=$raised+$amount;
if ($estimatedprojectcost>=$newraised){
    $newcompleted=1;
}
$sql ='UPDATE Projects SET raised='.$newraised.' WHERE id='.$projectid;
$conn->query($sql);
$sql ='UPDATE Projects SET completed='.$newcompleted.' WHERE id='.$projectid;
$conn->query($sql);
$sql ='UPDATE Donation SET approved=true WHERE id='.$read;
$conn->query($sql);
$conn->close();


?>