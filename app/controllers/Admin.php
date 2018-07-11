<?php
    class Admin extends Controller {
        public function __construct(){
            if(!isLoggedIn()){
                redirect('');
            }

            //$this->pageModel = $this->model('Page');
            $this->competitionModel = $this->model('Competition');
            $this->individualModel = $this->model('Individual');
            $this->workshopModel = $this->model('Workshop');
            $this->bebrasModel = $this->model('Bebras');
        }

        public function index(){
            //Get pages
            //$pages = $this->pageModel->getPages();
            $competitions = $this->competitionModel->getCompetitions();

            $data = [
                //'pages' => $pages
                'competitions' => $competitions
            ];
            $this->view('admin/index', $data);
        }

        public function details($registrationType){

            switch($registrationType){
                case "individual":
                    $registrationDataModel = $this->individualModel->getIndividualRegistrators();
                    break;

                case "competition":
                    $registrationDataModel = $this->competitionModel->getCompetitionRegistrators();
                    break;

                case "workshop":
                    $registrationDataModel = $this->workshopModel->getWorkshopRegistrators();
                    break;

                case "bebras":
                    $registrationDataModel = $this->bebrasModel->getBebrasRegistrators();
                    break;

                default:
                    redirect();
            }

            $data = [
                'registrationType' => $registrationType,
                'registrationDataModel' => $registrationDataModel
            ];
            $this->view('admin/details', $data);
        }

        public function add(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //SANITIZE POST ARRAY
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'title' => trim($_POST['title']),
                    'slug' => trim($_POST['slug']),
                    'short_description' => trim($_POST['short_description']),
                    'full_description' => trim($_POST['full_description']),
                    'logo_src' => trim($_POST['logo_src']),
                    'title_err' => '',
                    'slug_err' => '',
                    'short_description_err' => '',
                    'full_description_err' => '',
                    'logo_src_err' => '',
                ];

                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter title';
                }
                if(empty($data['slug'])){
                    $data['content_err'] = 'Please enter content';
                }
                if(empty($data['short_description'])){
                    $data['slug_err'] = 'Please enter short description- displayed on front page';
                }
                if(empty($data['full_description'])){
                    $data['slug_err'] = 'Please enter full description- displayed on seperated page';
                }
                if(empty($data['logo_src'])){
                    $data['slug_err'] = 'Please enter slug- only filename with extension';
                }

                if(empty($data['title_err']) && empty($data['short_description_err']) && empty($data['slug_err']) && empty($data['full_description_err']) && empty($data['logo_src'])){
                    if($this->pageModel->addPage($data)){
                        flash('page_message', 'Competition added');
                        redirect('admin');
                    } else {
                        die("Something went wrong");
                    }
                } else {
                    $this->view('admin/add', $data);
                }

            } else{
                $data = [
                    'title' => '',
                    'slug' => '',
                    'short_description' => '',
                    'full_description' => '',
                    'logo_src' => ''
                  ];
                $this->view('admin/add', $data);
            }

        }

        public function edit($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //SANITIZE POST ARRAY
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $id,
                    'title' => trim($_POST['title']),
                    'slug' => trim($_POST['slug']),
                    'short_description' => trim($_POST['short_description']),
                    'full_description' => trim($_POST['full_description']),
                    'logo_src' => trim($_POST['logo_src']),
                    'title_err' => '',
                    'slug_err' => '',
                    'short_description_err' => '',
                    'full_description_err' => '',
                    'logo_src_err' => '',
                ];

                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter title';
                }
                if(empty($data['slug'])){
                    $data['content_err'] = 'Please enter content';
                }
                if(empty($data['short_description'])){
                    $data['slug_err'] = 'Please enter short description- displayed on front page';
                }
                if(empty($data['full_description'])){
                    $data['slug_err'] = 'Please enter full description- displayed on seperated page';
                }
                if(empty($data['logo_src'])){
                    $data['slug_err'] = 'Please enter slug- only filename with extension';
                }

                if(empty($data['title_err']) && empty($data['short_description_err']) && empty($data['slug_err']) && empty($data['full_description_err']) && empty($data['logo_src_err'])){
                    if($this->competitionModel->updateCompetition($data)){
                        flash('page_message', 'Competition edited');
                        redirect('admin');
                    } else {
                        die("Something went wrong");
                    }
                } else {
                    $this->view('admin/edit', $data);
                }

            } else{

                $competition = $this->competitionModel->getCompetitionById($id);

                $data = [
                    'id' => $id,
                    'title' => $competition->title,
                    'slug' => $competition->slug,
                    'short_description' => $competition->short_description,
                    'full_description' => $competition->full_description,
                    'logo_src' => $competition->logo_src
                  ];
                $this->view('admin/edit', $data);
            }

        }

        

    }