<?php

function validate($text)
{
    $antiChar = array('-',';',"'",'"','\\','*','<','>');
    foreach($antiChar as $char)
    {
        $pos = strpos($text, $char);
        if ($pos !== false) {
            return 0;
        }
    }
    return 1;
}