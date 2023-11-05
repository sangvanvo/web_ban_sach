<?php include_once VIEWS_DIR . "/layouts/header/index.php"; ?>

<style>
    .product img:hover {
        scale: 1.2;
        transition: all 0.5s;
    }

    #dropdown:hover #dropdown-menu {
        display: block;
    }

    .dropdown-item:hover {
        background-color: #17252a;
        color: white;
    }
</style>

<main>
    <section class="p-3">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-md-3 col-12 bg-white">
                    <div class="dropdown" id="dropdown">
                        <button class="btn btn-white w-100 d-flex justify-content-start" type="button"
                            style="box-shadow: none; color: #3aafa9;" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center gap-1 fs-4">
                                <i class="fa-solid fa-bars"></i>
                                <p class="m-0 ml-2"><a href="#" class="text-decoration-none fw-bold"
                                        style="color: #3aafa9;">Menu</a>
                                </p>
                            </div>
                        </button>
                        <ul class="dropdown-menu row w-100" id="dropdown-menu">
                            <li><a class="dropdown-item fw-bold" href="/book/search?tu_khoa=Tiểu_thuyết">Tiểu thuyết</a>
                            </li>
                            <li><a class="dropdown-item fw-bold" href="/book/search?tu_khoa=Truyện_ngắn">Truyện ngắn</a>
                            </li>
                            <li><a class="dropdown-item fw-bold" href="/book/search?tu_khoa=Truyện_tranh">Truyện
                                    tranh</a></li>
                            <!-- <li><a class="dropdown-item fw-bold"
                                    href="/book/search?tu_khoa=Truyện_khoa_học_viễn_tưởng">Truyện khoa học viễn
                                    tưởng</a></li> -->
                            <li><a class="dropdown-item fw-bold" href="/book/search?tu_khoa=Truyện_tình_yêu">Truyện tình
                                    yêu</a></li>
                            <li><a class="dropdown-item fw-bold" href="/book/search?tu_khoa=Truyện_phiêu_lưu">Truyện
                                    phiêu lưu</a></li>
                            <li><a class="dropdown-item fw-bold" href="/book/search?tu_khoa=Truyện_hài">Truyện hài</a>
                            </li>
                            <li><a class="dropdown-item fw-bold" href="/book/search?tu_khoa=Truyện_Ma">Truyện ma</a>
                            </li>
                            <li><a class="dropdown-item fw-bold" href="/book/search?tu_khoa=Tôn_giáo">Tôn giáo</a>
                            </li>
                        </ul>
                    </div>


                </div>
                <div id="carouselExampleInterval" class="carousel slide col-md-9 col-12" data-bs-ride="carousel">
                    <div class="carousel-inner rounded-3">

                        <div class="carousel-item active rounded-3" data-bs-interval="2000">
                            <img src="https://cdn0.fahasa.com/media/magentothem/banner7/Manga_mainbanner_T10_Slide_840x320_1.jpg"
                                class="d-block w-100 rounded-3 " style="height: 316px ;" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="https://cdn0.fahasa.com/media/magentothem/banner7/WimpyKid_banner_840x320.jpg"
                                class="d-block w-100 rounded-3" style="height: 316px ;" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="https://cdn0.fahasa.com/media/magentothem/banner7/SaleThu3_W3_T1023_banner_Slide_840x320.jpg  "
                                class="d-block w-100 rounded-3" style="height: 316px ;" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="p-3">
        <div class="container">
            <div class="row shadow-lg">
                <div class="d-flex justify-content-between bg-white py-2">
                    <a href="#" class="text-decoration-none fw-bold" style="color: #3aafa9; font-size: 17px;">Sản phẩm
                        mới</a>
                    <a href="#" class="text-decoration-none fw-bold" style="color: #3aafa9; font-size: 17px;">Xem tất
                        cả</a>
                </div>
            </div>

            <div class="row">
                <?php foreach ($ketqua as $sach): ?>
                    <div class="product col-md-3 col-sm-6 col-12 p-3 bg-white"
                        data-book_id="<?= htmlspecialchars($sach['id']) ?>">
                        <div class="col">
                            <div class="row p-3">
                                <div class="col-md-12 col-12 text-center">
                                    <!-- Hình ảnh sách -->
                                    <a href="/book/detail/<?= htmlspecialchars($sach['id']) ?>"><img class="img"
                                            src="<?= htmlspecialchars($sach['anh_bia']) ?>" alt="Hình ảnh sách"
                                            class="img-fluid" style=" height: 170px;"></a>
                                </div>
                                <div class="col-md-12 col-12 text-center mt-3">
                                    <!-- Tên sách -->
                                    <p class="fw-bold text-truncate name">
                                        <?= htmlspecialchars($sach['ten_sach']) ?>
                                    </p>
                                    <!-- Giá -->
                                    <p class="text-decoration-line-through price">
                                        <?= htmlspecialchars(format_money($sach['gia_goc'])) ?>
                                    </p>
                                    <p class="fw-bold text-danger sale">
                                        <?= htmlspecialchars(format_money($sach['gia_sale'])) ?>
                                    </p>
                                </div>

                                <div class="text-center">
                                    <p class="add_to_cart btn btn-dark">
                                        Thêm giỏ hàng
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>

    <section class="p-5">
        <div class="container">
            <div class="row shadow-lg">
                <div class="d-flex justify-content-between bg-white py-2">
                    <a href="#" class="text-decoration-none fw-bold" style="color: #3aafa9; font-size: 17px;">Có thể bạn
                        thích</a>
                    <a href="#" class="text-decoration-none fw-bold" style="color: #3aafa9; font-size: 17px;">Xem tất
                        cả</a>
                </div>
            </div>

            <div class="row">
                <?php foreach ($random as $sach): ?>
                    <div class="product col-md-3 col-sm-6 col-12 p-3 bg-white"
                        data-book_id="<?= htmlspecialchars($sach['id']) ?>">
                        <div class="col">
                            <div class="row p-3">
                                <div class="col-md-12 col-12 text-center">
                                    <!-- Hình ảnh sách -->
                                    <a href="/book/detail/<?= htmlspecialchars($sach['id']) ?>"><img class="img"
                                            src="<?= htmlspecialchars($sach['anh_bia']) ?>" alt="Hình ảnh sách"
                                            class="img-fluid" style=" height: 170px;"></a>
                                </div>
                                <div class="col-md-12 col-12 text-center mt-3">
                                    <!-- Tên sách -->
                                    <p class="fw-bold text-truncate name">
                                        <?= htmlspecialchars($sach['ten_sach']) ?>
                                    </p>
                                    <!-- Giá -->
                                    <p class="text-decoration-line-through price">
                                        <?= htmlspecialchars(format_money($sach['gia_goc'])) ?>
                                    </p>
                                    <p class="fw-bold text-danger sale">
                                        <?= htmlspecialchars(format_money($sach['gia_sale'])) ?>
                                    </p>
                                </div>

                                <div class="text-center">
                                    <p class="add_to_cart btn btn-dark">
                                        Thêm giỏ hàng
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <button class="fs-1 position-fixed bottom-0 end-0 border-0 bg-transparent">
        <a href="#body" style="color: #3aafa9;"><i class="fa-solid fa-circle-up"></i></a>
    </button>
</main>

<?php include_once VIEWS_DIR . "/layouts/footer/index.php"; ?>