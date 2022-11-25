@extends('layouts.app')

@section('content')
<div class="containor" data-key="users">
    <div class="form-container">
        <form data-url="{{ route('users.store') }}" id="add-form" class="body-bg p-3" class="form">
            @csrf
            @method('post')
            <div class="row">
                <div class="col mb-3">
                    <label for="lastname" class="form-label">Họ</label>
                    <input type="text" class="form-control" name="lastname" id="lastname">
                </div>
                <div class="col mb-3">
                    <label for="firstname" class="form-label">Tên</label>
                    <input type="text" class="form-control" name="firstname" id="firstname">
                </div>
            </div>
            
            <label class="form-label mb-3">Giới tính: </label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked>
                <label class="form-check-label" for="male">Nam</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                <label class="form-check-label" for="female">Nữ</label>
            </div>
            
            <br>

            <label for="email" class="form-label">Vai trò</label>
            <select class="form-select mb-3" aria-label="Default select example" id="role" name="role">           
            </select>

            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" id="phone">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Tên người dùng</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="name@example.com">
            </div>

            <div class="col my-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>

            <br>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary my-3">Thêm mới</button>
            </div>
            
        </form>
    </div>
</div>

<script src="{{ asset('js/process-request.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        addTitleForPage('Thêm người dùng');
        penddingRoles();
    })
</script>
@endsection