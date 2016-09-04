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
//二进制转asc
function bin2asc($temp) {
        $len = strlen($temp);
		$data="";
        for($i=0; $i<($len/8); $i++) {
                $data .= chr(intval(substr($temp, $i * 8, 8), 2));
        }
        return $data;
}

$zhb=array("111"=>"乾","000"=>"坤","010"=>"坎","101"=>"离","001"=>"震","100"=>"艮","110"=>"巽","011"=>"兑","1"=>"阳","0"=>"阴");


$szb=array("2"=>"二","3"=>"三","4"=>"四","5"=>"五","6"=>"六","7"=>"七","8"=>"八","9"=>"九","10"=>"十");

function z_bg($str){
	global $zhb,$szb;
	$bin=asc2bin($str);
	$result=strtr($bin,$zhb);
	$rs="";
	$rn=substr($result,0,2);
	$nownums=1;
	$jh=0;
	for($i=2;$i<strlen($result)+2;$i=$i+2){
		$nowstr=substr($result,$i,2);

		if($nowstr==$rn&&$nownums<10){
			$nownums++;
		}else{
			if($nownums>1){
				$rs.=$rn.$nownums;
			}else{
				$rs.=$rn;
			}
			$nownums=1;
		}
			$rn=$nowstr;
	}
	$rs=strtr($rs,$szb);
	$result="";
	for($i=0;$i<strlen($rs);$i=$i+8){
		$result.=substr($rs,$i,8);
		if($i+8<strlen($rs)&&!$jh){
			$result.="，";
			$jh=1;
		}else{
			$result.="。\n";
			$jh=0;
		}
		
	}	
	return $result;
}
function de_bg($str){
	global $zhb,$szb;
	$dzhb=array_flip($zhb);
	$dszb=array_flip($szb);
	$str=strtr($str,array("，"=>"","。"=>"","\n"=>""));
	
	$rs="";
	$rn=substr($str,0,2);
	for($i=2;$i<strlen($str)+2;$i=$i+2){
		$nowstr=substr($str,$i,2);
		$rns=$nowstr;
		$nowstr=strtr($nowstr,$dszb);
		if(strlen($nowstr)==1){
			$rs.=str_repeat($rn,$nowstr);
			$rns="";
		}else{
			$rs.=$rn;
		}
		$rn=$rns;
	}
	$rs=bin2asc(strtr($rs,$dzhb));
	return $rs;
}

echo (z_bg('名称出处：LADY-077 水野美香 桐原あずさ 水菜 丽水菜丽(1987年5月20- )，出生于日本东京都，现为AV女优，有“暗黑郭采洁”之称。水菜丽是ALICE JAPAN既希志爱野以及七海奈奈之后，2008年推出的新人。种子链接: http://pan.baidu.com/s/1c0BZ7zy 密码: 4q7t'));