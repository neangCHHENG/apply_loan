<div class="col-xl-12">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                Menu <span class="fw-300"><i>List</i></span>
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
                            <th style="width: 50% !important;">Menu</th>
                            <th style="text-align:center!important">Level</th>
                            <th style="text-align:center!important">Type</th>
                            <th style="text-align:center!important">Type Menu</th>
                            <th style="text-align:center!important">Article</th>
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
@include('AdminMenu.Menu.popupOrdering')
<script>
    {
        var dataUpdate = null;
        var data = null;
        var storeSelect = null;
        $(document).ready(function() {
            getdata();
            $('#menuSelectList').select2({
                dropdownParent: $("#formModal")
            });
        });
        function getBytypeList(){
            storeSelect = $("#typeMenu").val();
            getdata();
        }

        function getdata() {
            let type = $("#typeMenu").val();
            if(type === undefined){
               type = 'Top';
            }

            $.ajax({
                url: "{{ url('api/admin/menu/indexList')}}/"+ type,
                type: "GET",
                beforeSend: function(xhr) {

                    xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                },
                success: function(response) {
                    if (response.status == "error") {
                        sweetToast(response.msg, response.icon);
                        return;
                    }
                    data = response.data;
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
            $.ajax({
                url: "{{ url('/api/admin/menu/create') }}/"+ 0, // id sent number 0 for open form create
                type: "GET",
                beforeSend: function(xhr) {
                    blockagePage('Please Wait...');
                    xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                },
                success: function(response) {
                    $('#containerDiv').html(response);
                    unblockagePage();
                },
                error: function(xhr) {
                    Msg('Error GET controller", "error');
                    unblockagePage();
                }
            });
        }

        var edit= (id)=> {
            // get view
            $.ajax({
                url: "{{ url('/api/admin/menu/create') }}/"+ id, // id sent number id for open form update
                type: "GET",
                beforeSend: function(xhr) {
                    blockagePage('Please Wait...');
                    xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                },
                success: function(response) {
                    $('#containerDiv').html(response);
                    unblockagePage();
            // get data
                    $.ajax({
                        url: "{{ url('/api/admin/menu/edit')}}/"+id,
                        type: "GET",
                        beforeSend: function(xhr) {
                            blockagePage('Please Wait...');
                            xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                        },
                        success: function(response) {
                            let data = response.data;
                            dataUpdate = data;
                            getParentItem(id); //get id for select menu
                            let nameConfigType = response.config_type.filter(val=>val.type == data.menu_type);

                            $('#type').attr('disabled','disabled');
                            $('#btnUpdate').show();

                            $('#menu_type').val(data.menu_type);
                            $('#param1').val(data.param1);
                            $('#menuItemTypeShow').val(data.menu_type.replace(/_/,' '));
                            if(data.reference_id != null){
                                if(data.menu_type == 'single_category'){
                                    let singleCategory = response.category.filter(val => val.id == data.reference_id)[0];
                                    $('#referenceInput').val(singleCategory.name_en);
                                }else if(data.menu_type == 'single_article'){
                                    $('#referenceInput').val(data.article.title_en);
                                }else if(data.menu_type == 'event_list' || data.menu_type == 'event_grid'){
                                    let categoryEvent = response.categoryEvent.filter(val => val.id == data.reference_id)[0];
                                    $('#referenceInput').val(categoryEvent.name_en);
                                }
                                $('#lableNameReference').text(nameConfigType[0].name);
                                $('#reference_id').val(data.reference_id);
                                $('#divReference').show();
                            }else if(data.link){
                                $('#link').val(data.link);
                                $('#divLink').show();
                            }else{
                                $('#divReference').hide();
                                $('#divLink').hide();
                            }
                            unblockagePage();
                        },
                        error: function(xhr) {
                            Msg('Error GET controller", "error');
                            unblockagePage();
                        }
                    });
                },
                error: function(xhr) {
                    Msg('Error GET controller", "error');
                    unblockagePage();
                }
            });

        }

        var popupOrdering=(id)=>{
            let type = $("#typeMenu").val();
            if(type === undefined){
               type = 'Top';
            }
            $('#displayType').text(type+' Menu');
            $.ajax({
                url: "{{ url('api/admin/menu/indexList')}}/"+ type,
                type: "GET",
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                },
                success: function(response) {
                    if (response.status == "error") {
                        sweetToast(response.msg, response.icon);
                        return;
                    }

                    let menuSelectList = '';
                    response.data.forEach(element => {
                        menuSelectList += `<option value="${element.id}"> ${element.menu_en} - [${element.menu_kh}]</option>`;
                    });
                    $('#menuSelectList').html(menuSelectList);
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

            $('#formModal').modal();

        }

        var saveOrdering=()=>{
           alter('can you Save Ordering now hak hak ');
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
                        url: "{{ url('/api/admin/menu') }}/"+id,
                        type: "DELETE",
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                        },
                        success: function(response) {
                            if (response.status == "error") {
                                validationMgs(response);
                                return;
                            }
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
                    "data": "menu_en",
                    "name": "menu_en",
                    "searchable": true,
                    "orderable": false,
                    "visible": true,
                    render: function(menu_en, type, row, meta) {
                        return '-'.repeat(row.level)+' '+menu_en+' - ['+row.menu_kh+']';
                    }

                },
                {
                    "data": "level",
                    "name": "level",
                    "searchable": false,
                    "orderable": false,
                    "visible": true,
                    render: function(level, type, row, meta) {
                        return level;
                    }

                },
                {
                    "data": "type",
                    "name": "type",
                    "searchable": false,
                    "orderable": false,
                    "visible": true,

                },
                {
                    "data": "menu_type",
                    "name": "menu_type",
                    "searchable": false,
                    "orderable": false,
                    "visible": true,

                },
                {
                    "data": "article",
                    "name": "article",
                    "searchable": false,
                    "orderable": false,
                    "visible": true,
                    render: function(article, type, row, meta) {
                        if(row.menu_type === 'single_article'){
                            return row.article == null?'':row.article.title_en;
                        }
                        return '';
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
                            `<a class="dropdown-item" href="javascript:void(0);" onclick="popupOrdering(${row.id})"> <i class="fal fa-pencil" aria-hidden="true"></i> Ordering</a>` +
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
                "ordering": false,
                // "order": [2,'ASC'],
                // "rowId": "id",
                "responsive": "true",
                dom: "<'row mb-3'<'col-sm-12 col-md-4 d-flex align-items-center justify-content-start'f><'col-ms-12 col-md-4 selectMenu'><'col-sm-12 col-md-4 d-flex align-items-center justify-content-end'lB>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            });
            //////INT TABLE/////

            let text = `<label for="typeMenu">Type Menu:</label>`+
               `<select name="typeMenu" id="typeMenu" onchange="getBytypeList()" class="form-control">`+
                   `<option value="Top" `+checkSelect('Top')+`>Top</option>`+
                   `<option value="Main" `+checkSelect('Main')+`>Main</option>`+
                   `<option value="Bottom" `+checkSelect('Bottom')+`>Bottom</option>`+
               '</select>';

            $('.selectMenu').html(text);


            function checkSelect(type){
                if(storeSelect == type){
                    return 'selected';
                }

                return storeSelect;
            }
        }

    }
</script>

