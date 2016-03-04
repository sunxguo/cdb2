<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Common extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->helper("upload");
		$this->load->library('GetData');
        //$this->load->library('PHPExcel');
//		$this->load->library('PHPExcel');
		$this->load->model("dbHandler");
	}
	public function addInfo(){
		$table="";
		$data=json_decode($_POST['data']);

		$info=array();
		switch($data->infoType){
			case "banner":
				$table="banner";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"title"=>$data->title,
					"introduction"=>$data->introduction,
					"addtime"=>$time,
					"edittime"=>$time,
					"content"=>$data->content,
					"thumbnail"=>strstr($data->thumbnail,'http')?$data->thumbnail:SERVER_IP.($data->thumbnail),
					"order"=>is_numeric($data->order)?$data->order:0,
					"draft"=>$data->draft
				);
			break;
			case "aboutus":
				$table="aboutus";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"appname"=>$data->appname,
					"addtime"=>$time,
					"edittime"=>$time,
					"content"=>$data->content,
					"logo"=>strstr($data->logo,'http')?$data->logo:SERVER_IP.($data->logo),
					"version"=>$data->version,
					"role"=>$data->role
				);
			break;
			case "seller":
				$table="seller";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"sid"=>$data->sid,
					"name"=>$data->name,
					"addtime"=>$time,
					"edittime"=>$time,
					"workno"=>$data->workno,
					"gender"=>$data->gender,
					"phone"=>$data->phone,
					"password"=>md5($data->password."63"),
					"photo"=>$data->photo==""?'':(strstr($data->photo,'http')?$data->photo:SERVER_IP.($data->photo)),
					"role"=>is_numeric($data->role)?$data->role:1,
					"token"=>md5(($data->phone).($data->password).time()),
					"status"=>$data->status
				);
			break;
			case "product":
				$table="goods";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"sid"=>$data->sid,
					"name"=>$data->name,
					"detailedname"=>$data->detailedname,
					"barcode"=>$data->barcode,
					"price"=>$data->price,
					"pic1"=>strstr($data->photo,'http')?$data->photo:SERVER_IP.($data->photo),
					"isedit"=>$data->isedit,
					"categoryid"=>$data->categoryid,
					"description"=>$data->description,
					"expressfee"=>$data->expressfee,
					"isrecommend"=>$data->isrecommend,
					"isattend"=>$data->isattend,
					"count"=>$data->count,
					"status"=>$data->status,
					"addtime"=>$time,
					"edittime"=>$time
				);
			break;
			// case "category":
			// 	$table="category";
			// 	$time=date("Y-m-d H:i:s");
			// 	$info=array(
			// 		"sid"=>$data->sid,
			// 		// "supername"=>$data->supername,
			// 		"name"=>$data->name,
			// 		"order"=>$data->order,
			// 		"addtime"=>$time,
			// 		"edittime"=>$time
			// 	);
			// break;
			case "subcategory":
			    if($this->getdata->isExist('category',array('name'=>$data->name,'sid'=>$data->sid))){
					echo json_encode(array("result"=>"failed","message"=>"该二级分类已经存在，请更换！"));
					return false;
				}
				$table="category";
				$time=date("Y-m-d H:i:s");
				$category=$this->getdata->getContent('category',$data->superid);
				$info=array(
					"sid"=>$data->sid,
					"superid"=>$data->superid,
					"supername"=>$category->supername,
					"name"=>$data->name,
					"addtime"=>$time,
					"edittime"=>$time
				);
			break;
			case "supermarket":
				if($this->getdata->isExist('supermarket',array('no'=>$data->no,'type'=>0))){
					echo json_encode(array("result"=>"failed","message"=>"超市代码已经存在，请更换！"));
					return false;
				}
				if($this->getdata->isExist('supermarket',array('sno'=>$data->sno))){
					echo json_encode(array("result"=>"failed","message"=>"超市编号已经存在，请更换！"));
					return false;
				}
				$table="supermarket";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"no"=>$data->no,
					"sno"=>$data->sno,
					"name"=>$data->name,
					"type"=>0,
					"logo"=>strstr($data->logo,'http')?$data->logo:SERVER_IP.($data->logo),
					"status"=>$data->status,
					"addtime"=>$time,
					"edittime"=>$time,
				);
			break;
			case "subsupermarket":
				if($this->getdata->isExist('supermarket',array('sno'=>$data->sno))){
					echo json_encode(array("result"=>"failed","message"=>"超市编号已经存在，请更换！"));
					return false;
				}
				$table="supermarket";
				$time=date("Y-m-d H:i:s");
				$supermarket=$this->getdata->getContent('supermarket',$data->supermarket);
				$info=array(
					"no"=>$supermarket->no,
					"sno"=>$data->sno,
					"name"=>$supermarket->name,
					"sname"=>$data->sname,
					"type"=>1,
					"province"=>$data->province,
					"city"=>$data->city,
					"area"=>$data->area,
					"detailedarea"=>$data->detailedarea,
					"logo"=>strstr($data->logo,'http')?$data->logo:SERVER_IP.($data->logo),
					"lng"=>$data->lng,
					"lat"=>$data->lat,
					"status"=>$data->status,
					"addtime"=>$time,
					"edittime"=>$time
				);
			break;
			case "activity":
				    $table="activity"; 
					$time=date("Y-m-d H:i:s");
					if($data->name == '1')
					{
			
						$info=array(
							"sid"=>$data->sid,
							"name"=>$data->name,
							"content"=>$data->content,
							"thumbnail1"=>$data->thumbnail,
							"fullprice"=>$data->fullprice,
							"reduceprice"=>$data->reduceprice,
							"begintime"=>$data->begintime,
							"endtime"=>$data->endtime,
							"addtime"=>$time,
							"status"=>$data->status
							);
					}
				
				
				
			break;
			// case "essay":
			// 	$table="essay";
			// 	$info=array(
			// 		"column"=>$data->column,
			// 		"title"=>$data->title,
			// 		"islink"=>$data->islink,
			// 		"link"=>$data->link,
			// 		"summary"=>$data->summary,
			// 		"content"=>$data->content,
			// 		"thumbnail"=>$data->thumbnail,
			// 		"author"=>1,
			// 		"time"=>date("Y-m-d H:i:s")
			// 	);
			// 	if(isset($data->author)){
			// 		$info['author']=$data->author;
			// 	}
			// 	if(isset($data->avatar)){
			// 		$info['authorAvatar']=$data->avatar;
			// 	}
			// break;
			// case "user":
			// 	if($data->validcode!=$_SESSION['authcode']){
			// 		echo json_encode(array("result"=>"failed","message"=>"验证码错误！"));
			// 		return false;
			// 	}
			// 	$table='user';
			// 	$info=array(/
			// 		"email"=>$data->email,
			// 		"password"=>md5('SXJY'.($data->password)),
			// 		"time"=>date("Y-m-d H:i:s")
			// 	);
		}
		$result=$this->dbHandler->insertData($table,$info);
		//var_dump($result);
		if($result==1)echo json_encode(array("result"=>"success","message"=>"信息写入成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息写入失败"));
	}
	public function addBulkInfo(){
		//var_dump($_POST['data']);
		$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		switch($data->infoType){
			case "coupons":
				$table="coupon";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"sid"=>$data->sid,
					"facevalue"=>$data->facevalue,
					"useprice"=>$data->useprice,
					"beginvalid"=>$data->beginvalid,
					"endvalid"=>$data->endvalid,
					"addtime"=>$time,
					"edittime"=>$time
				);
				$users=array();

				if($data->buyerid==0)
				{
					$allUsers=$this->getdata->getBuyers(array('result'=>'data'));
					foreach ($allUsers as $key => $value) 
					{
						$users[]=$value->id;
					}
				}
				else
				{
					$usersLinecode=explode(',',$data->buyerid);
					foreach ($usersLinecode as $value) 
					{
						$user=$this->getdata->getContentAdvance('buyer',array('linecode'=>$value));
						if(isset($user->id))
						{
							$users[]=$user->id;
						}
					}
				}

				
				foreach ($users as $value) 
				{
					$info['buyerid']=$value;
					$result=$this->dbHandler->insertData($table,$info);
				}
				// if($data->pushmsg=='1'){
				// 	$pushUrl='http://182.92.156.106:9080/CDB/buyer/sendcoupons';
				// 	$ids=implode(',',$users);
				// 	httpPost($pushUrl,array('ids'=>$ids));
				// }
			break;
		}

			
		echo json_encode(array("result"=>"success","message"=>"信息写入成功"));
	}
	public function modifyInfo(){

		$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		$where=array();
		switch($data->infoType){
			case "banner":
				$table="banner";
				$where=array('id'=>$data->id);
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->title)){
					$info['title']=$data->title;
				}
				if(isset($data->introduction)){
					$info['introduction']=$data->introduction;
				}
				if(isset($data->content)){
					$info['content']=$data->content;
				}
				if(isset($data->thumbnail)){
					$info['thumbnail']=strstr($data->thumbnail,'http')?$data->thumbnail:SERVER_IP.($data->thumbnail);
				}
				if(isset($data->order)){
					$info['order']=$data->order;
				}
				if(isset($data->draft)){
					$info['draft']=$data->draft;
				}

			break;
			case "aboutus":
				$table="aboutus";
				$where=array('id'=>$data->id);
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->role)){
					$info['role']=$data->role;
				}
				if(isset($data->content)){
					$info['content']=$data->content;
				}
				if(isset($data->logo)){
					$info['logo']=strstr($data->logo,'http')?$data->logo:SERVER_IP.($data->logo);
				}
				if(isset($data->appname)){
					$info['appname']=$data->appname;
				}
				if(isset($data->version)){
					$info['version']=$data->version;
				}
			break;
			case "buyer":
				$table="buyer";
				$where=array('id'=>$data->id);
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->alias)){
					$info['alias']=$data->alias;
				}
				if(isset($data->gender)){
					$info['gender']=$data->gender;
				}
				if(isset($data->photo)){
					$info['photo']=strstr($data->photo,'http')?$data->photo:SERVER_IP.($data->photo);
				}
				if(isset($data->birthdate)){
					$info['birthdate']=$data->birthdate;
				}
				if(isset($data->phone)){
					$info['phone']=$data->phone;
				}
				if(isset($data->status)){
					$info['status']=$data->status;
				}

			break;
			case "seller":
				$table="seller";
				$where=array('id'=>$data->id);
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->sid)){
					$info['sid']=$data->sid;
				}
				if(isset($data->name)){
					$info['name']=$data->name;
				}
				if(isset($data->gender)){
					$info['gender']=$data->gender;
				}
				if(isset($data->photo)){
					$info['photo']=$data->photo==""?'':(strstr($data->photo,'http')?$data->photo:SERVER_IP.($data->photo));
				}
				if(isset($data->workno)){
					$info['workno']=$data->workno;
				}
				if(isset($data->role)){
					$info['role']=$data->role;
				}
				if(isset($data->phone)){
					$info['phone']=$data->phone;
				}
				if(isset($data->password)){
					$info['password']=md5($data->password."63");
				}
				if(isset($data->status)){
					$info['status']=$data->status;
				}

			break;
			case "supermarket":
				$table="supermarket";
				$where=array('id'=>$data->id);
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->no)){
					if($this->getdata->isModifyExist('supermarket',$data->id,array('no'=>$data->no,'type'=>0))){
						echo json_encode(array("result"=>"failed","message"=>"超市代码已经存在，请更换！"));
						return false;
					}
					$info['no']=$data->no;
				}
				if(isset($data->sno)){
					if($this->getdata->isModifyExist('supermarket',$data->id,array('sno'=>$data->sno))){
						echo json_encode(array("result"=>"failed","message"=>"超市编号已经存在，请更换！"));
						return false;
					}
					$info['sno']=$data->sno;
				}
				if(isset($data->name)){
					$info['name']=$data->name;
				}
				if(isset($data->sname)){
					$info['sname']=$data->sname;
				}
				if(isset($data->province)){
					$info['province']=$data->province;
				}
				if(isset($data->city)){
					$info['city']=$data->city;
				}
				if(isset($data->area)){
					$info['area']=$data->area;
				}
				if(isset($data->detailedarea)){
					$info['detailedarea']=$data->detailedarea;
				}
				if(isset($data->logo)){
					$info['logo']=strstr($data->logo,'http')?$data->logo:SERVER_IP.($data->logo);
				}
				if(isset($data->lng)){
					$info['lng']=$data->lng;
				}
				if(isset($data->lat)){
					$info['lat']=$data->lat;
				}
				if(isset($data->status)){
					$info['status']=$data->status;
				}
			break;
			case "product":
				$table="goods";
				$where=array('id'=>$data->id);
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->sid)){
					$info['sid']=$data->sid;
				}
				if(isset($data->name)){
					$info['name']=$data->name;
				}
				if(isset($data->barcode)){
					$info['barcode']=$data->barcode;
				}
				if(isset($data->sid)){
					$info['sid']=$data->sid;
				}

				if(isset($data->expressfee)){
					$info['expressfee']=$data->expressfee;
				}
				if(isset($data->count)){
					$info['count']=$data->count;
				}
				if(isset($data->description)){
					$info['description']=$data->description;
				}
				if(isset($data->detailedname)){
					$info['detailedname']=$data->detailedname;
				}
				if(isset($data->price)){
					$info['price']=$data->price;
				}
				if(isset($data->photo)){

					$info['pic1']=strstr($data->photo,'http')?$data->photo:SERVER_IP.($data->photo);
				}
				if(isset($data->isattend)){
					$info['isattend']=$data->isattend;
				}
				if(isset($data->isrecommend)){
					$info['isrecommend']=$data->isrecommend;
				}
				if(isset($data->isedit)){
					$info['isedit']=$data->isedit;
				}
				if(isset($data->categoryid)){
					$info['categoryid']=$data->categoryid;
				}
				if(isset($data->status)){
					$info['status']=$data->status;
				}
			break;

			case "category":
				$table="category";
				$where=array('id'=>$data->id);
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->sid)){
					$info['sid']=$data->sid;
				}
				if(isset($data->name)){
					$info['name']=$data->name;
				}
				if(isset($data->order)){
					$info['order']=$data->order;
				}
			break;
			// case "essay":
			// 	$table="essay";
			// 	$where=array('id'=>$data->id);
			// 	$info=array(
			// 		"column"=>$data->column,
			// 		"title"=>$data->title,
			// 		"summary"=>$data->summary,
			// 		"islink"=>$data->islink,
			// 		"link"=>$data->link,
			// 		"content"=>$data->content,
			// 		"thumbnail"=>$data->thumbnail,
			// 		"time"=>date("Y-m-d H:i:s")
			// 	);
			// 	if(isset($data->author)){
			// 		$info['author']=$data->author;
			// 	}
			// 	if(isset($data->avatar)){
			// 		$info['authorAvatar']=$data->avatar;
			// 	}
			// break;
		}
		$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息修改成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息修改失败"));
	}
	public function deleteInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		switch($data->infoType){
			case 'banner':
				$condition['table']="banner";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'buyer':
				$condition['table']="buyer";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'seller':
				$condition['table']="seller";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'supermarket':
				$condition['table']="supermarket";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'product':
				$condition['table']="goods";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'category':
				$condition['table']="category";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'order':
				$condition['table']="order";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'address':
				$condition['table']="address";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'comment':
				$condition['table']="comment";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'coupon':
				$condition['table']="coupon";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'advice':
				$condition['table']="advice";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'aboutus':
				$condition['table']="aboutus";
				$condition['where']=array("id"=>$data->id);
			break;
            case 'activity':
				$condition['table']="activity";
				$condition['where']=array("id"=>$data->id);
			break;
			
			
			// case 'essay':
			// 	$condition['table']="essay";
			// 	$condition['where']=array("id"=>$data->id);
			// break;
		}
		$result=$this->dbHandler->deleteData($condition);
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息删除成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息删除失败"));
	}
	public function deleteBulkInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		switch($data->infoType){
			case 'banners':
				$table="banner";
				$where="id";
			break;
			case 'buyers':
				$table="buyer";
				$where="id";
			break;
			case 'sellers':
				$table="seller";
				$where="id";
			break;
			case 'supermarkets':
				$table="supermarket";
				$where="id";
			break;
			case 'products':
				$table="goods";
				$where="id";
			break;
			case 'categories':
				$table="category";
				$where="id";
			break;
			case 'orders':
				$table="order";
				$where="id";
			break;
			case 'addresses':
				$table="address";
				$where="id";
			break;
			case 'comments':
				$table="comment";
				$where="id";
			break;
			case 'coupons':
				$table="coupon";
				$where="id";
			break;
			case 'advices':
				$table="advice";
				$where="id";
			break;
			case 'aboutuss':
				$table="aboutus";
				$where="id";
			break;
			case 'activity':
				$table="activity";
				$where="id";
			break;
		}
		foreach ($data->idArray as $value) {
			$result=$this->dbHandler->deleteData(array('table'=>$table,'where'=>array($where=>$value)));
		}
		echo json_encode(array("result"=>"success","message"=>"信息删除成功"));
	}

    //添加一级分类
    public function addCategory()
    {
    	$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		switch($data->infoType)
		{
	    	case "category":
	    	        if($this->getdata->isExist('category',array('supername'=>$data->supername,'sid'=>$data->sid)))
	    	        {
						echo json_encode(array("result"=>"failed","message"=>"该一级分类已经存在，请更换！"));
						return false;
					}
					$table="category";
					$time=date("Y-m-d H:i:s");
					$info=array
					(
						"sid"=>$data->sid,
						"supername"=>$data->supername,
						"order"=>$data->order,
						"addtime"=>$time,
						"edittime"=>$time
					);
			break;
		}
		$result=$this->dbHandler->insertDataReturnId($table,$info);
		//var_dump($result);
		// $result=$this->dbHandler->insertDataReturnId($table,$info);
		// print_r($result);
		if(!empty($result))
		{
			$table="category";
			$where=array('id'=>$result);
		    $result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>array('superid'=>$result)));
		    if($result==1) echo json_encode(array("result"=>"success","message"=>"信息修改成功"));
		    else echo json_encode(array("result"=>"failed","message"=>"信息修改失败"));
		}
	}

	// public function getInfo(){
	// 	$condition=array();
	// 	$data=json_decode($_POST['data']);
	// 	$result=array();
	// 	switch($data->infoType){
	// 		// case 'essay':
	// 		// 	$result=$this->getdata->getContent('essay',$data->id);
	// 		// break;
	// 		// case 'login':
	// 		// 	if(property_exists($data, "email") && property_exists($data, "password")){
	// 		// 		$email=$data->email;
	// 		// 		$password=$data->password;
	// 		// 		$info=$this->getdata->getContentAdvance('user',array('email'=>$email));
	// 		// 		if(property_exists($info,'email')){
	// 		// 			$post_pwd=MD5("SXJY".$password);
	// 		// 			$db_pwd=$info->password;
	// 		// 			if($post_pwd==$db_pwd){
	// 		// 				$_SESSION['useremail']=$info->email;
	// 		// 				$_SESSION['userid']=$info->id;
	// 		// 				$_SESSION['usertype']="user";
	// 		// 				echo json_encode(array("result"=>"success","message"=>"登录成功!"));
	// 		// 				return false;
	// 		// 			}
	// 		// 			else{
	// 		// 				echo json_encode(array("result"=>"failed","message"=>"密码错误!"));
	// 		// 				return false;
	// 		// 			}
	// 		// 		}
	// 		// 		else{
	// 		// 			echo json_encode(array("result"=>"failed","message"=>"用户名不存在!"));
	// 		// 			return false;
	// 		// 		}
	// 		// 	}else{
	// 		// 		echo json_encode(array("result"=>"failed","message"=>"请输入用户名和密码!"));
	// 		// 		return false;
	// 		// 	}
	// 		// break;
	// 		case 'logout':
	// 			unset($_SESSION["useremail"]);
	// 			unset($_SESSION["userid"]);
	// 			unset($_SESSION["usertype"]);
	// 			$result='成功退出！';
	// 		break;
	// 		case 'subSupermarkets':
	// 			$result=$this->getdata->getSubSupermarkets($data->id);
	// 		break;
	// 		case 'supermarket':
	// 			$result=$this->getdata->getContent('supermarket',$data->id);
	// 		break;
	// 		case 'categories':
	// 			$result=$this->getdata->getCategories(
	// 				array(
	// 					'result'=>'data',
	// 					'sid'=>$data->id,
	// 					'orderBy'=>array('order'=>'ASC')
	// 				)
	// 			);
	// 		break;
	// 	}
	// 	echo json_encode(array("result"=>"success","message"=>$result));
	// }

	public function getInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		$result=array();
		switch($data->infoType){
			// case 'essay':
			// 	$result=$this->getdata->getContent('essay',$data->id);
			// break;
			// case 'login':
			// 	if(property_exists($data, "email") && property_exists($data, "password")){
			// 		$email=$data->email;
			// 		$password=$data->password;
			// 		$info=$this->getdata->getContentAdvance('user',array('email'=>$email));
			// 		if(property_exists($info,'email')){
			// 			$post_pwd=MD5("SXJY".$password);
			// 			$db_pwd=$info->password;
			// 			if($post_pwd==$db_pwd){
			// 				$_SESSION['useremail']=$info->email;
			// 				$_SESSION['userid']=$info->id;
			// 				$_SESSION['usertype']="user";
			// 				echo json_encode(array("result"=>"success","message"=>"登录成功!"));
			// 				return false;
			// 			}
			// 			else{
			// 				echo json_encode(array("result"=>"failed","message"=>"密码错误!"));
			// 				return false;
			// 			}
			// 		}
			// 		else{
			// 			echo json_encode(array("result"=>"failed","message"=>"用户名不存在!"));
			// 			return false;
			// 		}
			// 	}else{
			// 		echo json_encode(array("result"=>"failed","message"=>"请输入用户名和密码!"));
			// 		return false;
			// 	}
			// break;
			case 'logout':
				unset($_SESSION["useremail"]);
				unset($_SESSION["userid"]);
				unset($_SESSION["usertype"]);
				$result='成功退出！';
			break;
			case 'subSupermarkets':
				$result=$this->getdata->getSubSupermarkets($data->id);
			break;
			case 'supermarket':
				$result=$this->getdata->getContent('supermarket',$data->id);
			break;
			case 'categories':
				$result=$this->getdata->getCategory(
					array(
						'result'=>'data',
						'sid'=>$data->id,
						'orderBy'=>array('order'=>'ASC')
					)
				);
			break;
		}
		echo json_encode(array("result"=>"success","message"=>$result));
	}
	public function uploadImage(){
		$result=upload("image");
		echo json_encode($result);

	}
	public function setLanguage(){
		$_SESSION['language']=$_POST['language'];
	}
	public function createVeriCode(){
		veri_code();
	}
	/*
	public function checkMobileCode(){
		if(isset($_POST['code']) && strcasecmp($_POST['code'],$_SESSION['mobilecode'])==0){
			echo json_encode(array("result"=>"success","message"=>"Right Security code!"));
		}else{
			echo json_encode(array("result"=>"failed","message"=>"Wrong Security code!"));
		}
	}
	public function checkEmail(){
		if(!$this->commongetdata->checkUniqueAdvance("user",array("user_email"=>$_POST['email']))){
			echo json_encode(array("result"=>"notunique","message"=>"The email already exists!"));
			return false;
		}else{
			echo json_encode(array("result"=>"failed","message"=>"验证码输入错误！"));
		}
	}
	public function checkUsername(){
		if(!$this->commongetdata->checkUniqueAdvance("user",array("user_username"=>$_POST['username']))){
			echo json_encode(array("result"=>"notunique","message"=>"The username already exists!"));
			return false;
		}else{
			echo json_encode(array("result"=>"success","message"=>"Success!"));
		}
	}
	public function checkEmailExist(){
		if(!$this->commongetdata->checkUniqueAdvance("user",array("user_email"=>$_POST['email']))){
			echo json_encode(array("result"=>"notunique","message"=>"The email already exists!"));
			return false;
		}else{
			echo json_encode(array("result"=>"failed","message"=>"验证码输入错误！"));
		}
	}
	public function exportExcel($title,$subject,$description,$header,$data){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("AiiMai");
		$objPHPExcel->getProperties()->setLastModifiedBy("AiiMai");
		$objPHPExcel->getProperties()->setTitle($title);
		$objPHPExcel->getProperties()->setSubject($subject);
		$objPHPExcel->getProperties()->setDescription($description);
		$objPHPExcel->setActiveSheetIndex(0);
		//设值
		$letterArray=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		foreach($header as $index=>$field){
			$objPHPExcel->getActiveSheet()->setCellValue($letterArray[$index].'1',$field);
		}
		foreach($data as $key=>$value){
			foreach($value as $k=>$v){
				$objPHPExcel->getActiveSheet()->setCellValue($letterArray[$k].($key+2),$v);
			}
		}
		// Save Excel 2007 file
		//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		$fileName='uploads/'.$title.date("Ymd").'.xls';
		$objWriter->save($fileName);
//		$this->load->view('redirect',array("url"=>"/uploads/".$title.date("Ymd").".xls"));
		return '/'.$fileName;
	}*/
}