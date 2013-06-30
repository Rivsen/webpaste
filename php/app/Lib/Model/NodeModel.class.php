<?php
/**
 * 节点Model
 * @category   webpaste
 * @author    尛柒
 */
Class NodeModel extends Model{
	//auto Fields status-1 sort-0
	protected $_auto=array(
		array('status','1'),
		array('sort','0'),
	);
	//atuo validate Fields name-require title-require pid-require-checkPid(exists)
	protected $_validate = array(
		array('name','require','节点名称必须填写',1,'',3),
		array('title','require','节点标题必须填写',1,'',3),
		array('pid','require','父级ID必须填写',1,'',3),
		array('pid','checkPid','父级ID不存在',1,'callback',3),
	);
	//checkPid-exists
	protected function checkPid($data){
		return $data==0?true:$this->getPidInfo($data)?true:false;
	}
	//getPidInfo 
	public function getPidInfo($pid){
		$node=$this->find($pid);
		return $node;
	}
	//_before_insert auto Fields level
	protected function _before_insert(&$data,$options){
		$l=$this->getPidInfo($data['pid']);
		$level=$l?$l['level']:0;
		$level++;
		$data['level']=$level;
		if(!in_array($level, array(1,2,3))){
			$this->error='等级超出限制';
			return false;
		}
	}
}
?>