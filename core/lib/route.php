<?php
namespace core\lib;
use core\lib\conf;
class route{
	public $ctrl;
	public $action;
	public  function __construct() {
		//xx.com/index/index
		//xx.com/index.php/index/index
		/**
		 * 1.隐藏index.php
		 * 2.获取url 参数部分
		 * 3.返回对应控制器和方法
		 */
		if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !='/'){
			//  /index/index
			$path = $_SERVER['REQUEST_URI'];			
			$pathArr = explode('/', trim($path,'/'));//去除字符串头尾的‘/’符号
			if(isset($pathArr[0])){
				$this->ctrl = $pathArr[0];
			}
			unset($pathArr[0]);
			if(isset($pathArr[1])){
				$this->action = $pathArr[1];
				unset($pathArr[1]);
			}else{
				$this->action = conf::get('ACTION','route');
			}
			//url 多余部分转换成GET
			//id/1/str/2/text/3
			$count = count($pathArr)+2;			
			$i = 2;
			while ($i<$count) {
				//判断是否出现 id/1/22 情况，则出现单数的时候
				if(isset($pathArr[$i+1])){
					$_GET[$pathArr[$i]] = $pathArr[$i+1];		
				}
				$i += 2;
			}	
			
		}else{
			$this->ctrl = conf::get('CTRL','route');
			$this->action = conf::get('ACTION','route');
		}
	}
}