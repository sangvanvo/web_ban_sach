<?php include_once VIEWS_DIR . "/layouts/header/index.php"; ?>

<style>
    .form-floating>label {
        transition: transform 0.2s ease-in-out;
    }

    .btn-hover-dark:hover {
        background: #000 !important;
    }

    #draggable:hover {
        cursor: move;
    }

    @keyframes transformX {
        from {
            transform: translateX(-55%);
        }

        to {
            transform: translateX(0);
        }
    }

    body {
        background: url('/images/background/tu-sach-mien-phi.jpg');
    }
</style>

<main class="container d-flex flex-column justify-content-center overflow-hidden" style="min-height: 100vh;">
    <div class="d-flex justify-content-end mx-2 mx-md-0" style="animation: transformX 0.5s ease-out;">
        <div id="draggable" class="bg-dark text-white p-4 rounded-3 shadow-lg col col-lg-5">
            <div class="fs-2 fw-semibold text-center mb-5 ">Đăng nhập</div>
            <form id="login_form" action="/login" method="post" class="d-flex flex-column">
                <div class="form-floating mb-3">
                    <input value="admin@gmail.com" type="email" class="form-control shadow-none" name="email" id="email"
                        placeholder="name@example.com" autocomplete="off">
                    <label for="email" class="text-dark-emphasis">Email</label>
                </div>
                <div class="form-floating">
                    <input value="11111" type="password" class="form-control shadow-none" name="password" id="password"
                        placeholder="Mật khẩu">
                    <label for="password" class="text-dark-emphasis">Mật khẩu</label>
                </div>

                <div class="mt-4 mb-2 text-end">
                    <a href="/forgot-pass" class="mb-0 text-decoration-none fw-bold" style="color: #3aafa9;">Quên
                        mật khẩu?</a>
                </div>

                <button type="submit" class="login-btn btn-hover-dark mb-4 btn text-white fw-semibold"
                    style="background: #3aafa9;">
                    Đăng nhập
                </button>
            </form>
            <p class="d-flex py-2 gap-2 mb-0 fw-bold">
                Chưa có tài khoản?
                <a href="/signup" style="color: #3aafa9;">Đăng ký</a>
            </p>
        </div>
    </div>
    <button class="fs-1 position-fixed bottom-0 end-0 border-0 bg-transparent">
        <a href="#body" style="color: #3aafa9;"><i class="fa-solid fa-circle-up"></i></a>
    </button>
</main>

<script>
    $.validator.setDefaults({
        submitHandler: function (form) {
            $.ajax({
                url: '/login',
                type: 'POST',
                data: {
                    "email": $('#login_form input[name="email"]').val(),
                    "password": $('#login_form input[name="password"]').val(),
                },
                success: function (res) {
                    res = JSON.parse(res);
                    Swal.fire({
                        title: `${res["error"] ? 'Lỗi' : 'Thành công'}`,
                        text: `${res["message"]}`,
                        icon: `${res["error"] ? 'error' : 'success'}`,
                        confirmButtonText: 'Ok',
                        customClass: {
                            confirmButton: `${res["error"] ? 'bg-danger' : 'bg-success'}`,
                        },
                    }).then(function () {
                        if (!res["error"]) window.location.href = '/';
                    })
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    })

    $().ready(function () {
        $('#login_form').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 5,
                },
            },
            messages: {
                email: 'Email không hợp lệ',
                password: {
                    required: 'Vui lòng nhập mật khẩu',
                    minlength: 'Mật khẩu phải có ít nhất 5 ký tự',
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