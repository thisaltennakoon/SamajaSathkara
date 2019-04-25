<?php
/*$projectname=$_POST['projectname'];
$projecttype=$_POST['projecttype'];
$descriptionabouttheproject=$_POST['descriptionabouttheproject'];
$estimatedprojectcost=$_POST['estimatedprojectcost'];*/
abstract class State{
    public function changestateoftheproject($project){}
}
class ProposedProject extends State{
    public function __construct() {
        echo "I am ProposedProject      ";
    }
    public function changestateoftheproject($project){
        $project->set_state(new ProjectInProgress());
    }
}
class ProjectInProgress extends State{
    public function __construct() {
        echo "I am Project In Progress\r\n";
    }
    public function changestateoftheproject($project){
        $project->set_state(new CompletedProject());
    }
}
class CompletedProject extends State{
    public function __construct() {
        echo "I am CompletedProject     ";
    }
    public function changestateoftheproject($project){
        //project.set_state(new ProjectInProgress());
    }
}

class Project{
    static $projectid=0;
    var $projectname,$projecttype,$descriptionabouttheproject,$state,$estimatedprojectcost,$totaldonationsgatheredsofar,$date_of_proposal;
    var $user_of_the_proposal,$date_of_approval,$date_of_completion,$this_project_id;
    //$adminlist=array();
    //$donarlist=array();
    /*public function __construct($user_of_the_proposal,$descriptionabouttheproject) {    //propose a project by user
        $this->state=new ProposedProject();
        self::$projectid++;
        $this->user_of_the_proposal=$user_of_the_proposal;
        $this->descriptionabouttheproject=$descriptionabouttheproject;

    }*/
    public function __construct($projectname,$projecttype,$descriptionabouttheproject,$estimatedprojectcost) { //create a new project by admin
        $this->state=new ProjectInProgress();
        self::$projectid++;
        $this->this_project_id=self::$projectid;
        $this->projectname=$projectname;
        $this->projecttype=$projecttype;
        $this->descriptionabouttheproject=$descriptionabouttheproject;
        $this->estimatedprojectcost=$estimatedprojectcost;
    }
    public function approve_a_project($projectname,$projecttype,$estimatedprojectcost){ //approve a proposed project by admin
        $this->changestate();
        $this->projectname=$projectname;
        $this->projecttype=$projecttype;
        $this->estimatedprojectcost=$estimatedprojectcost;
    }
    public function donatetothisproject($amount){
        //echo $this->$projectid;
        //echo $amount;
        //echo $this->projectname;
        if ((($this->totaldonationsgatheredsofar)+($amount))<=$this->estimatedprojectcost){
            $this->totaldonationsgatheredsofar=($this->totaldonationsgatheredsofar)+$amount;
            if($this->totaldonationsgatheredsofar>=$this->estimatedprojectcost){
                $this->changestate();
            }
        }else{
            echo "Unable to donate this project";
        }
    }
    public function changestate(){
        //echo "my current state is ".$this->state;
        $this->state->changestateoftheproject($this);
    }
    public function set_state($s){
        $this->state=$s;
    }
}
//$project=new Project($projectname,$projecttype,$descriptionabouttheproject,$estimatedprojectcost);
$project=new Project("aaa","dsfsfd","werewr",1000);
$serialized_project=serialize($project);
$unserialized_obj=unserialize($serialized_project);
echo $unserialized_obj->projecttype;
//echo $serialized_project;
//echo "<br>";
//echo "\n".$project->this_project_id;
//$a->donatetothisproject(100);
//$a->donatetothisproject(900);
//$a->changestate();
$servername = "localhost";                                    // host which has established our computer.If the database is on a sever, then this should change accordinly
$username = "root";                                           // username and the password of the mysql sever
$password = "";
$dbname = "SamajaSathkara";
$conn = new mysqli($servername,$username,$password,$dbname); // making the connection with mysql
if ($conn->connect_error){                                   // check whether the connection is correctly established or not
    die("Connection failed: " . $conn->connect_error);
}     

$c="'";
$date=strval(date("Y-m-d"));
$time= strval(date("H:i:s"));

$sql = "INSERT INTO Projects (submitdate,submittime,serializedproject ) VALUES ('$date','$time','$serialized_project')"; // insert data to the created table
if ($conn->query($sql)===TRUE){
    echo "<h3>Your object has been successfully saved.</h3>";
}else{
    echo "Error: ". $sql ."<br>" . $conn->error;
}


?>

