<?php


class Article{
    public $db;
//    构造方法
    public function __construct(){
        $this->db = include 'db.php';
    }

//    首页
    public function index(){
//获得到数据信息.放进变量中，在主页中遍历内容时用到！。如果不在index()方法申明下，
//        直接在index主页中写$db是用不了的
        $db = $this->db;
        include 'template/index.html';
    }

//    显示文章添加页面
    public function addshow(){
        include 'template/addshow.html';
    }

//    用来接收文章数据，并存入数据库文件的方法
    public function add(){

//         上传图片开始
////        如果上传有错误
//        if ($_FILES['pic']['error']!=0) {
//            $tofile = 'uploads/thumb.pic';
//        }else{
////        处理上传
//            is_dir('uploads') || mkdir('uploads');
//            $tofile = 'uploads/'.time().mt_rand(1,100000).'.'.pathinfo($_FILES['pic']['name'])['extension'];
////        移动文件
//            move_uploaded_file($_FILES['pic']['tmp_name'],$tofile);
//        }
//        处理上传图片结束

//            把添加文章的内容追加到数据库里
        $this->db[] = array(
            'name'=>$_POST['name'],
            'content'=>$_POST['content'],
//            'thumb'=>$tofile,
//            'time'=>time()
        );
//        将数据写回数据库文件
        $this->_write_db_file($this->db,'db.php');
        $this->_success('添加成功');

    }


//          显示文章编辑页面
    public function editshow(){
//   在调转到editshow时把数据库放进一个变量中，在editshow页面中用，不好直接用$this->db
        $db = $this->db;
        include 'template/editshow.html';
    }

//            修改标题内容，方法开始
        public function edit(){
//            处理上传图片开始
//        if ($_FILES['pic']['error']!=0) {
//            $tofile = 'uploads/thumb.pic';
//        }else{
//            is_dir('uploads') || mkdir('uploads');
////            获得地址
//            $tofile = 'uploads/'.time().mt_rand(1,100000).'.'.pathinfo($_FILES['pic']['name'])['extension'];
////           移动文件
//            move_uploaded_file($_FILES['pic']['tmp_name'],$tofile);
//        }
//        处理上传图片结束

//     edit方法POST到表单提交，隐藏域name为id.他的value是几号，这里就是几号
//     编辑修改完毕后，POST到了这里，把POST到的内容，在次追加到数据库里面的第几号！在将其写回去！
            $this->db[$_POST['id']]= array(
                'name'=>$_POST['name'],
                'content'=>$_POST['content'],
//                'thumb'=>$tofile,
//                'time'=>time()
            );
//            将数据写回数据库文件
        $this->_write_db_file($this->db,'db.php');
        $this->_success('编辑成功');
        }
//            修改方法结束


//            删除开始
        public function shanchu(){
            $s = $this->db;
            include 'template/shanchu.html';
        }
//            删除结束

//            删除方式
        public function sc(){

            unset($this->db[$_POST['id']]);
//                直接删除几号。然后在调用数据库重新填写
            $this->_write_db_file($this->db,'db.php');
            $this->_success('删除');
        }

//        显示内容开始
        public function show(){
//            数据库放进变量，内容主页用！
            $db = $this->db;
            include 'template/show.html';
        }

















//用来专门将数据写回数据库文件的方法
//第一个参数是要写入的数据（数组）
//第二个参数是要写到哪个文件里
    private function _write_db_file($db,$dbfilename){
//        组合要写回去的数据
        $str = "<?php \r\n return ".var_export($db,true)."\r\n ?>";
        file_put_contents($dbfilename,$str);
    }

//    成功提示的方法
    private function _success($msg,$tourl='wenindex.php'){
        echo "<script>
            alert('{$msg}');
            location.href = '{$tourl}';
        </script>";
    }

}