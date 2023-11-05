<footer class="fw-bold text" style="background-color: #def2f1; color: #17252a;">
    <div class="container-fluid text-center">
        <div class="container p-4">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="fw-bold">Hỗ Trợ Khách Hàng</h4>
                    <p class="mb-0 fw-bold" style="color: #3aafa9; font-size: 17px;">Email: Bookstore@gamil.com</p>
                    <p class="mb-0 fw-bold" style="color: #3aafa9; font-size: 17px;">Hotline: 19006060</p>
                </div>
                <div class="col-md-3 my-3 my-md-0">
                    <h4 class="fw-bold">Giới thiệu</h4>
                    <p class="mb-0 fw-bold"><a href="#" class="text-decoration-none"
                            style="color: #3aafa9; font-size: 17px;">Thông tin về shop</a>
                    </p>
                    <p class="mb-0 fw-bold"><a href="#" class="text-decoration-none"
                            style="color: #3aafa9; font-size: 17px;">Tuyển Dụng</a></p>
                </div>
                <div class="col-md-3 mb-3">
                    <h4 class="fw-bold">Tài Khoản</h4>
                    <p class="mb-0 fw-bold"><a href="#" class="text-decoration-none"
                            style="color: #3aafa9; font-size: 17px;">Đăng nhập</a></p>
                    <p class="mb-0 fw-bold"><a href="#" class="text-decoration-none"
                            style="color: #3aafa9; font-size: 17px;">Đăng ký</a></p>
                </div>
                <div class="col-md-3">
                    <h4 class="fw-bold">Hướng Dẫn</h4>
                    <p class="mb-0 fw-bold mb-0 mb-md-3"><a href="#" class="text-decoration-none"
                            style="color: #3aafa9; font-size: 17px;">Hướng dẫn
                            mua hàng</a>
                    </p>
                    <p class="mb-0 fw-bold mb-0 mb-md-3"><a href="#" class="text-decoration-none"
                            style="color: #3aafa9; font-size: 17px;">Phương
                            thức thanh
                            toán</a>
                    </p>
                    <p class="mb-0 fw-bold mb-0 mb-md-3"><a href="#" class="text-decoration-none"
                            style="color: #3aafa9; font-size: 17px;">câu hỏi
                            thường gặp</a>
                    </p>
                </div>
            </div>
            <hr>
            <div>
                <div class=" d-flex justify-content-center">
                    <p class="mb-0 fw-bold">Copyright © 2023 Bookstore.vn</p>
                </div>
                <div class="d-flex justify-content-center">
                    <p class="mb-0 fw-bold">Địa chỉ: Ninh Kiều, Cần Thơ</p>
                </div>
                <div class="d-flex justify-content-center">
                    <img src="/images/footer/dathongbao.png" alt="" style="width: 220px; height: 83px;">
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    $().ready(() => {
        fetch('/cart/list', {
            method: 'POST',
        })
            .then(res => res.json())
            .then(data => {
                let html = '';

                if (data.length === 0) {
                    $('header .cart .top').remove();
                    $('header .cart .bottom').remove();
                    const el = `<div style="height: 300px;" class="empty-cart d-flex justify-content-center align-items-center">
                            <img src="/images/cart/empty-cart.png" class="w-25" alt="">
                        </div>`;
                    $('header .cart').html(el);
                }

                data.forEach(item => {
                    html += `
                       <li class="cart-item my-2" style="list-style-type: none;">
                           <a href="/book/detail/${item.id_sach}" class="d-flex gap-3 text-decoration-none text-dark">
                               <img src="${item.anh_bia}" alt="Hình ảnh sách" class="img-fluid" style=" height: 100px; width: 100px;">
                               <div class="flex-grow-1">
                                   <p class="mb-0 fw-bold text-truncate" style="width: 70%;">${item.ten_sach}</p>
                                   <div>
                                       <p class="mb-0 fw-bold text-danger">${item.gia_sale} đ</p>
                                        <p class="fw-bold">Số lượng: <span class="quantity">${item.so_luong}</span></p>
                                   </div>
                               </div>
                           </a>
                       </li>
                       `;
                })

                $('.cart-list').html(html);
                $('.cart-quantity').html($('.cart-item').length);
            })
            .catch(error => {
                console.error("Error:", error);
            });

        $('.add_to_cart').each(function () {
            $(this).on('click', function () {
                const book = $(this).closest('.product');
                const bookId = book[0].dataset.book_id;

                const formData = new FormData();
                formData.append('bookId', bookId);

                fetch('/cart', {
                    method: 'POST',
                    body: formData
                })
                    .then(res => res.json())
                    .then(res => {
                        if (!$('.cart-list').length) {
                            $('header .cart.dropdown-menu').html(
                                `<div class="top d-flex text-center" style="background-color: white;">
                                <p class="opacity-75" href="#">Sản phẩm mới thêm</p>
                                </div>
                                <ul class="cart-list overflow-y-scroll overflow-x-hidden" style="height: 400px;"></ul>
                                <div class="bottom w-100 text-end pe-3 pb-2">
                                    <a href="/cart" class="btn btn-dark">
                                        Xem giỏ hàng
                                    </a>
                                </div>
                                `
                            );
                        }

                        const item = `
                            <li class="cart-item my-2" style="list-style-type: none;">
                                <a href="/book/detail/${bookId}" class="d-flex gap-3 text-decoration-none text-dark">
                                    <img src="${book.find('.img').prop('src')}" alt="Hình ảnh sách" class="img-fluid" style=" height: 100px; width: 100px;">
                                    <div class="flex-grow-1">
                                        <p class="fw-bold text-truncate" style="width: 80%;">${book.find('.name').text()}
                                        </p>
                                        <div class="">
                                            <p class="fw-bold text-danger">${book.find('.sale').text()}</p>
                                            <p class="fw-bold">Số lượng: <span class="quantity">1</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>`;

                        let isExist = false;
                        $('.cart-item').each(function () {
                            const itemId = $(this).find('a').prop('href').split('/')[5]
                            if (itemId === bookId) {
                                $(this).find('.quantity').html(Number($(this).find('.quantity').text()) + 1);
                                isExist = true;
                            }
                        })
                        if (!isExist) {
                            $('.cart-list').append(item)
                        }

                        $('.cart-quantity').html($('.cart-item').length);

                        Swal.fire({
                            title: `${res["error"] ? 'Lỗi' : 'Thành công'}`,
                            text: res["message"],
                            icon: `${res["error"] ? 'error' : 'success'}`,
                            confirmButtonText: 'Ok',
                            customClass: {
                                confirmButton: `${res["error"] ? 'bg-danger' : 'bg-success'}`,
                            },
                        }).then(() => {
                            if (res['error'] === 2) {
                                window.location.href = '/login';
                            }
                        })
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
            })
        })

        // $('img')
        //     .wrap('<span style="display:inline-block"></span>')
        //     .css('display', 'block')
        //     .parent()
        //     .zoom();

        $(".pan").pan();
    })

    $("#draggable").draggable()
</script>

</body>

</html>