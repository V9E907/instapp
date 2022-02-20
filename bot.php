<?php
error_reporting(0);
if(!file_exists('admin.json')){
$token = readline('5103519034:AAFWkrJxzmLm7_IYgyiE2PmZLuqlhPEm2J8');
$id = readline('5089517588');
$save['info'] = [
'token'=>$token,
'id'=>$id
];
file_put_contents('admin.json',json_encode($save),64|128|256);
}
function save($array){
file_put_contents('admin.json',json_encode($array),64|128|256);
}
$token = json_decode(file_get_contents('admin.json'),true)['info']['token'];
$id = json_decode(file_get_contents('admin.json'),true)['info']['id'];
include 'index.php';
if($id == ""){
echo "Error Id";
}
try {
 $callback = function ($update, $bot) {
  global $id;
  if($update != null){
   if(isset($update->message)){
    $message = $update->message;
    $chat_id = $message->chat->id;   
    $name = $message->from->first_name;
    $message_id = $message->message_id;
    $text = $message->text;
$admin = json_decode(file_get_contents('admin.json'),true);
if($text == '/start'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*
- Hello And Welcome ( ????? ?????? ????? ??) .
- Into Your Insta Up Coin Miner .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Start .','callback_data'=>'start']],[['text'=>'- Stop .','callback_data'=>'stop']],
[['text'=>'- Dev .','url'=>'t.me/V_9_E']],
]
])
]);
}
$mode = file_get_contents("mode.txt");
if($text !='/start' && $mode == 'id'){
file_put_contents("id.txt","$text");
system("rm mode.txt ; screen -dmS swap'.$chat_id.' php swap.php");
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
}
}
if(isset($update->callback_query)) {
    $chat_id1 = $update->callback_query->message->chat->id;
    $mid = $update->callback_query->message->message_id;
    $data = $update->callback_query->data;
    $message = $update->message;
    $chat_id = $message->chat->id;
    $text = $message->text;
    $name = $message->from->first_name;
if($data == 'start'){
file_put_contents("mode.txt","id");
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Now Please Send Me Your Id .
- ( Of Your InstaUp Account ) .
*",
'parse_mode'=>'markdown',
]);
}
if($data == 'stop'){
system("screen -S swap'.$chat_id1.' -X kill");
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Done Stopped Your Bot .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Go Bacj .','callback_data'=>'back']],
]
])
]);
}
}
      }
    };
         $bot = new EzTG(array('throw_telegram_errors'=>true,'token' => $token, 'callback' => $callback));
  }
    catch(Exception $e){
 echo $e->getMessage().PHP_EOL;
 sleep(1);
}
