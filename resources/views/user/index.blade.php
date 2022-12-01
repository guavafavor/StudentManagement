@extends('layouts.app')

@section('content')
<div class="containor" data-key="users">
    <div id="list">
        <div class="m-3 p-2">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <a href="{{ route('users.create') }}">
                    <button class="btn btn-dark" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Thêm
                    </button>
                </a>
            </div>

            <table class="table shadow p-4 bg-body rounded">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Tài khoản</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                </ul>
            </nav>
        </div>
    </div>
@include('user.edit')
</div>

<script src="{{ asset('js/process-request.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        addTitleForPage('Danh sách người dùng');
        makeFirstComing();
        setPagination();

        //display edit form
        $('tbody').on('click', '.edit-btn', function(){ 
            var url = $(this).attr('data-url');

            penddingRoles();

            $.ajax ({
                url: url,
                type: 'get',
                success: function(data){
                    var user = data.user;
                    
                    $('#username').val(user.username);
                    $('#email').val(user.email);
                    $('#firstname').val(user.firstname);
                    $('#lastname').val(user.lastname);
                    $('#phone').val(user.phone);
                    $('#role option[value='+user.role_id+']').prop('selected', true);
                    
                    genderValue = '';
                    if('male' == user.gender) {
                        genderValue = '[value=Male]';
                    } else {
                        genderValue = '[value=Female]';
                    }
                    $('input:radio[name=gender]').filter(genderValue).prop('checked', true);

                    var active = user.active == 1 ? true : false;
                    $('#active').prop('checked', active);
                    
                    var url = '{{ route("users.update", ":id") }}';
                    url = url.replace(':id', user.id);
                    $('#update-form').attr('data-url', url);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }                                   
            });

            $("#form-container").css({"width": "100%", "display": "flex", "padding": "10px"});
        });
    });
</script>
@endsection
