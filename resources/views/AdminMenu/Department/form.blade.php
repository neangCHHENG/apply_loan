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
                    <span class="input-group-btn">
                        <a id="imgthumbnail" data-input="thumbnail" data-preview="holderthumbnail"
                            class="btn btn-primary text-white" style="border-radius: none;">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="filepath"
                        value="{{ $Department ? $Department->thumbnail : '' }}">
                    <div id="holderthumbnail" style="margin-top:15px;max-height:100px;"></div>
                    @if ($Department)
                        <img src="{{ $Department->thumbnail }}" alt="thumbnail" id="showThumbnail"
                            style="margin-top:15px;max-height:100px;">
                    @endif
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
