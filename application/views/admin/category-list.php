<title>商品分类管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 分类管理 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="text-c">
		  超市：
		<select id="supermarket" class="select" style="height:31px;width:inherit;vertical-align:middle;">
          <option value="-1">所有</option>
          <?php foreach($supermarkets as $sm):?>
          <optgroup label="<?php echo $sm->name;?>">
            <?php foreach($sm->subSupermarkets as $ssm):?>
            <option value="<?php echo $ssm->id;?>" <?php echo isset($_GET['sid']) && $_GET['sid']==$ssm->id?'selected':'';?>><?php echo $ssm->sname;?></option>
            <?php endforeach;?>
          </optgroup>
          <?php endforeach;?>
        </select> 添加时间：
		<input type="text" value="<?php echo isset($_GET['startTime'])?$_GET['startTime']:'';?>" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" value="<?php echo isset($_GET['endTime'])?$_GET['endTime']:'';?>" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
		<!-- 类型：
		<select id="type" class="select" name="admin-role" size="1" style="height:31px;width:inherit;vertical-align:middle;">
			<option value="-1" <?php echo !isset($_GET['type'])?'selected':'';?>>所有</option>
			<option value="0" <?php echo isset($_GET['type']) && $_GET['type']=='0'?'selected':'';?>>总店</option>
			<option value="1" <?php echo isset($_GET['type']) && $_GET['type']=='1'?'selected':'';?>>分店</option>
		</select> -->
		<input type="text" value="<?php echo isset($_GET['keywords'])?$_GET['keywords']:'';?>" id="keywords" class="input-text" style="width:250px" placeholder="输入分类名称"name="">
		<button onclick="searchCategory();" type="submit" class="btn btn-success radius" name=""><i class="Hui-iconfont">&#xe665;</i> 搜分类</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<a href="javascript:;" onclick="member_del_bulk()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
			<a href="javascript:;" onclick="member_add('添加分类','/admin/categoryadd','500','300')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加一级分类</a>
			<a href="javascript:;" onclick="member_add('添加分类','/admin/subcategoryadd','500','300')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加二级分类</a>
			
		</span> 
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="120">超市</th>
				<th width="120">一级分类</th>
				<th width="120">二级分类</th>
				<th width="80">排序序号</th>
				<th width="120">添加时间</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($categories as $category):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $category->id;?>" name="id"></td>
				<td><?php echo $category->supermarket->name.' - '.$category->supermarket->sname;?></td>
				<td><?php echo $category->supername;?></td>
				<td><?php echo $category->name;?></td>
				<td><?php echo $category->order;?></td>
				<td><?php echo $category->addtime;?></td>
				<td class="td-manage">
					<a title="编辑" href="javascript:;" onclick="member_edit('修改分类信息','/admin/categoryedit','<?php echo $category->id;?>','500','300')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> 
					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $category->id;?>')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	</div>
</div>
<script type="text/javascript" src="/assets/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 4, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0]}// 制定列不参与排序
		]
	});
	$('.table-sort tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});
});
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
// /*用户-查看*/
// function member_show(title,url,id,w,h){
// 	layer_show(title,url+'?id='+id,w,h);
// }
// /*用户-停用*/
// function member_stop(obj,id){
// 	layer.confirm('确认要下架吗？',function(index){
// 		var product = new Object(); 
// 	    product.infoType = 'product';
// 	    product.id = id;
// 	    product.status = 1;
// 	    dataHandler('/common/modifyInfo',product,null,null,null,function(){
// 			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="上架"><i class="Hui-iconfont">&#xe603;</i></a>');
// 			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
// 			$(obj).remove();
// 			layer.msg('已下架!',{icon: 5,time:1000});
// 		},false,false);
// 	});
// }

// /*用户-启用*/
// function member_start(obj,id){
// 	layer.confirm('确认要启用吗？',function(index){
// 		var product = new Object(); 
// 	    product.infoType = 'product';
// 	    product.id = id;
// 	    product.status = 0;
// 	    dataHandler('/common/modifyInfo',product,null,null,null,function(){
// 			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
// 			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已上架</span>');
// 			$(obj).remove();
// 			layer.msg('已上架!',{icon: 6,time:1000});
// 		},false,false);
// 	});
// }
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}
// /*图片-编辑*/
// function product_edit(title,url,id){
// 	var index = layer.open({
// 		type: 2,
// 		title: title,
// 		content: url
// 	});
// 	layer.full(index);
// }
// /*密码-修改*/
// function change_password(title,url,id,w,h){
// 	layer_show(title,url+'?id='+id,w,h);	
// }
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var category = new Object(); 
	    category.infoType = 'category';
	    category.id = id;
		dataHandler('/common/deleteInfo',category,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},false,false);
	});
}
/*seller-批量删除*/
function member_del_bulk(){
	var memberArray = new Array();
    $("input[name='id']:checked").each(function(){
        memberArray.push($(this).val()); 
    });
    if(memberArray.length<1){
       layer.alert('请选择要删除的分类！');
        return false;
    }
	layer.confirm('确认要删除这些分类吗？',function(index){
	    var categories = new Object();
	    categories.infoType = 'categories';
	    categories.idArray = memberArray;
	    dataHandler("/common/deleteBulkInfo",categories,null,null,null,function(){
	    	$("input[name='id']:checked").each(function(){
		        $(this).parents("tr").remove();
		    });
			layer.msg('已删除!',{icon:1,time:1000});
	    },false,false);
	});
}
</script> 
</body>
</html>