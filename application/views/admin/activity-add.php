<title>添加优惠活动</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="role" value="0" type="hidden">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>超市：</label>
      <div class="formControls col-5"> <span class="select-box">
        <select id="supermarket" onchange="getSubSupermarkets();" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择总超市！">
          <option value="" selected>请选择总超市</option>
          <?php foreach($supermarkets as $sm):?>
          <option value="<?php echo $sm->id;?>"><?php echo $sm->name;?></option>
          <?php endforeach;?>
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"></label>
      <div class="formControls col-5"> <span class="select-box">
        <select id="subsupermarket" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择具体超市！">
          <option value="" selected>请选择具体超市</option>
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div>
    <!-- <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>添加活动：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value=""  id="name" name="member-buyer" datatype="*2-16" nullmsg="活动不能为空"> -->
        <!-- placeholder="多用户用英文逗号分隔，只填写0为所有用户" -->
     <!--  </div>
      <div class="col-4"> </div>
    </div> -->

   <!--  <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>选择活动：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="name-1" name="name" value="1" datatype="*" checked="checked">
          <label for="name-1">优惠券</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="name-2" name="name" value="2" >
          <label for="name-2">减免活动</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div> -->
    <!-- <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>简介图：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="facevalue" name="member-facevalue"  datatype="n" nullmsg="简介图最多三张">
      </div>
      <div class="col-4"> </div>
    </div> -->

   <!--  <div class="row cl">
      <label class="form-label col-3">Logo：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div> -->
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>超市活动图1：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail1" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file1').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>超市活动图2：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail2" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file2').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>活动详情图：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail3" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file3').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>

    <!-- <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>logo：</label>
      <div class="formControls col-5">
                <img src="" id="thumbnail" style="max-width:90%;max-height:100px;">
        <div class="uploader-thum-container">
          <div id="fileList" class="uploader-list">
                    </div>
          <div id="filePicker" onclick="$('#file').click();" style="margin-top:10px;">
                        <div class="webuploader-pick">选择图片</div>
                    </div>
                    <form id="uploadImgThumb" enctype="multipart/form-data">
                        <input onchange="return uploadThumb()" name="image" type="file" id="file" style="display:none;" accept="image/*">
                    </form> -->
          <!--  <button id="btn-star" class="btn btn-default btn-uploadstar radius ml-10">开始上传</button> -->
       <!--  </div>
      </div>
    </div>
 -->
    <div class="row cl">
      <label class="form-label col-3"></span>满足金额：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" placeholder="满￥" name="fullprice" id="fullprice" datatype="n" ignore="ignore">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"></span>减免金额：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" placeholder="减￥" name="reduceprice" id="reduceprice" datatype="n" ignore="ignore">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3">内容：</label>
      <div class="formControls col-5">
        <textarea id="content" name="" cols="" rows="" class="textarea"></textarea>
      </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>有效期始：</label>
      <div class="formControls col-5">
        <input type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate">
      </div>
      <div class="col-4"> </div>
    </div>
    
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>有效期止：</label>
      <div class="formControls col-5">
        <input type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'datemin\')}'})" id="datemax" class="input-text Wdate">
      </div>
    </div>
    
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否使用：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="status-1" name="status" value="0" datatype="*" >
          <label for="status-1">否</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="status-2" name="status" value="1" checked="checked">
          <label for="status-2">是</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>
    <!-- <div class="row cl">
      <label class="form-label col-3">头像：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div> -->
    <!-- <div class="row cl">
      <label class="form-label col-3">备注：</label>
      <div class="formControls col-5">
        <textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)"></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
      </div>
      <div class="col-4"> </div>
    </div> -->
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;添加&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>
<form id="uploadImgThumb1" enctype="multipart/form-data">
    <input onchange="return uploadThumb1()"  name="image" type="file" id="file1" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb2" enctype="multipart/form-data">
    <input onchange="return uploadThumb2()"  name="image" type="file" id="file2" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb3" enctype="multipart/form-data">
    <input onchange="return uploadThumb3()"  name="image" type="file" id="file3" style="display:none;" accept="image/*">
</form>
<script type="text/javascript" src="/assets/lib/icheck/jquery.icheck.min.js"></script>
<script charset="utf-8" src="/assets/js/jquery.form.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({ 
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
  
	$("#form-member-add").Validform({

		tiptype:2,
		callback:function(form)
    {
       // alert('ok');
			// form[0].submit();
      saveActivity(true,function()
      {
        alert('添加成功！');
        var index = parent.layer.getFrameIndex(window.name);
        // parent.$('.btn-refresh').click();
        parent.window.location.reload();
        parent.layer.close(index);
      });
		}
	});
});

</script>
</body>
</html>