<?php
$token = json_decode(file_get_contents('admin.json'),true)['info']['token'];
$id = json_decode(file_get_contents('admin.json'),true)['info']['id'];
include 'index.php';
$admin = json_decode(file_get_contents('admin.json'),true);
$checked = 0;
$hit = 0;
$bad = 0;
$error = 0;
$edit = bot('sendMessage',[
'chat_id'=>$id,
'text'=>"
- Done Started The Bot .
- Now Please Wait Until You Get results .
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- Tries : $checked .",'callback_data'=>'i']],
[['text'=>"- Swapped : $hit .",'callback_data'=>'i1']],
[['text'=>"- Didn't Swap : $bad .",'callback_data'=>'i2']],
[['text'=>"- Error : $error .",'callback_data'=>'i4']],
]
])
]);
while(true){
$idd = file_get_contents("id.txt");
$swap = swap($idd);
if($swap == 'true'){
$hit += 1;
$checked += 1;
bot('editMessageReplyMarkup',[
'chat_id'=>$id,
'message_id'=>$edit->result->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- Tries : $checked .",'callback_data'=>'i']],
[['text'=>"- Swapped : $hit .",'callback_data'=>'i1']],
[['text'=>"- Didn't Swap : $bad .",'callback_data'=>'i2']],
[['text'=>"- Error : $error .",'callback_data'=>'i4']],
]
])
]);
}elseif($swap == 'false'){
$bad += 1;
$checked += 1;
bot('editMessageReplyMarkup',[
'chat_id'=>$id,
'message_id'=>$edit->result->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- Tries : $checked .",'callback_data'=>'i']],
[['text'=>"- Swapped : $hit .",'callback_data'=>'i1']],
[['text'=>"- Didn't Swap : $bad .",'callback_data'=>'i2']],
[['text'=>"- Error : $error .",'callback_data'=>'i4']],
]
])
]);
} else {
$error += 1;
$checked += 1;
bot('editMessageReplyMarkup',[
'chat_id'=>$id,
'message_id'=>$edit->result->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- Tries : $checked .",'callback_data'=>'i']],
[['text'=>"- Swapped : $hit .",'callback_data'=>'i1']],
[['text'=>"- Didn't Swap : $bad .",'callback_data'=>'i2']],
[['text'=>"- Error : $error .",'callback_data'=>'i4']],
]
])
]);
}
}
?>
