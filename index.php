<?php

 $to_crawl="https://www.codecademy.com";
 function get_links($url)
 {
 	$input=@file_get_contents($url);
 	$regexp="<a\s[^>]*href=(\"??)([^\">]*?)\\1[^>]*>(.*)<\/a>";
 	preg_match_all("/$regexp/siU", $input, $matches);
 	$base_url=parse_url($url,PHP_URL_HOST);
 	$l=$matches[2];
 	foreach ($l as $link) 
 	{
 		if(strpos($link, "#"))
 		{
 			$link=substr($link,0,strpos($link,"#"));
 		}
 		if(substr($link, 0)==".")
 		{
 			$link=substr($link,1);
 		}
 		if(substr($link,0,7)=="http://")
 		{
 			$link=$link;
 		}
 		else if (substr($link,0,8)=="https://") {
 			$link=$link;
 		}
 		else if(substr($link,0,2)=="//")
 		{
 			$link=substr($link, 2);
 		}
 		else if(substr($link,0,2)=="#")
 		{
 			$link=$url;
 		}
 		else
 		{
 			if(substr($link,0,1)!="/")
 			{
 				$link=$base_url."/".$link;
 			}
 			else
 			{
 				$link=$base_url.$link;
 			}
 		}
 		if(substr($link,0,7)!="http://"&&substr($link,0,8)!="https://")
 		{
 			if(substr($url,0,7)=="http://")
 				$link="http://".$link;
 			else
 				$link="https://".$link;
 		}			
 		echo $link."<br/>";
 	}
 }
 get_links($to_crawl);
?>