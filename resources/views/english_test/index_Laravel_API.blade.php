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

        .main {
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
            <a href="{{route('english_test.guzzle')}}">
                <button type="button" class="btn btn-primary fetch"
                        data-url="{{route('english_test.guzzle')}}">Fetch
                </button>
            </a>
            <button type="button" class="btn btn-warning">Parse</button>
        </div>

        <hr>
        @if(!Session::has('info'))
            <h2 class="h5 text-black-50">User Info</h2>
            <dl class="row">
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
        @endif


        @if(Session::has('info'))
            <h2 class="h5 text-black-50">User Info</h2>
            <dl class="row">
                <!-- This is an example -->
                <dt class="col-sm-3">First Name</dt>
                <dd class="col-sm-9">{{$guzzleDataArray['firstName']}}</dd>
                <dt class="col-sm-3">Last Name</dt>
                <dd class="col-sm-9">{{$guzzleDataArray['lastName']}}</dd>
                <dt class="col-sm-3">Company</dt>
                <dd class="col-sm-9">{{$guzzleDataArray['company']}}</dd>
                <dt class="col-sm-3">Phone</dt>
                <dd class="col-sm-9">{{$guzzleDataArray['phone']}}
                    <span style="color:red;"></span>
                </dd>
            </dl>
        @endif
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
            @if(!Session::has('success'))
                <tbody>
                <!-- This is an example -->
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="#"></a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm">Detail</button>
                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>

                </tbody>
            @endif
            @if(Session::has('success'))
                @for($i=0;$i<count($deresponse);$i++)
                    <tbody>
                    <!-- This is an example -->
                    <tr>
                        <input type="hidden" name="id" value="{{$showDataArray['id'][$i]}}">
                        <td>{{$showDataArray['username'][$i]}}</td>
                        <td>{{$showDataArray['name'][$i]}}</td>
                        <td>{{$showDataArray['city'][$i]}}</td>
                        <td>
                            <a href="#">{{$showDataArray['email'][$i]}}</a>
                        </td>
                        <td>
                            <a href="{{route('english_test.detail',['id'=>$showDataArray['id'][$i]])}}">
                                <button type="button" class="btn btn-info btn-sm">Detail</button>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>

                    </tbody>
                @endfor
            @endif
        </table>
    </div>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

    {{--$('.fetch').click(function (){--}}

    {{--    let ajaxUrl=$('.fetch').data('url');--}}

    {{--    $.ajax(--}}
    {{--        ajaxUrl,{--}}
    {{--            type:'get',--}}
    {{--            data:{--}}
    {{--                "_token":"{{csrf_token()}}",--}}
    {{--                 },--}}
    {{--            success:function (result){--}}
    {{--                if (result.code==='success'){--}}
    {{--                    alert('get JSON success!')--}}
    {{--                    location.reload();--}}
    {{--                }else {--}}
    {{--                    alert('get JSON fail!')--}}

    {{--                }--}}
    {{--            }--}}
    {{--        });--}}


    {{--})--}}

</script>

@endsection
