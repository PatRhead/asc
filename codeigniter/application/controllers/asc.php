<?php
class asc extends CI_Controller
{

	function __construct()
	    	{
			parent::__construct();


			$this->load->library('session');
			$this->load->helper('url');
			$this->load->database();
			/*------------------------------*/

			$this->load->library('grocery_CRUD');
	    	}

	function index()
	{
		

		$data = array(
			'username' => $this->session->userdata('username'),
			'displayName' => $this->session->userdata('displayName'),
			'mail' =>$this->session->userdata('mail'),
			);

		
		
		$this->load->view('twerk/index.php', $data);



		/*echo 'Hello world!';
		echo $this->session->userdata('username');
		echo $this->session->userdata('displayName');
		echo $this->session->userdata('mail');
		*/
	}

	
    function _example_output($output = null)

    {
        $this->load->view('our_template.php',$output);    
    }
 
    
    function offices()

    {
    	$this->grocery_crud->set_table('Request');
        $output = $this->grocery_crud->render();
 
        $this->_example_output($output);

    }

	function studentView()
	{
		//send session data to the view
		$data = array(
			'username' => $this->session->userdata('username'),
			'displayName' => $this->session->userdata('displayName'),
			'mail' =>$this->session->userdata('mail')
			);


		//format session data
		$NameExploded = explode(", ", $data['displayName']);
		$FirstLast = $NameExploded[1]  . " " . $NameExploded[0];

		
		//query DB to test if user is in it.
		$newQuery = $this->db->query('SELECT * FROM Student WHERE username ="'. $data['username'].'"');
		//$rows = $newQuery->num_rows();
		if ($newQuery->num_rows() == 0)
		{
			$query = $this->db->query('INSERT INTO Student (FnameLname, Email, username, College) values ("'. $FirstLast .'", "'. $data['mail'] .'", "'. $data['username'] . '", "Arts")');
		}


		//Call our seminars table for the student view
		$this->grocery_crud->set_table('Seminars');
		$this->grocery_crud->set_theme('datatables');
		$this->grocery_crud->unset_delete();
		$this->grocery_crud->unset_add();
		$this->grocery_crud->unset_edit();
		$this->grocery_crud->unset_columns('created');
		$this->grocery_crud->unset_columns('l_id');
		$this->grocery_crud->add_action('Register', 'http://www.grocerycrud.com/assets/uploads/general/smiley.png', 'asc/register', '');
		$output = $this->grocery_crud->render();
		$data['seminars'] = $output;

		//render crud table for students registered seminars
		//added a new comment to test git! 
		$registered = new grocery_CRUD();
		$registered->set_model('custom_query_model');
		$registered->set_theme('datatables');
		$registered->set_table('Seminars');
		$registered->set_subject('Seminar');
		$registered->unset_columns('created');
		$registered->unset_columns('l_id');
		$registered->unset_operations();
		$where = "WHERE Student.username ='" .$data['username'] ."' AND  Student.s_id = Register.s_id AND Register.sem_id = Seminars.sem_id";
		$registered->basic_model->set_query_str('SELECT Seminars.sem_id, Seminars.Name, Seminars.Building, Seminars.timedate, Seminars.Description, Seminars.Materials FROM Register, Seminars, Student ' . $where); //Query text here
		$registered->add_action('Cancel', base_url('img/close.png'), 'asc/cancelreg', '');
		$studentOutput = $registered->render();
		$data['registered'] = $studentOutput;
	 
		//$this->_example_output($output);
		$this->load->view('twerk/student.php', $data);

	}

	//cancels a registration for the logged in student
	function cancelreg($primary_key) {

		$data = array(
			'username' => $this->session->userdata('username'),
			'displayName' => $this->session->userdata('displayName'),
			'mail' =>$this->session->userdata('mail')
			);

		//get current users DB data and assign student id to variabe
		$studentQuery = $this->db->query('SELECT * FROM Student WHERE username ="'. $data['username'].'"');
		if ($studentQuery->num_rows() > 0)
		{
		   $row = $studentQuery->row(); 

		   $s_id = $row->s_id;
		}



		$sem_id = $primary_key;
		//query DB to test if user is in it.
		$delete = $this->db->query('DELETE from Register WHERE Register.s_id ='.$s_id . ' AND Register.sem_id='. $sem_id);
		redirect('./asc/studentView');
	}

	//Register action, registers student once the action on CRUD table is clicked
	function register($primary_key){
		$data = array(
			'username' => $this->session->userdata('username'),
			'displayName' => $this->session->userdata('displayName'),
			'mail' =>$this->session->userdata('mail')
			);

		//get current users DB data and assign student id to variabe
		$studentQuery = $this->db->query('SELECT * FROM Student WHERE username ="'. $data['username'].'"');
		if ($studentQuery->num_rows() > 0)
		{
		   $row = $studentQuery->row(); 

		   $s_id = $row->s_id;
		}
		$sem_id = $primary_key; 

		$register = $this->db->query('INSERT into Register VALUES ('. $s_id .', '. $sem_id .')');
		redirect('./asc/studentView');
	}

	function adminView()
	{
		/*$data = array(
			'username' => $this->session->userdata('username'),
			'displayName' => $this->session->userdata('displayName'),
		);*/

		
		
		
	}	
	
}
?>
