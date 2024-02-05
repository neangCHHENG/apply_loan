<div class="modal fade" id="formModalConfigType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userFormLabel">Menu Item Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="accordion accordion-outline displayContentConfigType" id="js_demo_accordion-3">

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
     $(document).ready(function() {
        getType();
    });

    function getType(){
        $.ajax({
            url: "{{ url('api/admin/type-config') }}",
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

                var group_name = response.data.reduce(function(result, value) {
                    result[value.group_name] = result[value.group_name] || [];
                    result[value.group_name].push({group_name:value.group_name, name: value.name, description:value.description, config_value: value.config_value, type: value.type });
                    return result;
                }, {});

                let optionSelect = '';
                for( var key in group_name){
                    optionSelect += `<div class="card">` +
                        `<div class="card-header">` +
                        `<a href="javascript:void(0);" class="card-title " data-toggle="collapse" data-target="#category_article_${key}" aria-expanded="false">` +
                        `<i class="fal fa-file-medical-alt width-2 fs-xl"></i> ` +key +
                        `<span class="ml-auto">` +
                        `<span class="collapsed-reveal">` +
                        `<i class="fal fa-minus fs-xl"></i>` +
                        `</span>` +
                        `<span class="collapsed-hidden">` +
                        `<i class="fal fa-plus fs-xl"></i>` +
                        `</span>` +
                        `</span>` +
                        `</a>` +
                        `</div>` +
                        `<div id="category_article_${key}" class="collapse" data-parent="#js_demo_accordion-3">` +
                        `<div class="card-body">`;
                            group_name[key].forEach(value_config_type => {

                                let jsonConfig = {};

                                let functionName = '';
                                let dataActionType = '';
                                let dataActionTitle = '';
                                let dataReferenceId = '';
                                let filConfigValue = '';
                                if( value_config_type.config_value) {
                                        jsonConfig = JSON.parse( value_config_type.config_value);
                                        dataActionType = jsonConfig.action;
                                        dataActionTitle = jsonConfig.actionTitle;
                                        dataReferenceId = jsonConfig.referenceId;
                                        functionName = jsonConfig.action;
                                        callBack="'id'";
                                        referenceId ="'referenceId'";
                                        filConfigValue = value_config_type.config_value;
                                }
                            optionSelect += `<div class="card">` +
                                `<div class="card-header">` +
                                `<a href="javascript:void(0);" class="card-title" data-action-type="${dataActionType}" data-type="${value_config_type.type}" data-action-title="${dataActionTitle}" `+
                                `  data-reference-id="${dataReferenceId}" data-fil-config-value='${filConfigValue}' onclick="selectMenu(this)">` +
                                `<i class="fal fa-file-medical-alt width-2 fs-xl"></i>${value_config_type.name} ` +
                                `</a>` +
                                `</div></div>`;
                        });

                        optionSelect +=  `</div></div></div>`;
                };
                $('.displayContentConfigType').html(optionSelect);
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

    function selectMenu(type){
        let item = $(type);

        $('#param1').val(item[0].dataset.filConfigValue);
        $('#menu_type').val(item[0].dataset.type);
        $('#menuItemTypeShow').val(item[0].innerText);

        if(item[0].dataset.type == 'single_article' || item[0].dataset.type == 'single_category' || item[0].dataset.type == 'event_list' || item[0].dataset.type == 'event_grid')
        {
            $('#lableNameReference').text(item[0].innerText);
            $('#divReference').show();
            $('#divLink').hide();
        }else if(item[0].dataset.type == 'external_url')
        {
            $('#referenceInput').val('');
            $('#divReference').hide();
            $('#divLink').show();
        }else{
            $('#referenceInput').val('');
            $('#divReference').hide();
            $('#divLink').val('');
            $('#divLink').hide();
        }
        $('#formModalConfigType').modal('hide');
    }
</script>
