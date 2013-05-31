<?php
/**
 * 粘贴代码：增改查
 * @category   ThinkPHP技术交流中心
 * @author   Rivsen, 尛柒
 */
class EmptyAction extends Action{
    //代码类型
    //31/5 10:50 Tears - 修改了排序和 删除多余类型
    public $mode = array(
        "php",
        "html",
        "javascript",
        "css",
        "text",
        "sql",
        "xml",
        "golang",
        "ruby ",
        "jsp",
        "java",
        "ini",
        "diff",
        "json",
    );
    //新增 和 修改的表单
    public function index(){
        $this->assign('mode',$this->mode);
        $this->display('Index:index');
    }
    //31/5 10:50 Tears - 新增修改加入口
    public function edit(){
        $this->get_code(); 
        $this->index();
    }
    //查看页面
    //31/5 10:50 Tears - 提炼出get_code 方法  用于查询逻辑
    public function show() {
        $this->get_code();        
        $this->display('Index:show');
    }
    //ajax提交地址  --  增
    // 31/5 10:50 Tears - 修改 - 修改URL 生成规则
    // 31/5 16:10 Tears - 添加代码非空判断
    public function submit(){
        if( $this->isPost() ) {
            $id =  $this->_post("id");// post id
            $mode = $this->_post("mode");
            $code = $this->_post("code");
            if (empty($code)) {
               $this->ajaxReturn(0, "保存失败！提交的代码不能为空！", 0);
            }
            if( in_array($mode, $this->mode) ) {
                $datetime = date( 'Y-m-d H:i:s' );
                $model = M("paste");
                $data = array('id'=>$id , 'mode'=>$mode, 'code'=>$code, 'publish'=>$datetime);
                $res = $model->save($data);
                $result = empty($id) ? $res : $id;
                $this->ajaxReturn($result, "保存完成！<a href=\"".U($result.'/show')."\">点击查看</a><br /> 查看地址<br /> 
                    <p>".$_SERVER["SERVER_NAME"].U($result.'/show'), $result);
                die();
            }
            $this->ajaxReturn(0, "保存失败！提交的代码类型不正确！", 0);
        } else {
            $this->ajaxReturn(0, "请使用post方式提交。", 0);
        }
    }
    // 代码查询逻辑
    private function get_code(){
        $model = M("paste");
        $id = MODULE_NAME;
        if( $id > 0 ) {
            $map['id']=array('eq',$id);
            $result = $model->where($map)->select();
            if( count($result) > 0 ) {
                $result = $result[0];
                $show = true;
            } else {
                $show = false;
            }
        } else {
            $show = false;
        }
        $this->assign('id', $id);
        $this->assign('show', $show);
        $this->assign('code', $result);
    }
}

