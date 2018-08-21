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

            $securityCount = $this->registrationModel->countRegistratorsBySlug('security');
            $gameCount = $this->registrationModel->countRegistratorsBySlug('game');
            $skillCount = $this->registrationModel->countRegistratorsBySlug('skill');
            $websiteCount = $this->registrationModel->countRegistratorsBySlug('website');
            
            $competitionCount = $securityCount + $gameCount + $skillCount + $websiteCount;

            $multimediaCount = $this->registrationModel->countRegistratorsBySlug('multimedia');
            $networksCount = $this->registrationModel->countRegistratorsBySlug('networks');
            $seCount = $this->registrationModel->countRegistratorsBySlug('se');
            $datascienceCount = $this->registrationModel->countRegistratorsBySlug('datascience');

            $workshopCount = $multimediaCount + $networksCount + $seCount + $datascienceCount;
            
            $bebrasCount = $this->registrationModel->countRegistratorsBySlug('bebras');

            $checkins = $this->registrationModel->getAllCheckedIn();

            $checkins23 = $this->registrationModel->getCheckedInByDate(23);
            $checkins24 = $this->registrationModel->getCheckedInByDate(24);
            $checkins25 = $this->registrationModel->getCheckedInByDate(25);

            $recentCheckins = array();
            $count = 0;
            foreach($checkins as $checkin):
                if($count > 10){break;}
                array_push($recentCheckins, array($this->registrationModel->getRegistratorsById($checkin->registration_id), $checkin->checkin_time));
                $count++;
            endforeach;

            $data = [
                //'pages' => $pages
                'competitions' => $competitions,
                'individualCount' => $individualCount,
                'competitionCount' => $competitionCount,
                'workshopCount' => $workshopCount,
                'bebrasCount' => $bebrasCount,
                'multiCount' => $multimediaCount,
                'seCount' => $seCount,
                'networksCount' => $networksCount,
                'datascienceCount' => $datascienceCount,
                'skillCount' => $skillCount,
                'gameCount' => $gameCount,
                'websiteCount' => $websiteCount,
                'securityCount' => $securityCount,
                'checkins' => $checkins,
                'checkins23' => $checkins23,
                'checkins24' => $checkins24,
                'checkins25' => $checkins25,
                'recentCheckins' => $recentCheckins
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

            $securityCount = $this->registrationModel->countRegistratorsBySlug('security');
            $gameCount = $this->registrationModel->countRegistratorsBySlug('game');
            $skillCount = $this->registrationModel->countRegistratorsBySlug('skill');
            $websiteCount = $this->registrationModel->countRegistratorsBySlug('website');

            $multimediaCount = $this->registrationModel->countRegistratorsBySlug('multimedia');
            $networksCount = $this->registrationModel->countRegistratorsBySlug('networks');
            $seCount = $this->registrationModel->countRegistratorsBySlug('se');
            $datascienceCount = $this->registrationModel->countRegistratorsBySlug('datascience');

            $data = [
                'registrationType' => $registrationType,
                'registrationDataModel' => $registrationDataModel,
                'multiCount' => $multimediaCount,
                'seCount' => $seCount,
                'networksCount' => $networksCount,
                'datascienceCount' => $datascienceCount,
                'skillCount' => $skillCount,
                'gameCount' => $gameCount,
                'websiteCount' => $websiteCount,
                'securityCount' => $securityCount
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

            $individualSheetTitles = ['ID', 'ชื่อ-นามสกุล', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้น', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์'];
            $workshopSheetTitles = ['ID', 'ประเภท', 'ชื่อ-นามสกุล', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้น', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์'];
            $competitionSheetTitles = ['ID', 'ประเภท', 'ชื่อทีม', 'ชื่อ-นามสกุล สมาชิกคนที่ 1', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้น', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์', 'ชื่อ-นามสกุล สมาชิกคนที่ 2', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้น', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์', 'ชื่อ-นามสกุล สมาชิกคนที่ 3', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้น', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์', 'ชื่อ-นามสกุล สมาชิกคนที่ 4', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้น', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์', 'ชื่อ-นามสกุล สมาชิกคนที่ 5', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้น', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์', 'ชื่อ-นามสกุล สมาชิกคนที่ 6', 'รหัสประจำตัวประชาชน', 'อายุ', 'ระดับชั้น', 'โรงเรียน', 'อีเมล', 'เบอร์โทรศัพท์'];

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
                switch($item['category']) {
                    case "security":
                        $item['category'] = "ความปลอดภัยของระบบคอมพิวเตอร์";
                        break;
                    case "game":
                        $item['category'] = "กีฬาอิเล็กทรอนิกส์";
                        break;
                    case "skill":
                        $item['category'] = "แก้ปัญหาเชิงวิเคราะห์";
                        break;
                    case "website":
                        $item['category'] = "พัฒนาเว็บไซต์";
                        break;
                    case "multimedia":
                        $item['category'] = "สายลับจับผิดภาพ";
                        break;
                    case "networks":
                        $item['category'] = "เชื่อมต่อทุกสิ่งด้วย IoT";
                        break;
                    case "se":
                        $item['category'] = "สร้างหุ่นยนต์ให้อัจฉริยะ";
                        break;
                    case "datascience":
                        $item['category'] = "แกะรอยโปเกม่อน";
                        break;
                }
                
                for($i=1; $i<=6; $i++){
                    if (!is_null($item['candidate0'.$i.'_id'])) {
                        $item['candidate0'.$i.'_id'] = " ".$item['candidate0'.$i.'_id'];
                        $item['candidate0'.$i.'_phone'] = " ".$item['candidate0'.$i.'_phone'];

                        if($item['candidate0'.$i.'_grade']==98){
                            $item['candidate0'.$i.'_grade'] = "ปวช.";
                        } else if($item['candidate0'.$i.'_grade']==99){
                            $item['candidate0'.$i.'_grade'] = "ปวส.";
                        } else {
                            $mGrade = $item['candidate0'.$i.'_grade'];
                            $item['candidate0'.$i.'_grade'] = "ม. $mGrade";
                        }
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

        public function registration(){
            $registrators = $this->registrationModel->getAllCheckedIn();

            $data = [
                'registrators' => $registrators
            ];
            $this->view('admin/registration', $data);
                        
        }

        public function normalregistration(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $searchResult = $this->registrationModel->getRegistratorsByName($_POST['team_name']);
                $data = [
                    'searchResult' => $searchResult
                ];
            } else {

            }
            
            $this->view('admin/normalregistration', $data);
                        
        }

        public function checkin($id){
            
            $registrators = $this->registrationModel->getRegistratorsById($id);
            $isCheckedin =  $this->registrationModel->getCheckedInById($id);

            if($isCheckedin){
                if(isset($isCheckedin->team_name)){
                    $name = 'ทีม '.$isCheckedin->team_name;
                } else {
                    $name = $isCheckedin->candidate01_name;
                }
                flash('page_message', "$name เคยลงทะเบียนไปแล้ว");
                redirect("admin/registration");
            } else if($registrators){
                $registrators = $registrators[0];
                if($this->registrationModel->checkIn($id)){
                    if(isset($registrators->team_name)){
                        $name = "ทีม ".$registrators->team_name;
                    } else {
                        $name = $registrators->candidate01_name;
                    }
                    switch($registrators->category) {
                        case "security":
                            $type = "ความปลอดภัยของระบบคอมพิวเตอร์";
                            break;
                        case "game":
                            $type = "กีฬาอิเล็กทรอนิกส์";
                            break;
                        case "skill":
                            $type = "แก้ปัญหาเชิงวิเคราะห์";
                            break;
                        case "website":
                            $type = "พัฒนาเว็บไซต์";
                            break;
                        case "multimedia":
                            $type = "สายลับจับผิดภาพ";
                            break;
                        case "networks":
                            $type = "เชื่อมต่อทุกสิ่งด้วย IoT";
                            break;
                        case "se":
                            $type = "สร้างหุ่นยนต์ให้อัจฉริยะ";
                            break;
                        case "datascience":
                            $type = "แกะรอยโปเกม่อน";
                            break;
                        case "individual":
                            $type = "เข้าชมงาน";
                            break;
                        case "bebras":
                            $type = "Bebras";
                            break;
                    }
                    flash('page_message', "ลงทะเบียน $name ($type) แล้ว");
                    redirect("admin/registration");
                } else {
                    die("Something went wrong");
                }
            } else {
                die("ไม่พบ ID นี้ในฐานข้อมูล");
            }
            //$this->view('admin/registration', $data);
        }

        public function allcheckin(){
            
            //$allCheckin = $this->registrationModel->getAllCheckedIn();
            $individualCheckin = $this->registrationModel->getAllCheckedInBySlug("individual");
            $competitionCheckin = $this->registrationModel->getAllCheckedInBySlug("competition");
            $workshopCheckin = $this->registrationModel->getAllCheckedInBySlug("workshop");
            $bebrasCheckin = $this->registrationModel->getAllCheckedInBySlug("bebras");

            $data = [
                'individualCheckin' => $individualCheckin,
                'competitionCheckin' => $competitionCheckin,
                'workshopCheckin' => $workshopCheckin,
                'bebrasCheckin' => $bebrasCheckin,
            ];
            
            $this->view('admin/allcheckin', $data);
        }

    }