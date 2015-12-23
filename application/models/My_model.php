<?php
    class My_Model extends CI_Model{
        function __construct()
        {
            parent::__construct();
        }
         /*
            check for the Id is there or not
            if there: 
                then give alert
            else
                create a new one
            send the data to customer table
            send approval
        */
        public function insert_value($elment, $data, $uId)
        {
            $mobile = array_slice($data, 6 , -1);
            print_r ($mobile);
//            exit();
            $query = $this->db->get_where('rt_customer_login_details', $mobile);
            echo "<br>";
            print_r($this->db->last_query());
            echo "<br>";
            if($query->num_rows() > 0)
            {
                print_r("This mobile number is already in use");
            }
            else
            {
                print_r("Creating New Id");
                $Message = "Please verify http://localhost/index.php/login/" + $data['rt_customers_rt_customer_id'] ;
//                exit();
                $email = $data['email_id'];
                
                $this->db->insert('rt_customers', $uId);
                $this->db->insert('rt_customer_login_details', $data);
                
                $this->sendEmail($uId['rt_customer_id'], $email);
                /* Send Verification Mail */
            }
        }
        
        public function sendEmail($Verification, $email){
            $this->load->library('email');
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $this->email->initialize($config); 
            $this->email->from('crush.vlove@gmail.com', 'Your Name');
            $this->email->to('crush.vlove@gmail.com');
            $this->email->subject('Email Test');
            $Message = "Please verify http://localhost/index.php/login/verify/$Verification" ; 
            echo $Message;
            $this->email->message($Message);

            $this->email->send();

            echo $this->email->print_debugger();
            
        }
        
        public function verifymail($Verification){
            $query = $this->db->get_where('rt_customer_login_details', array('rt_customers_rt_customer_id' => $Verification));
            if($query->num_rows <= 0){
                echo "Uid Exists";
                $Update_Q = "update rt_customer_login_details set is_email_verified='Yes' where rt_customers_rt_customer_id='$Verification'";
                echo $Update_Q;
                $this->db->query($Update_Q);
            }
        }
        /*
        public function insert_value($elment, $data, $uId){
            $query = $this->db->get_where('rt_customers',  $uId);
            echo $query->num_rows();
            echo '<br>';
            
            if($query->num_rows() > 0 ){
                echo "It is already there";
                echo '<br>';
                foreach ($query->result() as $Row){
                    echo $Row->rt_customer_id;    
                }
                $SubData['rt_customers_rt_customer_id'] = $uId['rt_customer_id'];
                $Sub_query = $this->db->get_where('rt_customer_login_details', $SubData);
                foreach ($Sub_query->result() as $Row){
                    if($Row->rt_customers_rt_customer_id == $uId['rt_customer_id']){
                        echo '<br>';
                        print("id with this name is already inserted");
                    }
                    
                }
            }
            else
            {
                echo "I Don't have such ID So i will Create it";
                $this->db->insert('rt_customers', $uId);
                echo "Now moving for more";
              
                $this->db->insert('rt_customer_login_details', $data);
                    
            }
        }
        */
    }