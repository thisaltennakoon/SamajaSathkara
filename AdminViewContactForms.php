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
echo "<h1>Admin Panel/Submitted Contact Forms       </h1>";
echo '<h3><a href="#C4">View Old Contact Forms</a></h3>';
$sql = "SELECT id,readed,submitdate,submittime,firstname,lastname,email,pnumber,messages FROM ContactForm Where readed=false"; //reading things from the table
$result = $conn->query($sql);
$fetcheddata=array();
$a=0;
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){       //while loop
        //echo "firstname: ". $row["firstname"]."<br>"." lastname: " . $row["lastname"]."<br>"."email: ".$row["email"]."<br>"."pnumber: ".$row["pnumber"]."<br>"."<br>";
        //$sql ='UPDATE ContactForm SET readed=true WHERE id='.$row["id"];
        //$conn->query($sql);
        //echo $result->num_rows;
        
        array_push($fetcheddata,$row["id"],$row["readed"],$row["submitdate"],$row["submittime"],$row["firstname"],$row["lastname"],$row["email"],$row["pnumber"],$row["messages"]);
        //echo $fetcheddata[$a]." - ".$fetcheddata[$a+1]." - ".$fetcheddata[$a+2]." - ".$fetcheddata[$a+3]." - ".$fetcheddata[$a+4]." - ".$fetcheddata[$a+5]." - ".$fetcheddata[$a+6]." - ".$fetcheddata[$a+7]." - ".$fetcheddata[$a+8];
        echo "<b>Data & Time : </b>".$fetcheddata[$a+2]." ".$fetcheddata[$a+3];
        echo "<br>";
       // echo "<hr width="50%" size="3" />";
        echo "<b>Name : </b>".$fetcheddata[$a+4]." ".$fetcheddata[$a+5];
        echo "<br>";
        echo '<b>Email : </b><a href="mailto:'.$fetcheddata[$a+6].'?Subject=Samaja%20Sathkara&body=Your Message: '.$fetcheddata[$a+8].'" target="_top">'.$fetcheddata[$a+6].'</a>';
        echo "<br>";
        echo "<b>Phone Number : </b>".$fetcheddata[$a+7];
        echo "<br>";
        echo "<b>Message : </b>".$fetcheddata[$a+8];
        
        echo "<br>";
        //<p>This is an email link:<a href="mailto:someone@example.com?Subject=Hello%20again" target="_top">Send Mail</a></p>
        //echo '<input type="button" id="'.$row["id"].'" onclick="myFunction('.$row["id"].')">Mark as Read</button>';
        //echo '<p id="'.$row["id"].'" style="display:none">'.$row["firstname"].'</p>';
       // echo '<button type="button" id="'.$row["id"].'" onclick="myFunction('.$row["id"].')">Mark as Read</button>';
        echo '<p>Mark as Read: <label class="switch"> <input type="checkbox" id="'.$row["id"].'" onclick="myFunction('.$row["id"].')"><span class="slider round"></span></label></p>';
        //<label class="switch">
  ///<input type="checkbox" >
  //<span class="slider round"></span></label>
        //echo "<html><input type="button" onclick="alert('Hello World!')" value="Click Me!"></html>";
        //<input type="button" onclick="alert('Hello World!')" value="Click Me!">
        //echo "<br>";
        echo "<hr>";
        
        $a=$a+9;
        
    }   

   /* echo '<form action="#" method="post">'.
    '<input type="checkbox" name="readrequestcheckbox" value="true">Mark all as read</input>'.
    
    '<input type="submit" value="Apply">'.
    '</form>';
    function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "demo_post.asp", true);
  xhttp.send();
    */
                   
}else{
    echo "All submitted contact forms have been readed.";
}
echo "<hr>";echo "<hr>";
echo '<h2 id="C4">Old Contact Forms</h2>';
$sql = "SELECT id,readed,submitdate,submittime,firstname,lastname,email,pnumber,messages FROM ContactForm Where readed=true"; //reading things from the table
$result = $conn->query($sql);
if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()){       //while loop
      //echo "firstname: ". $row["firstname"]."<br>"." lastname: " . $row["lastname"]."<br>"."email: ".$row["email"]."<br>"."pnumber: ".$row["pnumber"]."<br>"."<br>";
      //$sql ='UPDATE ContactForm SET readed=true WHERE id='.$row["id"];
      //$conn->query($sql);
      //echo $result->num_rows;
      
      //array_push($fetcheddata,$row["id"],$row["readed"],$row["submitdate"],$row["submittime"],$row["firstname"],$row["lastname"],$row["email"],$row["pnumber"],$row["messages"]);
      //echo $fetcheddata[$a]." - ".$fetcheddata[$a+1]." - ".$fetcheddata[$a+2]." - ".$fetcheddata[$a+3]." - ".$fetcheddata[$a+4]." - ".$fetcheddata[$a+5]." - ".$fetcheddata[$a+6]." - ".$fetcheddata[$a+7]." - ".$fetcheddata[$a+8];
      echo "<b>Data & Time : </b>".$row["submitdate"]." ".$row["submittime"];
      echo "<br>";
     // echo "<hr width="50%" size="3" />";
      echo "<b>Name : </b>".$row["firstname"]." ".$row["lastname"];
      echo "<br>";
      echo '<b>Email : </b><a href="mailto:'.$row["email"].'?Subject=Samaja%20Sathkara&body=Your Message: '.$row["messages"].'" target="_top">'.$row["email"].'</a>';
      echo "<br>";
      echo "<b>Phone Number : </b>".$row["pnumber"];
      echo "<br>";
      echo "<b>Message : </b>".$row["messages"];
      
      echo "<br>";
      //<p>This is an email link:<a href="mailto:someone@example.com?Subject=Hello%20again" target="_top">Send Mail</a></p>
      //echo '<input type="button" id="'.$row["id"].'" onclick="myFunction('.$row["id"].')">Mark as Read</button>';
      //echo '<p id="'.$row["id"].'" style="display:none">'.$row["firstname"].'</p>';
     // echo '<button type="button" id="'.$row["id"].'" onclick="myFunction('.$row["id"].')">Mark as Read</button>';
      echo '<p>Mark as Read: <label class="switch"> <input type="checkbox" checked id="'.$row["id"].'" onclick="myFunction('.$row["id"].')"><span class="slider round"></span></label></p>';
      //<label class="switch">
///<input type="checkbox" >
//<span class="slider round"></span></label>
      //echo "<html><input type="button" onclick="alert('Hello World!')" value="Click Me!"></html>";
      //<input type="button" onclick="alert('Hello World!')" value="Click Me!">
      //echo "<br>";
      echo "<hr>";
      
      //$a=$a+9;
      
  }   

 /* echo '<form action="#" method="post">'.
  '<input type="checkbox" name="readrequestcheckbox" value="true">Mark all as read</input>'.
  
  '<input type="submit" value="Apply">'.
  '</form>';
  function loadDoc() {
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById("demo").innerHTML = this.responseText;
  }
};
xhttp.open("POST", "demo_post.asp", true);
xhttp.send();
  */
                 
}else{
  echo "All submitted contact forms have been readed.";
}
?>

<script>
function myFunction(a) {
    var checkBox = document.getElementById(a);
  //var text = document.getElementById("text");
  if (checkBox.checked == true){
    var ajax=new XMLHttpRequest();
    var url='markasread.php';
    //ajax.onreadystatechange=response;
    ajax.open('POST',url,true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.send('read='+a);
  } else {
    var ajax=new XMLHttpRequest();
    var url='markasunread.php';
    //ajax.onreadystatechange=response;
    ajax.open('POST',url,true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.send('read='+a);
  }



    
      
}
</script>
</body>
</html>


