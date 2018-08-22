<?php
    class Users extends Controller {
        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function register(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              // Process form
        
              // Sanitize POST data
              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
              // Init data
              $data =[
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'verification_code' => trim($_POST['verification_code']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'verification_code_err' => ''
              ];
      
              // Validate Email
              if(empty($data['email'])){
                $data['email_err'] = 'Pleae enter email';
              } else {
                // Check email
                if($this->userModel->findUserByEmail($data['email'])){
                  $data['email_err'] = 'Email is already taken';
                }
              }
      
              // Validate Name
              if(empty($data['username'])){$data['username_err'] = 'Pleae enter username';}
              // Validate Password
              if(empty($data['password'])){
                $data['password_err'] = 'Pleae enter password';
              } elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be at least 6 characters';
              }
    
              // Validate Confirm Password
              if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Pleae confirm password';
              } else {
                if($data['password'] != $data['confirm_password']){
                  $data['confirm_password_err'] = 'Passwords do not match';
                }
              }

              // Validate Verification Code
              if($data['verification_code'] != '$mZDdK@84u9Efazm'){
                $data['verification_code_err'] = 'Are you sure?';
              }
      
              // Make sure errors are empty
              if(empty($data['email_err']) && empty($data['username_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['verification_code_err'])){
                // Validated

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if($this->userModel->register($data)){
                  flash('register_success', 'You are registered.');
                  redirect('users/login');
                } else {
                  die('Something went wrong');
                }
      
              } else {
                // Load view with errors
                $this->view('users/register', $data);
              }
      
            } else {
              // Init data
              $data =[
                'username' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'verification_code' => '',
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'verification_code_err' => ''
              ];
      
              // Load view
              $this->view('users/register', $data);
            }
          }
      

        public function login(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Init data
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => ''
                ];

                //Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email or username';
                }

                //Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                }

                //Check for email
                if($this->userModel->findUserByEmail($data['email'])){
                    //Found
                } else {
                    $data['password_err'] = 'Incorrect email or password';
                }

                //Make sure errors are empty
                if(empty($data['password_err']) && empty($data['email_err'])){
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                    if($loggedInUser){
                        //Create Session
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['password_err'] = 'Incorrect email or password';
                        $this->view('users/login', $data);
                    }
                } else {
                    $this->view('users/login', $data);
                }

            } else {
                if (isset($_SESSION['user_id'])) {
                    redirect('admin');
                }
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''
                ];

                $this->view('users/login', $data);
            }
        }

        public function createUserSession($user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_username'] = $user->username;
            $_SESSION['privilege'] = $user->privilege;
            redirect('admin/index');
        }

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_username']);
            unset($_SESSION['privilege']);
            session_destroy();
            redirect('');
        }

    }