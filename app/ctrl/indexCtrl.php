<?php
namespace app\ctrl;
class indexCtrl extends \core\app{
	public function index(){
		$temp = new \core\lib\model;
		print_r($temp);
		$data = 'hello';
		$title = '视图文件';
		$this->assign('title',$title);
		$this->assign('data',$data);
		$this->display('index.html');
	}
}