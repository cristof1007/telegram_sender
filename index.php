<?php
define( 'ABSPATH', dirname(__FILE__) . '/' );
require_once(ABSPATH . 'config.php');




// verify key
function verifyData(){
    
    $chatId = $_GET['chat_id'];
    $key = $_GET['key'];
    $message = $_GET['message'];

    if(!isset($key) || !isset($chatId) || !isset($message)){
        header($_SERVER['SERVER_PROTOCOL'] . ' 400 Data is wrong!');
    }

    if($key == '' || $chatId == '' || $message == '') {
        header($_SERVER['SERVER_PROTOCOL'] . ' 400 Data is empty!');
    }

    $key = APP_KEY;
    if(APP_KEY != $key) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 401 Invalid key');
    }
}

function sendMessage() {
    $chatId = $_GET['chat_id'];
    $message = $_GET['message'];
    $apiToken = BOT_TOKEN;
    
    $data = [
        'chat_id' => $chatId,
        'text' => $message
    ];

    try {
        $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" .
        http_build_query($data) );
    } catch (\Throwable $th) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 400');
        
    }
}

verifyData();
sendMessage();
//   $apiToken = "";
//   $data = [
//       'chat_id' => '684268624',
//       'text' => 'Hello from PHP!'
//   ];
//   $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" .
//                                  http_build_query($data) );

?>