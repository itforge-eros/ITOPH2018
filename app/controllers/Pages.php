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
            //$this->view('pages/underconstruction.php');
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
                    $mailText = "เข้าร่วมกิจกรรม Workshop";
                    $registrationDataModel = $this->workshopModel->getWorkshopBySlug($slug);
                    break;

                case 'bebras':
                    $registrationType = "bebras";
                    $pdfH2Text = "สมัครเข้าทดสอบการแข่งขันทักษะการคิดทางคอมพิวเตอร์ระดับชาติประจำปี 2018 (BEBRAS)";
                    $mailText = "เข้าทดสอบการแข่งขันทักษะการคิดทางคอมพิวเตอร์ระดับชาติประจำปี 2018 (BEBRAS)";
                    $registrationDataModel = null;
                    break;

                case 'individual':
                    $registrationType = "individual";
                    $pdfH2Text = "ใบสมัครเข้าชมงาน IT Ladkrabang Openhouse 2018";
                    $mailText = "เข้าชมงาน IT Ladkrabang Openhouse 2018";
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
                if($slug != 'game'){if(empty($data['school_name'])){$data['school_name_err'] = 'กรุณากรอกชื่อโรงเรียน';}}
                

                //Candidate01 is always required.
                for($i=1; $i<=6; $i++):
                    if(empty($data['candidate0'.$i.'_name'])){$data['candidate0'.$i.'_name_err'] = 'กรุณากรอกชื่อ-สกุลสมาชิกคนที่ '.$i;}
                    else if (!strpos($data['candidate0'.$i.'_name'], ' ')){$data['candidate0'.$i.'_name_err'] = 'กรุณากรอกทั้งชื่อและนามสกุล';}
                    if(empty($data['candidate0'.$i.'_id'])){$data['candidate0'.$i.'_id_err'] = 'กรุณาหมายเลขบัตรประชาชนสมาชิกคนที่ '.$i;}
                    if(strlen($data['candidate0'.$i.'_id']) != 13) {
                        $data['candidate0'.$i.'_id_err'] = 'หมายเลขบัตรประชาชนไม่ถูกต้อง';
                    }

                    if(empty($data['candidate0'.$i.'_age'])){$data['candidate0'.$i.'_age_err'] = 'กรุณากรอกอายุสมาชิกคนที่ '.$i;}
                    else if($data['candidate0'.$i.'_age'] < 10 || $data['candidate0'.$i.'_age'] > 30){$data['candidate0'.$i.'_age_err'] = 'อายุสมาชิกคนที่ '.$i. ' ไม่ถูกต้อง';}

                    if($slug == 'game'){if(empty($data['candidate0'.$i.'_school'])){$data['candidate0'.$i.'_school_err'] = 'กรุณากรอกชื่อโรงเรียน';}}
            
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
                    if($slug == 'game'){$error_array[] = 'candidate0'.$i.'_school_err';}
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

                            $s3 = new Aws\S3\S3Client([
                                'version' => 'latest',
                                'region'  => 'us-east-1',
                                'endpoint' => 'https://s3.itforge.io',
                                'use_path_style_endpoint' => true,
                                'credentials' => [
                                        'key'    => 'X3GA2MY4MIOYGCPG5FLX',
                                        'secret' => 'TZ3ozryPNTypUu5EBzXPwulNx4kmvz5MtoAhJCsU',
                                    ],
                            ]);

                            //PDF HERE
                            $mpdf = new \Mpdf\Mpdf();

                            $content = '
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                <style>
                                    body, .container, h1, h2, h3, p {font-family: "Garuda";}
                                    h1, h2{font-weight: bold; margin-top: 0.75em; margin-bottom: 0.25em;}
                                    h2 {text-align: center;}
                                    h3 {text-align: left; font-weight: bold; margin-top: 1em; margin-bottom: -0.25em;}
                                    p {font-weight: normal; font-size: 14pt;}
                                    strong {font-weight: bold; font-size: 14pt;}
                                    td {padding: 4px 10px;}
                                    .img-wrapper {width: 100%; text-align: center;}
                                    img {width: 360px;}
                                    .right {width: 50%; float: right; text-align: center;}
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
                                    </tr>';
                            if($slug != 'game'){
                                $content .= '<tr>
                                    <td><strong>สถานศึกษา</strong></td>
                                    <td>'.$data['school_name'].'</td>
                                    <td></td>
                                    <td></td>
                                </tr>';
                            }
                            $content .= '</table>';
                                for($i=1; $i<=6 ;$i++):
                                    if(empty($data['candidate0'.$i.'_name'])){break;}
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
                                    <p>วันที่........เดือน................พ.ศ......</p>
                                </div>                             
                            </div>
                            </body>';
                            
                            $content = mb_convert_encoding($content, 'UTF-8', 'UTF-8');
                            $mpdf->WriteHTML($content);
                            $pdfdata = $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);

                            // Send a PutObject request and get the result object.
                            $insert = $s3->putObject([
                                'Bucket' => 'itopenhouse2018',
                                'Key'    => $filename,
                                'Body' => $pdfdata,
                                'ACL'        => 'private',
                            ]);
                            
                            
                            // Download the contents of the object.
                            // $retrive = $s3->getObject([
                            //     'Bucket' => 'itopenhouse2018',
                            //     'Key'    => $tmpt_filename,
                            //     'SaveAs' => fopen($filename, 'r')
                            // ]);

                            // Create the Transport
                            $transport = (new Swift_SmtpTransport(MAIL_HOST, 465, 'ssl'))
                                ->setUsername(MAIL_USER)
                                ->setPassword(MAIL_PASS);

                            // Create the Mailer using your created Transport
                            $mailer = new Swift_Mailer($transport);
                            $attachment = new Swift_Attachment($pdfdata, $filename, 'application/pdf');

                            // Create a message
                            $message = (new Swift_Message('WELCOME TO IT KMITL OPENHOUSE 2018. ยินดีต้อนรับเข้าสู่งาน “เปิดบ้านไอทีลาดกระบัง2018”'))
                                ->setFrom([MAIL_SENDER => MAIL_SENDER_NAME])
                                ->setTo([$data['teacher_email'] => $data['teacher_name']])
                                ->setBody(
                                    '<html>
                                        <body>
                                            <img src="'.URLROOT.'/public/assets/img/openhouse-2018-logo.svg">
                                            <h1>ยินดีต้อนรับเข้าสู่งาน “เปิดบ้านไอทีลาดกระบัง”</h1>
                                            <p> สวัสดีครับ '.$data['teacher_name'].'</p>
                                            <p> ขอบคุณที่นำนักเรียนในความปกครองของท่านมาร่วมเป็นส่วนหนึ่งในงาน IT Openhouse 2018 ทีมของคุณได้ลงทะเบียนในรายการ ' . $registrationDataModel->title . ' </p>
                                            <p> เราจะประผลการลงทะเบียน ในวันที่ 15 สิงหาคม พ.ศ. 2561 ติดตามผลการลงทะเบียนได้ที่ https://openhouse.it.kmitl.ac.th/</p>
                                        </body>
                                    </html>'
                                ,'text/html')
                                ->attach($attachment);

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
                }

                if(empty($data['candidate01_age'])){$data['candidate01_age_err'] = 'กรุณากรอกอายุ';}
                else if($data['candidate01_age'] < 10 || $data['candidate01_age'] > 30){$data['candidate01_age_err'] = 'อายุไม่ถูกต้อง';}

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

                        $s3 = new Aws\S3\S3Client([
                            'version' => 'latest',
                            'region'  => 'us-east-1',
                            'endpoint' => 'https://s3.itforge.io',
                            'use_path_style_endpoint' => true,
                            'credentials' => [
                                    'key'    => 'X3GA2MY4MIOYGCPG5FLX',
                                    'secret' => 'TZ3ozryPNTypUu5EBzXPwulNx4kmvz5MtoAhJCsU',
                                ],
                        ]);

                        //PDF HERE
                        $mpdf = new \Mpdf\Mpdf();

                        $content = '
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <style>
                                body, .container, h1, h2, h3, p {font-family: "Garuda";}
                                h1, h2{font-weight: bold; margin-top: 0.75em; margin-bottom: 0.25em;}
                                h2 {text-align: center;}
                                h3 {text-align: left; font-weight: bold; margin-top: 1em; margin-bottom: -0.25em;}
                                p {font-weight: normal; font-size: 16pt;}
                                td {padding: 4px 10px;}
                                strong {font-weight: bold; font-size: 14pt;}
                                .img-wrapper {width: 100%; text-align: center;}
                                img {width: 360px;}
                                .right {width: 50%; float: right; text-align: center;}
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
                        $pdfdata = $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);

                        // Send a PutObject request and get the result object.
                        $insert = $s3->putObject([
                            'Bucket' => 'itopenhouse2018',
                            'Key'    => $filename,
                            'Body' => $pdfdata,
                            'ACL'        => 'private',
                        ]);
                        
                        
                        // Download the contents of the object.
                        // $retrive = $s3->getObject([
                        //     'Bucket' => 'itopenhouse2018',
                        //     'Key'    => $tmpt_filename,
                        //     'SaveAs' => fopen($filename, 'r')
                        // ]);

                        // Create the Transport
                        $transport = (new Swift_SmtpTransport(MAIL_HOST, 465, 'ssl'))
                            ->setUsername(MAIL_USER)
                            ->setPassword(MAIL_PASS);

                        // Create the Mailer using your created Transport
                        $mailer = new Swift_Mailer($transport);
                        $attachment = new Swift_Attachment($pdfdata, $filename, 'application/pdf');
                        
                        // Create a message
                        $message = (new Swift_Message('WELCOME TO IT KMITL OPENHOUSE 2018. ยินดีต้อนรับเข้าสู่งาน “เปิดบ้านไอทีลาดกระบัง2018”'))
                            ->setFrom([MAIL_SENDER => MAIL_SENDER_NAME])
                            ->setTo([$data['candidate01_email'] => $data['candidate01_name']])
                            ->setBody(
                                '<html>
                                    <body>
                                        <img src="'.URLROOT.'/public/assets/img/openhouse-2018-logo.svg">
                                        <h1> ยินดีต้อนรับเข้าสู่งาน “เปิดบ้านไอทีลาดกระบัง” </h1>
                                        <p> สวัสดีครับ '.$data['candidate01_name'].'</p>
                                        <p> ขอบคุณที่ร่วมเป็นส่วนหนึ่งในงาน IT Openhouse 2018 คุณได้ลงทะเบียน'.$mailText.'</p>
                                    </body>
                                </html>'
                            ,'text/html')
                            ->attach($attachment);

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
                    $data['candidate0'.$i.'_name_err'] = '';
                    $data['candidate0'.$i.'_age_err'] = '';
                    $data['candidate0'.$i.'_id_err'] = '';
                    $data['candidate0'.$i.'_grade_err'] = '';
                    $data['candidate0'.$i.'_school_err'] = '';
                    $data['candidate0'.$i.'_phone_err'] = '';
                    $data['candidate0'.$i.'_email_err'] = '';
                }

                $this->view('pages/registration', $data);
            }
            
        }

        //สำหรับแข่งขัน
        public function success($filename){

            $s3 = new Aws\S3\S3Client([
                'version' => 'latest',
                'region'  => 'us-east-1',
                'endpoint' => 'https://s3.itforge.io',
                'use_path_style_endpoint' => true,
                'credentials' => [
                        'key'    => 'X3GA2MY4MIOYGCPG5FLX',
                        'secret' => 'TZ3ozryPNTypUu5EBzXPwulNx4kmvz5MtoAhJCsU',
                    ],
            ]);

            // Get a command object from the client
            $command = $s3->getCommand('GetObject', [
                'Bucket' => 'itopenhouse2018',
                'Key'    => $filename.'.pdf'
            ]);

            // Create a pre-signed URL for a request with duration of 10 miniutes
            $presignedRequest = $s3->createPresignedRequest($command, '+10 minutes');
            // Get the actual presigned-url
            $presignedUrl =  (string)  $presignedRequest->getUri();
            
            $data = [
                'title' => 'การสมัครแข่งขันเสร็จสิ้น',
                'filename' => $filename,
                'url' => $presignedUrl
            ];
            $this->view('pages/success', $data);
        }

        //สำหรับอย่างอื่นที่ไม่ใช่แข่งขัน
        public function complete($filename){

            $s3 = new Aws\S3\S3Client([
                'version' => 'latest',
                'region'  => 'us-east-1',
                'endpoint' => 'https://s3.itforge.io',
                'use_path_style_endpoint' => true,
                'credentials' => [
                        'key'    => 'X3GA2MY4MIOYGCPG5FLX',
                        'secret' => 'TZ3ozryPNTypUu5EBzXPwulNx4kmvz5MtoAhJCsU',
                    ],
            ]);

            // Get a command object from the client
            $command = $s3->getCommand('GetObject', [
                'Bucket' => 'itopenhouse2018',
                'Key'    => $filename.'.pdf'
            ]);

            // Create a pre-signed URL for a request with duration of 10 miniutes
            $presignedRequest = $s3->createPresignedRequest($command, '+10 minutes');
            // Get the actual presigned-url
            $presignedUrl =  (string)  $presignedRequest->getUri();

            $data = [
                'title' => 'การสมัครเสร็จสิ้น',
                'filename' => $filename,
                'url' => $presignedUrl
            ];
            $this->view('pages/complete', $data);
        }

        public function timetable(){
            $data = ['title' => 'IT OPENHOUSE 2018 - Timetable'];
            $this->view('pages/timetable');
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