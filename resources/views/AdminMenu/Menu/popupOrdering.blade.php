<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userFormLabel">Ordering <span id="displayType"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="userForm">
                    @csrf
                    <div class="form-group row" >
                        <label  class="col-sm-4 col-form-label"></label>
                        <div class="demo-v-spacing mt-0 mt-xl-0 col-sm-8">
                            <button type="button" class="btn btn-outline-success btn-pills btn-lg btn-block waves-effect waves-themed form-control">
                                First Menu
                            </button>
                            <button type="button" class="btn btn-outline-success btn-pills btn-lg btn-block waves-effect waves-themed form-control">
                                Bottom Menu
                            </button>
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label for="name" class="col-sm-4 col-form-label">After Menu : </label>
                        <div class="col-sm-6">
                            <select name="ordering" class="form-control border-left-0 bg-transparent pl-0" id="menuSelectList"></select>
                        </div>
                        <div class="col-sm-2" style="position: absolute;right: 40px;padding: 0px 20px;">
                            <button class="btn btn-default" type="button" style="    border-bottom-left-radius: 0px;border-top-left-radius: 0px;padding: 9px 23px;">Apply</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
