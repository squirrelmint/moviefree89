<?php

function setAlert($type, $message){

    $arr_type = array(
        "success" => array("color"=>"#66BB6A", "label"=>"Success"),
        "error" => array("color"=>"#EF5350", "label"=>"Oops.."),
        "warning" => array("color"=>"#FF7043", "label"=>"warning"),
        "info" => array("color"=>"#2196F3", "label"=>"Info")
    );

    $session = \Config\Services::session();

    $title = $arr_type[$type]["label"];
    $color = $arr_type[$type]["color"];

    $html = "";
    $html .= 'swal({';
        $html .= 'title: "'.$message.'",';
        $html .= 'text: "You clicked the button!",';
        $html .= 'confirmButtonColor: "'.$color.'",';
        $html .= ' type: "'.$type.'"';
    $html .= '});';
    
    $session->setFlashdata('alert', $html );
    
}

function getAlert(){

    if(isset($_SESSION['alert'])){

        echo $_SESSION['alert'];

    }

}