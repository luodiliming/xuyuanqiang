<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
include 'controller/Article.class.php';
include 'libs/functions.php';



$article = new Article();
//$article->index();
//获得get参数
$a = isset($_GET['a'])?$_GET['a']:'index';

$article->$a();


















