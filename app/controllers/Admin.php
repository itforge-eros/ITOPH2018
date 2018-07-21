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
            $this->registrationModel = $this->model('Registration');
        }

        public function index(){
            //Get pages
            //$pages = $this->pageModel->getPages();
            $competitions = $this->competitionModel->getCompetitions();
            $individualCount = $this->registrationModel->countRegistratorsBySlug('individual');
            
            $competitionCount = 0;
            $competitionCount += $this->registrationModel->countRegistratorsBySlug('skill');
            $competitionCount += $this->registrationModel->countRegistratorsBySlug('game');
            $competitionCount += $this->registrationModel->countRegistratorsBySlug('website');
            $competitionCount += $this->registrationModel->countRegistratorsBySlug('security');

            $workshopCount = 0;
            $workshopCount += $this->registrationModel->countRegistratorsBySlug('multimedia');
            $workshopCount += $this->registrationModel->countRegistratorsBySlug('se');
            $workshopCount += $this->registrationModel->countRegistratorsBySlug('datascience');
            $workshopCount += $this->registrationModel->countRegistratorsBySlug('networks');

            $bebrasCount = $this->registrationModel->countRegistratorsBySlug('bebras');

            $data = [
                //'pages' => $pages
                'competitions' => $competitions,
                'individualCount' => $individualCount,
                'competitionCount' => $competitionCount,
                'workshopCount' => $workshopCount,
                'bebrasCount' => $bebrasCount
            ];
            $this->view('admin/index', $data);
        }

        public function details($registrationType){

            switch($registrationType){
                case "individual":

                case "security":
                case "game":
                case "skill":
                case "website":

                case "multimedia":
                case "se":
                case "networks":
                case "datascience":

                case "bebras":
                    $registrationDataModel = $this->registrationModel->getRegistratorsBySlug($registrationType);
                    break;

                case "competition":
                    $registrationDataModel = $this->registrationModel->getCompetitionRegistrators();
                    break;

                case "workshop":
                    $registrationDataModel = $this->registrationModel->getWorkshopRegistrators();
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

        public function delete($id){
            
            $query = $this->registrationModel->getRegistrationById($id);
            $category = $query->category;

            if(!isset($_SESSION['privilege'])) {$yourname = $_SESSION['user_username']; die("คุณ $yourname ไม่มีสิทธิ์ลบ Record นี้");}
            else {
                if($this->registrationModel->deleteRegistrationById($id)){
                    flash('page_message', "ลบการลงทะเบียน #$id แล้ว");
                    redirect("admin/details/$category");
                } else {
                    die("Something went wrong");
                }
            }

        }

        public function export($slug){

            $individualSheetTitles = ['ID', 'ชื่อ-นามสกุล', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้นมัธยมศึกษาปีที่', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์'];
            $workshopSheetTitles = ['ID', 'ประเภท', 'ชื่อ-นามสกุล', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้นมัธยมศึกษาปีที่', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์'];
            $competitionSheetTitles = ['ID', 'ประเภท', 'ชื่อทีม', 'ชื่อ-นามสกุล สมาชิกคนที่ 1', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้นมัธยมศึกษาปีที่', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์', 'ชื่อ-นามสกุล สมาชิกคนที่ 2', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้นมัธยมศึกษาปีที่', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์', 'ชื่อ-นามสกุล สมาชิกคนที่ 3', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้นมัธยมศึกษาปีที่', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์', 'ชื่อ-นามสกุล สมาชิกคนที่ 4', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้นมัธยมศึกษาปีที่', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์', 'ชื่อ-นามสกุล สมาชิกคนที่ 5', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้นมัธยมศึกษาปีที่', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์', 'ชื่อ-นามสกุล สมาชิกคนที่ 6', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้นมัธยมศึกษาปีที่', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์'];

            switch($slug){
                case "individual":
                    $filename = "ITOPH18-Vistors.xlsx";
                    $registrationDataModel = $this->registrationModel->getRegistratorsBySlugWithoutCategory($slug);
                    $sheet_titles = $individualSheetTitles;
                    break;

                case "competition":
                    $filename = "ITOPH18-Competition-Registrators.xlsx";
                    $registrationDataModel = $this->registrationModel->getCompetitionRegistrators();
                    $sheet_titles = $competitionSheetTitles;
                    break;

                case "workshop":
                    $filename = "ITOPH18-Workshop-Registrators.xlsx";
                    $registrationDataModel = $this->registrationModel->getWorkshopRegistrators();
                    $sheet_titles = $workshopSheetTitles;
                    break;

                case "bebras":
                    $filename = "ITOPH18-Bebras-Registrators.xlsx";
                    $registrationDataModel = $this->registrationModel->getRegistratorsBySlugWithoutCategory($slug);
                    $sheet_titles = $individualSheetTitles;
                    break;
                
                case "security":
                case "game":
                case "skill":
                case "website":
                $filename = "ITOPH18-Competition-$slug-Registrators.xlsx";
                    $registrationDataModel = $this->registrationModel->getRegistratorsBySlug($slug);
                    $sheet_titles = $competitionSheetTitles;
                    break;
                
                case "multimedia":
                case "se":
                case "networks":
                case "datascience":
                    $filename = "ITOPH18-Workshop-$slug-Registrators.xlsx";
                    $registrationDataModel = $this->registrationModel->getRegistratorsBySlug($slug);
                    $sheet_titles = $workshopSheetTitles;
                    break;

                default:
                    redirect();
            }

            $array = json_decode(json_encode($registrationDataModel), True);
            $newarray = [];
            //I DO THIS BECAUSE ID AND PHONE WILL BE STORED AS EXPONENTIAION IN XLSX!
            foreach($array as $item) {
                for($i=1; $i<=6; $i++){
                    if (!is_null($item['candidate0'.$i.'_id'])) {
                        $item['candidate0'.$i.'_id'] = "='".$item['candidate0'.$i.'_id'];
                        $item['candidate0'.$i.'_phone'] = "='".$item['candidate0'.$i.'_phone'];
                    }
                }
                $newarray[] = $item;
            }
            
            $data = array_merge(array(), $newarray);
            array_unshift($data , $sheet_titles);
            
            $writer = new XLSXWriter();
            $writer->writeSheet($data);
            $writer->writeToFile($filename);

            header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            readfile($filename);
            exit(0);
        }

    }