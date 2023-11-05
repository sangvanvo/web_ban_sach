<?php include_once VIEWS_DIR . "/layouts/header/index.php"; ?>

<main class="" style="background-color: #efefef; min-height: 70vh;">
    <section class="">
        <div class=" container p-5">
            <div class="row">
                <div class="col-12 col-lg-3  px-5 pb-2">
                    <div class="pb-2">
                        <div class="d-flex justify-content-start align-items-center gap-2 mb-4">
                            <div class="preview-img p-2 d-flex justify-content-center align-items-center">
                                <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="" style="border-radius: 50%; width: 50px; height: 50px; background-color: #efefef;">
                            </div>
                            <p class="mb-0 text-decoration-none text-black fw-bold text-truncate w-50"><?= htmlspecialchars($user['email']) ?></p>

                        </div>
                        <hr>
                    </div>
                    <div class="d-flex gap-2">
                        <i class="fa-regular fa-user" style="font-size: 25px;"></i>
                        <p class="fw-bold">Tài Khoản Của Tôi</p>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="/profile" class="fw-semibold text-decoration-none text-black">Hồ
                            Sơ</a>
                        <a href="#" class="text-decoration-none text-black fw-bold" style="color:#3aafa9 !important;">Đổi Mật
                            Khẩu</a>
                    </div>

                </div>
                <div class="col-12 col-lg-9 p-5" style="background-color: white;">
                    <div class="pb-3">
                        <div class="p-2 d-flex  align-items-center mb-2">
                            <div class="p-2 d-flex justify-content-center align-items-center " style="border-radius: 50%; width: 50px; height: 50px; background-color: white;">
                                <i class="fa-solid fa-key" style="font-size: 25px;"></i>
                            </div>
                            <h3>Đổi Mật Khẩu</h3>
                        </div>

                        <div class="row d-column flex-column-reverse flex-md-row gap-3 gap-md-0">
                            <div class="col-12 col-lg-9">

                                <form id="user_change_pass_form">
                                    <div class="mb-3 row align-items-center">
                                        <div class="col-4 text-end">
                                            <label class="form-label fw-semibold">Mật khẩu
                                                cũ</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="password" id="password" class="form-control" name="old_password" style="box-shadow: none;">
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <div class="col-4 text-end">
                                            <label class="form-label fw-semibold">Mật khẩu
                                                mới</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="password" class="form-control" id="new_password" name="new_password" style="box-shadow: none;">
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <div class="col-4 text-end">
                                            <label class="form-label fw-semibold">Nhập
                                                lại
                                                mật khẩu
                                                mới </label>
                                        </div>
                                        <div class="col-8">
                                            <input type="password" class="form-control" name="a_new_password" style="box-shadow: none;">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn text-white " style="min-width: 100px; background-color: #3aafa9;" aria-disabled="false">Lưu</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>>
    </div>

</main>
<script>
    $.validator.setDefaults({
        ignore: [],
        submitHandler: function(form) {
            $.ajax({
                url: '/profile/password',
                type: 'POST',
                data: {
                    "old_password": $('#user_change_pass_form input[name="old_password"]').val(),
                    "new_password": $('#user_change_pass_form input[name="new_password"]').val(),
                },
                success: function(res) {


                    res = JSON.parse(res);

                    Swal.fire({
                        title: `${res["error"] ? 'Lỗi' : 'Thành công'}`,
                        text: res["message"],
                        icon: `${res["error"] ? 'error' : 'success'}`,
                        confirmButtonText: 'Ok',
                        customClass: {
                            confirmButton: `${res["error"] ? 'bg-danger' : 'bg-success'}`,
                        },
                    }).then(function() {
                        window.location.href = '/profile/password'

                    })
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    })



    $().ready(function() {
        $('#user_change_pass_form').validate({
            rules: {
                old_password: {

                    required: true,
                    minlength: 5,
                },
                new_password: {
                    required: true,
                    minlength: 5,
                },
                a_new_password: {
                    required: true,
                    minlength: 5,
                    equalTo: '#new_password',
                },
            },
            messages: {
                old_password: {
                    required: 'Bạn chưa nhập mật khẩu',
                    minlength: 'Mật khẩu phải có ít nhất 5 ký tự ',

                },
                new_password: {
                    required: 'Bạn chưa nhập mật khẩu',
                    minlength: 'Mật khẩu phải có ít nhất 5 ký tự ',

                },
                a_new_password: {
                    required: 'Bạn chưa nhập mật khẩu',
                    minlength: 'Mật khẩu phải có ít nhất 5 ký tự ',
                    equalTo: 'Mật khẩu không trùng khớp với mật khẩu đã nhập',
                },
            },
            errorElement: 'span',
            errorPlacement: (error, element) => {
                error.addClass('invalid-feedback');

                error.insertAfter(element);

            },
            highlight: (element, errorClass, validClass) => {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: (element, errorClass, validClass) => {
                $(element).addClass('is-valid').removeClass('is-invalid');
            },
        })
    });
</script>

<?php include_once VIEWS_DIR . "/layouts/footer/index.php"; ?>