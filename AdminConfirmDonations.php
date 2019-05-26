<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 30px;
  height: 17px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(13px);
  -ms-transform: translateX(13px);
  transform: translateX(13px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 3417px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
</head>

<body>

<?php

$servername = "localhost";                                    // host which has established our computer.If the database is on a sever, then this should change accordinly
$username = "root";                                           // username and the password of the mysql sever
$password = "";
$dbname = "SamajaSathkara";
$conn = new mysqli($servername,$username,$password,$dbname); // making the connection with mysql
if ($conn->connect_error){                                   // check whether the connection is correctly established or not
    die("Connection failed: " . $conn->connect_error);
}                                                            // upto here ,connection is established
echo "<h1>Admin Panel/Donations Approving       </h1>";
echo '<h3><a href="#C4">View Approved Donations</a></h3>';
$sql = "SELECT id,ProjectID,amount,submitdate,submittime,BankSlip,isMember,UserID,fullname,NIC,email,pnumber,approved FROM Donation Where approved=false"; //reading things from the table

$result = $conn->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){       //while loop
        echo "<b>Data & Time : </b>".$row["submitdate"]." ".$row["submittime"];
        echo "<br>";
       
        echo "<b>Name : </b>".$row["fullname"];
        echo "<br>";
        echo '<b>Email : </b><a href="mailto:'.$row["email"].'?Subject=Samaja%20Sathkara&body=" target="_top">'.$row["email"].'</a>';
        echo '(Click this link to send a email)';
        echo "<br>";
        echo "<b>Phone Number : </b>".$row["pnumber"];
        echo "<br>";
        echo "<b>ProjectID : </b>".$row["ProjectID"];
        echo "<br>";
        echo "<b>amount : </b>".$row["amount"];
        echo "<br>";
        echo "<b>BankSlip : </b>".$row["BankSlip"];
        echo "<br>";
        echo "<b>isMember : </b>".$row["isMember"];
        echo "<br>";
        echo "<b>UserID : </b>".$row["UserID"];
        echo "<br>";
        echo "<b>NIC : </b>".$row["NIC"];
        echo "<br>";
        echo '<p>Mark as Approved: <label class="switch"> <input type="checkbox" id="'.$row["id"].'" onclick="myFunction('.$row["id"].')"><span class="slider round"></span></label></p>';
        echo "<hr>";
      }
    }else{
    //echo "All submitted contact forms have been readed.";
  }

echo "<hr>";echo "<hr>";
echo '<h2 id="C4">Approved Donations</h2>';

$sql = "SELECT id,ProjectID,amount,submitdate,submittime,BankSlip,isMember,UserID,fullname,NIC,email,pnumber,approved FROM Donation Where approved=true"; //reading things from the table

$result = $conn->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){       //while loop
        echo "<b>Data & Time : </b>".$row["submitdate"]." ".$row["submittime"];
        echo "<br>";
       
        echo "<b>Name : </b>".$row["fullname"];
        echo "<br>";
        echo '<b>Email : </b><a href="mailto:'.$row["email"].'?Subject=Samaja%20Sathkara&body=" target="_top">'.$row["email"].'</a>';
        echo '(Click this link to send a email)';
        echo "<br>";
        echo "<b>Phone Number : </b>".$row["pnumber"];
        echo "<br>";
        echo "<b>ProjectID : </b>".$row["ProjectID"];
        echo "<br>";
        echo "<b>amount : </b>".$row["amount"];
        echo "<br>";
        echo "<b>BankSlip : </b>".$row["BankSlip"];
        echo "<br>";
        echo "<b>isMember : </b>".$row["isMember"];
        echo "<br>";
        echo "<b>UserID : </b>".$row["UserID"];
        echo "<br>";
        echo "<b>NIC : </b>".$row["NIC"];
        echo "<br>";
        //echo '<p>Mark as Read: <label class="switch"> <input type="checkbox" id="'.$row["id"].'" onclick="myFunction('.$row["id"].')"><span class="slider round"></span></label></p>';
        echo '<p>Mark as Approved: <label class="switch"> <input type="checkbox" checked id="'.$row["id"].'" onclick="myFunction('.$row["id"].')"><span class="slider round"></span></label></p>';
      
        echo "<hr>";
      }
    }else{
    //echo "All submitted contact forms have been readed.";
  }

?>

<script>
function myFunction(a) {
    var checkBox = document.getElementById(a);
  //var text = document.getElementById("text");
  if (checkBox.checked == true){
    var ajax=new XMLHttpRequest();
    var url='markasConfirmed.php';
    //ajax.onreadystatechange=response;
    ajax.open('POST',url,true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.send('read='+a);
  } else {
    var ajax=new XMLHttpRequest();
    var url='markasNotConfirmed.php';
    //ajax.onreadystatechange=response;
    ajax.open('POST',url,true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.send('read='+a);
  }



    
      
}
</script>
</body>
</html>


