<?php
    /*
     * Base Controller
     * Loads the models and views
     */

     class Controller {
         //Load model
         public function model($model){
             require_once '../app/models/'.$model.'.php';
             return new $model();
         }

         //Load view
         public function view($view, $data = []){
             //Check view file
             if(file_exists('../app/views/'.$view.'.php')){
                 require_once '../app/views/'.$view.'.php';
             } else {
                 die('หน้าเว็บกำลังอยู่ระหว่างการปรับปรุง ขออภัยในความไม่สะดวก');
             }
         }
     }