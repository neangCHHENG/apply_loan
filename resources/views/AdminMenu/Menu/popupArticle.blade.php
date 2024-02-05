<div class="modal fade" id="formModalArticle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userFormLabel">Article List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="accordion accordion-outline displayContentArticle" >
                            <table id="datalistArticle" class="table table-bordered table-hover table-striped w-100" style="font-size: 12px;border:1px solid #eee;">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" onclick="createArticle()" style="position: absolute; left: 20px;" data-dismiss="modal" >Create Article</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        getArticle();
    });

    function getArticle(){
        $.ajax({
            url: "{{ url('api/admin/article') }}",
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
                dataListArticle(response.data);
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
    function selectArticle(id){
        let dateRow = getRowData(id)

        $('#formModalArticle').modal('hide');
        $('#reference_id').val(dateRow.id);
        $('#referenceInput').val(dateRow.title_en);
    }
    function getRowData(id) {
        var table = $('#datalistArticle').DataTable();
        var selectRow = table.row($('#datalistArticle #' + id));
        return selectRow.data();
    }
    function createArticle() {
        $.ajax({
            url: "{{ url('/api/admin/article/create') }}",
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
     // datatable data
    function dataListArticle(data) {
        var cols = [
            {
                "data": "id",
                "name": "id",
                "searchable": false,
                "orderable": false,
                "visible": false,

            },
            {
                "data": "title_en",
                "name": "title_en",
                "searchable": true,
                "orderable": true,
                "visible": true,
                // "class": "dt-center",
                render: function(title_en, type, row, meta) {
                    var str = `<a href="javascript:void(0);" onclick="selectArticle(${row.id})">${title_en} - ${row.title_kh}</a>`;
                    return str;
                }

            }

        ];

        var btn = [

        ];
        if ($.fn.DataTable.isDataTable('#datalistArticle')) {
            $('#datalistArticle').DataTable().clear();
            $('#datalistArticle').DataTable().destroy();
        }
        //////INT TABLE//////
        var table = $('#datalistArticle').DataTable({
            "data": data,
            "columns": cols,
            "buttons": btn,
            "ordering": false,
            // "order": [2,'ASC'],
            "rowId": "id",
            "responsive": "true",
            dom: "<'row mb-3'<'col-sm-12 col-md-4 d-flex align-items-center justify-content-start'f><'col-ms-12 col-md-4 selectMenu'><'col-sm-12 col-md-4 d-flex align-items-center justify-content-end'lB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        });
        //////INT TABLE/////
    }

</script>
