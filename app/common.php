<?php

if (! function_exists('imagePath')) {
    function imagePath($path) {

        return url('/').$path;
    }
}


if (! function_exists('langUrl')) {
    function langUrl($name) {
        return route($name, app()->getLocale());
    }
}

if (! function_exists('paymentStatus')) {
    function paymentStatus($status=null) {
        $options = '';

        $payments = array('Pending','Paid','Partial');

        foreach($payments as $payment){
            $select='';
            if($payment == $status)
            $select = 'selected';
        $options .='<option value="'.$payment.'" '.$select.' >'.$payment.'</option>';
        }

        return $options;
    }
}

if (! function_exists('paymentMethods')) {
    function paymentMethods($method=null) {
        $options = '';

        $payment_methods = array('Cash','Bank Transfer','Mobile Account','Other');
        foreach($payment_methods as $payment_method){
            $select='';
            if($payment_method == $method)
            $select = 'selected';
        $options .='<option value="'.$payment_method.'" '.$select.'>'.$payment_method.'</option>';
        }

        return $options;
    }
}

if (! function_exists('changeDateFormat')) {
    function changeDateFormat($date,$format) {
        return date($format, strtotime($date));
    }
}


/**
 * Shortcut for accessing the config theme.
 *
 * @param  string  $file
 * @return string
 */
function theme($file = null)
{


    // Laravel perfers dot notation for view file names, especially in test
    $dot_file = str_replace('/', '.', $file);
    $dot_file = preg_replace('/^\./', '', $dot_file);

    // To check the file's existance, we need '/' in files however
    $file_name = str_replace('.', '/', $file);
    $file_name = preg_replace('/^\//', '', $file_name);

    $theme_file = resource_path('views/' .
        "/{$file_name}.blade.php"
    );

    return file_exists($theme_file) ?"$dot_file":"$dot_file";
}



?>
