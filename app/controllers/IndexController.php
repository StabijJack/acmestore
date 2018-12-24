<?php

namespace App\Controllers;
use App\Classes\Mail;

class IndexController extends BaseController
{
    public function show()
    {
        echo "Inside HomePage from  Controller class";

        // $mail = new Mail;
        // $data = [
        //     'to' => 'jj.schneider@live.nl',
        //     'subject' => 'test mail',
        //     'view' => 'welcome.php',
        //     'name' => 'jacky',
        //     'body' => 'testing'
        // ];
        // if($mail->send($data)){
        //     echo "Email send succesfully";
        // }
        // else{
        //     echo "Email send FAIL";
        // }

        
        

    }
}