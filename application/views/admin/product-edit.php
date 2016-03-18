<title>编辑商品</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form action="?id=<?php echo $product->id;?>" class="form form-horizontal" id="form-member-add">
    <input id="id" value="<?php echo $product->id;?>" type="hidden">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>超市：</label>
      <div class="formControls col-5"> <span class="select-box">
        <select id="supermarket" onchange="getCategories();" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择所属总超市！">
          <option value="" selected>请选择超市</option>
          <?php foreach($supermarkets as $sm):?>
          <optgroup label="<?php echo $sm->name;?>">
            <?php foreach($sm->subSupermarkets as $ssm):?>
            <option value="<?php echo $ssm->id;?>" <?php echo $ssm->id==$product->sid?'selected':'';?>><?php echo $ssm->sname;?></option>
            <?php endforeach;?>
          </optgroup>
          
          <?php endforeach;?>
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分类：</label>
      <div class="formControls col-5"> <span class="select-box">
        <select id="category" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择商品分类！">
          <?php foreach($categories as $category):?>
          <option value="<?php echo $category->id;?>" <?php echo $category->id==$product->categoryid?'selected':'';?>><?php echo $category->name;?></option>
          <?php endforeach;?>
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品名称：</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -  -->
        <input type="text" class="input-text" value="<?php echo $product->name;?>" placeholder="" id="name" name="name" datatype="*2-16" nullmsg="商品名称不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品详细名称：</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -->
        <input type="text" class="input-text" value="<?php echo $product->detailedname;?>" placeholder="" id="detailedname" name="detailedname" datatype="*2-16" nullmsg="商品详细名称不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3">条形码：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $product->barcode;?>" placeholder="" id="barcode" name="barcode" datatype="*2-16" ignore="ignore">
      </div>
      <div class="col-4"> </div>
    </div>
     <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>原价：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $product->actualprice;?>" placeholder="" id="actualprice" name="actualprice" datatype="*2-16" nullmsg="原价不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>优惠价格：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $product->price;?>" placeholder="" id="price" name="price" datatype="*2-16" nullmsg="实际价格不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品图片1：</label>
      <div class="formControls col-5">
        <img src="<?php echo $product->pic1;?>" id="thumbnail1" style="max-width:90%;max-height:100px;">

        <span class="btn-upload form-group">
          <a href="javascript:$('#file1').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品图片2：</label>
      <div class="formControls col-5">
        <img src="<?php echo $product->pic2;?>" id="thumbnail2" style="max-width:90%;max-height:100px;">

        <span class="btn-upload form-group">
          <a href="javascript:$('#file2').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品图片3：</label>
      <div class="formControls col-5">
        <img src="<?php echo $product->pic3;?>" id="thumbnail3" style="max-width:90%;max-height:100px;">

        <span class="btn-upload form-group">
          <a href="javascript:$('#file3').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品图片4：</label>
      <div class="formControls col-5">
        <img src="<?php echo $product->pic4;?>" id="thumbnail4" style="max-width:90%;max-height:100px;">

        <span class="btn-upload form-group">
          <a href="javascript:$('#file4').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品图片5：</label>
      <div class="formControls col-5">
        <img src="<?php echo $product->pic5;?>" id="thumbnail5" style="max-width:90%;max-height:100px;">

        <span class="btn-upload form-group">
          <a href="javascript:$('#file5').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
         
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
  

    <div class="row cl">
        <label class="form-label col-3">商品详情：</label>
        <div class="formControls col-5">
          <textarea id="description" name="" cols="" rows="" class="textarea" value="<?php echo $product->description;?>"></textarea>
        </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>运费：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $product->expressfee;?>" placeholder="" id="expressfee" name="expressfee" datatype="*1-16" nullmsg="运费不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>库存 ：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $product->count;?>" placeholder="" id="count" name="count" datatype="*1-16" nullmsg="库存不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否参加活动：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="isattend-1" name="isattend" value="0" datatype="*" <?php echo $product->isattend=='0'?'checked':'';?>>
          <label for="isedit-1">否</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="isattend-2" name="isattend" value="1" <?php echo $product->isattend=='1'?'checked':'';?>>
          <label for="isedit-2">是</label>
        </div>
        <div span class="c-red">*若选择参加活动，请在活动专区查看商品信息</div>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否今日推荐：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="isrecommend-1" name="isrecommend" value="0" datatype="*" <?php echo $product->isrecommend=='0'?'checked':'';?>>
          <label for="isedit-1">否</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="isrecommend-2" name="isrecommend" value="1" <?php echo $product->isrecommend=='1'?'checked':'';?>>
          <label for="isedit-2">是</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>

    <!-- <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否可编辑：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="isedit-1" name="isedit" value="0" datatype="*" <?php echo $product->isedit=='0'?'checked':'';?>>
          <label for="isedit-1">否</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="isedit-2" name="isedit" value="1" <?php echo $product->isedit=='1'?'checked':'';?>>
          <label for="isedit-2">是</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div> -->
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否上架：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="status-1" name="status" value="0" datatype="*" <?php echo $product->status=='0'?'checked':'';?>>
          <label for="status-1">立即上架</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="status-2" name="status" value="1" <?php echo $product->status=='1'?'checked':'';?>>
          <label for="status-2">暂不上架</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;保存&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>
<!-- <form id="uploadImgThumb" enctype="multipart/form-data">
    <input onchange="return uploadThumb()" name="image" type="file" id="file" style="display:none;" accept="image/*">
</form> -->
<form id="uploadImgThumb1" enctype="multipart/form-data">
    <input onchange="return uploadThumb1()" name="image" type="file" id="file1" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb2" enctype="multipart/form-data">
    <input onchange="return uploadThumb2()" name="image" type="file" id="file2" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb3" enctype="multipart/form-data">
    <input onchange="return uploadThumb3()" name="image" type="file" id="file3" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb4" enctype="multipart/form-data">
    <input onchange="return uploadThumb4()" name="image" type="file" id="file4" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb5" enctype="multipart/form-data">
    <input onchange="return uploadThumb5()" name="image" type="file" id="file5" style="display:none;" accept="image/*">
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
		callback:function(form){
      // alert('ok');
			// form[0].submit();
      updateProduct(false,function(){
        alert('保存成功！');
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