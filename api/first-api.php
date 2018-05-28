<?php

require_once dirname(dirname(__FILE__)) . '/rules/constants.php';
list($usec, $sec) = explode(" ", microtime());
$startTime = ((float) $usec + (float) $sec);

if ($_GET['section'] == "1") {
    $response['RS'] = 200;
    $array['1'] = 'We must respect the will of the individual.';
    $array['2'] = 'Take it easy. I can assure you that everything will turn out fine.';
    $response['data'] = $array;
} elseif ($_GET['section'] == "2") {
    $response['RS'] = 200;
    $array['1'] = 'Bob was so beside himeself that he could scarecely tell fact from fiction.';
    $array['2'] = 'His new novel, which combines prose with his gift for poetry, is going to be published.';
    $response['data'] = $array;
} elseif ($_GET['section'] == "3") {
    $response['RS'] = 200;
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
    
    echo dirname(dirname(__FILE__)) . '/rules/constants.php';
    
    echo $_SERVER['DOCUMENT_ROOT'] . "<br>";
    echo ROOT_PATH . "<br>";
    $logFolderPath = ROOT_PATH . "/var/log";
    $detailLogFileName = $logFolderPath . "/". DETAIL_LOG_File;
    $logFileName = $logFolderPath ."/". SHORT_LOG_FILE;
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    echo $logFileName;

    $url = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $strlog = gmdate("Y-m-d H:i:s") . ': ' . $name . ' Source: '. $ipAddress . ' Request URL: ' . $url;

    // write to log file
    file_put_contents($logFileName, $strlog."\n", FILE_APPEND);
    file_put_contents($detailLogFileName, $strlog."\n", FILE_APPEND);

    
    $duration = getMicrotimeFloat() - $startTime;

    $strlog = gmdate("Y-m-d H:i:s"). ': ' . $name;

    file_put_contents($logFileName, $strlog.' Source: '.$ipAddress.' DURATION: ' . $duration."\n", FILE_APPEND);

    if (is_array($response_body)) {
        $response_body = json_encode($response_body);
    }

    file_put_contents($detailLogFileName, $strlog." DURATION: $duration"." Response: ".$response_body."\n", FILE_APPEND);

    
}