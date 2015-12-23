<?php
    class Login extends CI_controller{
        public function __constructor(){
            $this->load->model('My_model');
        }
        
        public function First(){
            //Load the relevent pages
            $this->load->helper('url');
            $this->load->view('header.html');
        }
        
        public function form_processor_login(){
            echo $_POST["login"];
        }
        
        public function link_to_Customer(){
            $this->load->helper('url');
            $this->load->view('customer.html');
        }
        
        public function login_parser(){
        /*
            Algo:
            1. check weather Name and pass are of same.
            2. check for approval
        */
            echo $_POST["lUname"];
            echo "<br>";
            echo $_POST["lPass"];
        
        }
    
        public function truck_signup_parser(){
            /*
                send the data to truck table
                send approval 
            */
//            echo "Hello Truck Owner";
//            echo "<br>";
//            echo $_POST["tUname"];
//            echo "<br>";
//            echo $_POST["tEmail"];
//            echo "<br>";
//            echo $_POST["tPassword"];
//            echo "<br>";
//            echo $_POST["tMobile"];
            $this->load->model('My_Model');
            /*
                create a random id and put in the rt_customers
                create random verification mail id of 24 char
            */
            $Username = $_POST["cUname"];
            if (isset($_POST['cSameId'])){
                $Username = $_POST["cEmail"];
                echo "Is is checked";
                echo "<br>";
            }
            
            /*Check for No field Blank*/
            if (empty($_POST["cUname"])){
                print_r("Username is empty");
                exit();
            }
                
            $uId = array('rt_customer_id' => uniqid(true));

            $data = array("customer_user_name" => $Username,
                          "email_id" => $_POST["cEmail"],
                          "customer_password" => uniqid(),
                          "customer-type" => 'Truck Owner',
                          'is_email_verified' => 'No',
                          "is_mobile_verified" => 'No',
                          "mobile_number" => $_POST["cMobile"]);
            $data['rt_customers_rt_customer_id'] = $uId['rt_customer_id'];
            
            print_r($data);
//            exit();
            $this->My_Model->insert_value('Customer', $data, $uId);    
        }

        public function customer_signup_parser(){
           
            $this->load->model('My_Model');
            /*
                create a random id and put in the rt_customers
                create random verification mail id of 24 char
            */
            $Username = $_POST["cUname"];
            if (isset($_POST['cSameId'])){
                $Username = $_POST["cEmail"];
                echo "Is is checked";
                echo "<br>";
            }
            
            /*Check for No field Blank*/
            if (empty($_POST["cUname"])){
                print_r("Username is empty");
                exit();
            }
                
            $uId = array('rt_customer_id' => uniqid(true));

            $data = array("customer_user_name" => $Username,
                          "email_id" => $_POST["cEmail"],
                          "customer_password" => uniqid(),
                          "customer-type" => 'Transporter',
                          'is_email_verified' => 'No',
                          "is_mobile_verified" => 'No',
                          "mobile_number" => $_POST["cMobile"]);
            $data['rt_customers_rt_customer_id'] = $uId['rt_customer_id'];
            
            print_r($data);
//            exit();
            $this->My_Model->insert_value('Customer', $data, $uId);    


        }

        public function agent_signup_parser(){
            /*
                send data to agent table
                send approval
            */
//            echo "Hello agent";
//            echo "<br>";
//            echo $_POST["aUname"];
//            echo "<br>";
//            echo $_POST["aEmail"];
//            echo "<br>";
//            echo $_POST["aPassword"];
//            echo "<br>";
//            echo $_POST["aMobile"];
            $this->load->model('My_Model');
            /*
                create a random id and put in the rt_customers
                create random verification mail id of 24 char
            */
            $Username = $_POST["cUname"];
            if (isset($_POST['cSameId'])){
                $Username = $_POST["cEmail"];
                echo "Is is checked";
                echo "<br>";
            }
            
            /*Check for No field Blank*/
            if (empty($_POST["cUname"])){
                print_r("Username is empty");
                exit();
            }
                
            $uId = array('rt_customer_id' => uniqid(true));

            $data = array("customer_user_name" => $Username,
                          "email_id" => $_POST["cEmail"],
                          "customer_password" => uniqid(),
                          "customer-type" => 'Agent',
                          'is_email_verified' => 'No',
                          "is_mobile_verified" => 'No',
                          "mobile_number" => $_POST["cMobile"]);
            $data['rt_customers_rt_customer_id'] = $uId['rt_customer_id'];
            
            print_r($data);
//            exit();
            $this->My_Model->insert_value('Customer', $data, $uId);    
            
        }

        public function verify($VerificationCode){
            $this->load->model('My_model');
            $this->load->helper('url');
//            echo "Verification code is .$VerificationCode.";
            $this->My_model->verifymail($VerificationCode);
            /* Send to the verification page */
            $this->load->view("login_button.html");
            /*Check in Database for this UId and then make the email verified as Yes*/
        }
    }
