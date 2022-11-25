<div id="form-container" class="overlay">
    <a class="closebtn">&times;</a>
    <div class="overlay-content">
        <form method="POST" id="update-form" class="body-bg p-3 form">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="stu_id" class="form-label">Mã sinh viên:</label>
                <input type="text" class="form-control" id="id" name="id" disabled >
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="lastname" class="form-label">Họ</label>
                    <input type="text" class="form-control" id="lastname" name="lastname">
                </div>
                <div class="col mb-3">
                    <label for="firstname" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="firstname" name="firstname">
                </div>
            </div>
            
            <label class="form-label mb-3">Giới tính: </label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                <label class="form-check-label" for="male">Nam</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                <label class="form-check-label" for="female">Nữ</label>
            </div>

            <br>

            <label for="type" class="form-label">Trường</label>
            <select class="form-select mb-3" aria-label="Default select example" name="school"  id="school">
            </select>

            <div class="mb-3">
                <label for="phone" class="form-label">Tên người dùng</label>
                <input type="text" class="form-control" id="username" name="username" disabled>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="identification" class="form-label">Số chứng minh thư</label>
                <input type="text" class="form-control" id="identification" name="identification">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary mt-3">Xác nhận chỉnh sửa</button>
            </div>
        </form>
    </div>
</div>
