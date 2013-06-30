<?php
/**
 * 权限Model
 * @category   webpaste
 * @author    尛柒
 */
Class AccessModel extends Model{
		//atuo validate Fields role_id-require-checkroleid(exists) node_id-require-checknodeid(exists)
	protected $_validate = array(
		array('role_id','require','用户组ID必须填写',1,'',3),
		array('role_id','checkroleid','用户组ID不存在',1,'callback',3),
		array('node_id','require','节点ID必须填写',1,'',3),
		array('node_id','checknodeid','节点ID不存在',1,'callback',3),
	);
	//checkroleid-exists
	protected function checkroleid($data){
		return M('Role')->find($data)?true:false;
	}
	//checknodeid-exists
	protected function checknodeid($data){
		return $this->getNodeInfo($data)?true:false;
	}
	// get node info
	protected function getNodeInfo($node_id){
		return M('Node')->find($node_id);
	}
	//_before_insert (auto Fields pid level) validate access exists
	protected function _before_insert(&$data,$options){
		$map['role_id']=$data['role_id'];
		$map['node_id']=$data['node_id'];
		if ($this->where($map)->find()) {
			$this->error='该用户组已经存在此节点权限';
			return false;
		}
		$node=$this->getNodeInfo($data);
		$data['pid']=$node['pid'];
		$data['level']=$node['level'];
	}
}
?>