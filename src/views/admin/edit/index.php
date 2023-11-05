<?php include_once VIEWS_DIR . "/admin/layouts/header/index.php"; ?>

<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }

    nav a:hover {
        color: #17252a !important;
    }

    main img:hover {
        scale: 1.2;
        transition: all 0.5s;
    }
</style>

<main class="container" style="min-height: 100vh;">
    <div class="container rounded-3 my-5 d-flex justify-content-center flex-column align-items-center">
        <p class="fs-3 fw-semibold">Chỉnh sửa sản phẩm</p>

        <form id="edit_book_form" action="/admin/edit" method="post" enctype="multipart/form-data" class="col-12 col-lg-6 shadow-lg p-4">
            <input type="number" hidden value="<?= htmlspecialchars($book['id']) ?>" id="book_id" name="book_id">

            <div class=" form-group mb-3">
                <label for="name">Tên Sản Phẩm:</label>
                <input value="<?= htmlspecialchars($book['ten_sach']) ?>" type="text" class="form-control" id="name" name="name" autocomplete="off">
            </div>

            <div class="form-group mb-3">
                <label for="price">Giá:</label>
                <input value="<?= htmlspecialchars(format_money($book['gia_goc'])) ?>" type="number" class="form-control" id="price" name="price">
            </div>

            <div class="form-group mb-3">
                <label for="price">Sale:</label>
                <input value="<?= htmlspecialchars(format_money($book['gia_sale'])) ?>" type="number" class="form-control" id="sale" name="sale">
            </div>

            <div class="form-group mb-3">
                <div class="form-control d-flex align-items-center gap-3 justify-content-between">
                    <div>
                        <label>Ảnh Bìa:</label>
                    </div>
                    <div>
                        <input hidden type="file" class="form-control-file img" id="img" name="img" accept="image/*">
                        <label for="img" class="btn btn-primary">Chọn</label>
                    </div>
                </div>
                <div class="preview-img mt-3">
                    <img src="<?= htmlspecialchars($book['anh_bia']) ?>" alt="" style="width: 85px;">
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="form-control d-flex align-items-center gap-3 justify-content-between">
                    <label>Hình ảnh khác:</label>
                    <input hidden type="file" class="form-control-file imgs" multiple id="imgs" name="imgs[]" accept="image/*">
                    <label for="imgs" class="btn btn-primary">Chọn</label>
                </div>
                <div class="preview-imgs mt-3">
                    <?php foreach ($book['imgs'] as $item) : ?>
                        <img src="<?= htmlspecialchars($item['hinh_anh']) ?>" alt="" style="width: 85px;">
                    <?php endforeach ?>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="description">Tác giả:</label>
                <input value="<?= htmlspecialchars($book['tac_gia']) ?>" type="text" class="form-control" id="author" name="author" autocomplete="off"></input>
            </div>

            <div class="form-group mb-3">
                <label for="description">Mô Tả:</label>
                <textarea class="form-control" id="description" name="description" rows="6"> <?= htmlspecialchars($book['mo_ta']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</main>

<script>
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
                const files = $(this)[0].files;

                if (files.length === 1) {
                    const file = files[0];

                    if (!isValidFile(file)) {
                        $(this).val('');
                        previewTag.addClass('d-none')
                        return;
                    }

                    const img = URL.createObjectURL(file);

                    previewTag.removeClass('d-none').find('img').prop('src', img);
                    $(this).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
                    return;
                }

                let html = '';
                Array.from(files).forEach(file => {
                    if (!isValidFile(file)) {
                        $(this).val('');
                        previewTag.addClass('d-none')
                        return;
                    }
                    const img = URL.createObjectURL(file);
                    html += `<img src="${img}" alt="" style="width: 100px;">`
                })
                previewTag.removeClass('d-none').html(html);
            }
        })
    }

    $().ready(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                const formData = new FormData();
                const img = $('.img')[0].files[0];
                const imgs = $('.imgs')[0].files;

                formData.append('img', img);

                for (var i = 0; i < imgs.length; i++) {
                    formData.append("imgs[]", imgs[i]);
                }

                const book = {
                    "book_id": $('#book_id').val(),
                    "name": $('#name').val(),
                    "price": Number($('#price').val()),
                    "sale": Number($('#sale').val()),
                    "author": $('#author').val(),
                    "description": $('#description').val()
                };

                formData.append("book", JSON.stringify(book));

                fetch('/admin/edit', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(res => res.json())
                    .then(res => {
                        Swal.fire({
                            title: `${res["error"] ? 'Lỗi' : 'Thành công'}`,
                            text: res["message"],
                            icon: `${res["error"] ? 'error' : 'success'}`,
                            confirmButtonText: 'Ok',
                            customClass: {
                                confirmButton: `${res["error"] ? 'bg-danger' : 'bg-success'}`,
                            },
                        }).then(() => {
                            if (!res['error']) {
                                window.location.href = '/admin'
                            }
                        })
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
            }
        })
        $('#edit_book_form').validate({
            rules: {
                name: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true
                },
                sale: {
                    required: true,
                    number: true,
                },
                img: {
                    required: true,
                },
                description: {
                    required: true,
                },
            },
            messages: {
                name: 'Nhập tên sách',
                price: {
                    required: 'Nhập giá bán',
                    number: 'Vui lòng nhập số',
                },
                sale: {
                    required: 'Nhập giá sale',
                    number: 'Vui lòng nhập số',
                },
                img: 'Chọn ảnh bìa',
                description: 'Nhập mô tả',
            },
            errorElement: 'span',
            errorPlacement: (error, element) => {
                error.addClass('invalid-feedback');
                if (element.prop('type') === 'file') {
                    element.closest('.form-control').addClass('is-invalid')
                    error.insertAfter(element.parent('div').parent('div'));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: (element, errorClass, validClass) => {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: (element, errorClass, validClass) => {
                $(element).addClass('is-valid').removeClass('is-invalid');
            },
        })

        previewImg($('#edit_book_form input.img'), $('.preview-img'));
        previewImg($('#edit_book_form input.imgs'), $('.preview-imgs'));
    });
</script>

<?php include_once VIEWS_DIR . "/admin/layouts/footer/index.php"; ?>