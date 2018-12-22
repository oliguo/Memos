<?php
define('ABS_PATH', '/');
ini_set('log_errors', true);
ini_set('error_log', ABS_PATH.'/storage/logs/errors.log');
$log_data=['file'=>dirname(__FILE__).'/'.basename(__FILE__, '.php').'.php','date'=>date('Y-m-d H:i:s')];
$req_dump = print_r(array_merge(getallheaders(),$_REQUEST,$log_data), true);
$fp=__loging_open('logs.log', 5);
fwrite($fp, $req_dump);



fclose($fp);


function __loging_open($log_file, $log_size = 1) {
    $__log_file = ABS_PATH . '/storage/logs/' . $log_file;
    $__log_dest = ABS_PATH . '/storage/logs/' . $log_file . '_' . date_with_micro('Ymd-Hisu') . '.log';
    $__log_size = 0;
    $fp;
    if (file_exists($__log_file)) {
        $__log_size = round(filesize($__log_file) / 1024 / 1024, 2); //MB
        if ($__log_size >= $log_size) {
            if (copy($__log_file, $__log_dest)) {
                $fp = fopen($__log_file, 'w'); //override the file
            } else {
                $fp = fopen($__log_file, 'a');
            }
        } else {
            $fp = fopen($__log_file, 'a');
        }
    } else {
        $fp = fopen($__log_file, 'a');
    }
    return $fp;
}
