<div class="header row px-2 py-4 shadow mb-4 rounded">
    <div class="col-8">
        <div class="container">
            <div class="row row-cols-auto">
                <div class="col">
                    <a href="{{ route('users') }}">Danh sách người dùng</a>
                </div>
                <div class="col">
                    <a class="{{ request()->is(['students', 'students/*']) ? 'active' : '' }}" href="{{  route('students') }}">Danh sách sinh viên</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 text-center">
        <a href="#{{-- route('logout') --}}">Đăng xuất</a>
    </div>
</div>

