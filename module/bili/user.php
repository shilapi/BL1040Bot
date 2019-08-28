<?php

	global $Queue, $Event;
	$api = "https://api.kaaass.net/biliapi/user/space?id=";

	$uid = nextArg();
	if(parseQQ($uid))$uid = getData("bili/user/".parseQQ($uid));
	if(!$uid)$uid = getData("bili/user/".$Event['user_id']);
	if($uid == "")leave("请提供uid！如需绑定请使用 #bili.bind ！");
	else if(intval($uid) === NULL)leave('请提供纯数字uid！');
	if(!($data = json_decode(file_get_contents($api.$uid),ture)['data']))leave('查询失败！');

	$attention = $data['card']['attention'];
	$fans = $data['card']['fans'];
	$name = $data['card']['name'];
	$sign = $data['card']['sign'];
	$face = $data['card']['face'];
	$level = $data['card']['level_info']['current_level'];
	$official = $data['card']['official_verify']['title'];
	$sex = $data['card']['sex'];
	$official = $official?"官方认证：".$official:"暂未进行个人认证";
	$sumplay = 0;
	$sumseconds = 0;

	$videoApi = "https://api.kaaass.net/biliapi/user/contribute?pageCount=150&id=".$uid."&page=";
	$n = 0;
	do{
		$videos = json_decode(file_get_contents($videoApi.$n), true)['data'];
		foreach($videos as $video){
			$sumplay += $video['play'];
			$sumseconds += $video['duration'];
		}
		$n += 1;
	}while(count($videos));

	$sumtime = $sumseconds?"看完".($sex == "女"?"她":"他")."的全部视频需要".intval($sumseconds / 86400)."天".intval($sumseconds % 86400 / 3600)."小时".intval($sumseconds % 3600 / 60)."分钟".($sumseconds % 60)."秒":($sex == "女"?"她":"他")."还没有发过视频嗷";

	$msg = <<<EOT
Bilibili 用户 uid{$uid} 的数据：
[CQ:image,file={$face}]
{$name}
{$sign}
{$official}
{$sumtime}

{$level}级/{$attention}关注/{$fans}粉丝/{$sumplay}播放
EOT;
	$Queue[]= sendBack($msg);

?>
