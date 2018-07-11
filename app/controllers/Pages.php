<?php
    class Pages extends Controller {
        public function __construct(){
            $this->eventModel = $this->model('Event');
            $this->competitionModel = $this->model('Competition');
            $this->workshopModel = $this->model('Workshop');
            $this->rallyModel = $this->model('Rally');
            $this->pageModel = $this->model('Page');

        }

        public function index(){
            $events = $this->eventModel->getEvents();
            $compets = $this->competitionModel->getCompetitions();
            $workshops = $this->workshopModel->getWorkshops();
            $rallys = $this->rallyModel->getRallys();

            $data = [
                'title' => 'IT OPENHOUSE 2018',
                'events' => $events,
                'competitions' => $compets,
                'workshops' => $workshops,
                'rallys' => $rallys
            ];
            
            
            $this->view('pages/index', $data);
        }

        public function details($slug){
            $competition = $this->competitionModel->getCompetitionBySlug($slug);
            $data = [
                'competition' => $competition
            ];
            $this->view('pages/details', $data);
        }

        public function registration($slug){

            switch ($slug) {
                case 'security':
                case 'skill':
                case 'game':
                case 'website':
                    $registrationType = "competition";
                    $registrationDataModel = $this->competitionModel->getCompetitionBySlug($slug);
                    break;

                case 'multimedia':
                case 'se':
                case 'networks':
                case 'datascience':
                    $registrationType = "workshop";
                    $pdfH2Text = "ใบสมัคร Workshop";
                    $registrationDataModel = $this->workshopModel->getWorkshopBySlug($slug);
                    break;

                case 'bebras':
                    $registrationType = "bebras";
                    $pdfH2Text = "สมัครเข้าทดสอบการแข่งขันทักษะการคิดทางคอมพิวเตอร์ระดับชาติประจำปี 2018 (BEBRAS)";
                    $registrationDataModel = null;
                    break;

                case 'individual':
                    $registrationType = "individual";
                    $pdfH2Text = "ใบสมัครเข้าชมงาน IT Openhouse 2018";
                    $registrationDataModel = null;
                    break;
                
                default:
                    redirect('');
            }

            /*
             *   Handle COMPETITION registration form after submitting
             */

            if($_SERVER['REQUEST_METHOD'] == 'POST' && $registrationType == "competition"){
                //SANITIZE POST ARRAY
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $registrations = $this->competitionModel->getRegistrations();
                $data = array_map('trim', $_POST);
                $data['category'] = $slug;
                $data['registrationType'] = $registrationType;
                $data['registrationDataModel'] = $registrationDataModel;

                //VALIDATION

                //Team name & School is always required.
                if(empty($data['team_name'])){$data['team_name_err'] = 'กรุณากรอกชื่อทีม';}
                if(empty($data['school_name'])){$data['school_name_err'] = 'กรุณากรอกชื่อโรงเรียน';}

                //Candidate01 is always required.
                for($i=1; $i<=6; $i++):
                    if(empty($data['candidate0'.$i.'_name'])){$data['candidate0'.$i.'_name_err'] = 'กรุณากรอกชื่อ-สกุลสมาชิกคนที่ '.$i;}
                    else if (!strpos($data['candidate0'.$i.'_name'], ' ')){$data['candidate0'.$i.'_name_err'] = 'กรุณากรอกทั้งชื่อและนามสกุล';}
                    if(empty($data['candidate0'.$i.'_id'])){$data['candidate0'.$i.'_id_err'] = 'กรุณาหมายเลขบัตรประชาชนสมาชิกคนที่ '.$i;}
                    if(strlen($data['candidate0'.$i.'_id']) != 13) {
                        $data['candidate0'.$i.'_id_err'] = 'หมายเลขบัตรประชาชนไม่ถูกต้อง';
                    } else {
                    $sum = 0;
                    for($j=0;$j<12;$j++) {
                        $digitValue = substr($data['candidate0'.$i.'_id'],$j,1);
                        $digitId = substr($data['candidate0'.$i.'_id'],$j,1);
                        $sum += (int)($digitValue)*($digitId);
                    }
                    $digit13 = substr($data['candidate0'.$i.'_id'],12,1);
                    if((11-($sum%11))%10 != (int)($digit13)) {$data['candidate0'.$i.'_id_err'] = 'หมายเลขบัตรประชาชนไม่ถูกต้อง';}
                    }

                    if(empty($data['candidate0'.$i.'_age'])){$data['candidate0'.$i.'_age_err'] = 'กรุณากรอกอายุสมาชิกคนที่ '.$i;}
                    else if($data['candidate0'.$i.'_age'] < 10 || $data['candidate0'.$i.'_age'] > 30){$data['candidate0'.$i.'_age_err'] = 'อายุสมาชิกคนที่ '.$i. ' ไม่ถูกต้อง';}
            
                    if(empty($data['candidate0'.$i.'_email'])){$data['candidate0'.$i.'_email_err'] = 'กรุณากรอกอีเมลสมาชิกคนที่ '.$i;}
                    else{$email = filter_var($_POST['candidate0'.$i.'_email'], FILTER_VALIDATE_EMAIL); if(!$email){$data['candidate0'.$i.'_email_err'] = 'อีเมลสมาชิกคนที่ '.$i.' ไม่ถูกต้อง';}}
        
                    if(empty($data['candidate0'.$i.'_phone'])){$data['candidate0'.$i.'_phone_err'] = 'กรุณากรอกเบอร์โทรศัพท์สมาชิกคนที่ '.$i;}
                    else if(strlen($data['candidate0'.$i.'_phone'])!=10){$data['candidate0'.$i.'_phone_err'] = 'เบอร์โทรศัพท์สมาชิกคนที่ '.$i.' ไม่ถูกต้อง';}

                    if( ($slug == 'security' || $slug == 'website') && $i==2 ){break;}
                    else if($slug == 'skill' && $i==3){break;}
                endfor;

                if(empty($data['teacher_name'])){$data['teacher_name_err'] = 'กรุณากรอกชื่อ-สกุลอาจารย์';}
                else if (!strpos($data['teacher_name'], ' ')){$data['teacher_name_err'] = 'กรุณากรอกทั้งชื่อและนามสกุล';}
                if(empty($data['teacher_email'])){$data['teacher_email_err'] = 'กรุณากรอกอีเมลอาจารย์';}

                if(empty($data['teacher_email'])){$data['teacher_email_err'] = 'กรุณากรอกอีเมลสมาชิกคนที่ '.$i;}
                else{$email = filter_var($_POST['teacher_email'], FILTER_VALIDATE_EMAIL); if(!$email){$data['teacher_email_err'] = 'อีเมลอาจารย์ไม่ถูกต้อง';}}

                if(empty($data['teacher_phone'])){$data['teacher_phone_err'] = 'กรุณากรอกเบอร์โทรศัพท์อาจารย์';}
                else if(strlen($data['teacher_phone'])!=10){$data['teacher_phone_err'] = 'เบอร์โทรศัพท์อาจารย์ไม่ถูกต้อง';}

                $error_array = ['team_name_err', 'school_name_err', 'teacher_name_err', 'teacher_email_err', 'teacher_phone_err'];
                for($i=1; $i<=6; $i++){
                    $error_array[] = 'candidate0'.$i.'_name_err';
                    $error_array[] = 'candidate0'.$i.'_age_err';
                    $error_array[] = 'candidate0'.$i.'_id_err';
                    $error_array[] = 'candidate0'.$i.'_phone_err';
                    $error_array[] = 'candidate0'.$i.'_email_err';
                }

                $error = false;
                foreach($error_array as $field) {
                    if(!empty($data[$field])) {$error = true;}
                }

                if(!$error){
                    $tmpt_filename = uniqid('IT-OPENHOUSE-2018-');
                    $filename = $tmpt_filename.".pdf";
                    if($slug != "game"){
                        $data['candidate01_school'] = $data['school_name'];
                        if(!empty($data['candidate02_name'])){ $data['candidate02_school'] = $data['school_name'];}
                        if(!empty($data['candidate03_name'])){ $data['candidate03_school'] = $data['school_name'];}
                    }
                    $data['registration_date'] = date("Y-m-d H:i:s");
                    $data['pdf_filename'] = $filename;

                    if($this->competitionModel->addRegistration($data)){

                        if($registrationType == "competition"):
                            //PDF HERE
                            $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
                            $fontDirs = $defaultConfig['fontDir'];

                            $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
                            $fontData = $defaultFontConfig['fontdata'];

                            $mpdf = new \Mpdf\Mpdf([
                                'fontDir' => array_merge($fontDirs, [
                                    dirname(__FILE__)."/../../public/assets/font",
                                ]),
                                'fontdata' => $fontData + [
                                    'THSarabunNew' => [
                                        'R' => 'THSarabunNew.ttf',
                                        'B' => 'THSarabunNew-Bold.ttf',
                                    ]
                                ],
                                'default_font' => 'THSarabunNew'
                            ]);

                            $content = '
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                <style>
                                body, .container, h1, h2, h3, p {font-family: "Garuda";}

                                h1, h2{
                                    font-weight: bold;
                                    margin-top: 0.75em;
                                    margin-bottom: 0.25em;
                                }

                                h2 {
                                    text-align: center;
                                }

                                h3 {
                                    text-align: left;
                                    font-weight: bold;
                                    margin-top: 1em;
                                    margin-bottom: -0.25em;
                                }

                                p {
                                    font-weight: normal;
                                    font-size: 16pt;
                                }

                                strong {
                                    font-weight: bold;
                                    font-size: 14pt;
                                }

                                .img-wrapper {
                                    width: 100%;
                                    text-align: center;
                                }

                                img {
                                    width: 360px;
                                }

                                .right {
                                    width: 50%;
                                    float: right;
                                    text-align: center;
                                }
                            </style>
                            </head>
                            <body>
                            <div class="container">
                                <div class="img-wrapper">
                                    <img src="'.URLROOT.'/public/assets/img/openhouse-2018-logo.svg">
                                </div>
                                <h2>ใบสมัครการแข่งขัน'.$registrationDataModel->title.'</h2>
                                <table>
                                    <tr>
                                        <td><strong>ชื่อทีม</strong></td>
                                        <td>'.$data['team_name'].'</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>สถานศึกษา</strong></td>
                                        <td>'.$data['school_name'].'</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                                <h3>สมาชิกคนที่ 1</h3>
                                <hr>
                                <table>
                                    <tr>
                                        <td><strong>ชื่อ-นามสกุล</strong></td>
                                        <td>'.$data['candidate01_name'].'</td>
                                        <td><strong>รหัสประจำตัวประชาชน</strong></td>
                                        <td>'.$data['candidate01_id'].'</td>
                                    </tr>
                                    <tr>
                                        <td><strong>อายุ</strong></td>
                                        <td>'.$data['candidate01_age'].'</td>
                                        <td><strong>ชั้นมัธยมศึกษาปีที่</strong></td>
                                        <td>'.$data['candidate01_grade'].'</td>
                                    </tr>
                                    <tr>
                                        <td><strong>อีเมล</strong></td>
                                        <td>'.$data['candidate01_email'].'</td>
                                        <td><strong>เบอร์โทรศัพท์</strong></td>
                                        <td>'.$data['candidate01_phone'].'</td>
                                    </tr>
                                </table>';
                                if(!empty($data['candidate02_name'])):
                                    $content .= '
                                        <h3>สมาชิกคนที่ 2</h3>
                                        <hr>
                                        <table>
                                            <tr>
                                                <td><strong>ชื่อ-นามสกุล</strong></td>
                                                <td>'.$data['candidate02_name'].'</td>
                                                <td><strong>รหัสประจำตัวประชาชน</strong></td>
                                                <td>'.$data['candidate02_id'].'</td>
                                            </tr>
                                            <tr>
                                                <td><strong>อายุ</strong></td>
                                                <td>'.$data['candidate02_age'].'</td>
                                                <td><strong>ระดับการศึกษา</strong></td>
                                                <td>'.$data['candidate02_grade'].'</td>
                                            </tr>
                                            <tr>
                                                <td><strong>อีเมล</strong></td>
                                                <td>'.$data['candidate02_email'].'</td>
                                                <td><strong>เบอร์โทรศัพท์</strong></td>
                                                <td>'.$data['candidate02_phone'].'</td>
                                            </tr>
                                        </table>';
                                endif;
                                if(!empty($data['candidate03_name'])):
                                    $content .= '
                                        <h3>สมาชิกคนที่ 3</h3>
                                        <hr>
                                        <table>
                                            <tr>
                                                <td><strong>ชื่อ-นามสกุล</strong></td>
                                                <td>'.$data['candidate03_name'].'</td>
                                                <td><strong>รหัสประจำตัวประชาชน</strong></td>
                                                <td>'.$data['candidate03_id'].'</td>
                                            </tr>
                                            <tr>
                                                <td><strong>อายุ</strong></td>
                                                <td>'.$data['candidate03_age'].'</td>
                                                <td><strong>ชั้นมัธยมศึกษาปีที่</strong></td>
                                                <td>'.$data['candidate03_grade'].'</td>
                                            </tr>
                                            <tr>
                                                <td><strong>อีเมล</strong></td>
                                                <td>'.$data['candidate03_email'].'</td>
                                                <td><strong>เบอร์โทรศัพท์</strong></td>
                                                <td>'.$data['candidate03_phone'].'</td>
                                            </tr>
                                        </table>';
                                endif;
                                if(!empty($data['candidate04_name'])):
                                    for($i=4; $i<=6 ;$i++):
                                        $content .= '
                                            <h3>สมาชิกคนที่ '.$i.'</h3>
                                            <hr>
                                            <table>
                                                <tr>
                                                    <td><strong>ชื่อ-นามสกุล</strong></td>
                                                    <td>'.$data['candidate0'.$i.'_name'].'</td>
                                                    <td><strong>รหัสประจำตัวประชาชน</strong></td>
                                                    <td>'.$data['candidate0'.$i.'_id'].'</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>อายุ</strong></td>
                                                    <td>'.$data['candidate0'.$i.'_age'].'</td>
                                                    <td><strong>ชั้นมัธยมศึกษาปีที่</strong></td>
                                                    <td>'.$data['candidate0'.$i.'_grade'].'</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>อีเมล</strong></td>
                                                    <td>'.$data['candidate0'.$i.'_email'].'</td>
                                                    <td><strong>เบอร์โทรศัพท์</strong></td>
                                                    <td>'.$data['candidate0'.$i.'_phone'].'</td>
                                                </tr>
                                            </table>';
                                    endfor;
                                endif;
                            
                            $content .= '
                                <h3>ข้อมูลอาจารย์ที่ปรึกษา</h3>
                                <hr>
                                <table>
                                    <tr>
                                        <td><strong>ชื่อ-นามสกุล</strong></td>
                                        <td>'.$data['teacher_name'].'</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>อีเมล</strong></td>
                                        <td>'.$data['teacher_email'].'</td>
                                        <td><strong>เบอร์โทรศัพท์</strong></td>
                                        <td>'.$data['teacher_phone'].'</td>
                                    </tr>
                                </table>
                                <p>ทางโรงเรียน อาจารย์ผู้ควบคุมทีม และนักเรียนที่เข้าร่วมการแข่งขัน
                                ได้อ่านและยอมรับในกฎกติกาการแข่งขันตอบปัญหาแล้ว และยินดีปฏิบัติตามกฎกติกาดังกล่าวทุกประการ</p>
                                <div class="right">
                                    <p>ลงชื่ออาจารย์ผู้ควบคุมทีม</p>
                                    <p>.......................................</p>
                                    <p>(.....................................)</p>
                                    <p>วันที่..........เดือน...................พ.ศ.......</p>
                                </div>                             
                            </div>
                            </body>';
                            
                            $content = mb_convert_encoding($content, 'UTF-8', 'UTF-8');
                            $mpdf->WriteHTML($content);
                            $mpdf->Output(dirname(__FILE__)."/../../public/registration/".$filename, \Mpdf\Output\Destination::FILE);

                            // Create the Transport
                            $transport = (new Swift_SmtpTransport(MAIL_HOST, 25))
                                ->setUsername(MAIL_USER)
                                ->setPassword(MAIL_PASS);

                            // Create the Mailer using your created Transport
                            $mailer = new Swift_Mailer($transport);

                            // Create a message
                            $message = (new Swift_Message('IT Openhouse 2018: ใบสมัครการแข่งขัน'))
                                ->setFrom(['openhouse2018@edu.bstudio.click' => 'IT Openhouse 2018'])
                                ->setTo([$data['teacher_email'] => $data['teacher_name']])
                                ->setBody(
                                    '<html>
                                        <body>
                                            <img src="'.URLROOT.'/public/assets/img/openhouse-2018-logo.svg">
                                            <h1> นี่คือใบสมัครแข่งขันรายการ ' . $registrationDataModel->title . '</h1>
                                        </body>
                                    </html>'
                                ,'text/html')
                                ->attach(Swift_Attachment::fromPath(dirname(__FILE__)."/../../public/registration/".$filename));

                            // Send the message
                            $result = $mailer->send($message);

                        endif;

                        flash('page_message', 'ลงทะเบียนเสร็จสิ้น');
                        redirect('pages/success/'.$tmpt_filename);
                    } else {
                        die("Something went wrong");
                    }
                } else {
                    $this->view('pages/registration', $data);
                }

            }else if($_SERVER['REQUEST_METHOD'] == 'POST' && $registrationType != "competition"){

                /*
                 *   Handle INDIVIDUAL / BEBRAS / WORKSHOP registration form after submitting
                 */
                //SANITIZE POST ARRAY
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = array_map('trim', $_POST);
                $data['category'] = $slug;
                $data['registrationType'] = $registrationType;
                if($registrationType == "workshop"){$data['registrationDataModel'] = $registrationDataModel;}

                //VALIDATION
                if(empty($data['candidate01_name'])){$data['candidate01_name_err'] = 'กรุณากรอกชื่อ-สกุล';}
                else if (!strpos($data['candidate01_name'], ' ')){$data['candidate01_name_err'] = 'กรุณากรอกทั้งชื่อและนามสกุล';}

                if(empty($data['candidate01_id'])){$data['candidate01_id_err'] = 'กรุณาหมายเลขบัตรประชาชน';}
                else if(strlen($data['candidate01_id']) != 13) {
                    $data['candidate01_id_err'] = 'หมายเลขบัตรประชาชนไม่ถูกต้อง';
                  } else {
                    $sum = 0;
                    for($i=0;$i<12;$i++) {
                        $digitValue = substr($data['candidate01_id'],$i,1);
                        $digitId = substr($data['candidate01_id'],$i,1);
                        $sum += (int)($digitValue)*($digitId);
                    }
                    $digit13 = substr($data['candidate01_id'],12,1);
                    if((11-($sum%11))%10 != (int)($digit13)) {$data['candidate01_id_err'] = 'หมายเลขบัตรประชาชนไม่ถูกต้อง';}
                  }

                if(empty($data['candidate01_age'])){$data['candidate01_age_err'] = 'กรุณากรอกอายุ';}
                else if($data['candidate01_age'] < 10 || $data['candidate01_age'] > 30){$data['candidate01_age'] = 'อายุไม่ถูกต้อง';}

                if(empty($data['candidate01_school'])){$data['candidate01_school_err'] = 'กรุณากรอกชื่อสถาบัน';}

                if(empty($data['candidate01_email'])){$data['candidate01_email_err'] = 'กรุณากรอกอีเมล';}
                else{$email = filter_var($_POST['candidate01_email'], FILTER_VALIDATE_EMAIL); if(!$email){$data['candidate01_email_err'] = 'อีเมลไม่ถูกต้อง';}}

                if(empty($data['candidate01_phone'])){$data['candidate01_phone_err'] = 'กรุณากรอกเบอร์โทรศัพท์';}
                else if(strlen($data['candidate01_phone'])!=10){$data['candidate01_phone_err'] = 'เบอร์โทรศัพท์ไม่ถูกต้อง';}

                $error_array = ['team_name_err', 'school_name_err', 'teacher_name_err', 'teacher_email_err', 'teacher_phone_err'];
                for($i=1; $i<=1; $i++){
                    $error_array[] = 'candidate0'.$i.'_name_err';
                    $error_array[] = 'candidate0'.$i.'_age_err';
                    $error_array[] = 'candidate0'.$i.'_id_err';
                    $error_array[] = 'candidate0'.$i.'_phone_err';
                    $error_array[] = 'candidate0'.$i.'_email_err';
                }

                $error = false;
                foreach($error_array as $field) {
                    if(!empty($data[$field])) {$error = true;}
                }

                if(!$error){
                    $tmpt_filename = uniqid('IT-OPENHOUSE-2018-');
                    $filename = $tmpt_filename.".pdf";
                    $data['registration_date'] = date("Y-m-d H:i:s");
                    $data['pdf_filename'] = $filename;

                    if($this->competitionModel->addRegistration($data)){

                        //PDF HERE
                        $mpdf = new \Mpdf\Mpdf();

                        $content = '
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <style>
                            body, .container, h1, h2, h3, p {font-family: "Garuda";}

                            h1, h2{
                                font-weight: bold;
                                margin-top: 0.75em;
                                margin-bottom: 0.25em;
                            }

                            h2 {
                                text-align: center;
                            }

                            h3 {
                                text-align: left;
                                font-weight: bold;
                                margin-top: 1em;
                                margin-bottom: -0.25em;
                            }

                            p {
                                font-weight: normal;
                                font-size: 16pt;
                            }

                            strong {
                                font-weight: bold;
                                font-size: 14pt;
                            }

                            .img-wrapper {
                                width: 100%;
                                text-align: center;
                            }

                            img {
                                width: 360px;
                            }

                            .right {
                                width: 50%;
                                float: right;
                                text-align: center;
                            }
                        </style>
                        </head>
                        <body>
                        <div class="container">
                            <div class="img-wrapper">
                                <img src="'.URLROOT.'/public/assets/img/openhouse-2018-logo.svg">
                            </div>
                            <h2>'.$pdfH2Text;
                        if($registrationType == "workshop"){
                            $content .= ' '.$registrationDataModel->title;
                        }
                            $content .= '</h2>
                            <h3>รายละเอียดผู้สมัคร</h3>
                            <hr>
                            <table>
                                <tr>
                                    <td><strong>ชื่อ-นามสกุล</strong></td>
                                    <td>'.$data['candidate01_name'].'</td>
                                    <td><strong>รหัสประจำตัวประชาชน</strong></td>
                                    <td>'.$data['candidate01_id'].'</td>
                                </tr>
                                <tr>
                                    <td><strong>อายุ</strong></td>
                                    <td>'.$data['candidate01_age'].'</td>
                                    <td><strong>ชั้นมัธยมศึกษาปีที่</strong></td>
                                    <td>'.$data['candidate01_grade'].'</td>
                                </tr>
                                <tr>
                                    <td><strong>อีเมล</strong></td>
                                    <td>'.$data['candidate01_email'].'</td>
                                    <td><strong>เบอร์โทรศัพท์</strong></td>
                                    <td>'.$data['candidate01_phone'].'</td>
                                </tr>
                            </table>';
                        
                        $content .= '                                
                        </div>
                        </body>';
                        
                        $content = mb_convert_encoding($content, 'UTF-8', 'UTF-8');
                        $mpdf->WriteHTML($content);
                        $mpdf->Output(dirname(__FILE__)."/../../public/registration/".$filename, \Mpdf\Output\Destination::FILE);

                        // Create the Transport
                        $transport = (new Swift_SmtpTransport(MAIL_HOST, 25))
                            ->setUsername(MAIL_USER)
                            ->setPassword(MAIL_PASS);

                        // Create the Mailer using your created Transport
                        $mailer = new Swift_Mailer($transport);

                        // Create a message
                        $message = (new Swift_Message('IT Openhouse 2018: ใบสมัคร'))
                            ->setFrom(['openhouse2018@edu.bstudio.click' => 'IT Openhouse 2018'])
                            ->setTo([$data['candidate01_email'] => $data['candidate01_name']])
                            ->setBody(
                                '<html>
                                    <body>
                                        <img src="'.URLROOT.'/public/assets/img/openhouse-2018-logo.svg">
                                        <h1> นี่คือใบยืนย้นการลงทะเบียน</h1>
                                    </body>
                                </html>'
                            ,'text/html')
                            ->attach(Swift_Attachment::fromPath(dirname(__FILE__)."/../../public/registration/".$filename));

                        // Send the message
                        $result = $mailer->send($message);

                        

                        flash('page_message', 'ลงทะเบียนเสร็จสิ้น');
                        redirect('pages/complete/'.$tmpt_filename);
                    } else {
                        die("Something went wrong");
                    }
                } else {
                    $this->view('pages/registration', $data);
                }
            }else{

                $data = [
                    'registrationDataModel' => $registrationDataModel,
                    'registrationType' => $registrationType, //for bebras and individual
                    'team_name' => '',
                    'school_name' => '',
                    'teacher_name' => '',
                    'teacher_email' => '',
                    'teacher_phone' => ''
                ];

                for($i=1; $i<=6; $i++){
                    $data['candidate0'.$i.'_name'] = '';
                    $data['candidate0'.$i.'_age'] = '';
                    $data['candidate0'.$i.'_id'] = '';
                    $data['candidate0'.$i.'_grade'] = '';
                    $data['candidate0'.$i.'_school'] = '';
                    $data['candidate0'.$i.'_phone'] = '';
                    $data['candidate0'.$i.'_email'] = '';
                }

                $this->view('pages/registration', $data);
            }
            
        }

        //สำหรับแข่งขัน
        public function success($filename){
            $data = [
                'title' => 'การสมัครแข่งขันเสร็จสิ้น',
                'filename' => $filename
            ];
            $this->view('pages/success', $data);
        }

        //สำหรับอย่างอื่นที่ไม่ใช่แข่งขัน
        public function complete($filename){
            $data = [
                'title' => 'การสมัครเสร็จสิ้น',
                'filename' => $filename
            ];
            $this->view('pages/complete', $data);
        }

        public function contact(){
            $data = ['title' => 'IT OPENHOUSE 2018 - Contact'];
            $this->view('pages/contact');
        }

        public function route(){
            $data = ['title' => 'IT OPENHOUSE 2018 - Route'];
            $this->view('pages/route');
        }

        public function timetable(){
            $data = ['title' => 'IT OPENHOUSE 2018 - Timetable'];
            $this->view('pages/timetable');
        }

        public function pdftest(){
            $data = ['title' => 'pdftest'];
            $this->view('pages/pdftest');
        }

        public function development(){
            $events = $this->eventModel->getEvents();
            $compets = $this->competitionModel->getCompetitions();
            $workshops = $this->workshopModel->getWorkshops();
            $rallys = $this->rallyModel->getRallys();

            $data = [
                'title' => 'IT OPENHOUSE 2018',
                'events' => $events,
                'competitions' => $compets,
                'workshops' => $workshops,
                'rallys' => $rallys
            ];
            
            
            $this->view('pages/index', $data);
        }
    }