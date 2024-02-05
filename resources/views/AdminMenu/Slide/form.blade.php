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
                    <div class="form-group row" id="divMenu">
                        <label for="title_kh" class="col-sm-4 col-form-label">Title [Khmer]</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="title_kh" name='title_kh'
                                {{ old('title_kh') }} autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row" id="divMenu">
                        <label for="title_en" class="col-sm-4 col-form-label">Title [English]</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="title_en" name='title_en'
                                {{ old('title_en') }} autocomplete="off" />
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="col-sm-4 form-label" for="thumbnail">Image<span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <a id="lfm" data-input="thumbnail" data-preview="holder"
                                class="btn btn-primary text-white" style="border-radius: none; position: absolute;">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                            <input id="thumbnail" class="form-control" type="text" name="thumbnail"
                                {{ old('thumbnail') }}>
                            <div id="holder" style="margin-top:15px;max-height:100px; margin-bottom:15px;"></div>
                            {{-- show image when selected --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="internal_url" class="col-sm-4 col-form-label">Internal Url</label>
                        <div class="col-sm-8">
                            <textarea name="internal_url" class="form-control" id="internal_url" rows="3">{{ old('internal_url') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="external_url" class="col-sm-4 col-form-label">External Url</label>
                        <div class="col-sm-8">
                            <textarea name="external_url" class="form-control" id="external_url" rows="3">{{ old('external_url') }}</textarea>
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
    $('#lfm').filemanager('image', {
        prefix: route_prefix
    });
</script>
