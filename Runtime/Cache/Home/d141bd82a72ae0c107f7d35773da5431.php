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
        <div class="blank"></div>
        <h3 class="noticeDetailTitle"><strong><?php echo ($row["title"]); ?></strong></h3>
        <div class="noticeDetailInfo">发布者:<?php echo ($row["name"]); ?>小区物管</div>
        <div class="noticeDetailInfo">发布时间：<?php echo date('Y-m-d H:i:s',$row['create_time']);?></div>
        <div class="noticeDetailContent">
            <?php echo ($row["content"]); ?>
        </div>
        <input class="value" type="hidden" value="<?php echo ($row['id']); ?>"/>
        <button class="area">点击报名</button>
    </div>

	<!-- /主体 -->

	<!-- 底部 -->
	
    <script type="application/javascript">
        $(function(){
            var id = $(".value").val();

           $(".area").click(function(){
               $.post("<?php echo U('AreaAction/add');?>",{'id':id},function(data){
                   if(data.info == '还未登陆'){
                       if(confirm('还未登陆,确定登录')){
                           window.location = "<?php echo U('User/login');?>"
                       }
                   }else{
                       alert(data.info);
                   }

            });
           });
        });
    </script>


    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/Public/static/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>

	<!-- /底部 -->
</body>
</html>