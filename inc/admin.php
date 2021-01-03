<?php 
    class Admins{

        //set connection w db

        private $host = "localhost";
        private $database = "coderscr_admin";
        private $username = "coderscr_admin";
        private $password = "C2(pIfRwdM9?X6L}$[";

        public function __construct() {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->username, $this->password);
            $this->conn->exec("SET NAMES 'utf8';");
        }

        public function register_admin($array){
            $args_checkEmail = array("email" => $array["email"]);
            $sql_checkEmail = "SELECT * FROM admin WHERE email = :email";
            $result_checkEmail = $this->conn->prepare($sql_checkEmail);
            $result_checkEmail->execute($args_checkEmail);

            if($result_checkEmail->rowCount() > 0){
                $result_data["valid"] = false;
                $result_data["msg"] = "Sorry, Email existed in database";
            }
            else{
                $result_data["valid"] = true;
                $password = password_hash($array["password"],PASSWORD_BCRYPT);
                $args = array("fullname" => $array["fullname"], "email" => $array["email"], "password" => $password );
                $sql = "INSERT INTO admin SET fullname = :fullname, email = :email, password = :password";
                $result = $this->conn->prepare($sql);
                $result->execute($args);
                if($result->rowCount() >0){
                    $result_data["valid"] = true;
                    $result_data["msg"] = "Successfully register new admin"; 
                }else{
                    $result_data["valid"] = false;
                    $result_data["msg"] = "Error register new admin"; 
                }
            }
            return json_encode($result_data);
        }

        public function login_admin($array){
            //check email
            $args_checkPassword = array("email" => $array["email"]);
            $sql_checkPassword= "SELECT * FROM admin WHERE email = :email";
            //execute
            $result_checkpassword = $this->conn->prepare($sql_checkPassword);
            $result_checkpassword->execute($args_checkPassword);
            //checkresult
            if($result_checkpassword->rowCount() > 0){
                $row = $result_checkpassword->fetchObject();
                if(password_verify($array["password"], $row->password))
               {
                    session_start();
                    $_SESSION["id"] = $row->id;
                    $_SESSION["fullname"] = $row->fullname;
                    $_SESSION["email"] = $row->email;
                    $_SESSION["admin_login"] = true;
                    session_write_close();
                    $result_data["valid"] = true;
                    $result_data["msg"] = "Successfully, login";
               }else{
                    $result_data["valid"] = false;
                    $result_data["msg"] = "Sorry, password not match";
               }
            }else{
                $result_data["valid"] = false;
                $result_data["msg"] = "Sorry, error login";
            }
            return json_encode($result_data);
        }
        
        public function getClientList(){
            $sql = "SELECT * FROM clients";
            $result =$this->conn->prepare($sql);
            $result->execute();

            if($result->rowCount()>0){
                $result_data["valid"] = true;
                $result_data["msg"] = "Clients Data Retrieved";
                foreach($result as $key => $value){
                    $data[$key]["client_id"] = $value["client_id"];
                    $data[$key]["client_name"] = $value["client_name"];
                    $data[$key]["client_number"] = $value["client_number"];
                    $data[$key]["client_email"] = $value["client_email"];
                    $data[$key]["client_type"] = $value["client_type"];
                    $data[$key]["client_address"] = $value["client_address"];
                    $data[$key]["createdAt"] = $value["createdAt"];
                }
                $result_data["data"] = $data;
            }else{
                $result_data["valid"] = false;
                $result_data["msg"] = "Clients Data Error";
            }

            return json_encode($result_data);
        }

        public function getClientData($array){
            $args_getclient = array("client_id" => $array["client_id"]);
            $sql_getclient = "SELECT * FROM clients WHERE client_id = :client_id";
            $result_getclient = $this->conn->prepare($sql_getclient);
            $result_getclient->execute($args_getclient);

            if($result_getclient->rowCount()>0){
                $result_data["valid"] = true;
                $row = $result_getclient->fetchObject();
                $result_data["client_id"] = $row->client_id;
                $result_data["client_name"] = $row->client_name;
                $result_data["client_address"] = $row->client_address;
                $result_data["client_email"] = $row->client_email;
                $result_data["client_number"] = $row->client_number;
                $result_data["client_type"] = $row->client_type;
            }else{
                $result_data["valid"] = false;
                $result_data["msg"] = "Clients Data Error";
            }

            return json_encode($result_data);
        }

        public function editClientData($array){
            $args_editclient = array("client_id" => $array["client_id"], "client_name" => $array["client_name"],"client_email" => $array["client_email"], "client_address" => $array["client_address"], "client_number" => $array["client_number"], "client_type" => $array["client_type"]);
            $sql_editclient= "UPDATE clients SET client_name = :client_name, client_address = :client_address, client_email = :client_email, client_type = :client_type, client_number = :client_number WHERE client_id = :client_id";
            //execute
            $result_editclient = $this->conn->prepare($sql_editclient);
            $result_editclient->execute($args_editclient);

            if($result_editclient->rowCount()>0){
                $result_data["valid"] = true;
                $result_data["msg"] = "Successful Update Client Data";
            }
            else{
                $result_data["valid"] = false;
                $result_data["msg"] = "Update Clients Data Error";
            }
            return json_encode($result_data);
        }

        public function deleteClientData($array){
            $args_deleteclient = array("client_id" => $array["client_id"]);
            $sql_deleteclient = "DELETE FROM clients WHERE client_id = :client_id";
            $result_deleteclient = $this->conn->prepare($sql_deleteclient);
            $result_deleteclient -> execute($args_deleteclient);

            if($result_deleteclient->rowCount()>0){
                $result_data["valid"] = true;
                $result_data["msg"] = "Successful Delete Client Data";
            }
            else{
                $result_data["valid"] = false;
                $result_data["msg"] = "Error Delete Clients Data ";
            }
            return json_encode($result_data);
        }
    }
?>