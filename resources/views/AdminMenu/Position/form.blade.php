<div class="modal fade" id="positionformModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userFormLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="positionForm">
                    @csrf
                    <!--create token-->
                    <div class="form-group row">
                        <label for="title_kh" class="col-sm-4 col-form-label">Title [Khmer]</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="title_kh" name='title_kh'
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title_en" class="col-sm-4 col-form-label">Title [English]</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="title_en" name='title_en'
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="department" class="col-sm-4 col-form-label">Department</label>

                        <div class="col-sm-8">
                            <select class="form-control select2" id="department" name='department'>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="experience" class="col-sm-4 col-form-label">Experience</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="experience" name='experience'
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="description_kh">Description [Khmer]</label>
                        <div class="col-sm-8">
                            <textarea name="description_kh" id="description_kh" class="form-control article_editor"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="description_en ">Description
                            [English]</label>
                        <div class="col-sm-8">
                            <textarea name="description_en" id="description_en" class="form-control article_editor"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-sm-4 col-form-label">Noted</label>
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
