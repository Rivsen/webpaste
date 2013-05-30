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
    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES' => array(
        '/^show\/(\d+)/' => 'Index/show?id=:1',
        '/^index\/show\/(\d+)/' => 'Index/show?id=:1',
        'submit' => 'Index/submit',
    ),
    'DEFAULT_FILTER' => 'htmlspecialchars',
    'DB_PREFIX'=>'',
    'DB_TYPE'=>'mysql',
    'DB_HOST'=>'localhost',
    'DB_NAME'=>'webpaste',
    'DB_USER'=>'root',
    'DB_PWD'=>'',
    'DB_PORT'=>'3306',
    'LOG_RECORD' => true,
    /*
    'STATISTIC'=>true,
    'HTML_CACHE_ON' => true,
    'HTML_CACHE_TIME' => 180
     */
);
