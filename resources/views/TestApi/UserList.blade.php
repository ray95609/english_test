@extends('layouts.app')

@section('content')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Studio Classroom Interview Project - Front-end Developer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        #app {
            padding-top: 1rem;
        }
        .main{
            margin: auto;
            width: 800px;
            height: inherit;
            box-shadow: gray 10px 10px 10px;
            border-radius: 20px;

        }
    </style>
</head>
<body>
<div id="app">
    <div class="container">
        <h1 class="h5 text-center">Studio Classroom Front-end Developer Mini Project</h1>

        <hr>

        <div class="text-center">
            <button type="button" class="btn btn-primary fetch">fetch</button>
            <button type="button" class="btn btn-warning parse">Parse</button>
        </div>

        <hr>


        <h2 class="h5 text-black-50">User Info</h2>
        {{--  注意class  --}}
        <dl class="row user-detail-info">
            <!-- This is an example -->
            <dt class="col-sm-3">First Name</dt>
            <dd class="col-sm-9"></dd>
            <dt class="col-sm-3">Last Name</dt>
            <dd class="col-sm-9"></dd>
            <dt class="col-sm-3">Company</dt>
            <dd class="col-sm-9"></dd>
            <dt class="col-sm-3">Phone</dt>
            <dd class="col-sm-9">
                <span style="color:red;"></span>
            </dd>
        </dl>
        <hr>

        <h2 class="h5 text-black-50">User List</h2>

        <table class="table table-sm table-bordered table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Name</th>
                <th scope="col">City</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>

            {{--  注意class  --}}
            <tbody class="user-data-raw">

            </tbody>
        </table>
    </div>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

    //儲存後端拿到的 user data
    let userDataInfo = {};

    //取得 ajax url 使用 blade 給 js url 網址
    let getUserDataUrl = "{{route('TestApiExample.TestApiGetUserData')}}"

    //點選fetch button 做 ajax
    $(".fetch").on('click',function(){
        $.ajax(getUserDataUrl,{
            type:'get',
            data:{
                "_token":"{{csrf_token()}}",
            },
            success:function (result){
                //debug 可以看拿取的參數
                console.log(result);

                //簡單判斷返回資料長度正常才做JS html 渲染
                if(result.length>0){
                    userDataInfo = result;
                    let html = makeTableHtml(userDataInfo,'fetch');
                    $(".user-data-raw").html(html);
                    //綁定 detail click
                    detailClickEvent('fetch');
                    //綁定 delete click
                    deleteClickEvent();
                }
            }
        });
    });

    //點選parse button 做 ajax ，其實不用再做一次 但是題目需求 雖然我覺得很蠢
    $(".parse").on('click',function(){
        $.ajax(getUserDataUrl,{
            type:'get',
            data:{
                "_token":"{{csrf_token()}}",
            },
            success:function (result){

                //debug 可以看拿取的參數
                console.log(result);

                //簡單判斷返回資料長度正常才做JS html 渲染
                if(result.length>0){
                    userDataInfo = result;
                    let html = makeTableHtml(userDataInfo,'parse');
                    $(".user-data-raw").html(html);
                    //綁定 detail click
                    detailClickEvent('parse');
                    //綁定 delete click
                    deleteClickEvent();
                }
            }
        });
    });

    /**
     * 需用function 包起來 因為當AJAX 請求完 才綁定 JS 事件
     * @function 點選detail 渲染
     * @param type
     */
    function detailClickEvent(type){
        //點選detail 去已經抓好的 user data 對應 點選ID 渲染 上方detail
        $(".detail").on('click',function(){

            console.log('clicked detail');
            let userDetailInfoHtml = "";
            let clickId = $(this).data('id');

            //渲染detail info
            $.each(userDataInfo,function(key,data){
                if(data.id===clickId){

                    let first_name = type==="fetch"?data.first_name:data.lower_first_name;
                    let last_name = type==="fetch"?data.last_name:data.lower_last_name;

                    userDetailInfoHtml += ' <dt class="col-sm-3">First Name</dt>';
                    userDetailInfoHtml += '<dd class="col-sm-9">'+first_name+'</dd>';
                    userDetailInfoHtml += '<dt class="col-sm-3">Last Name</dt>';
                    userDetailInfoHtml += '<dd class="col-sm-9">'+last_name+'</dd>';
                    userDetailInfoHtml += ' <dt class="col-sm-3">Company</dt>';
                    userDetailInfoHtml += ' <dd class="col-sm-9">'+data.company.name+'</dd>';
                    userDetailInfoHtml += '<dt class="col-sm-3">Phone</dt>';
                    let style = "";
                    if(data.is_red_phone===1){
                        style = 'style="color:red;"';
                    }
                    userDetailInfoHtml += '<dd class="col-sm-9"><span '+style+'>'+data.phone+'</span></dd>';
                    $(".user-detail-info").html(userDetailInfoHtml);
                }
            });
        });
    }

    /**
     * 需用function 包起來 因為當AJAX 請求完 才綁定 JS 事件
     *
     * @function 點選delete 刪除 table tr dom
     *
     */
    function deleteClickEvent(){
        $(".delete").on('click',function(){
            let clickId = $(this).data('id'); //渲染detail info
            $(".tr_"+clickId).remove();
        });
    }

    /**
     * 渲染table html
     * @param dataInfo ajax 拿到的 user info
     * @param type     判斷 是哪種
     * @returns {string}
     */
    function makeTableHtml(dataInfo,type){
        let userDataRawHtml = "";
        //使用JS 做渲染HTML
        $.each(dataInfo,function(key,data){
            //fetch 時使用 一般user name ， parse 使用 lower_username
            let username = type==="fetch"?data.username:data.lower_username;

            //fetch 時使用 一般 name ， parse 使用 lower_name
            let name = type==="fetch"?data.name:data.lower_name;

            //fetch 時使用 一般user email ， parse 使用 link_email
            let email = type==="fetch"?data.email:data.link_email;

            //標記 tr class 組成 tr_id 刪除時會使用到
            userDataRawHtml += '<tr class="tr_'+data.id+'">';
            userDataRawHtml += '<input type="hidden" name="id" value="' + data.id +'">';

            userDataRawHtml += '<td>' + username +'</td>';
            userDataRawHtml += '<td>' + name +'</td>';
            userDataRawHtml += '<td>' + data.address.city +'</td>';
            userDataRawHtml += '<td>' + email +'</td>';
            userDataRawHtml += '<td>';
            //注意此處HTML class 及 data id
            userDataRawHtml += '<button type="button" class="btn btn-info btn-sm detail" data-id="'+data.id+'">Detail</button>';
            //注意此處HTML class 及 data id
            userDataRawHtml += '<button type="button" class="btn btn-danger btn-sm delete" data-id="'+data.id+'">Delete</button>';
            userDataRawHtml += '</td>';
            userDataRawHtml += '</tr>';
        });
        return userDataRawHtml;
    }

</script>

@endsection
