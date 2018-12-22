<?php
$log = dirname(__FILE__) . '/log_.txt';
$lock = dirname(__FILE__) . '/lock_';
$log_file = fopen($log, 'a') or die('Cannot create log file');
$lock_file = fopen($lock, 'w') or die('Cannot create lock file');
if (flock($lock_file, LOCK_EX | LOCK_NB)) {
    //echo "is not locked,go to run";
    fwrite($log_file, date('Y-m-d H:i:s').":exec now"."\n");
    
} else {
    //echo "is locked,skip";
    fwrite($log_file, date('Y-m-d H:i:s').":is locked,skip"."\n");
}
fclose($log_file);
exit;
