function getRoot(){
    return window.location.protocol + '//' + window.location.host;
}

function addTitleForPage(title) {
    $('title').text(title);
}

function getObjectOfPage() {
    return $('.containor').attr('data-key');
}

function getDataForRequest(kindOfObject) {
    var data;
    if (kindOfObject == 'students') {
        data = {
            id: $('#id').val(),
            username: $('#username').val(),
            email: $('#email').val(),
            firstname: $('#firstname').val(),
            lastname: $('#lastname').val(),
            gender: $("input[name='gender']:checked").val(),
            address: $('#address').val(),
            identification: $('#identification').val(),
            phone: $('#phone').val(),
            school: $('#school').val()
        };
    } else if (kindOfObject == 'users') {
        data = {
            username: $('#username').val(),
            email: $('#email').val(),
            firstname: $('#firstname').val(),
            lastname: $('#lastname').val(),
            gender: $("input[name='gender']:checked").val(),
            phone: $('#phone').val(),
            role: $('#role').val(),
            active: $('#active').is(':checked') ? 1 : 0,
            password: $('#password').val()
        };
    }
    return data;
}

function penddingRoles() {
    $.ajax({
        url: getRoot() + "/api/roles",
        type: 'get',
        success: function (data) {
            $('#role').html('');

            var roles = data.roles;
            for (let s in roles) {
                $('#role').append('<option value="' + roles[s].id + '">' + roles[s].name + '</option>')
            }
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
}

function penddingSchools() {
    $.ajax({
        url: getRoot() + "/api/schools",
        type: 'get',
        success: function (data) {
            $('#school').html('');

            var schools = data.schools;
            for (let s in schools) {
                $('#school').append('<option value="' + schools[s].id + '">' + schools[s].name + '</option>')
            }
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
}

//get data for first display
function makeFirstComing() {
    var url = getRoot() + '/api/' + getObjectOfPage();
    requestPaginationData(url);
}

//move to other page
$('.pagination').on('click', '.page-link', function () {
    var url = $(this).attr('data-url');
    requestPaginationData(url);
});

//active the page in navigation
$('.pagination').on('click', '.page-item', function () {
    $('.active').removeClass('active');
    $(this).addClass('active');
});

function penddingDataToTable(list) {
    var kindOfObject = getObjectOfPage();
    var html;

    for (let i in list) {
        var id, speInfo = '';
        if (kindOfObject == 'students') {
            id = list[i].stu_id;
            speInfo = "<td>" + list[i].school.name + "</td>";
        } else if (kindOfObject == 'users') {
            id = list[i].id;
            var msg = list[i].active == 1 ? "Đã kích hoạt" : "Chưa kích hoạt";
            speInfo = "<td>" + msg + "</td>";
        }
        var url = getRoot() + '/api/' + kindOfObject + '/' + id;

        html += "<tr>" +
            "<td>" + id + "</td>" +
            "<td>" + list[i].username + "</td>" +
            "<td>" + list[i].lastname + " " + list[i].firstname + "</td>" +
            "<td>" + list[i].email + "</td>" +
            "<td>" + list[i].phone + "</td>" +
            speInfo +
            "<td><a class='btn btn-warning btn-sm edit-btn' data-url='" + url + "'>Sửa</a> " +
            "<button data-url='" + url + "' class='btn btn-danger btn-sm delete-btn'>Xóa</button>" +
            "</td>" +
            "</tr>";
    }
    $('tbody').html(html);
}

//add new student/user
$('#add-form').submit(function (e) {
    e.preventDefault();

    var requestUrl = $(this).attr('data-url');
    var data = getDataForRequest(getObjectOfPage());
    var redirectUrl = getRoot() + '/' + getObjectOfPage();

    requestStoreNew(requestUrl, data, redirectUrl);
});

//update student/user
$('#form-container').on('submit', '#update-form', function (e) {
    e.preventDefault();

    var url = $(this).attr('data-url');
    var data = getDataForRequest(getObjectOfPage());

    requestUpdate(url, data);
});

//delete a student 
$('tbody').on('click', '.delete-btn', function () {
    var url = $(this).attr('data-url');
    alert(url);

    $.ajax({
        url: url,
        type: 'delete',
        success: function () {
            var url = $('.page-item.active .page-link').attr('data-url');
            requestPaginationData(url);
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    })
});

$('.closebtn').click(function () {
    closeEditForm();
});

function closeEditForm() {
    $("#form-container").css({ "width": "0%", "padding": "0" });
}

//send request for pagination
function requestPaginationData(url) {
    $.ajax({
        url: url,
        type: 'get',
        success: function (data) {
            penddingDataToTable(data.objects);
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    })
}

//send request for store new data, then redirect to the home page
function requestStoreNew(requestUrl, data, redirectUrl) {
    $.ajax({
        url: requestUrl,
        type: 'post',
        dataType: 'json',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify(data),
        success: function (msg) {
            window.location.href = redirectUrl;
        },
        error: function (err) {
            console.log("error: ", err);
        }
    });
}

//send request for updating
function requestUpdate(url, data) {
    $.ajax({
        url: url,
        type: 'patch',
        dataType: 'json',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify(data),
        success: function () {
            closeEditForm();
            var url = $('.page-item.active .page-link').attr('data-url');
            requestPaginationData(url);
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
}

//set pagination 
function setPagination(){
    var root = getRoot();
    var object = getObjectOfPage();
    var pageType = object == 'users' ? 'userpage' : 'studentpage';

    $.ajax({
        url: root + '/api/' + pageType,
        type: 'get',
        success: function (data) {
            console.log(data);
            for (var i = 1; i <= data.pageNum; i++){
                var url = root + '/api/' + object + '?page=' + i;

                var pageClass = 'page-item';
                if (i == 1) {
                    pageClass = 'page-item active';
                }

                $('.pagination').append("<li class='"+pageClass+"'><a class='page-link' data-url='"+url+"'>"+i+"</a></li>");
            }
        },
        error: function ( errorThrown) {
            console.log(errorThrown)
        }
    });
}

//set active for header link
// $('.header .container a').click(function () {
//     $('.active-link').removeClass('active-link');
//     $(this).addClass('active-link');
// });
