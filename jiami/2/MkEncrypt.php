<?php
/********************************************
* 使用方法:
* 1、将本段代码保存为 MkEncrypt.php
*
* 2、在要加密的页面前面引入这个 php 文件 <?php 后面
* require_once('MkEncrypt.php');
*
* 3、设置页面访问密码
********************************************/
// 密码 Cookie 加密盐
if (!defined('MK_ENCRYPT_SALT')) {
    define('MK_ENCRYPT_SALT', 'Kgs$JC!V');
}
/**
* 设置访问密码
* @param $password 访问密码
* @param $pageid 页面唯一 ID 值，用于区分同一网站的不同加密页面
*/
MkEncrypt('666');// 设置访问密码
function MkEncrypt($password, $pageid = 'default')
{
    $pageid = md5($pageid);
    $md5pw = md5(md5($password).MK_ENCRYPT_SALT);
    $postpwd = isset($_POST['pagepwd']) ? addslashes(trim($_POST['pagepwd'])) : '';
    $cookiepwd = isset($_COOKIE['mk_encrypt_'.$pageid]) ? addslashes(trim($_COOKIE['mk_encrypt_'.$pageid])) : '';
    if ($cookiepwd == $md5pw) {
        return;
    } // Cookie密码验证正确
if ($postpwd == $password) { // 提交的密码正确
setcookie('mk_encrypt_' . $pageid, $md5pw, time() + 86400, '/');// cookie时间*秒
return;
} ?>
<!DOCTYPE HTML>
<html>
<head>
<script src="./layer/jquery.min.js"></script>
<script src="./layer/layer.js"></script>
<head>
<title>巅峰小工具-任意PHP页面添加密码访问功能代码</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<link rel="stylesheet" href="./static/css/style.css" type="text/css" media="all">
</head>
<body>
  
<h1>该页面已加密</h1>
<div class="container w3layouts agileits">
<div class="login w3layouts agileits">
<h2>邀请码</h2>
<form method="post" id="form">
<input type="password" id="fancypig" name="pagepwd" placeholder="请输入密码">
  
<div class="send-button w3layouts agileits">

<input type="submit" value="确 认">
<?php if($postpwd): ?>
<script>setTimeout(function() {document.getElementById(layer.tips('警告：密码错误！请访问巅峰官网获取密码！','#fancypig', {tips: [1, '#ec4848'],time: 9000}))}, 30);</script>
<?php endif; ?>
</form>
</div>

<div class="send-button w3layouts agileits">

<input type="submit" onclick="showInfo()" value="密码获取">

</div>
</div>
<div class="clear"></div>
</div>

<script type="text/javascript">
            function showInfo() { //信息框
                layer.open({
        type: 1
        ,title: false //不显示标题栏
        ,closeBtn: false
        ,area: '300px;'
        ,shade: 0.2
        ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
        ,btn: ['我知道了']
        ,btnAlign: 'c'
        ,moveType: 1 //拖拽模式，0或者1
        ,content: '<div style="padding: 20px; line-height: 22px; background-color: #495057; color: #fff; font-weight: 300;">巅峰资源网<br><br>你可以在此添加任何HTML与文字<br><br>默认密码：666<br><br><img src="./qr-code.png" style="width:100%"</img></div>'
        ,success: function(layero){
          var btn = layero.find('.layui-layer-btn');
        }
      });
    }
        </script>

</body>
</html>
<?php
exit();
}
