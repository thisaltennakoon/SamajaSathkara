<?php


abstract class State{
    public function changestateoftheproject($project){}
}
/*class ProposedProject extends State{
    public function __construct() {
        echo "I am ProposedProject      ";
    }
    public function changestateoftheproject($project){
        $project->set_state(new ProjectInProgress());
    }
}*/
class ProjectInProgress extends State{
    public function __construct() {
        
    }
    public function changestateoftheproject($project){
        $project->set_state(new CompletedProject());
        $completed=1;
        $servername = "localhost";                                    // host which has established our computer.If the database is on a sever, then this should change accordinly
        $username = "root";                                           // username and the password of the mysql sever
        $password = "";
        $dbname = "SamajaSathkara";
        $conn = new mysqli($servername,$username,$password,$dbname); // making the connection with mysql
        if ($conn->connect_error){                                   // check whether the connection is correctly established or not
            die("Connection failed: " . $conn->connect_error);
        }  
        $sql ='UPDATE Projects SET completed='.$completed.' Where projectid="'.$project->projectid.'"';
        $conn->query($sql);
    }
}
class CompletedProject extends State{
    public function __construct() {
        echo "I am CompletedProject     ";
        
    }
    public function changestateoftheproject($project){
        $project->set_state(new ProjectInProgress());
        $completed=0;
        $servername = "localhost";                                    // host which has established our computer.If the database is on a sever, then this should change accordinly
        $username = "root";                                           // username and the password of the mysql sever
        $password = "";
        $dbname = "SamajaSathkara";
        $conn = new mysqli($servername,$username,$password,$dbname); // making the connection with mysql
        if ($conn->connect_error){                                   // check whether the connection is correctly established or not
            die("Connection failed: " . $conn->connect_error);
        }  
        $sql ='UPDATE Projects SET completed='.$completed.' Where projectid="'.$project->projectid.'"';
        $conn->query($sql);
    }
}

class Project{
    
    var $projectid,$completed,$estimatedprojectcost,$raised,$state;
  
    public function __construct($projectid,$completed,$estimatedprojectcost,$raised) { //create a new project by admin
        $this->projectid=$projectid;
        $this->completed=$completed;
        $this->estimatedprojectcost=$estimatedprojectcost;
        $this->raised=$raised;
        if($this->completed==0){
            $this->state=new ProjectInProgress();
        }else{
            $this->state=new CompletedProject();
        }
    }
 
    public function donatetothisproject($amount){
        //($this->raised)=($this->raised)+($amount);
        //echo $this->$projectid;
        //echo $amount;
        //echo $this->projectname;
        //if ((($this->raised)+($amount))<=$this->estimatedprojectcost){
            $this->raised=($this->raised)+$amount;
            $servername = "localhost";                                    // host which has established our computer.If the database is on a sever, then this should change accordinly
            $username = "root";                                           // username and the password of the mysql sever
            $password = "";
            $dbname = "SamajaSathkara";
            $conn = new mysqli($servername,$username,$password,$dbname); // making the connection with mysql
            if ($conn->connect_error){                                   // check whether the connection is correctly established or not
                die("Connection failed: " . $conn->connect_error);
            }  
            $sql ='UPDATE Projects SET raised='.$this->raised.' Where projectid="'.$this->projectid.'"';
            $conn->query($sql);
            
            if(($this->completed==0) && ($this->raised>=$this->estimatedprojectcost)){
                $this->changestate();
            }
        //}else{
           // echo "Unable to donate this project";
        }
    
    public function changestate(){
        //echo "my current state is ".$this->state;
        $this->state->changestateoftheproject($this);
    }
    public function set_state($s){
        $this->state=$s;

    }
}






//if ($estimatedprojectcost<=$raised){
 //   $completed=1;
///}
//echo 'newraised='.$raised;echo '<br>';
//echo 'new completed='.$completed;


//$sql ='UPDATE Projects SET completed='.$completed.' Where projectid="'.$projectid.'"';
//$conn->query($sql);

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

$project1=new Project($projectid,$completed,$estimatedprojectcost,$raised);
$project1->donatetothisproject($amount);

$servername = "localhost";                                    // host which has established our computer.If the database is on a sever, then this should change accordinly
$username = "root";                                           // username and the password of the mysql sever
$password = "";
$dbname = "SamajaSathkara";
$conn = new mysqli($servername,$username,$password,$dbname); // making the connection with mysql
if ($conn->connect_error){                                   // check whether the connection is correctly established or not
    die("Connection failed: " . $conn->connect_error);
} 
$sql ='UPDATE Donation SET approved=true WHERE id='.$read;
$conn->query($sql);
$conn->close();



?>