<div class="col-xl-12">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                Position <span class="fw-300"><i>List</i></span>
            </h2>
            <div class="panel-toolbar">
                <button class="btn btn-primary btn-sm waves-effect waves-themed" onclick="create()">Add New</button>
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <!-- datatable start -->
                <table id="datalist" class="table table-bordered table-hover table-striped w-100"
                    style="font-size: 12px;border:1px solid #eee;">
                    <thead>
                        <tr>
                            <th style="text-align:center!important">ID</th>
                            <th style="text-align:center!important">Title</th>
                            <th style="text-align:center!important">Department</th>
                            <th style="text-align:center!important">Department kh</th>
                            <th style="text-align:center!important">Department Id</th>
                            <th style="text-align:center!important">description_en</th>
                            <th style="text-align:center!important">description_kh</th>
                            <th style="text-align:center!important">Experience</th>
                            <th style="text-align:center!important">Note</th>
                            <th style="text-align:center!important">Create By</th>
                            <th style="text-align:center!important">Create Date</th>
                            <th style="text-align:center!important">Action</th>
                        </tr>
                    </thead>
                    <tbody style="border:1px solid #eee;"></tbody>
                </table>
                <!-- datatable end -->
            </div>
        </div>
    </div>
</div>
@include('AdminMenu.Position.form')
<script>
    {
        $(document).ready(function() {
            $('#btnUpdate').hide();
            getdata();
            getDepartmentList();
            var options = {
                height: 430,
                filebrowserImageBrowseUrl: '/filemanager?type=Images',
                filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/filemanager?type=Files',
                filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
            };
            $('.article_editor').each(function() {
                CKEDITOR.replace($(this).prop('id'), options);
                CKEDITOR.config.allowedContent = {
                    $1: {
                        elements: CKEDITOR.dtd,
                        attributes: true,
                        styles: true,
                        classes: true
                    }
                };
                CKEDITOR.config.disallowedContent = 'script; *[on*]';
            });
            $('#parent_tag_id').select2();
            $('#relate_article').select2();
        });

        var idEdit = null;

        function valueFil(val = null) {
            var title_kh = null;
            var title_en = null;
            var note = null;
            var department = null;
            var description_en = null;
            var description_kh = null;
            var experience = null;

            if (val === null) {
                title_kh = $('#title_kh').val();
                title_en = $('#title_en').val();
                department = $('#department').val();
                description_en = CKEDITOR.instances['description_en'].getData();
                description_kh = CKEDITOR.instances['description_kh'].getData();
                experience = $('#experience').val();
                note = $('#note').val();
            }
            if (val === 'clear') {
                $('#title_kh').val('');
                $('#title_en').val('');
                $('#department').val('');
                $('#experience').val('');
                CKEDITOR.instances['description_kh'].setData("");
                CKEDITOR.instances['description_kh'].setData("");
                $('#note').val('');
            }
            return {
                'title_kh': title_kh,
                'title_en': title_en,
                'department': department,
                'experience': experience,
                'description_kh': description_kh,
                'description_en': description_en,
                'note': note
            }
        }

        function getdata() {
            $.ajax({
                url: "{{ url('api/admin/position') }}",
                type: "GET",
                beforeSend: function(xhr) {
                    blockagePage('Please Wait...');
                    xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                },
                success: function(response) {
                    if (response.status == "error") {
                        sweetToast(response.msg, response.icon);
                        return;
                    }
                    dataList(response.data);
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

        // open form popup
        function create() {
            valueFil('clear');
            $('#btnUpdate').hide();
            $('#positionformModal').modal();
            $('#btnSave').text('Save');
        }

        function save() {
            if (0 === 0) {
                $.ajax({
                    url: "{{ url('/api/admin/position') }}",
                    type: "POST",
                    data: valueFil(),
                    beforeSend: function(xhr) {
                        blockagePage('Please Wait...');
                        xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                    },
                    success: function(response) {
                        if (response.status == "error") {
                            validationMgs(response);
                            return;
                        }
                        $("#positionformModal").modal('hide');
                        sweetToast(response.status, response.icon);
                        unblockagePage();
                        dataList(response.data);
                    },
                    error: function(e) {
                        Msg('Error Saving User', 'error');
                        unblockagePage();
                    }
                });
            }
        }

        function edit(id) {
            idEdit = id;
            let data = getRowData(id);
            $('#positionformModal').modal();
            $('#title_kh').val(data.title_kh);
            $('#title_en').val(data.title_en);
            $('#department').val(data.department_id).trigger('change');
            $('#experience').val(data.experience);
            CKEDITOR.instances['description_kh'].setData(data.description_kh);
            CKEDITOR.instances['description_en'].setData(data.description_en);
            $('#note').val(data.note);
            $('#btnSave').text('Add New');
            $('#btnUpdate').show();
        }

        function getRowData(id) {
            var table = $('#datalist').DataTable();
            var selectRow = table.row($('#datalist #' + id));
            return selectRow.data();
        }

        function update() {
            if (0 === 0) {
                $.ajax({
                    url: "{{ url('/api/admin/position') }}/" + idEdit,
                    type: "PUT",
                    data: valueFil(),
                    beforeSend: function(xhr) {
                        blockagePage('Please Wait...');
                        xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                    },
                    success: function(response) {
                        if (response.status == "error") {
                            validationMgs(response);
                            return;
                        }
                        idEdit = null;
                        $("#positionformModal").modal('hide');
                        $('#btnUpdate').hide();
                        unblockagePage();
                        sweetToast(response.status, response.icon);
                        dataList(response.data);
                    },
                    error: function(e) {
                        Msg('Error Saving User', 'error');
                        unblockagePage();
                    }
                });
            }
        }

        function destroy(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Deleted now!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('/api/admin/position') }}/" + id,
                        type: "DELETE",
                        beforeSend: function(xhr) {
                            blockagePage('Please Wait...');
                            xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                        },
                        success: function(response) {
                            if (response.status == "error") {
                                validationMgs(response);
                                return;
                            }
                            idEdit = null;
                            unblockagePage();
                            sweetToast(response.status, response.icon);
                            dataList(response.data);
                        },
                        error: function(e) {
                            Msg('Error Saving User', 'error');
                            unblockagePage();
                        }
                    });
                }
            });
        }

        // datatable data
        function dataList(data) {
            var cols = [{
                    "data": "id",
                    "name": "id",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "title_en",
                    "name": "title_en",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(title_en, type, row) {
                        return title_en + ' - [' + row.title_kh + ']';
                    }
                },
                {
                    "data": "department_en",
                    "name": "department_en",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(department_en, type, row) {
                        return department_en + ' - [' + row.department_kh + ']';
                    }
                },
                {
                    "data": "department_kh",
                    "name": "department_kh",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "department_id",
                    "name": "department_id",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "description_kh",
                    "name": "description_kh",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "description_en",
                    "name": "description_en",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },

                {
                    "data": "experience",
                    "name": "experience",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(experience, type, row) {
                        return experience + '++';
                    }
                },
                {
                    "data": "note",
                    "name": "note",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "create_by",
                    "name": "create_by",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "created_at",
                    "name": "created_at",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(created_at, type, row) {
                        return moment(created_at).format('DD-MMM-YYYY');
                    }
                },
                {
                    "data": null,
                    "name": "Action",
                    "searchable": false,
                    "orderable": false,
                    "visible": true,
                    "class": "dt-center",
                    render: function(data, type, row, meta) {
                        var str =
                            '<div class="dropdown">' +
                            '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-cog" aria-hidden="true"></i></button>' +
                            '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">' +
                            `<a class="dropdown-item" href="javascript:void(0);" onclick="edit(${row.id})"> <i class="fal fa-pencil" aria-hidden="true"></i> Edit</a>` +
                            '<a class="dropdown-item" href="javascript:void(0);" onclick="destroy(' + row.id +
                            ')"> <i class="fal fa-trash" aria-hidden="true"></i> Remove</a>' +
                            '</div>' +
                            '</div>';
                        return str;
                    }
                }, //
            ];
            var btn = [];
            if ($.fn.DataTable.isDataTable('#datalist')) {
                $('#datalist').DataTable().clear();
                $('#datalist').DataTable().destroy();
            }
            //////INT TABLE//////
            var table = $('#datalist').DataTable({
                "data": data,
                "columns": cols,
                "buttons": btn,
                "order": [1, 'asc'],
                "rowId": "id",
                "responsive": "true",
                dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            });
            //////INT TABLE//////
        }
    }

    $("#positionForm #department").select2({
        dropdownParent: $('#positionformModal')
    });

    function getDepartmentList() {
        $.ajax({
            url: "{{ url('/api/admin/position/getDepartmentList') }}",
            type: "GET",
            beforeSend: function(xhr) {
                blockagePage('Please wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }
                var typeStr = "<option></option>";
                for (var i = 0; i < response.data.length; i++) {
                    typeStr += "<option value=\"" + response.data[i].id + "\">" +
                        response.data[i].title_en + "-" + response.data[i].title_kh + "</option>";
                }
                $("#positionformModal #department").html(typeStr);
                $("#positionformModal #department").select2("destroy").select2({
                    dropdownParent: $('#positionformModal')
                });
                unblockagePage();
            },
            error: function(e) {
                if (e.status == 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }
                unblockagePage();
            }
        });
    }
</script>
