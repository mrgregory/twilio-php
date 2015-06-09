<?php

/*
 * Author:   Neuman Vong neuman@twilio.com
 * License:  http://creativecommons.org/licenses/MIT/ MIT
 * Link:     https://twilio-php.readthedocs.org/en/latest/
 */

function Services_Twilio_autoload($className)
{
    if (substr($className, 0, 15) != 'Services_Twilio'
        && substr($className, 0, 20) != 'Base_Services_Twilio'
        && substr($className, 0, 26) != 'TaskRouter_Services_Twilio'
        && substr($className, 0, 23) != 'Lookups_Services_Twilio'
        && substr($className, 0, 23) != 'Monitor_Services_Twilio'
        && substr($className, 0, 23) != 'Pricing_Services_Twilio') {
        return false;
    }
    $file = str_replace('_', '/', $className);
    if ( substr($file, -16) == '/Services/Twilio' )
    {
        $file = substr($className, 0, -16);
        if ( empty($file) ) $file = 'Main';
        $file = 'Base/'.$file;
    }
    return include dirname(__FILE__) . "/$file.php";
}

spl_autoload_register('Services_Twilio_autoload');
