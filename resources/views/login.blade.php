<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.min.js') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css"/>
</head>
<body class="bg-light">
    <div class="d-flex justify-content-center align-items-sm-center" style="height: 100vh;">
        <div class="border border-1 p-3 bg-with bg-white" style="width: 30%;">
            <form data-url="{{ route('login') }}" method="POST" id="login-form">
                @csrf
                @method('post')
                <p class="text-center text-uppercase fw-bold">Đăng nhập</p>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-primary" type="submit">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script src='{{ asset('js/jquery-3.6.1.min.js') }}'></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#login-form').submit(function(e){
        e.preventDefault();

        var url=$(this).attr('data-url');
        alert(url);

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            processData: false,
            data: JSON.stringify({
                email: $('#email').val(),
                password: $('#password').val()
            }),
            success: function(msg) {
                window.location.href = "{{ route('users') }}";
            },
            error: function(errorThrown) {
                console.log(errorThrown);
            }
        })
    })
})
</script>
</html>