<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	
    <!DOCTYPE html>
    <html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="/Public/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="/Public/static/bootstrap/js/jquery-1.11.2.min.js"></script>
        <link href="/Public/Home/css/style.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .main{margin-bottom: 60px;}
            .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
        </style>
    </head>
    <body>
    <div class="main">

</head>
<body>
	<!-- 头部 -->
	
    <!--导航部分-->
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid text-center">
            <div class="col-xs-3">
                <p class="navbar-text"><a href="index.html" class="navbar-link">首页</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="fuwu.html" class="navbar-link">服务</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="faxian.html" class="navbar-link">发现</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="<?php echo U('User/index');?>" class="navbar-link">我的</a></p>
            </div>
        </div>
    </nav>
    <!--导航结束-->

	<!-- /头部 -->
	
	<!-- 主体 -->
	
    <div class="container-fluid">
        <form action="<?php echo U(Server/approve);?>" method="post">
            <div class="form-group">
                <label>您的姓名(必填):</label>
                <input name="name" type="text" class="form-control" />
            </div>
            <div class="form-group">
                <label>你的房号(必填):</label>
                <input name="sn" type="text" class="form-control" />
            </div>
            <div class="form-group">
                <label>您与业主的关系(必填):</label>
                <select class="form-control" name="relation">
                    <option value="1">本人</option>
                    <option value="2">亲属</option>
                    <option value="3">租户</option>
                </select>
            </div>
            <div class="form-group">
                <label>联系电话(必填):</label>
                <input name="tel" type="text" class="form-control" />
            </div>
            <div class="form-group">
                <label>身份证号码(必填):</label>
                <input name="num" type="text" class="form-control" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary onlineBtn">确认提交</button>
            </div>
        </form>
    </div>

	<!-- /主体 -->

	<!-- 底部 -->
	



    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/Public/static/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>

	<!-- /底部 -->
</body>
</html>