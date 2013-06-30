<?php
/**
 * 用户组Model
 * @category   webpaste
 * @author    尛柒
 */
Class RoleModel extends Model{
	//auto Fields status-1 
	protected $_auto=array(
		array('status','1'),
	);
	//atuo validate Fields name-require 
	protected $_validate = array(
		array('name','require','用户组名称必须填写',1,'',3),
		array('name','','用户组名称已经存在',1,'require',3),
	);
}
?>