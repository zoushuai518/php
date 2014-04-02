<?php 
	/*
	* 名称: 分页类
	* 介绍: 适用于配合sql查询的分页
	* 作者: hetaoren <452649510@qq.com>
	* 创建时间: 2010-12-07
	* 最后修改: 2010-12-10
	*/
	
	class pager { 
		public $sql; //SQL查询语句 
		public $datanum; //查询所有的数据总记录数 
		public $page_size; //每页显示记录的条数 
		
		function __construct($sql,$page_size) { 
			$result = mysql_query($sql);
			$datanum = mysql_num_rows($result);
			$this->sql=$sql; 
			$this->datanum=$datanum; 
			$this->page_size=$page_size; 
		} 
		
		//当前页数 
		public function page_id() { 
			if($_SERVER['QUERY_STRING'] == ""){ 
				return 1; 
			}elseif(substr_count($_SERVER['QUERY_STRING'],"page_id=") == 0){ 
				return 1; 
			}else{ 
				return intval(substr($_SERVER['QUERY_STRING'],8)); 
			}
		} 
		
		//剩余url值 
		public function url() { 
			if($_SERVER['QUERY_STRING'] == ""){ 
				return ""; 
			}elseif(substr_count($_SERVER['QUERY_STRING'],"page_id=") == 0){ 
				return "&".$_SERVER['QUERY_STRING']; 
			}else{ 
				return str_replace("page_id=".$this->page_id(),"",$_SERVER['QUERY_STRING']); 
			}
		} 
		
		//总页数 
		public function page_num() { 
			if($this->datanum == 0){
				return 1;
			}else{
				return ceil($this->datanum/$this->page_size);
			}
		} 
	
		//数据库查询的偏移量 
		public function start() { 
			return ($this->page_id()-1)*$this->page_size; 
		} 
	
		//数据输出 
		public function sqlquery() { 
			return $this->sql." limit ".$this->start().",".$this->page_size;
		} 
	
		//获取当前文件名
		private function php_self() {
			return $_SERVER['PHP_SELF'];
		}
	
		//上一页
		private function pre_page() {
			if ($this->page_id() == 1) { //页数等于1
				return "<a href=".$this->php_self()."?page_id=1".$this->url().">上一页</a> ";
			}elseif ($this->page_id() != 1) { //页数不等于1
				return "<a href=".$this->php_self()."?page_id=".($this->page_id()-1).$this->url().">上一页</a> ";
			}
		}
	
		//显示分页
		private function display_page() {
			$display_page = "";
			if($this->page_num() <= 10){ //小于10页
				for ($i=1;$i<=$this->page_num();$i++)  //循环显示出页面
					$display_page .= "<a href=".$this->php_self()."?page_id=".$i.$this->url().">".$i."</a> ";
					return $display_page;
			}elseif($this->page_num() > 10){ //大于10页
				if($this->page_id() <= 6){
					for ($i=1;$i<=10;$i++)  //循环显示出页面
						$display_page .= "<a href=".$this->php_self()."?page_id=".$i.$this->url().">".$i."</a> ";
						return $display_page;
				}elseif(($this->page_id() > 6) && ($this->page_num()-$this->page_id() >= 4)){
					for ($i=$this->page_id()-5;$i<=$this->page_id()+4;$i++)  //循环显示出页面
						$display_page .= "<a href=".$this->php_self()."?page_id=".$i.$this->url().">".$i."</a> ";
						return $display_page;
				}elseif(($this->page_id() > 6) && ($this->page_num()-$this->page_id() < 4)){
					for ($i=$this->page_num()-9;$i<=$this->page_num();$i++)  //循环显示出页面
						$display_page .= "<a href=".$this->php_self()."?page_id=".$i.$this->url().">".$i."</a> ";
						return $display_page;
				}	
			}
		}
	
		//下一页
		private function next_page() {
			if ($this->page_id() < $this->page_num()) { //页数小于总页数
				return "<a href=".$this->php_self()."?page_id=".($this->page_id()+1).$this->url().">下一页</a> ";
			}elseif ($this->page_id() == $this->page_num()) { //页数等于总页数
				return "<a href=".$this->php_self()."?page_id=".$this->page_num().$this->url().">下一页</a> ";
			}
		}
	
		// 设置分页信息
		public function set_page_info() {
			$page_info = "共".$this->datanum."条 ";
			$page_info .= "<a href=".$this->php_self()."?page_id=1".$this->url().">首页</a> ";
			$page_info .= $this->pre_page();
			$page_info .= $this->display_page();
			$page_info .= $this->next_page();
			$page_info .= "<a href=".$this->php_self()."?page_id=".$this->page_num().$this->url().">尾页</a> ";
			$page_info .= "第".$this->page_id()."/".$this->page_num()."页";
			return $page_info;
		}
	
	}

?>