<?php
/**
 * 用户与用户组映射Model
 * @category   webpaste
 * @author    尛柒
 */
Class Role_userModel extends Model{
	//atuo validate Fields role_id-require-checkroleid(exists) user_id-require-checkuserid(exists)-checkUser(exists_role)
	protected $_validate = array(
		array('role_id','require','用户组ID必须填写',1,'',3),
		array('role_id','checkroleid','用户组ID不存在',1,'callback',3),
		array('user_id','require','用户ID必须填写',1,'',3),
		array('user_id','checkuserid','用户ID不存在',1,'callback',3),
		array('user_id','checkUser','用户ID已经有一个用户组',1,'callback',1),
	);
	//checkroleid-exists
	protected function checkroleid($data){
		return M('Role')->find($data)?true:false;
	}
	//checkuserid-exists
	protected function checkuserid($data){
		return M('User')->find($data)?true:false;
	}
	//checkUser-exists_role
	protected function checkUser($data){
		$map['user_id']=array('eq',$data);
		return $this->where($map)->select()?false:true;

	}
}
?>