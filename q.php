<?php

include './vendor/autoload.php';
$url_tpl = "http://www.juzimi.com/article/秦时明月?page=%d" ;

$i = range(0,51);

foreach($i as $page){
	$url = sprintf($url_tpl,$page);
	echo $url . "\n";
	$content = curl_get($url);
	//doContent($content);
}

function curl_get($url){
	$ch = curl_init($url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$content = curl_exec($ch);
	return $content;
}


function doContent($content){
	$pq = phpQuery::newDocument($content);
}
