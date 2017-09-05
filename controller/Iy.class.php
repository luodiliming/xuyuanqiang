<?php
header('content-type:text/html;charset=utf-8');

class Iy{
    public $db;
    public function __construct()
    {
        $this->db = include 'db.php';
    }

    public function entry(){
//        这里放进数据$db数据库，才好在主页HTML对数据库进行遍历
        $db = $this->db;
        include 'view/ly.html';
    }
}