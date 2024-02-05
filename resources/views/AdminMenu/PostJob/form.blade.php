<div class="modal fade" id="postJobformModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postJobFormLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="postJobForm">
                    @csrf
                    <div class="form-group row">
                        <label for="company" class="col-sm-4 col-form-label">Company</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="company" name='company'>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="position" class="col-sm-4 col-form-label">Position</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="position" name='position'>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="location" class="col-sm-4 col-form-label">Location</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="location" name='location'>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vacancy_type" class="col-sm-4 col-form-label">Vacancy Type</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="vacancy_type" name='vacancy_type'>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="urgent">Urgent </label>
                        <div class="col-sm-8 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="urgent" id="urgent">
                            <label class="custom-control-label" for="urgent"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hiring" class="col-sm-4 col-form-label">Hiring</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="hiring" name='hiring'
                                autocomplete="off" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="offered_salary" class="col-sm-4 col-form-label">Offered Salary</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="offered_salary" name='offered_salary'
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="qualification" class="col-sm-4 col-form-label">Qualification</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="qualification" name='qualification'>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="language_skills" class="col-sm-4 col-form-label">Language Skills</label>
                        <div class="col-sm-8">
                            <select multiple class="custom-select form-control select2" id="language_skills"
                                name='language_skills'>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="career_level" class="col-sm-4 col-form-label">Career Level</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="career_level" name='career_level'>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start_date" class="col-sm-4 col-form-label">Start Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="start_date" name='start_date'
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end_date" class="col-sm-4 col-form-label">End Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="end_date" name='end_date'
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="image">Thumbnail<span
                                class="text-danger"></span> </label>
                        <div class="col-sm-8">
                            <span class="input-group-btn">
                                <a id="imgthumbnail" data-input="thumbnail" data-preview="holderthumbnail"
                                    class="btn btn-primary text-white" style="border-radius: none;">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="filepath"
                                value="{{ $PostJob ? $PostJob->thumbnail : '' }}">
                        </div>
                        <div id="holderthumbnail" style="margin-top:15px;max-height:100px;"></div>
                        @if ($PostJob)
                            <img src="{{ $PostJob->thumbnail }}" alt="thumbnail" id="showThumbnail"
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
