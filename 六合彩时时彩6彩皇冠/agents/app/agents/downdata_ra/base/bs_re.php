<?
set_time_limit(0);
require"../../../../include/conn_ft8.php";
require"../../../../include/function.php";
require ("../../../../include/curl_http.php");

$mysql = "select passuid,passuid_tw,passuid_en from web_system";
$result = mysql_query($mysql);
$row = mysql_fetch_array($result);
$uid =$row['passuid'];

$settime=$_REQUEST['settime'];
$site=$_REQUEST['sitename'];

$curl = &new Curl_HTTP_Client();
$curl->store_cookies("cookies.txt"); 
$curl->set_user_agent("Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
$curl->set_referrer("".$site."/app/member/browse_BS/loadgame_RB.php?langx=zh-cn&uid=$uid";
$html_data=$curl->fetch_url("".$site."/app/member/browse_BS/reloadgame_RB.php?langx=zh-cn&uid=$uid&LegGame=ALL&page_no=$page_no";

preg_match_all("/new Array\(\'(.+?)\);/is",$meg,$matches);
echo $meg;
$cou=sizeof($matches[0]);
for($i=0;$i<$cou;$i++){
	$messages=$matches[0][$i];
	echo $messages;
	$messages=str_replace("new Array(","",$messages);
	$messages=str_replace(")","",$messages);
	$messages=str_replace("'","",$messages);
	//转码
	$messages = iconv("gb2312","utf-8",$messages);
	
	$datainfo=explode(",",$messages);
	
	$m_Date=date("m-d",strtotime($datainfo[1]));
	$m_Time=date("h:iA",strtotime($datainfo[1]));
	$m_Time=str_replace("M","",$m_Time);
	
	$checksql = "select MID from base_match where `MID` ='$datainfo[0]'";
	$checkresult = mysql_query($checksql);	
	$check=mysql_num_rows($checkresult);
	if($check==0){
		$sql = "INSERT INTO base_match(MID,M_Date,M_Time,MB_Team,TG_Team,M_League,MB_MID,TG_MID,ShowType) VALUES 
			('$datainfo[0]','$m_Date','$m_Time','$datainfo[4]','$datainfo[5]','$datainfo[2]','$datainfo[3]','$datainfo[4]','$datainfo[6]')";
		mysql_query($sql) or die ("操作失败!");
	}else{
		$sql = "update base_match set MB_Team='$datainfo[4]',TG_Team='$datainfo[5]',M_League='$datainfo[2]',ShowType='$datainfo[6]' where MID=$datainfo[0]";
		mysql_query($sql) or die ("操作失败1!");
	}
}
}	
$sql="update base_match set RE_Show=0 where RE_Show=1 and locate(MID,'$gmid')<1";
mysql_query($sql) or die ("操作失敗!");
mysql_close();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link href="/style/agents/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
</head>

<body bgcolor="#AACCCC">
<script> 
<!-- 
var limit="<?=$settime?>" 
if (document.images){ 
	var parselimit=limit
} 
function beginrefresh(){ 
if (!document.images) 
	return 
if (parselimit==1) 
	window.location.reload() 
else{ 
	parselimit-=1 
	curmin=Math.floor(parselimit) 
	if (curmin!=0) 
		curtime=curmin+"秒后自动获取本页最新数据！" 
	else 
		curtime=cursec+"秒后自动获取本页最新数据！" 
		timeinfo.innerText=curtime 
		setTimeout("beginrefresh()",1000) 
	} 
} 

window.onload=beginrefresh 
file://--> 
</script>
<table width="102" height="100" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="108" height="100" align="center"><br>
      走地数据正在接收<br>
      <span id="timeinfo"></span><br>
      <input type=button name=button value="简体" onClick="window.location.reload()"></td>
  </tr>
</table>
</body>
</html>
