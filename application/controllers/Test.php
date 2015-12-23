<?php
class Test extends CI_controller{
    
    public function __constructor(){
        $this->load->model('My_Model');
    }
    
    public function hello($param = 'Rahul'){
        echo "Hello = $param";
    }
    
    public function login (){
        
        $this->load->helper('url');
        $this->load->view('header.html');        
        /* I loads my model */
//        $this->load->model('My_Model');
        /*call the function in my_model calss */
        //$this->My_Model->get_Value($annu);
    //    echo $Result['Name'] ;
//        echo " <br> Bye $annu";
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
        echo "Hello Truck Owner";
        echo "<br>";
        echo $_POST["tUname"];
        echo "<br>";
        echo $_POST["tEmail"];
        echo "<br>";
        echo $_POST["tPassword"];
        echo "<br>";
        echo $_POST["tMobile"];
    }
    
    public function customer_signup_parser(){
        /*
            send the data to customer table
            send approval
        */
        echo "Hello Customer";
        echo "<br>";
        $data = array("customer_user_name" => $_POST["cUname"],
                      "email_id" => $_POST["cEmail"],
                      "customer_password" => $_POST["cPassword"],
                      "mobile_number" => $_POST["cMobile"]);
        
        
    }
    
    public function agent_signup_parser(){
        /*
            send data to agent table
            send approval
        */
        echo "Hello agent";
        echo "<br>";
        echo $_POST["aUname"];
        echo "<br>";
        echo $_POST["aEmail"];
        echo "<br>";
        echo $_POST["aPassword"];
        echo "<br>";
        echo $_POST["aMobile"];
    }
       
} 