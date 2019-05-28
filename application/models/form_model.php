<?php
  
  /**
   * This class helps to create the mode for the database operations
   */
  class Form_model extends CI_Model {
  	
  	Public function __construct()
  	{
  		parent :: __construct();
  		$this->load->database();
  	}
  	
  	/**
   * This method helps to insert data into the database
   */
  	public function insert_data(){

      $date_1 =$this->input->post('start_date'); 
      $date_2 =$this->input->post('end_date');
      $Duration = $this->dateDifference($date_1,$date_2);
		    $data = array(
		        'email' => $this->input->post('email'),
		        'username' => $this->input->post('username'),
		        'password' => $this->input->post('password'),
            'start_date' =>$this->input->post('start_date'),
            'end_date'=> $this->input->post('end_date'),
            'Duration'=> $Duration
		    );

        

        if ($this->db->insert('test', $data)) {
          return 1;
        }else{
          return false;
        }
		    
		}
	/**
	   * This method helps to display  data from the database
	   */
	   public function display_data() {
	   	$query= $this->db->get('test');
	   	return $query->result_array();
	   }
    /**
     * This method helps to delete data into the database
     */
    public function delete_data(){
      $id=$this->input->post('id');
      $this->db->where('ID',$id);
      $query=$this->db->delete('test');
      if ($query) {
        return true;
      }else{
        return false;
      }
     }

     /**
     * This method helps to update a specific data into the database
     */
     public function update_data(){
      $id=$this->input->post('ID');
      $data = array(
        "email" =>$this->input->post('email'),
        "username" =>$this->input->post('username'),
        "password" =>$this->input->post('password'),

      );
      $this->db->where('ID',$id);
     $query= $this->db->update('test',$data);
        if ($query) {
          return true;
        }else{
          return false;
        }
     }
     
      function dateDifference($date_1 , $date_2 , $differenceFormat = '%a Day(s), aprox. %m Month(s)' ){
       $datetime1 = date_create($date_1);
       $datetime2 = date_create($date_2);
    
       $interval = date_diff($datetime1, $datetime2);
    
      return $interval->format($differenceFormat);
    }

  }
?>