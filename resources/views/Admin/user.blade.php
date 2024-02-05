<div class="col-xl-12">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                User <span class="fw-300"><i>List</i></span>
            </h2>
            <div class="panel-toolbar">
                <button class="btn btn-primary btn-sm waves-effect waves-themed" onclick="newUser()">New User</button>
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <!-- datatable start -->
                <table id="userlist" class="table table-bordered table-hover table-striped w-100"
                    style="font-size: 12px;border:1px solid #eee;">

                    <thead>
                        <tr>
                            <th style="text-align:center!important">Id</th>
                            <!--0-->
                            <th style="text-align:center!important">Nº</th>
                            <!--1-->
                            <th style="text-align:center!important">-</th>
                            <!--2-->
                            <th style="text-align:center!important">Card ID</th>
                            <!--3-->
                            <th style="text-align:center!important">Name</th>
                            <!--4-->
                            <th style="text-align:center!important">Username</th>
                            <!--5-->
                            <th style="text-align:center!important">Email</th>
                            <!--6-->
                            <th style="text-align:center!important">Action</th>
                            <!--7-->
                        </tr>
                    </thead>
                    <tbody style="border:1px solid #eee;"></tbody>
                </table>
                <!-- datatable end -->
            </div>
        </div>
    </div>
</div>

@include('Admin/userrole')
@include('Admin/userform')
@include('Admin/resetPassword')
@include('Admin/userImgCrop')
@include('Admin/campuspermission')

<div id="viewUserPhotoDiv">
</div>

<script>
    var FilterButtonExist = false;
    $(document).ready(function() {
        initUserList();
    });

    function getUsers() {
        $.ajax({
            url: "{{ url('api/admin/maniUsers') }}",
            type: "POST",
            data: {
                _token: formToken,
                start: 0,
                end: 10
            },
            beforeSend: function(xhr) {
                blockagePage('Please Wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }

                console.log(response);

                unblockagePage();
            },
            error: function(e) {
                if (e.status = 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }

                unblockagePage();
            }
        });
    }

    function newUser() {
        $("#userForm #name").val("");
        $("#userForm #CardId").val("");
        $("#userForm #username").val("");
        $("#userForm #email").val("");
        $("#userForm #id").val(0);
        $("#userFormLabel").html("New User");

        $("#userFormModal").modal();
    }

    function viewUserPhoto(userid) {
        $.ajax({
            url: "{{ url('admin/viewUserPhoto') }}",
            type: "POST",
            data: {
                _token: formToken,
                userid: userid
            },
            beforeSend: function(xhr) {
                blockagePage('Please Wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }
                $("#viewUserPhotoDiv").html(response);
                $("#userViewPhoto").modal();

                unblockagePage();
            },
            error: function(e) {
                if (e.status = 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }

                unblockagePage();
            }
        });
    }

    function initUserList() {
        var cols = [{
                "data": "id",
                "name": "id",
                "searchable": false,
                "orderable": false,
                "visible": false
            }, //0
            {
                "data": "no",
                "name": "no",
                "searchable": false,
                "orderable": false,
                "visible": true,
                "class": "dt-right",
            }, //1
            {
                "data": "photo",
                "name": "photo",
                "searchable": false,
                "orderable": false,
                "visible": true,
                "class": "dt-center",
                "render": function(data, type, row) {
                    if (data == null) {
                        return "";
                    } else {
                        return "<a href='javascript:void(0);' onclick='viewUserPhoto(" + row.id + ")'> " +
                            "<center><div class=\"profile-image-md rounded-circle\" style=\"background-image:url('data:image/jpeg;base64," +
                            data + "'); background-size: cover;\"></div></center>" + "</a>";
                    }

                }
            }, //2
            {
                "data": "CardId",
                "name": "CardId",
                "searchable": true,
                "orderable": true,
                "visible": true,
                "class": "dt-center"
            }, //3
            {
                "data": "name",
                "name": "name",
                "searchable": true,
                "orderable": true,
                "visible": true,
                "render": function(data, type, row) {
                    return "<a href='javascript:void(0);' onclick='viewUserPhoto(" + row.id + ")'> " + data +
                        "</a>";
                }
            }, //4
            {
                "data": "username",
                "name": "username",
                "searchable": true,
                "orderable": true,
                "visible": true,
            }, //5
            {
                "data": "email",
                "name": "email",
                "searchable": true,
                "orderable": true,
                "visible": true,
            }, //6
            {
                "data": null,
                "name": "Action",
                "searchable": false,
                "orderable": false,
                "visible": true,
                "class": "dt-center",
                render: function(data, type, row) {
                    var str = "";

                    str =
                        '<div class="dropdown">' +
                        '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-cog" aria-hidden="true"></i></button>' +
                        '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">' +
                        '<a class="dropdown-item" href="javascript:void(0);" onclick="getUserRole(' + row.id +
                        ',\'' + row.username + '\')"> <i class="fal fa-list" aria-hidden="true"></i> Role</a>' +
                        '<a class="dropdown-item" href="javascript:void(0);" onclick="editUser(' + row.id +
                        ',\'' + row.username +
                        '\')"> <i class="fal fa-pencil" aria-hidden="true"></i> Edit</a>' +
                        '<a class="dropdown-item" href="javascript:void(0);" onclick="deleteUser(' + row.id +
                        ',\'' + row.username +
                        '\')"> <i class="fal fa-trash" aria-hidden="true"></i> Remove</a>' +
                        '<a class="dropdown-item" href="javascript:void(0);" onclick="showPassword(' + row.id +
                        ',\'' + row.username +
                        '\')"> <i class="fal fa-pencil-alt" aria-hidden="true"></i> Change Password</a>' +
                        '<a class="dropdown-item" href="javascript:void(0);" onclick="showphoto(' + row.id +
                        ',\'' + row.name + '\')"> <i class="fal fa-image" aria-hidden="true"></i> Photo</a>' +
                        '</div>' +
                        '</div>';
                    return str;
                }

            }, //7
        ];

        if ($.fn.DataTable.isDataTable('#userlist')) {
            $('#userlist').DataTable().clear();
            $('#userlist').DataTable().destroy();
        }


        //////INT TABLE//////
        var table = $('#userlist').DataTable({
            "ajax": {
                "url": "{{ url('api/admin/getUsers') }}",
                "type": "POST",
                "datatype": "json",
                "data": {
                    _token: formToken,
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                },
                /*success: function(response) {
                    console.log(response);
                }*/
            },
            "searchDelay": 500,
            "columns": cols,
            "serverSide": "true",
            "processing": "true",
            "order": [3, 'asc'],
            "rowId": "id",
            "responsive": "true",
            "stateSave": true,
            "select": true
        });
        //////INT TABLE//////
    }

    function showphoto(userid, username) {
        $("#userphotoid").html(userid);
        $('#imageCropDiv').modal();
        $('#clearimageselectbtn').trigger('click');
        $('#clearimagebtn').trigger('click');
        $('#userPictureLabel').html(username);

        $(".img-container img").attr('src', null);
    }

    function editUser(userid) {
        $.ajax({
            url: "{{ url('api/admin/editUser') }}",
            type: "POST",
            data: {
                _token: formToken,
                id: userid
            },
            beforeSend: function(xhr) {
                blockagePage('Please Wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }

                $("#userForm #CardId").val(response.data.CardId);
                $("#userForm #name").val(response.data.name);
                $("#userForm #username").val(response.data.username);
                $("#userForm #email").val(response.data.email);
                $("#userForm #id").val(response.data.id);
                $("#userFormLabel").html("Edit : " + response.data.username);
                $("#userFormModal").modal();

                unblockagePage();
            },
            error: function(e) {
                if (e.status = 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }

                unblockagePage();
            }
        });
    }

    function saveUser() {
        var id = $("#userForm #id").val();
        var CardId = $("#userForm #CardId").val() == null ? '' : $("#userForm #CardId").val();
        var name = $("#userForm #name").val();
        var username = $("#userForm #username").val();
        var email = $("#userForm #email").val();
        var action = id == 0 ? "{{ url('api/admin/saveUser') }}" : "{{ url('api/admin/updateUser') }}";

        $.ajax({
            url: action,
            type: "POST",
            data: {
                _token: formToken,
                id: id,
                CardId: CardId,
                name: name,
                username: username,
                email: email,
            },
            beforeSend: function(xhr) {
                blockagePage('Please Wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.status == "error") {
                    validationMgs(response);
                    return;
                }

                if (action == "{{ url('api/admin/saveUser') }}") {
                    var table = $('#userlist').DataTable();
                    table.row.add(response.data).draw();
                } else {
                    var table = $('#userlist').DataTable();
                    var selectRow = table.row($('#userlist #' + response.data.id));
                    selectRow.data(response.data);
                    table.draw();
                }

                sweetToast(response.msg, response.result);

                $("#userFormModal").modal('hide');

                unblockagePage();
            },
            error: function(e) {

                Msg('Error Saving User', 'error');
                unblockagePage();
            }
        });
    }

    function deleteUser(userid, username) {
        Swal.fire({
            title: 'Are you sure?',
            text: "To delete user :" + username + " !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            console.log(result.value);
            if (result.value) {

                $.ajax({
                    url: "{{ url('api/admin/deleteUser') }}",
                    type: "POST",
                    data: {
                        _token: formToken,
                        id: userid,
                    },
                    beforeSend: function(xhr) {
                        blockagePage('Please Wait...');
                        xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                    },
                    success: function(response) {
                        if (response.result == "error") {
                            sweetToast(response.msg, response.result);
                            return;
                        }

                        sweetToast(response.msg, response.result);

                        var table = $('#userlist').DataTable();
                        var selectRow = table.row($('#userlist #' + userid));
                        table.row(selectRow).remove().draw();

                        unblockagePage();
                    },
                    error: function(e) {
                        if (e.status = 401) //unauthenticate not login
                        {
                            Msg('Login is Required', 'error');
                        }

                        unblockagePage();
                    }
                });

            }
        });
    }

    function getUserRole(userid, username) {
        $.ajax({
            url: "{{ url('api/admin/getUserRole') }}",
            type: "POST",
            data: {
                _token: formToken,
                userid: userid
            },
            beforeSend: function(xhr) {
                blockagePage('Please Wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }

                initUserRoleList(response.data);

                $("#userRoleLabel").html("Role : " + username);

                $("#UserRoleModal").modal();

                unblockagePage();
            },
            error: function(e) {
                if (e.status = 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }

                unblockagePage();
            }
        });
    }

    function initUserRoleList(data) {
        var cols = [{
                "data": "id",
                "name": "id",
                "searchable": false,
                "orderable": false,
                "visible": false
            }, //0
            {
                "data": "name",
                "name": "name",
                "searchable": true,
                "orderable": true,
                "visible": true,
                "class": "dt-center"
            }, //1
            {
                "data": "isAdmin",
                "name": "isAdmin",
                "searchable": true,
                "orderable": true,
                "visible": true,
                "class": "dt-center"
            }, //2
            {
                "data": null,
                "name": "Action",
                "searchable": false,
                "orderable": false,
                "visible": true,
                "class": "dt-center",
                render: function(data, type, row) {
                    return "<label class=\"switch\"><input onchange=\"assignRole(" + row.id + "," + row
                        .userid +
                        ",this)\" type=\"checkbox\" " + (row.permit == 1 ? "checked" : "") +
                        "><span class=\"slider round\"></span></label>";
                }

            }, //3
        ];

        if ($.fn.DataTable.isDataTable('#RoleList')) {
            $('#RoleList').DataTable().clear();
            $('#RoleList').DataTable().destroy();
        }

        //////INT TABLE//////
        var table = $('#RoleList').DataTable({
            "data": data,
            "columns": cols,
            "order": [1, 'asc'],
            "rowId": "id",
            "responsive": "true",
            "select": true
        });
        //////INT TABLE//////
    }

    function assignRole(roleid, userid, element) {
        var checked = element.checked == true ? true : false;

        $.ajax({
            url: "{{ url('api/admin/assignRole') }}",
            type: "POST",
            data: {
                _token: formToken,
                userid: userid,
                roleid: roleid,
                checked: checked,
            },
            beforeSend: function(xhr) {
                blockagePage('Please Wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }

                Msg(response.msg, response.result);
                unblockagePage();
            },
            error: function(e) {
                if (e.status = 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }

                unblockagePage();
            }
        });
    }

    function showPassword(userid, username) {
        $("#userpasswordform #password").val("");
        $("#userpasswordform #id").val(userid);
        $("#userPasswordResetLabel").html("Reset " + username + " password");
        $("#userpasswordform").modal();
    }

    function resetPassword() {
        var password = $("#userpasswordform #password").val();
        var userid = $("#userpasswordform #id").val();

        $.ajax({
            url: "{{ url('api/admin/resetPassword') }}",
            type: "POST",
            data: {
                _token: formToken,
                id: userid,
                password: password
            },
            beforeSend: function(xhr) {
                blockagePage('Please Wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }

                sweetToast(response.msg, response.result);
                $("#userpasswordform").modal("hide");

                unblockagePage();
            },
            error: function(e) {
                Msg('Error while reset password', 'error');

                unblockagePage();
            }
        });
    }
</script>
