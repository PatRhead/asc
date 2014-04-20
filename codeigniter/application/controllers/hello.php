<?php
class Hello extends CI_Controller
{
   function index()
   {
   	$this->load->library('session');
   	
     echo 'Hello world!';
     echo $this->session->userdata('username');
     echo $this->session->userdata('displayName');
     echo $this->session->userdata('mail');
   }
}
?>
