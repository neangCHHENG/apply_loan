<div class="col-xl-12">
    <div id="panel-2" class="panel">
        <div class="panel-hdr">
            <h2>
                Create <span class="fw-300"><i>Article</i></span>
            </h2>
        </div>

        {{-- Tap menu --}}
        <div class="panel-container show">
            <div class="panel-content">
                <ul class="nav nav-pills justify-content-end" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="javascript:;"
                            onclick="chooseLanguage('kh')">Khmer</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:;"
                            onclick="chooseLanguage('en')">English</a></li>
                </ul>
            </div>
        </div>
        {{-- Top --}}
        <div class="panel-container show">
            <div class="panel-content p-0">
                <form class="needs-validation" novalidate>
                    <div class="panel-content">
                        <div class="form-row language_kh" id="language_kh">
                            <div class="col-md-6 mb-6">
                                <label class="form-label" for="title_kh">Title [Khmer]<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="title_kh" id="title_kh"
                                    onkeyup="setSlug('kh')" value="{{ $Article ? $Article->title_kh : '' }}"
                                    placeholder="Title" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 mb-6">
                                <label class="form-label" for="slug_kh">Slug [Khmer] <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug_kh" id="slug_kh"
                                    value="{{ $Article ? $Article->slug_kh : '' }}" readonly>
                            </div>
                        </div>
                        <div class="form-row language_en" id="language_en">
                            <div class="col-md-6 mb-6">
                                <label class="form-label" for="title_en">Title [Enlish]<span
                                        class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="title_en" id="title_en"
                                    onkeyup="setSlug('en')" value="{{ $Article ? $Article->title_en : '' }}"
                                    placeholder="Title" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 mb-6">
                                <label class="form-label" for="slug_en">Slug [Enlish]<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug_en" id="slug_en"
                                    value="{{ $Article ? $Article->slug_en : '' }}" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- content --}}
<div class="row">
    <div class="col-xl-8">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content p-2">
                    <form class="needs-validation" novalidate>
                        <div class="panel-content">
                            <div class="form-row">
                                <div class="col-md-12 mb-6 language_kh" id="language_kh">
                                    <label class="form-label" for="introduction_kh">Introduction [Khmer]<span
                                            class="text-danger"></span> </label>
                                    <textarea name="introduction_kh" id="introduction_kh" class="form-control introduction_kh" rows="2">{{ $Article ? $Article->introduction_kh : '' }}</textarea>
                                </div>
                                <div class="col-md-12 mb-6 language_kh" id="language_kh">
                                    <label class="form-label" for="article_editor_kh">Article Editor [Khmer]<span
                                            class="text-danger">*</span> </label>
                                    <textarea name="article_editor_kh" id="article_editor_kh" class="form-control article_editor">{{ $Article ? $Article->article_editor_kh : '' }}</textarea>
                                </div>
                                <div class="col-md-12 mb-6 language_kh" id="language_kh">
                                    <label class="form-label" for="meta_keyword_kh">Meta Key Word [Khmer]<span
                                            class="text-danger"></span> </label>
                                    <input type="text" name="meta_keyword_kh" id="meta_keyword_kh"
                                        class="form-control meta_keyword_kh"
                                        value="{{ $Article ? $Article->meta_keyword_kh : '' }}">
                                </div>
                                <div class="col-md-12 mb-6 language_kh" id="language_kh">
                                    <label class="form-label" for="meta_content_kh">Meta Content [Khmer]<span
                                            class="text-danger"></span> </label>
                                    <textarea name="meta_content_kh" id="meta_content_kh" class="form-control meta_content_kh" rows="2">{{ $Article ? $Article->meta_content_kh : '' }}</textarea>
                                </div>
                                {{-- English --}}
                                <div class="col-md-12 mb-6 language_en" id="language_en">
                                    <label class="form-label" for="introduction_en">Introduction [English]<span
                                            class="text-danger"></span> </label>
                                    <textarea name="introduction_en" id="introduction_en" class="form-control introduction_en" rows="2">{{ $Article ? $Article->introduction_en : '' }}</textarea>
                                </div>
                                <div class="col-md-12 mb-6 language_en" id="language_en">
                                    <label class="form-label" for="article_editor_en">Article Editor [English]<span
                                            class="text-danger">*</span> </label>
                                    <textarea name="article_editor_en" id="article_editor_en" class="form-control article_editor">{{ $Article ? $Article->article_editor_en : '' }}</textarea>
                                </div>
                                <div class="col-md-12 mb-6 language_en" id="language_en">
                                    <label class="form-label" for="meta_keyword_en">Meta Key Word [English]<span
                                            class="text-danger"></span> </label>
                                    <input type="text" name="meta_keyword_en" id="meta_keyword_en"
                                        class="form-control meta_keyword_en"
                                        value="{{ $Article ? $Article->meta_keyword_en : '' }}">
                                </div>
                                <div class="col-md-12 mb-6 language_en" id="language_en">
                                    <label class="form-label" for="meta_content_en">Meta Content [English]<span
                                            class="text-danger"></span> </label>
                                    <textarea name="meta_content_en" id="meta_content_en" class="form-control meta_content_en" rows="2">{{ $Article ? $Article->meta_content_en : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- letf panel --}}
    <div class="col-xl-4">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content p-2">
                    <form class="needs-validation" novalidate>
                        <div class="panel-content">
                            <div class="form-row">
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="validationCustom01">Status </label>
                                    <select class="custom-select form-control" name="state" id="state">
                                        @if ($Article)
                                            <option value="1"
                                                {{ $Article->state == 1 ? 'selected="selected"' : '' }}>
                                                Published</option>
                                            <option value="0"
                                                {{ $Article->state == 0 ? 'selected="selected"' : '' }}>
                                                Unpublished</option>
                                            <option value="2"
                                                {{ $Article->state == 2 ? 'selected="selected"' : '' }}>
                                                Archived</option>
                                            <option value="-2"
                                                {{ $Article->state == -2 ? 'selected="selected"' : '' }}>
                                                Trashed</option>
                                        @else
                                            <option value="1" selected="selected">Published</option>
                                            <option value="0">Unpublished</option>
                                            <option value="2">Archived</option>
                                            <option value="-2">Trashed</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="parent_category_id">Category</label>
                                    <select class="custom-select form-control" name="parent_category_id"
                                        id="parent_category_id">
                                        @foreach ($category as $key => $value)
                                            @if ($Article)
                                                <option value="{{ $value->id }}"
                                                    {{ $Article->parent_category_id == $value->id ? 'selected="selected"' : '' }}>
                                                    {{ $value->name_en }}</option>
                                            @else
                                                <option value="{{ $value->id }}"
                                                    {{ $key == 0 ? 'selected="selected"' : '' }}>{{ $value->name_en }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="schedule">Schedule Publishe</label>
                                    <input type="datetime-local" name="schedule" id="schedule" class="form-control"
                                        value="{{ $Article ? $Article->schedule : 0 }}">
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="feature">Featured </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="feature"
                                            id="feature"
                                            {{ $Article ? ($Article->feature == 1 ? 'checked' : '') : '' }}>
                                        <label class="custom-control-label" for="feature"></label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="available">Availabled Language</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="available"
                                            id="available">
                                        <label class="custom-control-label" for="available"></label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="ordering">Ordering<span
                                            class="text-danger">*</span> </label>
                                    <input type="number" class="form-control" name="ordering" id="ordering"
                                        value="{{ $Article ? $Article->ordering : 0 }}" placeholder="Number">
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="access">Access</label>
                                    <select class="custom-select form-control" name="access" id="access">
                                        <option value="1" selected="selected">Public</option>
                                        @if ($Article)
                                            <option value="1"
                                                {{ $Article->state == 1 ? 'selected="selected"' : '' }}>
                                                Guest</option>
                                            <option value="2"
                                                {{ $Article->state == 2 ? 'selected="selected"' : '' }}>
                                                Registered</option>
                                            <option value="3"
                                                {{ $Article->state == 3 ? 'selected="selected"' : '' }}>
                                                Special</option>
                                            <option value="4"
                                                {{ $Article->state == 4 ? 'selected="selected"' : '' }}>
                                                Super Users</option>
                                        @else
                                            <option value="1" selected="selected">Guest</option>
                                            <option value="2">Registered</option>
                                            <option value="3">Special</option>
                                            <option value="4">Super Users</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="relate_article">Relate Articles </label>
                                    <select class="custom-select form-control" name="relate_article"
                                        id="relate_article" multiple>
                                        @foreach ($RelateArticle as $key => $RelateArticles)
                                            <option value="{{ $RelateArticles->id }}">
                                                {{ $RelateArticles->title_en }} | {{ $RelateArticles->title_kh }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="parent_tag_id">Tags </label>
                                    <select class="custom-select form-control" name="parent_tag_id"
                                        id="parent_tag_id" multiple>
                                        <option value="Explore">Explore</option>
                                        <option value="StudentLife">Student Life</option>
                                        <option value="Campus">Campus</option>
                                        <option value="OverseasFieldTrip">Overseas FieldTrip</option>
                                        <option value="MostVisite">Most Visite</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="image">Image<span class="text-danger"></span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                class="btn btn-primary text-white" style="border-radius: none;">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" name="filepath"
                                            value="{{ $Article ? $Article->thumbnail : '' }}">
                                    </div>
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    @if ($Article)
                                        <img src="{{ $Article->thumbnail }}" alt="thumbnail" id="showThumbnail"
                                            style="margin-top:15px;max-height:100px;">
                                    @endif
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="image">Image Background<span
                                            class="text-danger"></span> </label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="imgBack" data-input="thumbnailimgBack" data-preview="holderBack"
                                                class="btn btn-primary text-white" style="border-radius: none;">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                        <input id="thumbnailimgBack" class="form-control" type="text"
                                            name="filepath" value="{{ $Article ? $Article->thumbnailimgBack : '' }}">
                                    </div>
                                    <div id="holderBack" style="margin-top:15px;max-height:100px;"></div>
                                    @if ($Article)
                                        <img src="{{ $Article->thumbnailimgBack }}" alt="thumbnail"
                                            id="showThumbnail" style="margin-top:15px;max-height:100px;">
                                    @endif
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="note">Note </label>
                                    <input type="text" class="form-control" name="note" id="note"
                                        value="{{ $Article ? $Article->note : '' }}" placeholder="Note">
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer " style="display: block;">
                            <button type="button" class="btn btn-primary"
                                onclick="save()">{{ $Article ? 'Add New' : 'Save' }}</button>
                            @if ($Article)
                                <button type="button" class="btn btn-primary" id="btnUpdate"
                                    onclick="update({{ $Article->id }})">Update</button>
                            @endif
                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($Article) {
    echo "<script> var dataArticle = $Article </script>";
} else {
    echo '<script> var dataArticle = null </script>';
}
?>
<script>
    $(document).ready(function() {
        $('.language_en').hide();
        var options = {
            height: 430,
            filebrowserImageBrowseUrl: '/filemanager?type=Images',
            filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/filemanager?type=Files',
            filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
        };
        $('.article_editor').each(function() {
            CKEDITOR.replace($(this).prop('id'), options);
            CKEDITOR.config.allowedContent = {
                $1: {
                    elements: CKEDITOR.dtd,
                    attributes: true,
                    styles: true,
                    classes: true
                }
            };
            CKEDITOR.config.disallowedContent = 'script; *[on*]';
        });
        $('#parent_tag_id').select2();
        $('#relate_article').select2();
    });

    // 1. valueFil() => get value
    // 2. valueFil('clear') => clear text
    function valueFil(val = null) {
        let title_en;
        let title_kh;
        let slug_kh;
        let slug_en;
        let state;
        let feature;
        let access;
        let thumbnail;
        let introduction_kh;
        let introduction_en;
        let meta_keyword_kh;
        let meta_content_kh;
        let meta_keyword_en;
        let meta_content_en;
        let note;
        let relate_article;
        let parent_tag_id;
        let article_editor_en;
        let article_editor_kh;
        let parent_category_id;
        let ordering;
        let schedule;
        let thumbnailimgBack;
        if (val === null) {
            title_en = $('#title_en').val();
            title_kh = $('#title_kh').val();
            slug_kh = $('#slug_kh').val();
            slug_en = $('#slug_en').val();
            state = $('#state').val();
            feature = $('#feature').is(':checked') ? 1 : 0;
            access = $('#access').val();
            thumbnail = $('#thumbnail').val();
            thumbnailimgBack = $('#thumbnailimgBack').val();
            introduction_kh = $('#introduction_kh').val();
            introduction_en = $('#introduction_en').val();
            meta_keyword_kh = $('#meta_keyword_kh').val();
            meta_content_kh = $('#meta_content_kh').val();
            meta_keyword_en = $('#meta_keyword_en').val();
            meta_content_en = $('#meta_content_en').val();
            note = $('#note').val();
            relate_article = $('#relate_article').val().toString();
            parent_tag_id = $('#parent_tag_id').val().toString();
            parent_category_id = $('#parent_category_id').val();
            article_editor_en = CKEDITOR.instances['article_editor_en'].getData();
            article_editor_kh = CKEDITOR.instances['article_editor_kh'].getData();
            ordering = $('#ordering').val();
            schedule = $('#schedule').val();
        }
        if (val === 'clear') {
            $('#title_en').val('');
            $('#title_kh').val('');
            $('#slug_kh').val('');
            $('#slug_en').val('');
            $('#state').val('');
            $('#feature').val('');
            $('#thumbnail').val('');
            $('#thumbnailimgBack').val('');
            $('#introduction_kh').val('');
            $('#introduction_en').val('');
            $('#meta_keyword_kh').val('');
            $('#meta_content_kh').val('');
            $('#meta_keyword_en').val('');
            $('#meta_content_en').val('');
            $('#note').val('');
            $('#access').val('');
            $('#ordering').val('');
            $('#schedule').val('');
            CKEDITOR.instances['article_editor_kh'].setData("");
            CKEDITOR.instances['article_editor_en'].setData("");
        }
        if ($('#available').is(':checked')) {
            title_en = title_kh;
            slug_en = slug_kh;
            introduction_en = introduction_kh;
            meta_content_en = meta_content_kh;
            meta_keyword_en = meta_keyword_kh;
            article_editor_en = article_editor_kh;
        }
        return {
            'title_en': title_en,
            'title_kh': title_kh,
            'slug_kh': slug_kh,
            'slug_en': slug_en,
            'state': state,
            'feature': feature,
            'thumbnail': thumbnail,
            'thumbnailimgBack': thumbnailimgBack,
            'introduction_kh': introduction_kh,
            'introduction_en': introduction_en,
            'meta_keyword_en': meta_keyword_en,
            'meta_content_en': meta_content_en,
            'meta_keyword_kh': meta_keyword_kh,
            'meta_content_kh': meta_content_kh,
            'note': note,
            'access': access,
            'relate_article': relate_article,
            'parent_tag_id': parent_tag_id,
            'article_editor_en': article_editor_en,
            'article_editor_kh': article_editor_kh,
            'parent_category_id': parent_category_id,
            'ordering': ordering,
            'schedule': schedule,
        };
    }

    function chooseLanguage(language) {
        if (language === 'kh') {
            $('.language_en').hide();
            $('.language_kh').show();
        } else {
            $('.language_en').show();
            $('.language_kh').hide();
        }
    }

    function setSlug(value) {
        let fil = valueFil();
        if (value === 'kh') {
            let slug_kh = fil.title_kh;
            slug_kh = slug_kh.toLowerCase();
            slug_kh = slug_kh.replace(/ /g, '-');
            $('#slug_kh').val(slug_kh);
        } else {
            let slug_en = fil.title_en;
            slug_en = slug_en.toLowerCase();
            slug_en = slug_en.replace(/ /g, "-");
            $('#slug_en').val(slug_en);
        }

    }

    function save() {
        if (0 === 0) {
            $.ajax({
                url: "{{ url('/api/admin/article') }}",
                type: "POST",
                data: valueFil(),
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                },
                success: function(response) {
                    if (response.status == "error") {
                        validationMgs(response);
                        return;
                    }
                    sweetToast(response.status, response.icon);
                    unblockagePage();

                    viewArticle(); // back article list
                },
                error: function(e) {
                    Msg(e, 'error');
                    unblockagePage();
                }
            });
        }
    }

    function update(id) {
        if (0 === 0) {
            $.ajax({
                url: "{{ url('/api/admin/article') }}/" + id,
                type: "PUT",
                data: valueFil(),
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                },
                success: function(response) {
                    if (response.status == "error") {
                        validationMgs(response);
                        return;
                    }
                    unblockagePage();
                    sweetToast(response.status, response.icon);
                    $('#articleList').trigger('click'); // back article list
                },
                error: function(e) {
                    Msg('Error Saving User', 'error');
                    unblockagePage();
                }
            });
        }
    }

    function editSelect2() {
        if (dataArticle.parent_tag_id) {

            $('#parent_tag_id').val(dataArticle.parent_tag_id.split(",")).change();
        }
        if (dataArticle.relate_article) {

            $('#relate_article').val(dataArticle.relate_article.split(",")).change();
        }
    }
</script>
<script>
    var route_prefix = "/filemanager";
    $('#lfm').filemanager('image', {
        prefix: route_prefix
    });
    var route_prefix = "/filemanager";
    $('#logoArticle').filemanager('image', {
        prefix: route_prefix
    });
    var route_prefix = "/filemanager";
    $('#imgBack').filemanager('image', {
        prefix: route_prefix
    });
</script>
