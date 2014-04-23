<?php

//Develped by Jesse Dotson for Winthrop University//
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
		
		$username = $this->session->userdata('username');


		if($this->session->userdata('logged_in'))
		{
			
			$adminQuery = $this->db->query('SELECT * FROM Admin WHERE username ="'. $data['username'].'"');
			if ($adminQuery->num_rows() > 0)
			{
			   redirect('./asc/adminView');
			}
			else
			{
				redirect('./asc/studentView');
			}
		}
		else
		{
			$this->load->view('twerk/index.php');
		}	

	}
	/////////////////////////////////////////////////All actions for the student view////////////////////////////////////////////////
	function studentView()
	{

		if($this->session->userdata('logged_in') == FALSE)
		{
			redirect('./asc/index');
		}
		//send session data to the view
		$data = array(
			'username' => $this->session->userdata('username'),
			'displayName' => $this->session->userdata('displayName'),
			'mail' =>$this->session->userdata('mail')
			);


		//format session data
		$NameExploded = explode(", ", $data['displayName']);
		$FirstLast = $NameExploded[1]  . " " . $NameExploded[0];

		
		//check to see if current user is Admin. If they are, send them to admin page.
		//Else, check if the user is a current student, if not, make them one. 
		$adminQuery = $this->db->query('SELECT * FROM Admin WHERE username ="'. $data['username'].'"');
		if ($adminQuery->num_rows() > 0)
		{
		   redirect('./asc/adminView');
		}
		else
		{
			//query DB to test if user is in it.
			$newQuery = $this->db->query('SELECT * FROM Student WHERE username ="'. $data['username'].'"');
			//$rows = $newQuery->num_rows();
			if ($newQuery->num_rows() == 0)
			{
				$query = $this->db->query('INSERT INTO Student (FnameLname, Email, username, College) values ("'. $FirstLast .'", "'. $data['mail'] .'", "'. $data['username'] . '", NULL)');
			}
		}

		//Call our seminars table for the student view
		$this->grocery_crud->set_table('Seminars');
		$this->grocery_crud->set_theme('datatables');
		$this->grocery_crud->unset_delete();
		$this->grocery_crud->unset_add();
		$this->grocery_crud->unset_edit();
		$this->grocery_crud->unset_operations();
		$this->grocery_crud->unset_columns('created', 'l_id');
		$this->grocery_crud->add_action('Register', 'http://www.grocerycrud.com/assets/uploads/general/smiley.png', 'asc/register', '');
		$output = $this->grocery_crud->render();
		$data['seminars'] = $output;

		//render crud table for students registered seminars
		$registered = new grocery_CRUD();
		$registered->set_model('custom_query_model');
		$registered->set_theme('datatables');
		$registered->set_table('Seminars');
		$registered->set_subject('Seminar');
		$registered->unset_columns('created', 'l_id');
		$registered->unset_operations();
		$where = "WHERE Student.username ='" .$data['username'] ."' AND  Student.s_id = Register.s_id AND Register.sem_id = Seminars.sem_id";
		$registered->basic_model->set_query_str('SELECT Seminars.sem_id, Seminars.Name, Seminars.Building, Seminars.timedate, Seminars.Description, Seminars.Materials FROM Register, Seminars, Student ' . $where); //Query text here
		$registered->add_action('Cancel', base_url('img/close.png'), 'asc/cancelreg', '');
		$studentOutput = $registered->render();
		$data['registered'] = $studentOutput;
	 
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
		if(!$register)
		{
			echo 'Can not have a duplicate register! <a href = "' . site_url("/asc/studentView") . '">Return to Student View</a>';	
		}
		else
		{
			redirect('./asc/studentView');
		}

			

	}

	//////////////////////////////////////* All actions for the Admin View Below *//////////////////////////////////////////


	//All output session data and grocery crud tables here
	function _admin_output($output = null, $table = null)
	{
		$data = array(
			'username' => $this->session->userdata('username')
			);

		$adminQuery = $this->db->query('SELECT * FROM Admin WHERE username ="'. $data['username'].'"');
		if ($adminQuery->num_rows() == 0)
		{
		   redirect('./auth/login');
		}

		$data['crudOutput'] = $output;
		$data['title'] = $table;

		$this->load->view('twerk/admin.php', $data);
	}

	//default page for the Admin. Contains the seminars table
	function adminView()
	{
		
		$data = array(
			'username' => $this->session->userdata('username')
			);

		$adminQuery = $this->db->query('SELECT * FROM Admin WHERE username ="'. $data['username'].'"');
		if ($adminQuery->num_rows() == 0)
		{
		   redirect('./auth/login');
		}

		//set admin Seminars view
		$adminSeminars = new grocery_CRUD();
		$adminSeminars->set_theme('datatables');
		$adminSeminars->set_table('Seminars');
		$adminSeminars->set_subject('Seminar');
		$adminSeminars->add_action('Email', '', 'asc/prepEmail', '');
		$adminSeminars->add_action('Report', '', 'asc/seminarReport', '');
		$output= $adminSeminars->render();
		$table = 'Seminars';

		$this->_admin_output($output, $table);
		
	}

	function adminStudent()
	{
		//set admin Seminars view
		$adminStudent = new grocery_CRUD();
		$adminStudent->set_theme('datatables');
		$adminStudent->set_table('Student');
		$adminStudent->set_subject('Student');
		$adminStudent->add_action('Report', '', 'asc/studentReport', '');
		$output= $adminStudent->render();
		$table = 'Student';

		$this->_admin_output($output, $table);
	}

	function adminRequest()
	{
		//set admin Requests View
		$adminRequests = new grocery_CRUD();
		$adminRequests->set_theme('datatables');
		$adminRequests->set_table('Request');
		$adminRequests->set_subject('Request');
		$output = $adminRequests->render();
		$table = 'Requests';

		$this->_admin_output($output, $table);
	}

	function adminLocation()
	{
		//set admin Location View
		$adminLocation = new grocery_CRUD();
		$adminLocation->set_theme('datatables');
		$adminLocation->set_table('Location');
		$adminLocation->set_subject('Location');
		$output = $adminLocation->render();
		$table = 'Locations';

		$this->_admin_output($output, $table);
	}

	function adminCollege()
	{
		//set admin College View
		$adminCollege = new grocery_CRUD();
		$adminCollege->set_theme('datatables');
		$adminCollege->set_table('College');
		$adminCollege->set_subject('College');
		$output = $adminCollege->render();
		$table = 'Colleges';

		$this->_admin_output($output, $table);
	}


	function requestsPage()
	{
		//load faculty requests page
		$this->load->view('twerk/requests.php');
	}

	function processRequest()
	{
		//process the request from the faculty
		$name = $this->input->post('name');
		$desc = $this->input->post('desc');
		$timedate = $this->input->post('timedate');
		$materials = $this->input->post('materials');

		if($name && $desc && $timedate && $materials)
		{
			$insertRequest = $this->db->query('INSERT INTO Request (Name, timedate, Description, Materials) VALUES ("'.$name.'", "'.$timedate.'", "'.$desc.'", "'.$materials.'")');
			if($this->db->affected_rows() > 0)
			{
				echo 'Success! <a href = "' . site_url("/asc/requestsPage") . '">Return to Requests Page</a>';
			}
			else
			{
				echo 'Something went wrong. Try again <a href = "' . site_url("/asc/requestsPage") . '">Return to Requests Page</a>';
			}
		}
		else
		{
			echo 'Please fill all fields. <a href = "' . site_url("/asc/requestsPage") . '">Return to Requests Page</a>';
		}
	}

	function prepEmail($primary_key)
	{
		$data = array(
		'username' => $this->session->userdata('username'),
		'rowKey' => $primary_key
		);


	 	$this->load->view('twerk/email.php', $data);

	}

	function studentReport($primary_key)
	{
		$data = array(
		'username' => $this->session->userdata('username'),
		'rowKey' => $primary_key
		);

		$query = $this->db->query('SELECT FnameLname FROM Student where Student.s_id =' .$primary_key .'');
		foreach ($query->result_array() as $row)
		{
		   $student = $row['FnameLname'];
		}

		$reportQuery = $this->db->query('SELECT Name FROM Student, Register, Seminars WHERE Student.s_id =' .$primary_key . ' AND Student.s_id = Register.s_id AND Register.sem_id = Seminars.sem_id');
	 	$list = array();

	 	foreach ($reportQuery->result_array() as $row)
		{
		   $name = $row['Name'];
		   $list[] .= $name;
		}
		$data['names'] = $list;
		$data['header'] = $student;


	 	$this->load->view('twerk/report.php', $data);

	}

	function seminarReport($primary_key)
	{
		$data = array(
		'username' => $this->session->userdata('username'),
		'rowKey' => $primary_key
		);

		//query the DB for the seminars name
		$query = $this->db->query('SELECT Name FROM Seminars where Seminars.sem_id =' .$primary_key .'');
		foreach ($query->result_array() as $row)
		{
		   $seminar = $row['Name'];
		}

		//query DB for list of students names in a seminar
		$reportQuery = $this->db->query('SELECT FnameLname FROM Student, Register, Seminars WHERE Seminars.sem_id =' .$primary_key . ' AND Student.s_id = Register.s_id AND Register.sem_id = Seminars.sem_id');
	 	$list = array();

	 	foreach ($reportQuery->result_array() as $row)
		{
		   $student = $row['FnameLname'];
		   $list[] .= $student;
		}
		$data['names'] = $list;
		$data['header'] = $seminar;


	 	$this->load->view('twerk/report.php', $data);

	}

	function sendEmail()
	{

		$primary_key = $this->input->post('to');
		$message = $this->input->post('message');
		$subject = $this->input->post('subject');
		
		$emailQuery = $this->db->query('SELECT Email FROM Student, Register, Seminars WHERE Seminars.sem_id =' .$primary_key . ' AND Student.s_id = Register.s_id AND Register.sem_id = Seminars.sem_id');
	 	$list = array();

	 	foreach ($emailQuery->result_array() as $row)
		{
		   $emailExplode = explode("mailbox.", $row['Email']);
		   $email = $emailExplode[0] . $emailExplode[1];
		   $list[] .= $email;
		}

		$this->load->library('email');

		$this->email->from('dotsonj2@winthrop.edu', 'Jesse Dotson');
		$this->email->to($list);
		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();

		echo 'Email Success! <a href = "' . site_url("/asc/adminView") . '">Return to Admin Dashboard</a>';


	}
			
}


?>
