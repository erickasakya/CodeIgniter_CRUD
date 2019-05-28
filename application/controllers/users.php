<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		$this->load->model('form_model');
		$this->load->helper(array('url_helper','form'));
		$this->load->library(array('form_validation'));
	}

	public function index()
	{
        
        error_reporting(0);
    
        $this->template->title = 'CodeIgniter APP';

        $neededjs= array('assets/DataTables/datatables.min.js','assets/js/bootstrap.js','assets/js/bootstrap_validator.js','assets/js/notify.min.js');

        $neededcss= array('assets/css/bootstrap.css','assets/css/notify.css','assets/css/animate.css','assets/css/font-awesome.min.css','assets/DataTables/dataTables.min.css');

        $this->AddLinks($neededjs,$neededcss);   
        $data['title']='Users of our system';
        // Load a view in the content partial
        $this->template->content->view('display',$data); 
       // Set a partial's content
        $this->template->footer = 'reserved for Company GMT Consults 2018';

        // Publish the template
        $this->template->publish();

	}

  public function AddLinks($js=false, $css=false){

    $requiredjs='';
    $requiredcss='';
    if (!($js === false)) {
        foreach ($js as $key => $link) {
          $requiredjs +=$this->template->javascript->add(base_url($link));
        }
    }
    if (!($css === false)) {
        foreach ($css as $key => $link) {
        $requiredcss +=$this->template->stylesheet->add(base_url($link), array('media' => 'all'));
      }
    }

    return json_encode($requiredjs.''.$requiredcss);
  }

//New procedure
 public function jsonList()
  {
    $data['data'] = $this->form_model->display_data();
    echo json_encode($data);
  }

public function create(){
  $this->load->library('form_validation');
  $this->form_validation->set_rules('email', 'Email', 'required', array('required'=>'%s should be Entered'));
  $this->form_validation->set_rules('username', 'Username', 'required', array('required'=>'%s should be Entered'));
  $this->form_validation->set_rules('password', 'Password', 'required', array('required'=>'%s should be Entered'));
  $feedback['error'] = true;
  if($this->form_validation->run() === FALSE ){
    $feedback['message'] = validation_errors('<li>','</li>');
    
  }else{
    if($this->input->post('ID') !== NULL && is_numeric($this->input->post('ID'))){ //editing exsting item
    
      if($this->form_model->update_data()){
        $feedback['error'] = false;
        $feedback['message'] = "Data updated";
      }else{
        $feedback['message'] = "Data could not be updated";
      }
    }else{
      //adding a new user
      $return_id = $this->form_model->insert_data();
      if(is_numeric($return_id)){
        $feedback['error'] = false;
        $feedback['message'] = "Data submitted";

      }else{
        $feedback['message'] = "There was a problem saving the data, please contact IT support";

      }
    }
  }
  echo json_encode($feedback);
}

  public function delete() {
  $response['message'] = "Data could not be deleted, contact support.";
  $response['success'] = FALSE;
  $query=$this->form_model->delete_data();
  if ($query) {
  	$response['success'] = TRUE;
    $response['message'] = "Data successfully deleted.";
  }
  echo json_encode($response);
  }


 public function marksheet_export($value='') {
  /*******EDIT LINES 3-8*******/
$DB_Server = "localhost"; //MySQL Server    
$DB_Username = "root"; //MySQL Username     
$DB_Password = "";             //MySQL Password     
$DB_DBName = "test";         //MySQL Database Name  
$DB_TBLName = "t"; //MySQL Table Name   
$filename = "marksheet";         //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection   
$sql = "Select * from $DB_TBLName";
$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
//select database   
$Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());   
//execute query 
$result = @mysql_query($sql,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
$file_ending = "xls";
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t";
}
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    } 
   # code...
 }
  

}
?>