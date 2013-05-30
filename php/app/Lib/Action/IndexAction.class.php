<?php
class IndexAction extends Action{
    public $mode = array(
        "text",
        "ace",
        "dart",
        "logiql",
        "sh",
        "theme-kr",
        "ext-elastic_tabstops_lite",
        "diff",
        "lsl",
        "snippets",
        "theme-merbivore",
        "ext-emmet",
        "django",
        "lua",
        "sql",
        "theme-merbivore_soft",
        "ext-keybinding_menu",
        "dot",
        "luapage",
        "stylus",
        "theme-mono_industrial",
        "ext-modelist",
        "erlang",
        "lucene",
        "svg",
        "theme-monokai",
        "ext-options",
        "forth",
        "makefile",
        "tcl",
        "theme-pastel_on_dark",
        "ext-searchbox",
        "ftl",
        "markdown",
        "tex",
        "theme-solarized_dark",
        "ext-settings_menu",
        "glsl",
        "mushcode_high_rules",
        "textile",
        "theme-solarized_light",
        "ext-spellcheck",
        "golang",
        "mushcode",
        "text",
        "theme-terminal",
        "ext-static_highlight",
        "groovy",
        "objectivec",
        "tmsnippet",
        "theme-textmate",
        "ext-statusbar",
        "haml",
        "ocaml",
        "toml",
        "theme-tomorrow",
        "ext-textarea",
        "haskell",
        "pascal",
        "typescript",
        "theme-tomorrow_night_blue",
        "ext-themelist",
        "haxe",
        "perl",
        "vbscript",
        "theme-tomorrow_night_bright",
        "ext-whitespace",
        "html",
        "pgsql",
        "velocity",
        "theme-tomorrow_night_eighties",
        "keybinding-emacs",
        "html_ruby",
        "php",
        "xml",
        "theme-tomorrow_night",
        "keybinding-vim",
        "ini",
        "powershell",
        "xquery",
        "theme-twilight",
        "abap",
        "jade",
        "prolog",
        "yaml",
        "theme-vibrant_ink",
        "actionscript",
        "java",
        "properties",
        "theme-ambiance",
        "theme-xcode",
        "asciidoc",
        "javascript",
        "python",
        "theme-chaos",
        "worker-coffee",
        "autohotkey",
        "jsoniq",
        "rdoc",
        "theme-chrome",
        "worker-css",
        "batchfile",
        "json",
        "rhtml",
        "theme-clouds",
        "worker-javascript",
        "c9search",
        "jsp",
        "r",
        "theme-clouds_midnight",
        "worker-json",
        "c_cpp",
        "jsx",
        "ruby",
        "theme-cobalt",
        "worker-lua",
        "clojure",
        "julia",
        "rust",
        "theme-crimson_editor",
        "worker-php",
        "coffee",
        "latex",
        "sass",
        "theme-dawn",
        "worker-xquery",
        "coldfusion",
        "less",
        "scad",
        "theme-dreamweaver",
        "csharp",
        "liquid",
        "scala",
        "theme-eclipse",
        "css",
        "lisp",
        "scheme",
        "theme-github",
        "curly",
        "livescript",
        "scss",
        "theme-idle_fingers"
    );
    public function index(){
        $this->display();
    }

    public function show() {
        $model = M("paste");
        if( $this->_get('id') > 0 ) {
            $result = $model->where('id='.$this->_get('id'))->select();
            if( count($result) > 0 ) {
                $result = $result[0];
                $show = true;
            } else {
                $show = false;
            }
        } else {
            $show = false;
        }

        $this->assign('show', $show);
        $this->assign('code', $result);
        $this->display();
    }

    public function submit(){
        if( $this->isPost() ) {
            $id = 0;
            $mode = $this->_post("mode");
            $code = $this->_post("code");

            if( in_array($mode, $this->mode) ) {
                $datetime = date( 'Y-m-d H:i:s' );
                $model = M("paste");
                $result = $model->add(array('mode'=>$mode, 'code'=>$code, 'publish'=>$datetime));
                $this->ajaxReturn($result, "保存完成！<a href=\"".U('Index/show').'/'.$result."\">点击查看</a>", $result);
                die();
            }

            $this->ajaxReturn(0, "保存失败！提交的代码类型不正确！", 0);
        } else {
            $this->ajaxReturn(0, "请使用post方式提交。", 0);
        }
    }
}
