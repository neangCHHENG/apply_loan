<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name='name'
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Group Name</label>
                        <div class="col-sm-8">
                            <select name="group_name" class="form-control" id="group_name">
                                <option value="Article">Article</option>
                                <option value="Configuration">Configuration</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-4 col-form-label">Type</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="type" name='type'
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="description" name='description'
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="config_value" class="col-sm-4 col-form-label">Config Value</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="config_value" name='config_value'
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
