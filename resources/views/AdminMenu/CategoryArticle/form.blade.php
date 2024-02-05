<div class="modal fade" id="formModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userFormLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="userForm">
                    @csrf
                    <!--create token-->
                    <div class="form-group row" >
                        <label for="name_kh" class="col-sm-4 col-form-label">Name [Khmer]</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name_kh" name='name_kh'
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label for="name_en" class="col-sm-4 col-form-label">Name [English]</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name_en" name='name_en'
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description_kh" class="col-sm-4 col-form-label">Description [Khmer]</label>
                        <div class="col-sm-8">
                            <textarea name="description_kh" class="form-control" id="description_kh" rows="3">{{old('description_kh')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description_en" class="col-sm-4 col-form-label">Description [English]</label>
                        <div class="col-sm-8">
                            <textarea name="description_en" class="form-control" id="description_en" rows="3">{{old('description_en')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row" id="divNote">
                        <label for="note" class="col-sm-4 col-form-label">Note</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="note" name='note'
                                autocomplete="off" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save</button>
                <button type="button" class="btn btn-primary" id="btnUpdate" onclick="update()">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
