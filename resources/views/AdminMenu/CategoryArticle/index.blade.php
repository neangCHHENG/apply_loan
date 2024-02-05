<div class="col-xl-12">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                Category <span class="fw-300"><i>List</i></span>
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
                            <th style="text-align:center!important">Name</th>
                            <th style="text-align:center!important">Note</th>
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
@include('AdminMenu.CategoryArticle.form')
<script>
    {
        var idEdit = null;

        function valueFil(val = null) {
            var name_kh = null;
            var name_en = null;
            var description_kh = null;
            var description_en = null;
            var note = null;
           if(val === null){
                name_kh = $('#name_kh').val();
                name_en = $('#name_en').val();
                description_kh = CKEDITOR.instances['description_kh'].getData();
                description_en =  CKEDITOR.instances['description_en'].getData();
                note = $('#note').val();
           }
           if(val === 'clear'){
               $('#name_kh').val('');
               $('#name_en').val('');
                $('#description_kh').val('');
                $('#description_en').val('');
                $('#note').val('');
           }
            return {
                'name_kh': name_kh,
                'name_en': name_en,
                'description_kh': description_kh,
                'description_en': description_en,
                'note': note
            }
        }

        $(document).ready(function() {
            $('#btnUpdate').hide();
            getdata();
        });

        function getdata() {
            $.ajax({
                url: "{{ url('api/admin/category-article') }}",
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
            $('#formModal').modal();
            $('#btnSave').text('Save');
        }

        function save() {
            if (0 === 0) {
                $.ajax({
                    url: "{{ url('/api/admin/category-article') }}",
                    type: "POST",
                    data:  valueFil(),
                    beforeSend: function(xhr) {
                        blockagePage('Please Wait...');
                        xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                    },
                    success: function(response) {
                        if (response.status == "error") {
                            validationMgs(response);
                            return;
                        }
                        $("#formModal").modal('hide');
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
            $('#formModal').modal();
            $('#name_kh').val(data.name_kh);
            $('#name_en').val(data.name_en);
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
                    url: "{{ url('/api/admin/category-article') }}/"+idEdit,
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
                        $("#formModal").modal('hide');
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
                        url: "{{ url('/api/admin/category-article') }}/"+id,
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
            var cols = [
                {
                    "data": "name_en",
                    "name": "name_en",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(name_en, type, row) {
                        return `${name_en} - [${row.name_kh}]`;
                    }
                },
                {
                    "data": "note",
                    "name": "note",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                }, //3

                {
                    "data": "created_at",
                    "name": "created_at",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(data, type, row) {
                        return moment(data.created_at).format('DD-MMM-YYYY');
                    }
                }, //4
                {
                    "data": null,
                    "name": "Action",
                    "searchable": false,
                    "orderable": false,
                    "visible": true,
                    "class": "dt-center",
                    render: function(data, type, row, meta) {
                        //return JSON.stringify(data);

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



            var btn = [
                // {
                //     extend: 'print',
                //     text: 'Print',
                //     titleAttr: 'Print Table',
                //     className: 'btn-outline-primary btn-sm'
                // }
            ];
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
</script>
<script>
    var options = {
           height: 230,
           filebrowserImageBrowseUrl: '/filemanager?type=Images',
           filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
           filebrowserBrowseUrl: '/filemanager?type=Files',
           filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
       };
       $('#description_kh').each(function () {
           CKEDITOR.replace($(this).prop('id'), options);
           CKEDITOR.config.allowedContent = true;
       });
       $('#description_en').each(function () {
           CKEDITOR.replace($(this).prop('id'), options);
           CKEDITOR.config.allowedContent = true;
       });
</script>
