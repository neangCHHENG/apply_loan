@extends('Cms.master-page')

@section('content')
    <section class="header-title">
        <div class="container-xl pt-5 pb-5">
            <h2 class="fw-bold pt-5 pb-5">
                {{ App::getLocale() == 'en' ? 'CONTACT US' : 'ទំនាក់ទំនង មកពួកយើង' }}
            </h2><br>
        </div>
    </section>
    <div class="container-xl p-5 mt-lg-5" style="background: #fff">
        <div class="row justify-content-center">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d488.63429286015617!2d104.90787548220902!3d11.546524786036116!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31095159f28cdfc7%3A0xb91bf07d4f9c912c!2sMengly%20J.%20Quach%20Education%20PLC!5e0!3m2!1sen!2skh!4v1704780377046!5m2!1sen!2skh"
                style="border:0; width:100%; height:40vh" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="col-md-6 col-sm-12"><br>
                <form method="post" action="" id="contactForm" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                    <!--create token-->
                    <div class="form-group">
                        <input placeholder="{{ App::getLocale() == 'en' ? 'Name' : 'ឈ្មោះ' }}" type="text"
                            class="form-control" id="Cont_name" name='name' autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <input placeholder="{{ App::getLocale() == 'en' ? 'Email Address' : 'អាស័យ​ដ្ឋាន​អ៊ី​ម៉េ​ល' }}"
                            type="email" class="form-control" id="Cont_email" name='email' autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <input placeholder="{{ App::getLocale() == 'en' ? 'Subject' : 'ប្រធានបទ' }}" type="text"
                            class="form-control" id="Cont_subject" name='subject' autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <textarea placeholder="{{ App::getLocale() == 'en' ? 'Message' : 'សារ' }}" type="text" class="form-control"
                            id="Cont_message" name='message' autocomplete="off"></textarea>
                    </div>
                    <div class="form-group">
                        <span class="input-group-btn">

                            <i class="fa fa-picture-o"></i> Select your profile
                            <input id="Cont_thumbnail" type="file" name="thumbnail" accept="image/*">
                        </span>
                    </div>
                    <div class="form-group">
                        <span class="input-group-btn">
                            <i class="fa fa-file"></i> Select your cv
                            <input id="Cont_fileCv" type="file" name="fileCv" accept="pdf/*">
                        </span>

                    </div>
                </form>
                <button type="button" id="btnSaveCont" class="btn-send btn btn-lg"
                    style="min-width: 100px;
            justify-content: center;">
                    {{ App::getLocale() == 'en' ? 'Send' : 'ផ្ញើ' }}
                </button>
            </div>
            <div class="col-md-6 col-sm-12"><br>
                <?php
                foreach ($menuFooterItems as $menuFooterItem) {
                    if ($menuFooterItem->type == 'address' || $menuFooterItem->type == 'phone' || $menuFooterItem->type == 'email' || $menuFooterItem->type == 'workingHours') {
                        $value = App::getLocale() == 'en' ? $menuFooterItem->value_en : $menuFooterItem->value_kh;
                        $str = '';
                        echo $str = $str . '<ul><li style="list-style: none;">' . $value . '</li></ul>';
                    }
                }
                ?>
            </div>

        </div>
    </div>
    <br><br>
    <script>
        function valueFilCont(val = null) {
            let name;
            let email;
            let subject;
            let message;
            let thumbnail;
            let fileCv;
            if (val === null) {
                name = $('#Cont_name').val();
                email = $('#Cont_email').val();
                subject = $('#Cont_subject').val();
                message = $('#Cont_message').val();
                thumbnail = $('#Cont_thumbnail')[0].files[0];
                fileCv = $('#Cont_fileCv')[0].files[0];
            }
            if (val === 'clear') {
                $('#Cont_name').val('');
                $('#Cont_email').val('');
                $('#Cont_subject').val('');
                $('#Cont_message').val('');
                $('#Cont_thumbnail').val('');
                $('#Cont_fileCv').val('');

            }

            return {
                'name': name,
                'email': email,
                'subject': subject,
                'message': message,
                'thumbnail': thumbnail,
                'fileCv': fileCv,

            };
        }
        var btnSaveCont = true;
        $('#btnSaveCont').on('click', () => {
            let formData = new FormData();
            formData.append("name", $('#Cont_name').val());
            formData.append("email", $('#Cont_email').val());
            formData.append("subject", $('#Cont_subject').val());
            formData.append("message", $('#Cont_message').val());
            formData.append("thumbnail_form", $('#Cont_thumbnail')[0].files[0]);
            formData.append("fileCv_form", $('#Cont_fileCv')[0].files[0]);

            $.ajax({
                url: "{{ url('/admin/message-contact/contactSubmit') }}/",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $("#csrf").val()
                },
                beforeSend: function() {
                    $('#btnSaveCont').text(
                        "{{ App::getLocale() == 'en' ? 'Sending...' : 'កំពុងផ្ញើ...' }}")
                    $('#btnSaveCont').attr("disabled", true);

                },
                success: function(response) {
                    if (response.status == "error") {
                        valueFilCont('clear');
                        validationMgs(response);
                        $('#btnSaveCont').text("{{ App::getLocale() == 'en' ? 'Send' : 'ផ្ញើ' }}");
                        $('#btnSaveCont').removeAttr("disabled");
                    } else {
                        valueFilCont('clear');
                        showMessage('success', 'Sent Successfully');
                        $('#btnSaveCont').text("{{ App::getLocale() == 'en' ? 'Send' : 'ផ្ញើ' }}");
                        $('#btnSaveCont').removeAttr("disabled");
                    }
                    btnSaveCont = true;
                    $('.btn-send-contact').text('{{ App::getLocale() == 'en' ? 'Send' : 'ផ្ញើ' }}');
                },
                error: function(e) {
                    showMessage('Error Saving User', 'error');
                }
            });
        });

        function sweetToast(message, icon) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: icon,
                title: message,
            });
        }

        function validationMgs(response) {
            let msg = '';
            for (let x in response.result) {
                msg += response.result[x][0];
            }
            return sweetToast(msg, response.icon);
        }

        function showMessage(type, message) {
            Swal.fire({
                position: "top-end",
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 2000
            });
        }
    </script>
@endsection
