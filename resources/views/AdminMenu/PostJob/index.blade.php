<div class="col-xl-12">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                Post Job <span class="fw-300"><i>List</i></span>
            </h2>
            <div class="panel-toolbar">
                <button class="btn btn-primary btn-sm waves-effect waves-themed" onclick="create()">Add New</button>
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <!-- datatable start -->
                <table id="datalist" class="table table-bordered table-hover table-striped w-100"
                    style="font-size: 12px;border:1px solid #eee;">
                    <thead>
                        <tr>
                            <th style="text-align:center!important">ID</th>
                            <th style="text-align:center!important">Position</th>
                            <th style="text-align:center!important">Department</th>
                            <th style="text-align:center!important">Company</th>
                            <th style="text-align:center!important">Location</th>
                            <th style="text-align:center!important">Vacancy Type</th>
                            <th style="text-align:center!important">Hiring</th>
                            <th style="text-align:center!important">Offered Salary</th>
                            <th style="text-align:center!important">Qualification</th>
                            <th style="text-align:center!important">Experiance</th>
                            <th style="text-align:center!important">Language Skills</th>
                            <th style="text-align:center!important">Language Skills ID</th>
                            <th style="text-align:center!important">Career Level</th>
                            <th style="text-align:center!important">Career Level ID</th>
                            <th style="text-align:center!important">Description</th>
                            <th style="text-align:center!important">Expiration Date</th>
                            <th style="text-align:center!important">Note</th>
                            <th style="text-align:center!important">Create By</th>
                            <th style="text-align:center!important">Create Date</th>
                            <th style="text-align:center!important">Action</th>
                            <th style="text-align:center!important">Company id</th>
                            <th style="text-align:center!important">position id</th>
                            <th style="text-align:center!important">location id</th>
                            <th style="text-align:center!important">vacancy type id</th>
                            <th style="text-align:center!important">qualification_id</th>
                            <th style="text-align:center!important">career_level</th>
                            <th style="text-align:center!important">urgent</th>
                        </tr>
                    </thead>
                    <tbody style="border:1px solid #eee;"></tbody>
                </table>
                <!-- datatable end -->
            </div>
        </div>
    </div>
</div>
@include('AdminMenu.PostJob.form')
<script>
    {
        $(document).ready(function() {
            $('#btnUpdate').hide();
            getdata();
            getPositionList();
            getLocationList();
            getVacancyTypeList();
            getQualificationList();
            getCompanyList();
            getLanguSkillList();
            getCareerLevelList();
        });
        var idEdit = null;

        function valueFil(val = null) {
            var location = null;
            var vacancy_type = null;
            var note = null;
            var position = null;
            var start_date = null;
            var end_date = null;
            var hiring = null;
            var offered_salary = null;
            var qualification = null;
            var language_skills = null;
            var company = null;
            var career_level = null;
            let thumbnail;
            var urgent;
            if (val === null) {
                location = $('#location').val();
                vacancy_type = $('#vacancy_type').val();
                position = $('#position').val();
                start_date = $('#start_date').val();
                end_date = $('#end_date').val();
                note = $('#note').val();
                thumbnail = $('#thumbnail').val();
                hiring = $('#hiring').val();
                qualification = $('#qualification').val();
                offered_salary = $('#offered_salary').val();
                language_skills = $('#language_skills').val().toString();
                company = $('#company').val();
                career_level = $('#career_level').val();
                urgent = $('#urgent').is(':checked') ? 1 : 0;


            }
            if (val === 'clear') {
                $('#location').val('');
                $('#qualification').val('');
                $('#vacancy_type').val('');
                $('#position').val('');
                $('#end_date').val('');
                $('#start_date').val('');
                $('#note').val('');
                $('#thumbnail').val('');
                $('#hiring').val('');
                $('#offered_salary').val('');
                $('#language_skills').val('');
                $('#company').val('');
                $('#career_level').val('');
                $('#urgent').val('');
            }
            return {
                'location': location,
                'vacancy_type': vacancy_type,
                'position': position,
                'end_date': end_date,
                'start_date': start_date,
                'note': note,
                'thumbnail': thumbnail,
                'hiring': hiring,
                'offered_salary': offered_salary,
                'qualification': qualification,
                'language_skills': language_skills,
                'company': company,
                'career_level': career_level,
                'urgent': urgent,
            }
        }

        function getdata() {
            $.ajax({
                url: "{{ url('api/admin/post-job') }}",
                type: "GET",
                beforeSend: function(xhr) {
                    blockagePage('Please Wait...');
                    xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                },
                success: function(response) {
                    if (response.status == "error") {
                        sweetToast(response.msg, response.icon);
                        return;
                    }
                    dataList(response.data);
                    unblockagePage();
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

        // open form popup
        function create() {
            valueFil('clear');
            $('#btnUpdate').hide();
            $('#postJobformModal').modal();
            $('#btnSave').text('Save');
        }

        function save() {
            if (0 === 0) {
                $.ajax({
                    url: "{{ url('/api/admin/post-job') }}",
                    type: "POST",
                    data: valueFil(),
                    beforeSend: function(xhr) {
                        blockagePage('Please Wait...');
                        xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                    },
                    success: function(response) {
                        if (response.status == "error") {
                            validationMgs(response);
                            return;
                        }
                        $("#postJobformModal").modal('hide');
                        sweetToast(response.status, response.icon);
                        unblockagePage();
                        dataList(response.data);
                    },
                    error: function(e) {
                        Msg('Error Saving User', 'error');
                        unblockagePage();
                    }
                });
            }
        }

        function edit(id) {
            idEdit = id;
            var data = getRowData(id);

            // Populate form fields
            $('#postJobformModal').modal();
            $('#location').val(data.location_id).trigger('change');
            $('#vacancy_type').val(data.vacancy_type_id).trigger('change');
            $('#position').val(data.position_id).trigger('change');
            $('#holderthumbnail').html(
                `<img src="${data.thumbnail}" alt="image" id="showThumbnail" style="height: 5rem;">`);
            $('#thumbnail').val(data.thumbnail);
            $('#end_date').val(data.end_date);
            $('#start_date').val(data.start_date);
            $('#note').val(data.note);
            $('#hiring').val(data.hiring);
            $('#offered_salary').val(data.offered_salary);
            $('#urgent').prop('checked', data.urgent == 1);
            $('#language_skills').val(data.language_skills_id.split(",")).change();
            $('#career_level').val(data.career_level_id).trigger('change');
            $('#company').val(data.company_id).trigger('change');
            $('#qualification').val(data.qualification_id).trigger('change');
            $('#btnSave').text('Add New');
            $('#btnUpdate').show();
        }

        function getRowData(id) {
            var table = $('#datalist').DataTable();
            var selectRow = table.row($('#datalist #' + id));
            return selectRow.data();
        }

        function update() {
            if (0 === 0) {
                $.ajax({
                    url: "{{ url('/api/admin/post-job') }}/" + idEdit,
                    type: "PUT",
                    data: valueFil(),
                    beforeSend: function(xhr) {
                        blockagePage('Please Wait...');
                        xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                    },
                    success: function(response) {
                        if (response.status == "error") {
                            validationMgs(response);
                            return;
                        }
                        idEdit = null;
                        $("#postJobformModal").modal('hide');
                        $('#btnUpdate').hide();
                        unblockagePage();
                        sweetToast(response.status, response.icon);
                        dataList(response.data);
                    },
                    error: function(e) {
                        Msg('Error Saving User', 'error');
                        unblockagePage();
                    }
                });
            }
        }

        function destroy(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Deleted now!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('/api/admin/post-job') }}/" + id,
                        type: "DELETE",
                        beforeSend: function(xhr) {
                            blockagePage('Please Wait...');
                            xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
                        },
                        success: function(response) {
                            if (response.status == "error") {
                                validationMgs(response);
                                return;
                            }
                            idEdit = null;
                            unblockagePage();
                            sweetToast(response.status, response.icon);
                            dataList(response.data);
                        },
                        error: function(e) {
                            Msg('Error Saving User', 'error');
                            unblockagePage();
                        }
                    });
                }
            });
        }

        function dataList(data) {
            var cols = [{
                    "data": "id",
                    "name": "id",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "position",
                    "name": "position",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "department_en",
                    "name": "department_en",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "company",
                    "name": "company",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },

                {
                    "data": "location",
                    "name": "location",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "vacancy_type",
                    "name": "vacancy_type",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "hiring",
                    "name": "hiring",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "offered_salary",
                    "name": "offered_salary",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "qualification",
                    "name": "qualification",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "experience",
                    "name": "experience",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    "render": function(data, type, row) {
                        var experience = row.experience;
                        return experience + ' ++ ';
                    }
                },
                {
                    "data": "language_skills",
                    "name": "language_skills",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "language_skills_id",
                    "name": "language_skills_id",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "career_level",
                    "name": "career_level",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "career_level_id",
                    "name": "career_level_id",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "description",
                    "name": "description",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "start_date",
                    "name": "start_date",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    "render": function(data, type, row) {
                        var start_date = moment(row.start_date).format('DD-MMM-YYYY');
                        var end_date = moment(row.end_date).format('DD-MMM-YYYY');
                        return start_date + ' - ' + end_date;
                    }
                },
                {
                    "data": "note",
                    "name": "note",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "create_by",
                    "name": "create_by",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "created_at",
                    "name": "created_at",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(created_at, type, row) {
                        return moment(created_at).format('DD-MMM-YYYY');
                    }
                },
                {
                    "data": null,
                    "name": "Action",
                    "searchable": false,
                    "orderable": false,
                    "visible": true,
                    "class": "dt-center",
                    render: function(data, type, row, meta) {
                        var str =
                            '<div class="dropdown">' +
                            '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-cog" aria-hidden="true"></i></button>' +
                            '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">' +
                            `<a class="dropdown-item" href="javascript:void(0);" onclick="edit(${row.id})"> <i class="fal fa-pencil" aria-hidden="true"></i> Edit</a>` +
                            '<a class="dropdown-item" href="javascript:void(0);" onclick="destroy(' + row.id +
                            ')"> <i class="fal fa-trash" aria-hidden="true"></i> Remove</a>' +
                            '</div>' +
                            '</div>';
                        return str;
                    }
                },
                {
                    "data": "company_id",
                    "name": "company_id",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "position_id",
                    "name": "position_id",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "location_id",
                    "name": "location_id",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "vacancy_type_id",
                    "name": "vacancy_type_id",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "qualification_id",
                    "name": "qualification_id",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "career_level",
                    "name": "career_level",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },
                {
                    "data": "urgent",
                    "name": "urgent",
                    "searchable": true,
                    "orderable": true,
                    "visible": false,
                },


            ];
            var btn = [];
            if ($.fn.DataTable.isDataTable('#datalist')) {
                $('#datalist').DataTable().clear();
                $('#datalist').DataTable().destroy();
            }
            //////INT TABLE//////
            var table = $('#datalist').DataTable({
                "data": data,
                "columns": cols,
                "buttons": btn,
                "order": [1, 'asc'],
                "rowId": "id",
                "responsive": "true",
                dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            });
            //////INT TABLE//////
        }
    }

    $("#postJobForm #qualification").select2({
        dropdownParent: $('#postJobformModal')
    });

    $("#postJobForm #position").select2({
        dropdownParent: $('#postJobformModal')
    });
    $("#postJobForm #location").select2({
        dropdownParent: $('#postJobformModal')
    });
    $("#postJobForm #vacancy_type").select2({
        dropdownParent: $('#postJobformModal')
    });
    $("#postJobForm #company").select2({
        dropdownParent: $('#postJobformModal')
    });
    $("#postJobForm #career_level").select2({
        dropdownParent: $('#postJobformModal')
    });
    $("#postJobForm #language_skills").select2({
        dropdownParent: $('#postJobformModal')
    });

    function getCareerLevelList() {
        $.ajax({
            url: "{{ url('/api/admin/post-job/getCareerLevelList') }}",
            type: "GET",
            beforeSend: function(xhr) {
                blockagePage('Please wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }
                var typeStr = "<option></option>";
                for (var i = 0; i < response.data.length; i++) {
                    typeStr += "<option value=\"" + response.data[i].id + "\">" +
                        response.data[i].title_en + "</option>";
                }
                $("#postJobForm #career_level").html(typeStr);
                $("#postJobForm #career_level").select2("destroy").select2({
                    dropdownParent: $('#postJobformModal')
                });
                unblockagePage();
            },
            error: function(e) {
                if (e.status == 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }
                unblockagePage();
            }
        });
    }

    function getLanguSkillList() {
        $.ajax({
            url: "{{ url('/api/admin/post-job/getLanguSkillList') }}",
            type: "GET",
            beforeSend: function(xhr) {
                blockagePage('Please wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }
                var typeStr = "<option></option>";
                for (var i = 0; i < response.data.length; i++) {
                    typeStr += "<option value=\"" + response.data[i].id + "\">" +
                        response.data[i].title_en + "</option>";
                }
                $("#postJobForm #language_skills").html(typeStr);
                $("#postJobForm #language_skills").select2("destroy").select2({
                    dropdownParent: $('#postJobformModal')
                });
                unblockagePage();
            },
            error: function(e) {
                if (e.status == 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }
                unblockagePage();
            }
        });
    }

    function getCompanyList() {
        $.ajax({
            url: "{{ url('/api/admin/post-job/getCompanyList') }}",
            type: "GET",
            beforeSend: function(xhr) {
                blockagePage('Please wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }
                var typeStr = "<option></option>";
                for (var i = 0; i < response.data.length; i++) {
                    typeStr += "<option value=\"" + response.data[i].id + "\">" +
                        response.data[i].title_en + "</option>";
                }
                $("#postJobForm #company").html(typeStr);
                $("#postJobForm #company").select2("destroy").select2({
                    dropdownParent: $('#postJobformModal')
                });
                unblockagePage();
            },
            error: function(e) {
                if (e.status == 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }
                unblockagePage();
            }
        });
    }

    function getQualificationList() {
        $.ajax({
            url: "{{ url('/api/admin/post-job/getQualificationList') }}",
            type: "GET",
            beforeSend: function(xhr) {
                blockagePage('Please wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }
                var typeStr = "<option></option>";
                for (var i = 0; i < response.data.length; i++) {
                    typeStr += "<option value=\"" + response.data[i].id + "\">" +
                        response.data[i].title_en + "</option>";
                }
                $("#postJobForm #qualification").html(typeStr);
                $("#postJobForm #qualification").select2("destroy").select2({
                    dropdownParent: $('#postJobformModal')
                });
                unblockagePage();
            },
            error: function(e) {
                if (e.status == 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }
                unblockagePage();
            }
        });
    }

    function getVacancyTypeList() {
        $.ajax({
            url: "{{ url('/api/admin/post-job/getVacancyTypeList') }}",
            type: "GET",
            beforeSend: function(xhr) {
                blockagePage('Please wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }
                var typeStr = "<option></option>";
                for (var i = 0; i < response.data.length; i++) {
                    typeStr += "<option value=\"" + response.data[i].id + "\">" +
                        response.data[i].title_en + "</option>";
                }
                $("#postJobForm #vacancy_type").html(typeStr);
                $("#postJobForm #vacancy_type").select2("destroy").select2({
                    dropdownParent: $('#postJobformModal')
                });
                unblockagePage();
            },
            error: function(e) {
                if (e.status == 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }
                unblockagePage();
            }
        });
    }

    function getLocationList() {
        $.ajax({
            url: "{{ url('/api/admin/post-job/getLocationList') }}",
            type: "GET",
            beforeSend: function(xhr) {
                blockagePage('Please wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }
                var typeStr = "<option></option>";
                for (var i = 0; i < response.data.length; i++) {
                    typeStr += "<option value=\"" + response.data[i].id + "\">" +
                        response.data[i].title_en + "</option>";
                }
                $("#postJobForm #location").html(typeStr);
                $("#postJobForm #location").select2("destroy").select2({
                    dropdownParent: $('#postJobformModal')
                });
                unblockagePage();
            },
            error: function(e) {
                if (e.status == 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }
                unblockagePage();
            }
        });
    }

    function getPositionList() {
        $.ajax({
            url: "{{ url('/api/admin/post-job/getPositionList') }}",
            type: "GET",
            beforeSend: function(xhr) {
                blockagePage('Please wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }
                var typeStr = "<option></option>";
                for (var i = 0; i < response.data.length; i++) {
                    typeStr += "<option value=\"" + response.data[i].id + "\">" +
                        response.data[i].title_en + "-" + response.data[i].department_title + "</option>";
                }
                $("#postJobForm #position").html(typeStr);
                $("#postJobForm #position").select2("destroy").select2({
                    dropdownParent: $('#postJobformModal')
                });
                unblockagePage();
            },
            error: function(e) {
                if (e.status == 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }
                unblockagePage();
            }
        });
    }
    var route_prefix = "/filemanager";
    $('#imgthumbnail').filemanager('image', {
        prefix: route_prefix
    });
</script>
