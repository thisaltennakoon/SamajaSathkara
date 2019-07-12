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

<h3>Create a Project</h3>

<div class="container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <!--form action="hello.php" method="post" /-->

    <label for="projectname">Project Name</label>
    <input type="text" id="projectname" name="projectname" placeholder="Project Name">

    <label for="estimatedprojectcost">Estimated Project Cost Rs.</label>
    <input type="text" id="estimatedprojectcost" name="estimatedprojectcost" placeholder="Estimated Project Cost">

    <label for="raised">Raised Rs.</label>
    <input type="text" id="raised" name="raised" placeholder="Total Donations Gathered So Far">

    </select>

    
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
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
  
    public function __construct($projectname,$estimatedprojectcost,$raised) { //create a new project by admin
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
      $date1=strval(date("Ymd"));
      $time1= strval(date("His"));
      $projectid= "project".$date1.$time1;
      
      $sql = "INSERT INTO Projects (completed ,createdate ,cratetime ,projectname ,estimatedprojectcost ,raised ,projectid) VALUES (false,'$date','$time','$projectname','$estimatedprojectcost','$raised','$projectid')"; // insert data to the created table
      if ($conn->query($sql)===TRUE){
          echo "<h3>Project has been sucessfully created";
      }else{
          echo "Error: ". $sql ."<br>" . $conn->error;
      }
      
      $conn->close();    //close the connection with database
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $projectname=$_POST['projectname'];
  echo "Project Name: ".$projectname."<br>";
  $estimatedprojectcost=$_POST['estimatedprojectcost'];
  echo "Estimated Project Cost: ".$estimatedprojectcost."<br>";
  $raised=$_POST['raised'];
  echo "Raised: ".$raised."<br>";
  $project=new Project($projectname,$estimatedprojectcost,$raised);
}
?>