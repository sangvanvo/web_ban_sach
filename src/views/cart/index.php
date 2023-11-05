<?php include_once VIEWS_DIR . "/layouts/header/index.php"; ?>

<style>
    body {
        background: #f5f5f5;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }

    .form-floating>label {
        transition: transform 0.2s ease-in-out;
    }

    .btn-hover-dark:hover {
        background: #000 !important;
    }

    #draggable:hover {
        cursor: move;
    }

    .img {
        max-width: 300px;
        height: auto;
        cursor: pointer;
    }

    .cart-btn-close:hover {
        color: crimson !important;
        cursor: pointer;
    }

    .jconfirm-buttons {
        display: flex;
        flex-direction: row-reverse;
    }

    .jconfirm-buttons button:hover {
        color: #fff !important;
        background: #000 !important;
    }
</style>

<main class="container overflow-hidden py-5" style="min-height: 70vh;">
    <div class="fs-2 my-4 border-bottom pb-3 w-100">
        <i class="fa-brands fa-shopify fs-1" style="color: #3aafa9;"></i>
        Giỏ hàng
    </div>

    <table class="row flex-column">
        <thead class="border text-white d-none d-md-block col" style="background: #2a7a73; margin-left: 0px;">
            <tr class="row">
                <th class="text-center py-3 col-6">Sản phẩm</th>
                <th class="text-center py-3 col-2">Số lượng</th>
                <th class="text-center py-3 col-2">Thành tiền</th>
                <th class="text-center py-3 col-2">Thao tác</th>
            </tr>
        </thead>

        <tbody class="border w-100 col">
            <?php foreach ($cartList as $item) : ?>
                <tr class="product d-none d-md-flex text-center row align-items-center bg-white py-4 flex-row" data-book_id="<?= htmlspecialchars($item['id_sach']) ?>">
                    <div>

                        <td class="text-start py-2 col-md-6">
                            <div class="d-flex">
                                <a href class="pan col-3 text-center me-3 me-md-0" data-big="<?= htmlspecialchars($item['anh_bia']) ?>">
                                    <img src="<?= htmlspecialchars($item['anh_bia']) ?>" alt="" data-action="zoom" style="width: 100px;">
                                </a>
                                <div class="col-8 mx-5 mx-lg-0 d-flex flex-column justify-content-around">
                                    <p class="text-truncate mb-0 fw-semibold">
                                        <?= htmlspecialchars($item['ten_sach']) ?>
                                    </p>
                                    <p>
                                        <span class="text-decoration-line-through text-black-50 me-2"><?= htmlspecialchars($item['gia_goc']) ?>đ</span>
                                        <span class="text-danger fw-bold sale"><?= htmlspecialchars($item['gia_sale']) ?></span>
                                        <span class="text-danger fw-bold">đ</span>
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="col-md-2 px-md-0">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex col-md-12 number-input">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn-minus btn btn-default btn-number rounded-end-0" style="border: 1px solid #17252a;" data-type="minus" data-field="quantity">
                                            <span class="fa fa-minus"></span>
                                        </button>
                                    </span>
                                    <input type="number" value="<?= htmlspecialchars($item['so_luong']) ?>" min="0" max="100" name="quantity" class="fw-bold form-control input-number text-center col rounded-0 border-end-0 border-start-0" style="box-shadow: none; border-color: #17252a;">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn-plus btn btn-default btn-number rounded-start-0" style="border: 1px solid #17252a;" data-type="plus" data-field="quantity">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </td>

                        <td class="col-md-2 text-center text-danger">
                            <span class="fw-bold total"><?= htmlspecialchars($item['so_luong'] * $item['gia_sale']) ?></span>
                            <span class="text-danger fw-bold">đ</span>
                        </td>

                        <td class="fs-4 cart-btn-close col-md-2 text-center" style="color: #3aafa9;">
                            <i class="fa-solid fa-trash"></i>
                        </td>

                    </div>
                </tr>

                <div class="product d-flex d-md-none text-center row align-items-center py-4 flex-column" data-book_id="<?= htmlspecialchars($item['id_sach']) ?>">
                    <div class="py-3 d-flex align-items-center border bg-white">
                        <div class="col-3">
                            <a href class="pan col-3 text-center me-3 me-md-0" data-big="<?= htmlspecialchars($item['anh_bia']) ?>">
                                <img src="<?= htmlspecialchars($item['anh_bia']) ?>" alt="" data-action="zoom" style="width: 100px;">
                            </a>
                        </div>

                        <div class="col-9 text-center px-2">

                            <div class="text-start">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="text-truncate mb-0 fw-semibold me-5">
                                        <?= htmlspecialchars($item['ten_sach']) ?>
                                    </p>
                                    <div class="fs-4 cart-btn-close me-2" style="color: #3aafa9;"><i class="fa-solid fa-trash"></i></div>
                                </div>
                                <p class="mt-2">
                                    <span class="text-decoration-line-through text-black-50 me-2"><?= htmlspecialchars($item['gia_goc']) ?> đ</span>
                                    <span class="text-danger fw-bold sale"><?= htmlspecialchars(format_money($item['gia_sale'])) ?></span>
                                </p>

                            </div>

                            <div class="text-start">
                                <div class="d-flex w-50 number-input">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn-minus btn btn-default btn-number  rounded-end-0" style="border: 1px solid #17252a;" data-type="minus" data-field="quantity">
                                            <span class="fa fa-minus"></span>
                                        </button>
                                    </span>
                                    <input type="number" value="<?= htmlspecialchars($item['so_luong']) ?>" min="0" max="100" name="quantity" class="form-control input-number text-center col rounded-0 border-end-0 border-start-0" style="box-shadow: none; border-color: #17252a;">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn-plus btn btn-default btn-number rounded-start-0" style="border: 1px solid #17252a;" data-type="plus" data-field="quantity">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </tbody>
    </table>

    <button class="fs-1 position-fixed bottom-0 end-0 border-0 bg-transparent">
        <a href="#body" style="color: #3aafa9;"><i class="fa-solid fa-circle-up"></i></a>
    </button>

</main>

<script>
    $().ready(function() {
        const swalDelete = (book) => {
            return Swal.fire({
                title: 'Xác nhận xóa?',
                text: "Bạn chắc chắn muốn xóa sản phẩm này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    const bookId = book[0].dataset.book_id;

                    $.ajax({
                        url: '/cart/delete/' + bookId,
                        type: 'POST',
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
                                $('.cart-item').each(function() {
                                    const itemId = $(this).find('a').prop('href').split('/')[5];
                                    if (itemId === bookId) {
                                        $(this).remove();
                                    }
                                })
                                book.remove();
                                if (!$('.cart-item').length) {
                                    window.location.reload();
                                }
                            })
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    })
                }
            })
        }

        $('.cart-btn-close').each(function() {
            $(this).on('click', () => {
                const book = $(this).closest('.product');
                swalDelete(book);
            })
        })

        $('.btn-minus').each(function() {
            $(this).on('click', function() {
                const book = $(this).closest('.product');
                const bookId = book[0].dataset.book_id;
                const input = $(this).closest('.number-input').find('input[name="quantity"]');
                const formData = new FormData();

                input[0].stepDown();

                $('.cart-item').each(function() {
                    const itemId = $(this).find('a').prop('href').split('/')[5];
                    if (itemId === bookId) {
                        $(this).find('.quantity').html(Number(input.val()));
                    }
                })

                if (Number(input.val()) === 0) {
                    input.val(1);
                    swalDelete(book);
                }

                book.find('.total').html(Number(input.val()) * Number(book.find('.sale').text()));

                formData.append('quantity', input.val());

                fetch('/cart/update/' + bookId, {
                    method: 'POST',
                    body: formData
                }).then()
            })
        })

        $('.btn-plus').each(function() {
            $(this).on('click', function() {
                const book = $(this).closest('.product');
                const bookId = book[0].dataset.book_id;
                const input = $(this).closest('.number-input').find('input[name="quantity"]');
                const formData = new FormData();

                input[0].stepUp();
                book.find('.total').html(Number(input.val()) * Number(book.find('.sale').text()));

                $('.cart-item').each(function() {
                    const itemId = $(this).find('a').prop('href').split('/')[5];
                    if (itemId === bookId) {
                        $(this).find('.quantity').html(Number(input.val()));
                    }
                })

                formData.append('quantity', input.val());

                fetch('/cart/update/' + bookId, {
                    method: 'POST',
                    body: formData
                }).then()
            })
        })
    })
</script>

<?php include_once VIEWS_DIR . "/layouts/footer/index.php"; ?>