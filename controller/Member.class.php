<?php
header('content-type:text/html;charset=utf-8');

class Member{

            public $db;
    public function __construct(){ //执行函数，把数据库放进$db属性，好下面用
           $this->db = include "zcdb.php";
    }


//                  显示注册页面
            public function zc(){
//判断有之前的秘钥的话，可直接进入后台!
            session_start();   //开启！
            if(isset($_SESSION['a'])){
                echo"<script>alert('进入！');location.href='index.php?c=houtai&a=index';</script>";
                die;
            }
//没有的话，老老实实的跳到注册主页，给我注册
            include "view/zhuce.html";
            }



//          获得注册信息放进数据库
        public function zhuce(){
//                判断验证码
//            如果$SESSION['code']不等于$POST 上来的code的话！就返回注册
//                开启
                session_start();
                if ($_POST['code']!=$_SESSION['code']){
                    go('验证码不正确','index.php?c=member&a=zc');
                    die;

                }





        if(isset($_POST['name']) && isset($_POST['pwd'])) {
                $this->db[] = array(
                    'name'=>$_POST['name'],
                    'pwd'=>$_POST['pwd'],
                );

                //组合要写回去的字符串
        $str = "<?php \n\r return ".var_export($this->db,true)."\n\r ?>";
//              将信息写回db.php地址中
         file_put_contents('zcdb.php',$str);

//       /这里不需要开启了，上面已经开启过了！
//
//        注册时留下一个session中写入用来标注登录状态的变量，后面做测试！
         $_SESSION['a']=1;




//            注册成功进入通过中转进入houtai类。index方法，
               echo "
           <script>alert('注册成功！');
        location.href='index.php?c=houtai&a=index';
           </script>
          ";
            }
        }


//                  显示登录页面
            public function dl(){
                session_start();//开启！
//判断有之前的秘钥的话，可直接进入后台!
                if(isset($_SESSION['a'])){
                    echo"<script>alert('进入！');location.href='index.php?c=houtai&a=index';</script>";
                    die;
                }
//没有的话，老老实实的跳到注册主页，给我登录！
                include "view/login.html";
            }





//         获得登录信息于数据库进行循环对比！
            public function denglu(){
//                判断里面有$_post信息的话就走
                if(isset($_POST['name']) && isset($_POST['pwd'])){
//                    循环遍历数据库里面的内容  然后进行对比，知道，之前有注册过吗。。
                    foreach ($this->db as $k=>$v){
//                        循环判断$v的 昵称和 POST上来的内容 有符合的吗！ 还判断内容！
                        if($v['name'] == $_POST['name'] && $v['pwd']==$_POST['pwd']){
                            //        开启   判断成功！发张入场券
                            session_start();
                            $_SESSION['a']=1;
//        在session中写入用来标注登录状态的变量 ，做测试  相当于拿了入场券

//                          判断里面有勾选一周登录的话，有就开启保存一周秘钥
                            if(isset($_POST['ck'])){
//                          在cookie中，保存秘钥时间一周
                                setcookie(session_name(),session_id(),time()+7*24*3600,'/');
                            }


// 确认好了 通过中转，注意！进入的是index.php三元判断后，进入houtai类和index方法！
//在那里判断是否有秘钥，有的话就进入后台主页，没有秘钥就返回
//      目的是为了防止没有通过注册和登入，而直接复印后台网址而进入后台页面的人
                            echo "
                        <script>alert('进入！');
                        location.href='index.php?c=houtai&a=index';
                        </script>
                        ";
                        }//判断结束
                    }  //循环结束

//                输入错误echo跳转，必须放在foreach循环的外面，登录错误跳回中转跳回主页
                    echo "
            <script>alert('输入错误！');
           location.href='index.php?c=index&a=entry';
            </script>
            
            ";
                }
            }//循环对比结束


                //删除会话记录！
            public function shanchu(){
//首先要开启
                session_start();
//清除session    就会把自动登录作用删除掉！,需要用户手动登录！！！！！！！！！！！！！！！！！！！！！！
                session_destroy();
                session_unset();
//清除后跳转回主页
                echo "<script>alert('退出成功！');location.href='index.php?c=index&a=entry';</script>";
            }





//    显示验证码
    public function code(){
//        进入code类中！
        (new Code)->show();

    }











































}







