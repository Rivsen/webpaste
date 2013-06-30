<?php
return array(
    'DEFAULT_THEME' => 'bootstrap',
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'html',
    'URL_CASE_INSENSITIVE' =>true,
    'URL_MODEL' => 2,
    'TMPL_PARSE_STRING' =>array(
       '__PUBLIC__' => __ROOT__,
    ),

    // 'URL_ROUTER_ON'   => true,
    // 'URL_ROUTE_RULES' => array(
    //     '/^show\/(\d+)/' => 'Index/show?id=:1',
    //     '/^index\/show\/(\d+)/' => 'Index/show?id=:1',
    //     'submit' => 'Index/submit',
    // ),

    'DEFAULT_FILTER' => 'htmlspecialchars',
    //数据库配置
    'DB_PREFIX'=>'wps_',
    'DB_TYPE'=>'mysql',
    'DB_HOST'=>'localhost',
    'DB_NAME'=>'webpaste',
    'DB_USER'=>'webpaste',
    'DB_PWD'=>'webpaste',
    'DB_PORT'=>'3306',
    'LOG_RECORD' => true,

    /*
    'STATISTIC'=>true,
    'HTML_CACHE_ON' => true,
    'HTML_CACHE_TIME' => 180
     */

    //RBAC 相关配置 Tears
    
    'USER_AUTH_ON'              =>  true,
    'USER_AUTH_TYPE'            =>  2,      // 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'             =>  'wps_authId',   // 用户认证SESSION标记
    'ADMIN_AUTH_KEY'            =>  'wps_administrator',
    'USER_AUTH_MODEL'           =>  'user',   // 默认验证数据表模型
    'AUTH_PWD_ENCODER'          =>  'md5',  // 用户认证密码加密方式
    'USER_AUTH_GATEWAY'         =>  '/Login',// 默认认证网关
    'NOT_AUTH_MODULE'           =>  'Login',   // 默认无需认证模块
    'REQUIRE_AUTH_MODULE'       =>  '',     // 默认需要认证模块
    'NOT_AUTH_ACTION'           =>  '',     // 默认无需认证操作
    'REQUIRE_AUTH_ACTION'       =>  '',     // 默认需要认证操作
    'GUEST_AUTH_ON'             =>  true,    // 是否开启游客授权访问
    'GUEST_AUTH_ID'             =>  0,        // 游客的用户ID
    'DB_LIKE_FIELDS'            =>  'title|remark',
    'RBAC_ROLE_TABLE'           =>  'wps_role',
    'RBAC_USER_TABLE'           =>  'wps_role_user',
    'RBAC_ACCESS_TABLE'         =>  'wps_access',
    'RBAC_NODE_TABLE'           =>  'wps_node',
    
);
