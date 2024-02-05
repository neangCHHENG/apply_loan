<div class="col-xl-12">
    <div id="panel-2" class="panel">
        <div class="panel-hdr">
            <h2>
                Create <span class="fw-300"><i>Menu</i></span>
            </h2>
        </div>
        {{-- Tap menu --}}
        <div class="panel-container show">
            <div class="panel-content">
                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label class="form-label" for="menu_en">Menu Enlish <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="menu_en" id="menu_en" onkeyup="setSlug()"
                            value="{{ $menu ? $menu->menu_en : '' }}" placeholder="Menu Enlish" required>
                        <input type="hidden" class="form-control" name="slug" id="slug"
                            value="{{ $menu ? $menu->slug : '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-6">
                        <label class="form-label" for="menu_kh">Menu Khmer <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="menu_kh" id="menu_kh"
                            value="{{ $menu ? $menu->menu_kh : '' }}" placeholder="Menu Khmer" required>
                    </div>
                </div>
            </div>
        </div>
        {{-- Tap menu --}}
    </div>
</div>
<div class="row">
    <div class="col-xl-8">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content p-2">
                    <form class="needs-validation" novalidate>
                        <div class="panel-content">

                            <div class="form-row">
                                <div class="col-md-12 mb-6">
                                    <div class="form-group">
                                        <label class="form-label">Menu Item Type <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm bg-white shadow-inset-2">
                                            <input type="hidden" class="form-control" id="menu_type" readonly>
                                            <input type="hidden" class="form-control" id="param1" readonly>
                                            <input type="text" class="form-control" id="menuItemTypeShow" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-default" type="button"
                                                    onclick="selectConfigType()">Select</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-6" id="divReference">
                                    <div class="form-group">
                                        <label class="form-label" id="lableNameReference"><span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm bg-white shadow-inset-2">
                                            <input type="hidden" class="form-control" id="reference_id" readonly>
                                            <input type="text" class="form-control" id="referenceInput" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-default" type="button"
                                                    onclick="getReference()">Select</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-6"  id="divLink">
                                    <label class="form-label" for="link">Link</label>
                                    <input type="text" class="form-control" name="link" id="link"
                                        value="{{ $menu ? $menu->link : '' }}" placeholder="Link" >
                                </div>
                                <div class="col-md-12 mb-6" id="divTarget">
                                    <label class="form-label" for="target">Target Window<span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select form-control" name="target" id="target">
                                        <option value="0" selected="selected">Parent</option>
                                        <option value="1">New Window With Navigation</option>
                                        <option value="2">New Window Without Navigation</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content p-2">
                    <form class="needs-validation" novalidate>
                        <div class="panel-content">
                            <div class="form-row">
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="type">Type</label>
                                    <select class="custom-select form-control" name="type" id="type" onchange="getParentItem()" >
                                        @foreach ($type as $types)
                                            @if ($menu != null)
                                                <option value="{{$types->name}}"  {{ $menu->type == $types->name ? 'selected="selected"' : '' }}>{{$types->name}}</option>
                                            @else
                                                <option value="{{$types->name}}">{{$types->name}}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="parent_id">Parent Item</label>
                                    <select class="custom-select form-control" name="parent_id" id="parent_id">

                                    </select>
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label class="form-label" for="validationCustom01">Status </label>
                                    <select class="custom-select form-control" name="state" id="state">
                                        @if ($menu)
                                            <option value="1" {{ $menu->state == 1 ? 'selected="selected"' : '' }}>
                                                Published</option>
                                            <option value="0" {{ $menu->state == 0 ? 'selected="selected"' : '' }}>
                                                Unpublished</option>
                                            <option value="2" {{ $menu->state == 2 ? 'selected="selected"' : '' }}>
                                                Archived</option>
                                            <option value="-2" {{ $menu->state == -2 ? 'selected="selected"' : '' }}>
                                                Trashed</option>
                                        @else
                                            <option value="1" selected="selected">Published</option>
                                            <option value="0">Unpublished</option>
                                            <option value="2">Archived</option>
                                            <option value="-2">Trashed</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer " style="display: block;">
                            <button type="button" class="btn btn-primary"
                                onclick="save()">{{ $menu ? 'Add New' : 'Save' }}</button>
                            @if ($menu)
                                <button type="button" class="btn btn-primary" id="btnUpdate"
                                    onclick="update({{ $menu->id }})">Update</button>
                            @endif
                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('AdminMenu.Menu.popupCategory')
@include('AdminMenu.Menu.popupArticle')
@include('AdminMenu.Menu.popupConfigType')
@include('AdminMenu.Menu.popupCategoryEvent')

<script>
    $(document).ready(function() {
        $('#divReference').hide();
        $('#divLink').hide();
        $('#divTarget').hide();
        // getParentItem();
    });

    function getParentItem(id){
        let type = valueFil().type;
        $.ajax({
            url: "{{ url('api/admin/menu/selectMenu') }}",
            type: "POST",
            data: {"type": type, "id": id },
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.status == "error") {
                    sweetToast(response.msg, response.icon);
                    return;
                }

                let optionParentMenu = '';
                response.data.forEach(element => {
                    let paddingLeft = '-'.repeat( element.level);
                    optionParentMenu += `<option value="${element.id}" ${selectParentMenu(element.id)}> ${paddingLeft} ${element.menu_en} - [${element.menu_kh}]</option>`;
                });
                $('#parent_id').html(optionParentMenu);
            },
            error: function(e) {
                if (e.status = 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }
                unblockagePage();
            }
        });

    }

    function selectParentMenu(idType){
        if(dataUpdate){
            if(idType == dataUpdate.parent_id){
                return 'selected';
            }
        }
        return '';
    }

    // 1. valueFil() => get value
    // 2. valueFil('clear') => clear text
    function valueFil(val = null) {
        let menu_en;
        let slug;
        let menu_kh;
        let link;
        let state;
        let parent_id;
        let reference_id;
        let menu_type;
        let type;
        let param1;

        if (val === null) {
            menu_en = $('#menu_en').val();
            slug = menu_en.replace(/ /g,'-');
            menu_kh = $('#menu_kh').val();
            link = $('#link').val();
            state = $('#state').val();
            parent_id = $('#parent_id').val();
            reference_id = $('#reference_id').val();
            menu_type = $('#menu_type').val();
            type = $('#type').val();
            param1 = $('#param1').val();

        }
        if (val === 'clear') {
            $('#menu_en').val('');
            $('#slug').val('');
            $('#menu_kh').val('');
            $('#link').val('');
            $('#state').val('');
            $('#parent_id').val('');
            $('#reference_id').val('');
            $('#menu_type').val('');
            $('#type').val('');
            $('#param1').val('');

        }

        return {
            'menu_en': menu_en,
            'slug': slug,
            'menu_kh': menu_kh,
            'link': link,
            'state': state,
            'parent_id': parent_id,
            'reference_id': reference_id,
            'menu_type': menu_type,
            'type': type,
            'param1': param1,

        };
        return data;
    }

    // open form popup
    function selectConfigType() {
        $('#referenceInput').val('');
        $('#reference_id').val('');
        $('#link').val('');
        $('#formModalConfigType').modal();
    }

    function getReference(){
        let menu_type = valueFil().menu_type;
        if(menu_type === 'single_article'){
            $('#formModalArticle').modal();
        }
        if(menu_type === 'single_category'){
            $('#formModalCategory').modal();
        }
        if(menu_type === 'event_list' || menu_type === 'event_grid'){
            $('#formModalCategoryEevent').modal();
        }
    }

    function setSlug() {
        let slug = valueFil().slug;
        slug = slug.toLowerCase();
        slug = slug.replace(/ /g, "-");
        $('#slug').val(slug);
    }

    function save() {
        if (0 === 0) {
            $.ajax({
                url: "{{ url('/api/admin/menu') }}",
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

                    viewMenuItems(); // back menu list
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
                url: "{{ url('/api/admin/menu') }}/" + id,
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
                    viewMenuItems(); // back menu list

                    unblockagePage();
                    sweetToast(response.status, response.icon);
                },
                error: function(e) {
                    Msg('Error Saving User', 'error');
                    unblockagePage();
                }
            });
        }
    }
</script>
