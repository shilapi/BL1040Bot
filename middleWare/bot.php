<?php

global $Message, $User_id, $Queue, $CQ, $Event;

if(/*preg_match('/机器人/', $Message) || */ parseQQ($Message) == config('bot')){
    if(config('master') == $User_id || config('devgroup') == $Event['group_id'])leave();
    $message=$User_id." in Group ".$Event['group_id']." says ".$Message;
    $Queue[]= sendMaster($message, true);
    $Queue[]= sendDevGroup($message, true);
/* }
if(parseQQ($Message) == config('bot')){ */
    if($Event['user_id'] == "80000000")leave("请不要使用匿名！");
    if(!isAdmin())
    	$Queue[]= sendBack('⑧要艾特/回复，有几率被拉黑，发送 '.config('prefix').'help 查看帮助列表。');
}

?>
