<div class="col-xl-12">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                Info <span class="fw-300"><i>List</i></span>
            </h2>
            <div class="panel-toolbar">
                {{-- <button class="btn btn-primary btn-sm waves-effect waves-themed" onclick="create()">Add New</button> --}}
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <!-- datatable start -->
                <table id="datalist" class="table table-bordered table-hover table-striped w-100"
                    style="font-size: 12px;border:1px solid #eee;">
                    <thead>
                        <tr>
                            <th style="text-align:center!important">Images</th>
                            <th style="text-align:center!important">Key</th>
                            <th style="text-align:center!important">Type</th>
                            <th style="text-align:center!important">Value</th>
                            <th style="text-align:center!important">description</th>
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
@include('AdminMenu.Info.form')
<script>
    {
        var idEdit = null;
        var dataAll = null;
        function valueFil(val = null) {
            let key = null;
            let type = null;
            let value_en = null;
            let value_kh = null;
            let thumbnail = null;
            let description_en = null;
            let description_kh = null;
            if(val === null){
                key = $('#key').val();
                type = $('#type').val();
                value_en = $('#value_en').val();
                value_kh = $('#value_kh').val();
                thumbnail = $('#thumbnail').val();
                description_en = $('#description_en').val();
                description_kh = $('#description_kh').val();
            }
            if(val === 'clear'){
                $('#key').val('');
                $('#type').val('');
                $('#value_en').val('');
                $('#value_kh').val('');
                $('#thumbnail').val('');
                $('#description_en').val('');
                $('#description_kh').val('');
                $('#key').attr("readonly", false);
            }
            return {
                'key': key,
                'type': type,
                'value_en': value_en,
                'value_kh': value_kh,
                'image': thumbnail,
                'description_en': description_en,
                'description_kh': description_kh,
            }
        }

        $(document).ready(function() {
            $('#btnUpdate').hide();
            getdata();
        });

        function getdata() {
            $.ajax({
                url: "{{ url('api/admin/info') }}",
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
                    dataAll = response.data;
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

        function selectType(){
            let txt = '';
            dataAll.forEach(element => {
                txt += `<option>${element.type}</option>`;
            });
            $('#types').html(txt);
        }

        // open form popup
        function create() {
           valueFil('clear');
            $('#btnUpdate').hide();
            $('#formModal').modal();
            selectType();
        }

        function save() {

            if (0 === 0) {
                $.ajax({
                    url: "{{ url('/api/admin/info') }}",
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
                        $("#formModal").modal('hide');
                        sweetToast(response.status, response.icon);
                        unblockagePage();
                        dataAll = response.data;
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
            $('#key').val(data.key);
            $('#key').attr("readonly",true);
            $('#type').val(data.type);
            $('#value_kh').val(data.value_kh);
            $('#value_en').val(data.value_en);
            $('#thumbnail').val(data.image);
            $('#holder').html(`<img src="${data.image}" alt="image" id="showimage" style="height: 5rem;">`);
            $('#description_kh').val(data.description_kh);
            $('#description_en').val(data.description_en);
            $('#btnSave').text('Add New');
            $('#btnUpdate').show();
            selectType();
        }

        function getRowData(id) {
            var table = $('#datalist').DataTable();
            var selectRow = table.row($('#datalist #' + id));
            return selectRow.data();
        }

        function update() {
            if (0 === 0) {
                $.ajax({
                    url: "{{ url('/api/admin/info') }}/"+idEdit,
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
                        dataAll = response.data;
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
                        url: "{{ url('/api/admin/info') }}/"+id,
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
                            dataAll = response.data;
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
                    "data": "image",
                    "name": "image",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(image, type, row){
                        return image == null?'No image':`<img src="${image}" width="50" >`;
                    }
                },
                {
                    "data": "key",
                    "name": "key",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "type",
                    "name": "type",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "value_en",
                    "name": "value_en",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(value_en, type, row) {
                        return `${value_en} - [${row.value_kh}]`;
                    }
                },
                {
                    "data": "description_en",
                    "name": "description_en",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(description_en, type, row) {
                        return description_en != null?description_en.substring(0, 100):'';
                    }

                },

                {
                    "data": "created_at",
                    "name": "created_at",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(data, type, row) {
                        return moment(data.created_at).format('DD-MMM-YYYY');
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
                        //return JSON.stringify(data);

                        var str =
                            '<div class="dropdown">' +
                            '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-cog" aria-hidden="true"></i></button>' +
                            '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">' +
                            `<a class="dropdown-item" href="javascript:void(0);" onclick="edit(${row.id})"> <i class="fal fa-pencil" aria-hidden="true"></i> Edit</a>` +
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
