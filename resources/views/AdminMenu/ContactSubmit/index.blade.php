<div class="col-xl-12">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                Company <span class="fw-300"><i>List</i></span>
            </h2>

        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <!-- datatable start -->
                <table id="datalist" class="table table-bordered table-hover table-striped w-100"
                    style="font-size: 12px;border:1px solid #eee;">
                    <thead>
                        <tr>
                            <th style="text-align:center!important">ID</th>
                            <th style="text-align:center!important">-</th>
                            <th style="text-align:center!important">Name</th>
                            <th style="text-align:center!important">Email</th>
                            <th style="text-align:center!important">Subject</th>
                            <th style="text-align:center!important">Message</th>
                            <th style="text-align:center!important">Created At</th>
                        </tr>
                    </thead>
                    <tbody style="border:1px solid #eee;"></tbody>
                </table>
                <!-- datatable end -->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        getdata();
    });

    function getdata() {
        $.ajax({
            url: "{{ url('api/admin/contact-submit') }}",
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

    function getRowData(id) {
        var table = $('#datalist').DataTable();
        var selectRow = table.row($('#datalist #' + id));
        return selectRow.data();
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
                "data": "thumbnail",
                "name": "thumbnail",
                "searchable": true,
                "orderable": true,
                "visible": true,
                "render": function(data, type, row) {
                    if (data == null) {
                        return "";
                    } else {
                        return (
                            '<center><a target="_blank" href="' +
                            '{{ asset('fileCv_forms/') }}/' + row.fileCv +
                            '"> <img src="' +
                            '{{ asset('thumbnails/') }}/' + data +
                            '" class="cover" alt="cover" style="width:50px"></a></center>'
                        );
                    }
                },
            },

            {
                "data": "name",
                "name": "name",
                "searchable": true,
                "orderable": true,
                "visible": true,
            },

            {
                "data": "email",
                "name": "external_url",
                "searchable": true,
                "orderable": true,
                "visible": true,
            },
            {
                "data": "subject",
                "name": "subject",
                "searchable": true,
                "orderable": true,
                "visible": true,
            },
            {
                "data": "message",
                "name": "message",
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
        ];


        var btn = [

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
            "order": [0, 'asc'],
            "rowId": "id",
            "responsive": "true",
            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        });
        //////INT TABLE//////
    }
</script>
