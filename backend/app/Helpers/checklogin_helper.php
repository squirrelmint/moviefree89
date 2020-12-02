<?php

function checkLogin(){
    
    if( !isset($_SESSION['login']) || !isset($_SESSION['uname']) || !isset($_SESSION['uid'])  || $_SESSION['sid']!=session_id() ){
        
        return false;

    }else{

        return true;
        
    }
    
}