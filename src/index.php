<!doctype html>
<html class="no-js" lang="en" style="height: 100%">

<head>
  <meta charset="utf-8" http-equiv="Content-Type" content="text/html;">
  <title>相离十八，再出发</title>
  <meta name="description" content="">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link rel="icon" href="http://119.23.238.53/src/img/icon.png">
  <link rel="manifest" href="site.webmanifest">
  <!--<link rel="apple-touch-icon" href="icon.png">-->
  <!-- Place favicon.ico in the root directory -->
  <link rel="stylesheet" href="../dist/css/layui.css" media="all">
  <!--<link rel="stylesheet" href="css/normalize.css">-->
  <link rel="stylesheet" href="css/main.css">
  <script src="../dist/layui.js"></script>
</head>

<body style="height: 100%" >
<!--导航栏-->
<!--<ul class="layui-nav layui-bg-cyan">-->
  <!--<li class="layui-nav-item"><a href="">藏青导航</a></li>-->
  <!--<li class="layui-nav-item layui-this"><a href="">产品</a></li>-->
  <!--<li class="layui-nav-item"><a href="">大数据</a></li>-->
  <!--<li class="layui-nav-item">-->
    <!--<a href="javascript:;">解决方案</a>-->
    <!--<dl class="layui-nav-child">-->
      <!--<dd><a href="">移动模块</a></dd>-->
      <!--<dd><a href="">后台模版</a></dd>-->
      <!--<dd><a href="">电商平台</a></dd>-->
    <!--</dl>-->
  <!--</li>-->
  <!--<li class="layui-nav-item"><a href="">社区</a></li>-->
<!--</ul>-->

<div class="match_height" style="text-align: center; ">
    <h1 style="margin-top: 20px; margin-bottom: 40px;">通用印刷OCR</h1>
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
  <!-- Add your site or application content here -->
  <!--<p>Hello world! This is HTML5 Boilerplate.</p>-->
  <div class="layui-upload-drag" id="uploadbyu">
    <i class="layui-icon"></i>
    <p>点击上传，或将文件拖拽到此处</p><p style="color: red">识别文字不宜过多</p>
  </div>
    <pre><br></pre>
    <div class="match_height">
        <textarea class="ocrttarea" name="str" id="str" value="" type="text" readonly="readonly"></textarea>
    </div>
</div>

  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>
  <script type="text/javascript" color="#FBFAF8" opacity="0.7" zindex="-2" count="300" src="../dist/js/canvas-nest.js"></script>
  <canvas id="c_n1" width="1508" height="857" style="position: fixed; top: 0px; left: 0px; z-index: -2; opacity: 0.7;"></canvas>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>
  <script src="../dist/layui.js" charset="utf-8"></script>
  <!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
  <script>
    layui.use('element', function(){
      var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块

      //监听导航点击
      element.on('nav(demo)', function(elem){
        //console.log(elem)
        layer.msg(elem.text());
      });
    });
  </script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
  layui.use('upload', function(){
    var $ = layui.jquery
      ,upload = layui.upload;

    //拖拽上传
    upload.render({
      elem: '#uploadbyu'
      ,url: './upload.php'
      ,method: 'post'
      ,accept: 'image'
      ,exts: 'jpg|png|jpeg'
      ,drag: true
      ,size: 1024 //限制文件大小，单位 KB
      // ,before: function(obj){ //
      //   layer.load(); //上传loading
      // }
      ,done: function(res){
        console.log(res);
            if(res.code > 0){
              return layer.msg('上传失败');
            }
            else if(res.code == 0){
                console.log(res.string);
                var str = res.string;
                document.getElementById("str").innerHTML=str;
              return layer.msg('上传成功');
            }
        }
      ,error: function(){
        //演示失败状态，并实现重传
        var demoText = $('#demoText');
        demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
        demoText.find('.demo-reload').on('click', function(){
          uploadInst.upload();
        });
      }
    });
  });
</script>

</body>
</html>
