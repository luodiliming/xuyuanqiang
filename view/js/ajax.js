// 就相当于js的window.onload()，JQ嘛就用$(function)，就相当于让html内容先走完在走 JQ的意思
$(function(){
    // 2当form标签id为#wishform被提交的时候，就会自动触发这个submit方法，用到了JQ 接下来走ajax
    $('#wishform').submit(function(){

        // 发送ajax
        $.ajax({
            url:"index.php?c=message&a=addmsg",//数据发送地址
            type: 'post',//数据传输方式
            data:{//需要传送的数据，抓到昵称id和内容的id.val()。是获得到他们的值，
                'name':$('#username').val(),
                'content': $('#content').val()
            },
//        从类文件  返回的数据格式是json
            dataType:'json',
            //这是成功接收到返回结果后执行的函数
            success:function(data){
//                 console.log(data);
//                 alert(data.sta);
//                 判断如果sta==ok的话就 执行下面的
                if(data.sta=='ok'){
                    // 设置两个容器装昵称和内容
                    var name = $('#username').val();
                    var content = $('#content').val();
                    // 随机位置
                    var left = Math.floor(Math.random()*(500+1-0)+0);
                    var top = Math.floor(Math.random()*(500+1-0)+0);
 // 跟真实的一样！把上面的内容放进dl中，而且不能有空格。在次放进一个变量中！属于一个新的节点
                    var str = "<dl style='left:"+left+"px;top:"+top+"px;' class='paper a2'><dt><span class='username'>"+name+"</span><span class='num'>No.00001</span></dt><dd class='content'>"+content+"</dd><dd class='bottom'><span class='time'>今天08:30</span><a href='' class='close'></a></dd></dl>";
 // 将新节点追加到div id为main里面
                    $('#main').append(str);
                    // 关掉许愿框和背景
                    $('#send-form').hide();
                    $('#windowBG').remove();
                }

            },//这里是假如不成立的话就走这里
            error:function (err) {
                alert(err);
            }
        })

        // 触发之后的拦截
        return false;
    })

})