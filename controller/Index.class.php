<?php
header('content-type:text/html;charset=utf-8');

class Index{

//
    public function entry(){
//        开始是手动进入
//        通过三元判断进来显示主页  直接！ 通过手动输入属性c=index&a=entry进入后台登录注册主页！
           include 'view/login.html';
    }
}









