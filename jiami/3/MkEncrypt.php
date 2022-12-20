<?php
/********************************************
* 使用方法:
*
* 在要加密的页面前面引入这个 php 文件 <?php 后面
* require_once('MkEncrypt.php');
*
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
	<meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no minimal-ui">
	<link rel="stylesheet" type="text/css" href="./static/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./static/css/util.css">
    <link rel="stylesheet" type="text/css" href="./static/css/main.css">
</head>
<body>
<div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(./static/images/bg-01.jpg);">
                    <span class="login100-form-title-1">该页面已加密</span>
                </div>

                <form class="login100-form validate-form">
                    <div class="wrap-input100 validate-input m-b-18" data-validate="密码不能为空">
                        <span class="label-input100">密码</span>
                        <input class="input100" type="password" id="fancypig" name="pagepwd" placeholder="请输入密码">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">

                        <div>
                            <a href="javascript:" onclick="showInfo()" class="txt1">如何获取密码？</a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">访 问</button>
						<?php if($postpwd): ?>
<script>setTimeout(function() {document.getElementById(layer.tips('警告：密码错误！请访问巅峰官网获取密码！','#fancypig', {tips: [1, '#ec4848'],time: 9000}))}, 30);</script>
<?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="./static/js/jquery-3.2.1.min.js"></script>
    <script src="./static/js/main.js"></script>
	
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
        ,content: '<div style="padding: 20px; line-height: 22px; background-color: #495057; color: #fff; font-weight: 300;">d66f.com<br><br>此源码由巅峰资源网发布<br><br>默认密码：666<br><br><img src="./qr-code.png" style="width:100%"</img></div>'
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
