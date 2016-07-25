<?php

function real_test($idnum,$name){

	error_reporting(E_ALL);
	ini_set('display_errors','On');

	include './vendor/autoload.php';

	//$idnum = '130123198706234534';
	//$name = '祁星月';
	$url = 'http://www.runchina.org.cn/portal.php?mod=score&ac=personal';

	$headstr = "-H 'Pragma: no-cache' -H 'Origin: http://www.runchina.org.cn' -H 'Accept-Encoding: gzip, deflate' -H 'Accept-Language: zh-CN,zh;q=0.8,en;q=0.6,zh-TW;q=0.4,ja;q=0.2' -H 'Upgrade-Insecure-Requests: 1' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36' -H 'Content-Type: application/x-www-form-urlencoded' -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8' -H 'Cache-Control: no-cache' -H 'Referer: http://www.runchina.org.cn/portal.php?mod=score&ac=personal' -H 'Cookie: SMHa_2132_saltkey=tQi19Tmq; SMHa_2132_lastvisit=1468828350; SMHa_2132_sid=l9z09Q; SMHa_2132_lastact=1468832009%09portal.php%09score; Hm_lvt_b0a502205e02e6127ae831a751ff05b3=1468831949; Hm_lpvt_b0a502205e02e6127ae831a751ff05b3=1468832009' -H 'Connection: keep-alive'";

	$data = array(
		'idnum' => $idnum,
		'name' => $name
	);

	$reg = '/\'([A-Za-z]+)\:\s?([^\']+)\'/';
	preg_match_all($reg,$headstr,$matches);
	$keys = $matches[1];
	$values = $matches[2];
	$headers = array_combine($keys,$values);

	$ch = curl_init($url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$content = curl_exec($ch);

	$pq = phpQuery::newDocument($content);
	$real_items = array();
	$results = $pq->find("table tr:gt(0)");
	foreach($results as $result){
		$x = $result->nodeValue ; 
		$v = explode("\n",$x);
		$real_items[] = array(
			$v[0]	, trim($v[2]),trim($v[5]),trim($v[6])
		);
	}

	echo json_encode($real_items);
}

//real_test('130123198706234534','祁星月');
