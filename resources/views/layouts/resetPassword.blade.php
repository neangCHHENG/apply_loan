<div class="modal fade" id="layoutresetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="layoutresetPasswordLabel">Change My Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="layoutresetPasswordform">
                    @csrf
                    <!--create token-->

                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="layoutresetpassword"
                                name='layoutresetpassword' autocomplete="off"
                                validate-attribute='{"required":"true"}' />

                            <div class="invalid-feedback">
                                Password is Require!!
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="layoutresetPassword()">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    function layoutresetPassword() {
        if (!formValidation("layoutresetPasswordform")) {
            sweetToast("Data didn't pass Validation", "error");
            return;
        }

        var password = $("#layoutresetPasswordform #layoutresetpassword").val();

        $.ajax({
            url: "{{ url('api/resetPassword') }}",
            type: "POST",
            data: {
                _token: formToken,
                password: password
            },
            beforeSend: function(xhr) {
                blockagePage('Please Wait...');
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.result == "error") {
                    sweetToast(response.msg, response.result);
                    return;
                }

                sweetToast(response.msg, response.result);
                $("#layoutresetPasswordModal").modal("hide");

                unblockagePage();
            },
            error: function(e) {
                if (e.status = 401) //unauthenticate not login
                {
                    Msg('Error While Reset Password', 'error');
                }

                unblockagePage();
            }
        });
    }
</script>
