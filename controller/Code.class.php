<?php
header('content-type:text/html;charset=utf-8');


class Code{
    public $image;
    public $bgcolor;//    随机颜色
    public $fontSize=30;  //文字大小！
    public $seed = 'zxcvbnmasdfghjklqwertyuiop1234567890';
    public $color= '#FFFFFF';
    public $b;//背景的颜色
    public $length=4;//长度
    public $fontfile = 'libs/font.ttf';//字体！
    public $imageWidth=100;   //宽
    public $imageHeight=50; //高
    public $words='';//一会用来记录验证码文字的属性，到注册方法和POst上来的验证码进行对比！


//    构造函数只执行一次！所以想把随机颜色放进去，在引用是行不通的
    public function __construct(){
//        头部
        header('content-type:image/png');
//        资源
        $this->image = imagecreatetruecolor(200,50);
    }


    public function show(){

        $this->peise();//配色4
        $this->yanzhengma();//验证码1  内有随机数

        $this->ganrao();//干扰线2
        $this->dian();//干扰点3
//最下面执行！
        $this->huabu();


        $this->_session();  //存下验证码  。一会到memder类里进行对比


    }

//            配色开始
    public function peise(){
//        背景颜色
        $this->b = imagecolorallocate($this->image,0,0,hexdec($this->color));
        //填充，就是当背景
        imagefill($this->image,0,0,$this->b);
    }



//    写验证码  写字！
    public function yanzhengma(){
        for ($i=0;$i<$this->length;$i++){
//    循环种子随机数  获得字符串
            $num = mt_rand(0,strlen($this->seed)-1);
//           通过for循环把每次得到的文字的第几号存在words属性里！。一会方法$SESSION里。于注册时输入的比较！！！！！！！！！！！！！！！！！！！！！！！！
            $this->words .= $this->seed[$num];
//    在随机颜色
            $this->bgcolor = imagecolorallocate($this->image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));

//    写字
//    参数：资源，文字大小。角度，x轴，Y轴，颜色，字体库。后面就是文字种子库里面的随机出来的第几个了 ！！
            imagettftext($this->image,
                $this->fontSize,
                mt_rand(-60,60),
                20+$i*$this->imageWidth/$this->length,//在水平的位置
                $this->imageHeight/2+$this->fontSize/2,//在垂直的位置
                $this->bgcolor,     //颜色
                $this->fontfile,    //字库
                $this->seed[$num]  //随机
            );
        }
    }


//    加干扰线
    public function ganrao(){
        //加干扰线
        for($i=0;$i<40;$i++){
//       在随机颜色
            $this->bgcolor = imagecolorallocate($this->image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
//    划线//参数：画布资源、起始点x坐标、起始点y坐标、结束点x坐标、结束点y坐标、颜色
            imageline($this->image,mt_rand(0,300),mt_rand(0,150),mt_rand(0,300),mt_rand(0,150),$this->bgcolor);
        }

    }



//    加干扰点
        public function dian(){
            //加干扰点
            for($i=0;$i<1000;$i++){
                //    在随机颜色
                $this->bgcolor = imagecolorallocate($this->image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
//    加点//参数，画布资源，x轴，y轴。颜色
                imagesetpixel($this->image,mt_rand(0,300),mt_rand(0,300),$this->bgcolor);
            }

        }



    //        最后一步
    public function huabu(){
//        输出
        imagepng($this->image);
//        销毁
        imagedestroy($this->image);

    }



    public function _session(){
//            开启
            session_start();
    //   把再for中得到的一长串文字中的第几号  当值，放心保险箱里   在注册判断方法里 进行于$POST上来的cope进行比较！
            $_SESSION['code'] = $this->words;




    }












}






