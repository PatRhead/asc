<?php
$this->load->library('authentication'); 

if($_POST) {  
   
   $adldap = new authentication(); 
 
   $username=strtoupper($this->input->post('username'));
   $password=$this->input->post('password'); 
  
   $data['username']=$username;
   $data['password']=$password;      
   
   $return_obj = array();    
    
   try {         
         
        $user_obj =$adldap->authenticate($username, $password);
       
       //authenticate the user
       if ($user_obj){       
        if($user_obj[RET_STATUS]==RET_OK){         
          echo "<br/>Successfully logged in by Username : ".$username."<br/>";
            echo RET_FIRSTNAME." :: ".$user_obj[RET_FIRSTNAME]; echo "<br/>";
         echo RET_LASTNAME." :: ".$user_obj[RET_LASTNAME]; echo "<br/>";
         echo RET_DISPLAYNAME." :: ".$user_obj[RET_DISPLAYNAME]; echo "<br/>";
         echo RET_EMAIL." :: ".$user_obj[RET_EMAIL]; echo "<br/>";
         echo RET_DEPARTMENT." :: ".$user_obj[RET_DEPARTMENT]; echo "<br/>";
         echo RET_USERID." :: ".$user_obj[RET_USERID]; echo "<br/><br/>";
          
          //syslog('LOG_INFO', 'User Authenticated');               
        
          echo "LDAP Server closed";
          
          $data['error']='';
          $this->load->view('view_detail',$data); 
         
        } else {
         $user_obj[RET_STATUS] = RET_ERROR;
         $data['error']=$user_obj[RET_MESSAGE];
           $this->load->view('login',$data); 
           }
       } else {
        $user_obj[RET_STATUS] = RET_ERROR;
        $data['error']=$user_obj[RET_MESSAGE];   
         $this->load->view('login',$data);  
       }
     
    } catch (adLDAPException $e) {
     $data['error']=$e;
     $this->load->view('login',$data);
     exit();
    }     
    
    } else {
     
   $data["error"] ='';
     
   $data['username']=$this->input->post('username');
   $data['password']=$this->input->post('password');   
   $this->load->view('login',$data);
    
    } 
    ?>