<div class="modal fade" id="formModalCategoryEevent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userFormLabel">Category Event List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="accordion accordion-outline displayContentCategoryEevent" >

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        getCategoryEvent();
    });

    function getCategoryEvent(){
        $.ajax({
            url: "{{ url('api/admin/category-event') }}",
            type: "GET",
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.status == "error") {
                    sweetToast(response.msg, response.icon);
                    return;
                }
                let optionSelect = '';
                for( var key in response.data){
                    optionSelect += `<div class="card">` +
                        `<div class="card-header">` +
                        `<a href="javascript:void(0);" class="card-title"`+
                        `data-id="${response.data[key].id}" data-name="${response.data[key].name_en}" onclick="selectCategoryEvent(this)">` +
                        `<i class="fal fa-file-medical-alt width-2 fs-xl"></i>${response.data[key].name_en} ` +
                        `</a>` +
                        `</div></div>`;
                };
                $('.displayContentCategoryEevent').html(optionSelect);
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
    function selectCategoryEvent(item){
        let category = $(item);
        $('#formModalCategoryEevent').modal('hide');
        $('#reference_id').val(category[0].dataset.id);
        $('#referenceInput').val(category[0].dataset.name);
    }
</script>
