<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="input-group">
                        <label class="col-sm-4 form-label" for="image">Image<span class="text-danger">*</span> </label>
                        <div class="col-sm-8">
                            <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary text-white" style="border-radius: none; position: absolute;">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                            <input id="image" class="form-control" type="text" name="image" {{old('image')}}>
                            <div id="holder" style="margin-top:15px;max-height:100px; margin-bottom:15px;"></div>
                            {{-- show image when selected --}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="url" class="col-sm-4 col-form-label">Url</label>
                        <div class="col-sm-8">
                            <input type="text" name="url" class="form-control" id="url" value="{{old('url')}}" autocomplete="off">
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
<script>
    var route_prefix = "/filemanager";
   $('#lfm').filemanager('image', {prefix: route_prefix});
</script>
