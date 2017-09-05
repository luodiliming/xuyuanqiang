<?php
header('content-type:text/html;charset=utf-8');


class Houtai{
// 防止一些人，没有通过注册和登录，直接复制后台网址，进入后台。做出的权限设置！
   public function index(){
            //开启！
            session_start();
//  判断里面没有$_SESSION['a']测试，就可以判断出它是没有通过注册和登录进来的！就让他返回注册页面
            if(!isset($_SESSION['a'])){
                echo"<script>alert('重新注册！');location.href='index.php?c=member&zc';</script>";
            }else{
//                有秘钥的话进入后台页面
                include "view/houtai.html";
            }
        }

}










