<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// |         lanfengye <zibin_5257@163.com>
// +----------------------------------------------------------------------

class Page {
	
    // 分页栏每页显示的页数
    public $rollPage = 5;
    // 页数跳转时要带的参数
    public $parameter  ;
    // 默认列表每页显示行数
    public $listRows = 20;
    // 起始行数
    public $firstRow	;
    // 分页总页面数
    protected $totalPages  ;
    // 总行数
    protected $totalRows  ;
    // 当前页数
    protected $nowPage    ;
    // 分页的栏的总页数
    protected $coolPages   ;
    // 分页显示定制
    protected $config  =	array('header'=>'条记录','prev'=>'上一页','next'=>'下一页','first'=>'第一页','last'=>'最后一页','theme'=>' %totalRow% %header% %nowPage%/%totalPage% 页 %upPage% %downPage% %first%  %prePage%  %linkPage%  %nextPage% %end%');
    // 默认分页变量名
    protected $varPage;

    /**
     * 架构函数
     * @access public
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     */
    public function __construct($totalRows,$listRows='',$parameter='') {
        $this->totalRows    =   $totalRows;
        $this->parameter    =   $parameter;
        $this->varPage      =   C('VAR_PAGE') ? C('VAR_PAGE') : 'p' ;
        if(!empty($listRows)) {
            $this->listRows =   intval($listRows);
        }
        $this->totalPages   =   ceil($this->totalRows/$this->listRows);     //总页数
        $this->coolPages    =   ceil($this->totalPages/$this->rollPage);
        $this->nowPage      =   !empty($_GET[$this->varPage])?intval($_GET[$this->varPage]):1;
        if(!empty($this->totalPages) && $this->nowPage>$this->totalPages) {
            $this->nowPage  =   $this->totalPages;
        }
        $this->firstRow     =   $this->listRows*($this->nowPage-1);
    }

    public function setConfig($name,$value) {
        if(array_key_exists($name, $this->config)) {
            $this->config[$name]    =   $value;
        }
    }
    
    private function link($page, $tip) {
    	$param = array($this->varPage=>$page);
    	if(!empty($this->parameter)) {
    		if(is_string($this->parameter)) { // aaa=1&bbb=2 转换成数组
    			parse_str($this->parameter,$this->parameter);
    		}
    		$param = array_merge($this->parameter, $param);
    	}
    	return "<a href='".U("", $param)."'>{$tip}</a>";
    }

    /**
     * 分页显示输出
     * @access public
     * @author lanfengye <zibin_5257@163.com>
     */
    public function show() {
        if(0 == $this->totalRows) return '';
        $p              =   $this->varPage;
        $nowCoolPage    =   ceil($this->nowPage/$this->rollPage);
        
        //上下翻页字符串
        $upRow   = $this->nowPage-1;
        $downRow = $this->nowPage+1;
        if ($upRow>0){
            $upPage=$this->link($upRow, $this->config['prev']);
        }else{
            $upPage="";
        }

        if ($downRow <= $this->totalPages){
            $downPage=$this->link($downRow, $this->config['next']);
        }else{
            $downPage="";
        }
        // << < > >>
        $theFirst = "";
        $prePage = "";
        if($nowCoolPage != 1){
        	if($this->nowPage - $this->rollPage > 1) {
	            $preRow =  $this->nowPage-$this->rollPage;
	            $prePage = $this->link($preRow, "上{$this->rollPage}页");
        	}
            $theFirst = $this->link(1, $this->config['first']);
        }
        $nextPage = "";
        $theEnd="";
        if($nowCoolPage != $this->coolPages){
        	if($this->nowPage + $this->rollPage < $this->totalPages) {
            	$nextRow = $this->nowPage+$this->rollPage;
            	$nextPage = $this->link($nextRow, "下{$this->rollPage}页");
        	}
            $theEndRow = $this->totalPages;
            $theEnd = $this->link($theEndRow, $this->config['last']);
        }
        // 1 2 3 4 5
        $linkPage = "";
        for($i=1;$i<=$this->rollPage;$i++){
            $page= $this->nowPage == $this->totalPages ? $this->nowPage - $this->rollPage + $i : ($nowCoolPage-1)*$this->rollPage+$i;
            if($page!=$this->nowPage){
                if($page>0 && $page<=$this->totalPages){
                    $linkPage .= $this->link($page, " {$page} ");
                }else{
                    break;
                }
            }else{
                if($this->totalPages != 1){
                    $linkPage .= "&nbsp;<span class='current'>".$page."</span>";
                }
            }
        }
        $pageStr	 =	 str_replace(
            array('%header%','%nowPage%','%totalRow%','%totalPage%','%upPage%','%downPage%','%first%','%prePage%','%linkPage%','%nextPage%','%end%'),
            array($this->config['header'],$this->nowPage,$this->totalRows,$this->totalPages,$upPage,$downPage,$theFirst,$prePage,$linkPage,$nextPage,$theEnd),$this->config['theme']);
        return $pageStr;
    }

}