<?php

require_once dirname(dirname(__FILE__)) . '/rules/constants.php';
list($usec, $sec) = explode(" ", microtime());
$startTime = ((float) $usec + (float) $sec);

if ($_GET['section'] == "1") {
    $response['RC'] = 200;
    $array['1'] = 'We must respect the will of the individual.';
    $array['2'] = 'Take it easy. I can assure you that everything will turn out fine.';
    $response['data'] = $array;
} elseif ($_GET['section'] == "2") {
    $response['RC'] = 200;
    $array['1'] = 'Bob was so beside himeself that he could scarecely tell fact from fiction.';
    $array['2'] = 'His new novel, which combines prose with his gift for poetry, is going to be published.';
    $response['data'] = $array;
} elseif ($_GET['section'] == "3") {
    $response['RC'] = 200;
    $array['1'] = 'I begged Richie to lend m a hundred buck, but he shook his head, saying, I am broke, too.';
    $array['2'] = 'I am apt to buy things on impulse whenever something is on sale. So am I.';
    $response['data'] = $array;
} else {
    $response['RS'] = 404;
    $response['data'] = "It is not ready yet! :p";
}

$response_body = JSON_encode($response);
echo $response_body;

if ($_GET['test'] == true) {

    $logFolderPath = ROOT_PATH . "/var/log";
    $detailLogFile = $logFolderPath . "/" . DETAIL_LOG_FILE;
    $logFile = $logFolderPath . "/" . SHORT_LOG_FILE;
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $name = "[first-api]";

    $url = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $strlog = gmdate("Y-m-d H:i:s") . ': ' . $name . ' Source: '. $ipAddress . ' Request URL: ' . $url;
    
    // write to log file
    file_put_contents($logFile, $strlog."\n", FILE_APPEND);
    file_put_contents($detailLogFile, $strlog."\n", FILE_APPEND);
    
    list($usec, $sec) = explode(" ", microtime());
    $currenttTime = ((float) $usec + (float) $sec);
    $duration = $currenttTime - $startTime;
    $strlog = gmdate("Y-m-d H:i:s"). ': ' . $name;

    file_put_contents($logFile, $strlog. ' Source: ' . $ipAddress . ' DURATION: ' . $duration . "\n", FILE_APPEND);
    if (is_array($response_body)) {
        $response_body = json_encode($response_body);
    }
    file_put_contents($detailLogFile, $strlog . " DURATION: $duration" . " Response: " . $response_body . "\n", FILE_APPEND);

}