<?php 
define('Copyright', '作者QQ:503064228');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'templates/offGamepk.php';
$ConfigModel = configModel("`g_pk_game_lock`, `g_mix_money`");
if ($ConfigModel['g_pk_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$_SESSION['cq'] = false;
$_SESSION['nc'] = false;
//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode(',', $result[0]['g_panlus']); 
$_SESSION['cq'] = false;
$_SESSION['gx'] = false;
$_SESSION['jx'] = false;
$_SESSION['gd'] = false;
$_SESSION['pk'] = true;


$g = $_GET['g'];
$abc = $_GET['abc'];
if($abc==null) {$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}


markPos("前台-PK10下注-（7-10名）");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/odds_7_pk.js"></script>
<title></title>
<script type="text/javascript">
var s = window.parent.frames.leftFrame.location.href.split('/');
		s = s[s.length-1];
		if (s !== "left.php")
			window.parent.frames.leftFrame.location.href = "/templates/left.php";
			
			
function soundset(sod){
if(sod.value=="on"){
sod.src="images/soundoff.png";
sod.value="off";
}
else{
sod.src="images/soundon.png";
sod.value="on";
}
SetCookie("soundbut",sod.value);
}
</script>
<style type="text/css">
div#row1 { float: left;  }
div#row2 { }
</style>
</head>
<body>
<table class="th" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td width="110" height="28" class="bolds">北京賽車(PK10)　　　</td>
        <td width="157" colspan="2" class="bolds" style="color:red">
        	 <div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">
<span>今天輸贏：</span></div><div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div></td>
        <td class="bolds" style="color:red" align="right"><img id='soundbut' name='soundbut' src="images/soundon.png" width="27" height="19" value='on' onclick="soundset(this);" title="开奖音开关"  style="display:none"/></td>
        <td width="112" align="right" class="bolds">
        	<span id="number" style="font-size:14px;position:relative; top:1px"></span>期開獎        </td>
        <td width="27" class="No_" id="a"></td>
        <td width="27" class="No_" id="b"></td>
        <td width="27" class="No_" id="c"></td>
        <td width="27" class="No_" id="d"></td>
        <td width="27" class="No_" id="e"></td>
        <td width="27" class="No_" id="f"></td>
        <td width="27" class="No_" id="g"></td>
        <td width="27" class="No_" id="h"></td>
		<td width="27" class="No_" id="j"></td>
        <td width="27" class="No_" id="k"></td>
    </tr>
    <tr>
    	<td height="30"><span id="o" style=" color:#009900; font-weight:bold; font-size:14px;position:relative; top:1px"></span>期</td>
        <td><span style="color:#0033FF; font-weight:bold" id="tys">七、八、九、十名</span></td>
        <td></td>
       <td width="85"><form id="form1" name="form1" method="post" action="">
       <!--   <label><span style="color:#0033FF; font-weight:bold" id="tys">
			<script>
			function changepan(sel){
			window.parent.frames.mainFrame.location.href = "sGame_pk_7.php?g=<?php echo$g?>&abc="+sel.value;
			}
			
			</script>
            <select name="abc" style="width:75px" onchange="changepan(this)">
			<?php   
			for($i=0;$i<count($pan);$i++){
			if($pan[$i]!=""){
			if($abc==$pan[$i]){
			?>			
			<option value="<?php echo$pan[$i]?>" selected="selected"><?php echo$pan[$i]?>盘</option>
			<?php			
			}
			else{
			?>
			<option value="<?php echo$pan[$i]?>" ><?php echo$pan[$i]?>盘</option>			
			<?php	
			}		
			}
			}		
			?>
            </select>
           </label>-->
      </form></td>
        <td>距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="6" align="right">距離開獎：<span style="color:red;font-size:104%" id="endTimes">加載中...</span></td>
		<td colspan="2"></td>
        <td colspan="2" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<form id="dp" action="" method="post" target="leftFrame" onsubmit = "return submitforms()">
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
	<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第七名</td>
   	</tr>
     <tr class="t_td_text">
    	<td width="29"  class="No_1"></td>
    	<td class="o" width="45" id="gh1"></td>
    	  <td class="tt" id="t1"></td>
    	<td width="29"  class="No_5"></td>
    	<td class="o" width="45" id="gh5"></td>
    	  <td class="tt" id="t5"></td>
    	<td width="29"  class="No_9"></td>
    	<td class="o" width="45" id="gh9"></td>
    	  <td class="tt" id="t9"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="gh11"></td>
    	  <td class="tt" id="t11"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_2"></td>
    	<td class="o" width="45" id="gh2"></td>
    	  <td class="tt" id="t2"></td>
    	<td width="29"  class="No_6"></td>
    	<td class="o" width="45" id="gh6"></td>
    	  <td class="tt" id="t6"></td>
    	<td width="29"  class="No_10"></td>
		<td class="o" width="45" id="gh10"></td>
    	  <td class="tt" id="t10"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="gh12"></td>
    	  <td class="tt" id="t12"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_3"></td>
    	<td class="o" width="45" id="gh3"></td>
    	  <td class="tt" id="t3"></td>
    	<td width="29"  class="No_7"></td>
    	<td class="o" width="45" id="gh7"></td>
    	  <td class="tt" id="t7"></td>
    	<td colspan="3" rowspan="2" class="caption_1"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="gh13"></td>
    	  <td class="tt" id="t13"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_4"></td>
    	<td class="o" width="45" id="gh4"></td>
    	  <td class="tt" id="t4"></td>
    	<td width="29"  class="No_8"></td>
    	<td class="o" width="45" id="gh8"></td>
    	  <td class="tt" id="t8"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="gh14"></td>
    	  <td class="tt" id="t14"></td>
    </tr>
    <tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第八名</td>
   	</tr>
     <tr class="t_td_text">
    	<td width="29"  class="No_1"></td>
    	<td class="o" width="45" id="hh1"></td>
    	  <td class="tt" id="t1"></td>
    	<td width="29"  class="No_5"></td>
    	<td class="o" width="45" id="hh5"></td>
    	  <td class="tt" id="t5"></td>
    	<td width="29"  class="No_9"></td>
    	<td class="o" width="45" id="hh9"></td>
    	  <td class="tt" id="t9"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="hh11"></td>
    	  <td class="tt" id="t11"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_2"></td>
    	<td class="o" width="45" id="hh2"></td>
    	  <td class="tt" id="t2"></td>
    	<td width="29"  class="No_6"></td>
    	<td class="o" width="45" id="hh6"></td>
    	  <td class="tt" id="t6"></td>
    	<td width="29"  class="No_10"></td>
		<td class="o" width="45" id="hh10"></td>
    	  <td class="tt" id="t10"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="hh12"></td>
    	  <td class="tt" id="t12"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_3"></td>
    	<td class="o" width="45" id="hh3"></td>
    	  <td class="tt" id="t3"></td>
    	<td width="29"  class="No_7"></td>
    	<td class="o" width="45" id="hh7"></td>
    	  <td class="tt" id="t7"></td>
    	<td colspan="3" rowspan="2" class="caption_1"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="hh13"></td>
    	  <td class="tt" id="t13"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_4"></td>
    	<td class="o" width="45" id="hh4"></td>
    	  <td class="tt" id="t4"></td>
    	<td width="29"  class="No_8"></td>
    	<td class="o" width="45" id="hh8"></td>
    	  <td class="tt" id="t8"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="hh14"></td>
    	  <td class="tt" id="t14"></td>
    </tr>
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第九名</td>
   	</tr>
     <tr class="t_td_text">
    	<td width="29"  class="No_1"></td>
    	<td class="o" width="45" id="ih1"></td>
    	  <td class="tt" id="t1"></td>
    	<td width="29"  class="No_5"></td>
    	<td class="o" width="45" id="ih5"></td>
    	  <td class="tt" id="t5"></td>
    	<td width="29"  class="No_9"></td>
    	<td class="o" width="45" id="ih9"></td>
    	  <td class="tt" id="t9"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="ih11"></td>
    	  <td class="tt" id="t11"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_2"></td>
    	<td class="o" width="45" id="ih2"></td>
    	  <td class="tt" id="t2"></td>
    	<td width="29"  class="No_6"></td>
    	<td class="o" width="45" id="ih6"></td>
    	  <td class="tt" id="t6"></td>
    	<td width="29"  class="No_10"></td>
		<td class="o" width="45" id="ih10"></td>
    	  <td class="tt" id="t10"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="ih12"></td>
    	  <td class="tt" id="t12"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_3"></td>
    	<td class="o" width="45" id="ih3"></td>
    	  <td class="tt" id="t3"></td>
    	<td width="29"  class="No_7"></td>
    	<td class="o" width="45" id="ih7"></td>
    	  <td class="tt" id="t7"></td>
    	<td colspan="3" rowspan="2" class="caption_1"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="ih13"></td>
    	  <td class="tt" id="t13"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_4"></td>
    	<td class="o" width="45" id="ih4"></td>
    	  <td class="tt" id="t4"></td>
    	<td width="29"  class="No_8"></td>
    	<td class="o" width="45" id="ih8"></td>
    	  <td class="tt" id="t8"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="ih14"></td>
    	  <td class="tt" id="t14"></td>
    </tr>
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第十名</td>
   	</tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_1"></td>
    	<td class="o" width="45" id="jh1"></td>
    	  <td class="tt" id="t1"></td>
    	<td width="29"  class="No_5"></td>
    	<td class="o" width="45" id="jh5"></td>
    	  <td class="tt" id="t5"></td>
    	<td width="29"  class="No_9"></td>
    	<td class="o" width="45" id="jh9"></td>
    	  <td class="tt" id="t9"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="jh11"></td>
    	  <td class="tt" id="t11"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_2"></td>
    	<td class="o" width="45" id="jh2"></td>
    	  <td class="tt" id="t2"></td>
    	<td width="29"  class="No_6"></td>
    	<td class="o" width="45" id="jh6"></td>
    	  <td class="tt" id="t6"></td>
    	<td width="29"  class="No_10"></td>
		<td class="o" width="45" id="jh10"></td>
    	  <td class="tt" id="t10"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="jh12"></td>
    	  <td class="tt" id="t12"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_3"></td>
    	<td class="o" width="45" id="jh3"></td>
    	  <td class="tt" id="t3"></td>
    	<td width="29"  class="No_7"></td>
    	<td class="o" width="45" id="jh7"></td>
    	  <td class="tt" id="t7"></td>
    	<td colspan="3" rowspan="2" class="caption_1"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="jh13"></td>
    	  <td class="tt" id="t13"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_4"></td>
    	<td class="o" width="45" id="jh4"></td>
    	  <td class="tt" id="t4"></td>
    	<td width="29"  class="No_8"></td>
    	<td class="o" width="45" id="jh8"></td>
    	  <td class="tt" id="t8"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="jh14"></td>
    	  <td class="tt" id="t14"></td>
    </tr>
</table>
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px"><input type="button" onclick="reset()" class="inputs ti" value="重填" /></td>
        <td align="left" style="padding-left:10px"><input type="submit" id="submits" class="inputs ti" value="下註" /></td>
        <td width="0" class="actiionn"></td>
    </tr>
</table>
</form>
<br />
<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption">
        <td><a class="nv" <?php echo $onclick?>>第七名</a></td>
        <td><a class="nv" <?php echo $onclick?>>第八名</a></td>
        <td><a class="nv" <?php echo $onclick?>>第九名</a></td>
        <td><a class="nv_a" <?php echo $onclick?>>第十名</a></td>
    </tr>
    <tr>
    	<td colspan="4" class="t_td_text" align="center">
        	<table class="hj" border="0" cellpadding="0" cellspacing="1">
            	<tr class="t_td_text" id="z_cl"><td></td></tr>
            </table>
        </td>
    </tr>
</table>
<div id="look" style="display:none"></div>
<?php include_once 'inc/cl_file.php';?>
<?php 
$name = base64_decode($_COOKIE['g_user']);
$db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$name}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>