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
        <table class="table table-hover table-border">
            <tr>
                <th>报修人</th>
                <th>电话</th>
                <th>地址</th>
                <th>报修时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($rows)): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($row["name"]); ?></td>
                <td><?php echo ($row["tel"]); ?></td>
                <td><?php echo ($row["address"]); ?></td>
                <td><?php echo date('Y-m-d H:i:s',$row['add_time']);?></td>
                <td><?php echo ($row["status_text"]); ?></td>
                <td>
                    <a class="text-info" href="<?php echo U('edit?id='.$row['id']);?>">编辑</a>
                    <a class="ajax-get" href="<?php echo U('del?id='.$row['id']);?>">删除</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>
</div>

	<!-- /主体 -->

	<!-- 底部 -->
	

    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/Public/static/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>

	<!-- /底部 -->
</body>
</html>