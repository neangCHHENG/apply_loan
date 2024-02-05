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
                        <label for="description_kh" class="col-sm-4 col-form-label">Description [Khmer]</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="form-control" id="description_kh" name='description_kh' autocomplete="off"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description_en" class="col-sm-4 col-form-label">Description [English]</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="form-control" id="description_en" name='description_en' autocomplete="off"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="external_url" class="col-sm-4 col-form-label">External Url</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="external_url" name='external_url'
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="facebook_url" class="col-sm-4 col-form-label">Facebook Url</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="facebook_url" name='facebook_url'
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
                        <label class="col-sm-4 col-form-label" for="image">Image Background<span
                                class="text-danger"></span> </label>
                        <div class="col-sm-8">
                            <span class="input-group-btn">
                                <a id="imgthumbnail" data-input="thumbnail" data-preview="holderthumbnail"
                                    class="btn btn-primary text-white" style="border-radius: none;">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="filepath"
                                value="{{ $Company ? $Company->thumbnail : '' }}">
                        </div>
                        <div id="holderthumbnail" style="margin-top:15px;max-height:100px;"></div>
                        @if ($Company)
                            <img src="{{ $Company->thumbnail }}" alt="thumbnail" id="showThumbnail"
                                style="margin-top:15px;max-height:100px;">
                        @endif
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
