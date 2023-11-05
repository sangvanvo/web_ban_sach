<?php include_once VIEWS_DIR . "/layouts/header/index.php"; ?>

<main class="" style="background-color: #efefef; min-height: 70vh;">
    <section class="">
        <div class="container p-5">
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
                        <a href="#" class="text-decoration-none text-black fw-bold" style="color:#3aafa9 !important;">Hồ
                            Sơ</a>
                        <a href="/profile/password" class="fw-semibold text-decoration-none text-black">Đổi
                            Mật
                            Khẩu</a>
                    </div>
                </div>

                <div class="col-12 col-lg-9 p-5" style="background-color: white;">
                    <div class="pb-3">
                        <div class="p-2 mb-2 ">
                            <h3>Hồ Sơ Của Tôi</h3>
                            <p>Quản lý thông tin hồ sơ tài khoản</p>
                        </div>

                        <div class="row justify-content-between d-column flex-column-reverse flex-lg-row gap-3 gap-md-0">
                            <div class="col-12 col-lg-8">
                                <div class="mb-3 align-items-center row">
                                    <div class="col-3 text-end">
                                        <label class="form-label fw-semibold">Email</label>
                                    </div>
                                    <div class=" col-9">
                                        <input readonly value="<?= htmlspecialchars($user['email'])  ?>" type="email" class="form-control" autocomplete="off" id="email" aria-describedby="email" name="email" style="box-shadow: none;">
                                    </div>
                                    <input type="hidden" name="id_user" value="<?= htmlspecialchars($user['id']) ?>">
                                </div>
                                <div class="mb-3 align-items-center row">
                                    <div class="col-3 text-end">
                                        <label class="form-label fw-semibold">Tên</label>
                                    </div>
                                    <div class=" col-9">
                                        <input value="<?= htmlspecialchars($user['ho_ten']) ?>" class="form-control" autocomplete="off" id="name" name="name" aria-describedby="name" style="box-shadow: none;">
                                    </div>
                                </div>
                                <div class="mb-3 align-items-center row">
                                    <div class="col-3 text-end">
                                        <label class="form-label fw-semibold">Số điện
                                            thoại</label>
                                    </div>
                                    <div class=" col-9">
                                        <input value="<?= htmlspecialchars($user['so_dien_thoai'])  ?>" class="form-control" autocomplete="off" id="phone" aria-describedby="phone" name="phone" style="box-shadow: none;">
                                    </div>
                                </div>
                                <div class="mb-3 align-items-center row">
                                    <div class="col-3 text-end">
                                        <label class="form-label fw-semibold">Địa
                                            Chỉ</label>
                                    </div>
                                    <div class=" col-9">
                                        <input value="<?= htmlspecialchars($user['dia_chi']) ?>" type="text" class="form-control" autocomplete="off" id="address" aria-describedby="address" name="address" style="box-shadow: none;">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="button" id="btn_edit_profile" class="btn text-white" style="min-width: 100px; background-color: #3aafa9;" aria-disabled="false">Lưu</button>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 d-flex justify-content-center align-items-center flex-column">
                                <div class="preview-img mt-3 p-2 d-flex justify-content-center align-items-center">
                                    <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="" style="border-radius: 50%; width: 100px; height: 100px; background-color: #efefef;">
                                </div>
                                <div class="py-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div>
                                            <input hidden type="file" class="form-control-file img" id="avatar" name="avatar" accept="image/*">
                                            <label id="label_avatar" for="avatar" class="btn text-white" style="background-color: #3aafa9;">Chọn
                                                ảnh</label>
                                            <button type="button" class="btn text-white d-none" id="btn_upload_avatar" style="background-color: #3aafa9;">Cập nhật</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="" style="font-size: 14px;">Dụng lượng file tối đa 10 MB</div>
                                    <div class="" style="font-size: 14px;">Định dạng:.JPEG, .JPG, .PNG, .GIF</div>
                                </div>

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
                url: '/user/edit',
                type: 'POST',
                data: {
                    "email": $('#signup_form input[name="email"]').val(),
                    "password": $('#signup_form input[name="password"]').val(),
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
                        if (!res["error"]) window.location.href = '/login';
                    })
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    })

    const isValidFile = (file) => {
        const allowSize = 10 * 1024 * 1024;

        const swal = (msg) => {
            return Swal.fire({
                title: 'Lỗi',
                text: msg,
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'bg-danger',
                },
            })
        }

        const size = file.size;
        const type = file.type;

        if (size > allowSize) {
            swal('Kích thước ảnh tối đa 10 MB');
            return false;
        }

        if (!type.includes('image')) {
            swal('Hình ảnh không đúng định dạng');
            return false;
        }

        return true;
    }

    const previewImg = (input, previewTag) => {
        input.on('change', function() {
            if ($(this).val()) {
                const file = $(this)[0]?.files[0];

                if (!isValidFile(file)) {
                    $(this).val('');
                    return;
                }

                const img = URL.createObjectURL(file);

                previewTag.removeClass('d-none').find('img').prop('src', img);
                $(this).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
                return;
            }
        })
    }

    $().ready(function() {
        const swal = (res) => {
            return Swal.fire({
                title: `${res["error"] ? 'Lỗi' : 'Thành công'}`,
                text: res["message"],
                icon: `${res["error"] ? 'error' : 'success'}`,
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: `${res["error"] ? 'bg-danger' : 'bg-success'}`,
                },
            })
        }

        $('#btn_edit_profile').on('click', function() {
            const formData = new FormData();

            const profile = {
                "id": $('input[name="id_user"]').val(),
                "name": $('input[name="name"]').val(),
                "phone": $('input[name="phone"]').val(),
                "address": $('input[name="address"]').val(),
            }

            formData.append('profile', JSON.stringify(profile));

            fetch('/profile', {
                    method: 'POST',
                    body: formData,
                })
                .then(res => res.json())
                .then(res => {
                    swal(res);
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        })

        $('#avatar').on('change', function() {
            if ($(this).val() && isValidFile($(this)[0]?.files[0])) {
                $('#btn_upload_avatar').removeClass('d-none');
                $('#label_avatar').addClass('d-none');
            }
        })

        $('#btn_upload_avatar').on('click', function() {
            $(this).addClass('d-none');
            $('#label_avatar').removeClass('d-none');

            const formData = new FormData();
            const avatar = $('#avatar')[0].files[0];

            formData.append('avatar', avatar);

            fetch('/profile/avatar', {
                    method: 'POST',
                    body: formData,
                })
                .then(res => res.json())
                .then(res => {
                    swal(res);
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        })

        previewImg($('#avatar'), $('.preview-img'));
    });
</script>

<?php include_once VIEWS_DIR . "/layouts/footer/index.php"; ?>