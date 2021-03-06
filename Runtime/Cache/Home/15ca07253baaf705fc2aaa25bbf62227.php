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
	
        <div class="boxbox">
            <?php if(is_array($rows)): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><div class="row noticeList">
                    <a href="<?php echo ($row["url"]); ?>">
                        <div class="col-xs-2">
                            <img class="noticeImg" src="<?php echo ($row["path"]); ?>" />
                        </div>
                        <div class="col-xs-10">
                            <p class="title"><?php echo ($row["title"]); ?></p>
                            <p class="intro"><?php echo ($row["description"]); ?></p>
                            <p class="info">浏览: <?php echo ($row["view"]); ?> <span class="pull-right"><?php echo ($row['create_time']); ?></span> </p>
                        </div>
                    </a>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    <div class="text-center">
        <button class="btn btn-info get_more">获取更多!~~~~</button>
    </div>

	<!-- /主体 -->

	<!-- 底部 -->
	
    <script type="application/javascript">
        $(function(){
            var p = 1;
            $(".get_more").click(function(){
                //设置默认页
                //发送ajax请求
                $.post("<?php echo U('businessList');?>",{p:p+1},function(data){
                    //判断是否有值
                    if(data.status == 1){
                        p++;
                        var html = '';
                        //循环出数据
                        $(data.info).each(function(i,e){
                            html += '<div class="row noticeList">\
                                    <a href="'+ e.url+'">\
                                            <div class="col-xs-2">\
                                            <img class="noticeImg" src="'+ e.path+'" />\
                                            </div>\
                                            <div class="col-xs-10">\
                                            <p class="title">'+ e.title+'</p>\
                                <p class="intro">'+ e.description+'</p>\
                            <p class="info">浏览:'+ e.view+'  <span class="pull-right">'+ e.create_time+'</span> </p>\
                </div>\
                </a>\
                </div>';
                            $('.boxbox').append(html);
                        });
                    }else{
                        alert('没有更多信息了');
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