<?php
header('content-type:text/html;charset=utf-8');

class Message{
    public $db;
    public function __construct()
    {    //执行方法，引入数据库.放进$db里
        $this->db = include 'db.php';
    }

//    添加到数据库的方法
    public function addmsg(){
//        从AJAX,POST上来的昵称和内容，追加进暂存数据库
        $this->db[] = array(
            'name'=>$_POST['name'],
            'content'=>$_POST['content']
        );
//                        把暂存的数据库内容转成字符转。放进容器里
        $str = "<?php \r\n return ".var_export($this->db,true)."\r\n ?>";
//            移动文件，放进真数据库地址中！
        file_put_contents('db.php',$str);
//                对AJAX发送信息，说存进数据库了！ 并且以json（对象数组）的信息发送过去
        echo json_encode(array('sta'=>'ok'));
    }

}