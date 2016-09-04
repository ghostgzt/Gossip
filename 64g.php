<?php
//asc转为二进制
function asc2bin($temp) {
        $len = strlen($temp);
		$data="";
        for($i=0; $i<$len; $i++) {
                $data .= sprintf("%08b", ord(substr($temp, $i, 1)));
        }
        return $data;
}
//die(asc2bin("人"));
//二进制转asc
function bin2asc($temp) {
        $len = strlen($temp);
		$data="";
        for($i=0; $i<($len/8); $i++) {
                $data .= chr(intval(substr($temp, $i * 8, 8), 2));
        }
        return $data;
}

$zhbstr=file_get_contents("64g.txt");
$zhbarr=explode("\r\n",$zhbstr);
$zhb=array();
foreach($zhbarr as $key){
	list($a,$b)=explode(":",$key);
	$zhb[$a]=$b;
}
//die(var_export(array_flip($zhb)));



$szb=array("2"=>"二","3"=>"三","4"=>"四","5"=>"五","6"=>"六","7"=>"七","8"=>"八","9"=>"九","10"=>"十");

function z_64g($str){
	global $zhb,$szb;
	$bin=asc2bin($str);
	//$result=strtr($bin,array_flip($zhb));
	$rs="";
	$rns=0;
	for($i=0;$i<strlen($bin);$i=$i+6){
		$nowstr=substr($bin,$i,6);
		//die($nowstr);
		$nns=strtr($nowstr,array_flip($zhb));
		if(strlen($nns)==4){
			$rs.="，".$nns."。";
			$rns=0;
		}else{
			if($rns==3){
				$rs.=$nns."，";
				$rns=0;
			}else{
				$rs.=$nns;
				$rns++;	
			}
		}
	
		
		
		
	}
	$rs=strtr($rs,array("。，"=>"，","，，"=>"，","。"=>"。\n"));
	return $rs;
}
function de_64g($str){
	global $zhb,$szb;
	$dszb=array_flip($szb);
	$rs=strtr($str,array("，"=>"","。"=>"","\n"=>""));


	$rs=bin2asc(strtr($rs,$zhb));
	return $rs;
}

echo (z_64g('名称出处：LADY-077 水野美香 桐原あずさ 水菜 丽水菜丽(1987年5月20- )，出生于日本东京都，现为AV女优，有“暗黑郭采洁”之称。水菜丽是ALICE JAPAN既希志爱野以及七海奈奈之后，2008年推出的新人。种子链接: http://pan.baidu.com/s/1c0BZ7zy 密码: 4q7t'));