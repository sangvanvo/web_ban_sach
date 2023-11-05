<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="/images/favicon/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/js/jquery.pan-master/dist/css/jquery.pan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="/css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/js/zoom-master/jquery.zoom.min.js"></script>
    <script src="/js/jquery.pan-master/dist/jquery.pan.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"
        integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .dropdown-menu {
            z-index: 100;
        }

        #dropdown:hover #dropdown-menu {
            display: block !important;
        }

        .dropdown-item:hover {
            background-color: #17252a;
            color: white !important;
        }

        header a:hover {
            color: #3aafa9 !important;
            cursor: pointer;
        }

        .cart#dropdown-menu {
            width: 500px !important;
        }

        .cart .cart-item:hover {
            cursor: pointer;
            opacity: 0.8;
        }

        .cart div a:hover {
            color: white !important;
        }

        .product:hover {
            scale: 1.05;
            transition: all 0.3s;
            border-radius: 4px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
    </style>
    <title>Trang chủ</title>
</head>

<body id="body" id="body">
    <header class="fw-bold position-sticky top-0 shadow-sm" style="background-color: #17252a; z-index: 1000;">
        <div class="container">
            <div class="row py-2 align-items-center" style="min-height: 60px;">
                <!-- LEFT -->
                <div class="col-md-6 col-6 d-none d-md-block">
                    <div class="text-start">
                        <a class="text-white text-decoration-none fw-bold" href="#"><i
                                class="fas fa-question-circle"></i> Trợ
                            giúp</a>
                        <a class="text-white text-decoration-none fw-bold mx-2" href="#"><i
                                class="fas fa-newspaper"></i> Tin tức</a>
                        <a class="text-white text-decoration-none fw-bold" href="#"><i class="fas fa-tags"></i> Khuyến
                            mãi</a>
                    </div>
                </div>
                <!-- END LEFT -->

                <!-- RIGHT -->
                <div class="col-md-6 col-12 ">
                    <div class="text-center text-md-end d-flex justify-content-md-end justify-content-center">
                        <a class="text-white text-decoration-none fw-bold d-flex align-items-center" href="#">
                            <i class="fas fa-gift"></i>
                            <span class="ms-1"> Ưu đãi</span>
                        </a>
                        <div>
                            <?php
                            if (isset($_SESSION['email'])) {
                                echo '<div id="dropdown" class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" style="box-shadow: none;" data-bs-toggle="dropdown" aria-expanded="false">
                                        <a href="login.php" class="text-decoration-none text-white fw-bold mx-0 mx-md-4">
                                        <i class="fa-regular fa-user text-white px-2"></i>';
                                echo htmlspecialchars(explode('@', $_SESSION['email'])[0]);
                                echo '</a>
                                    </button>
                                        <ul id="dropdown-menu" class="dropdown-menu text-white">
                                            <li><a class="dropdown-item" href="/profile">Tài khoản</a></li>
                                            ';
                                echo (isset($_SESSION['is_admin']) && ((int) $_SESSION['is_admin'] === 1)) ? '<li><a class="dropdown-item" href="/admin">Trang quản trị</a></li>' : '';
                                echo '<form id="logout_form" action="/logout" method="post" class="d-flex flex-column">
                                                <button class="dropdown-item" type="submit">
                                                    <i class="fas fa-sign-in-alt"></i>
                                                    Đăng Xuất
                                                </button>
                                            </form>
                                            </li>
                                        </ul>
                                    </div>';
                            } else {
                                echo '
                                    <a class="text-white text-decoration-none fw-bold mx-3" href="/login"><i
                                    class="fas fa-sign-in-alt"></i>
                                     Đăng nhập</a>
                                    <a class="text-white text-decoration-none fw-bold" href="/signup"><i
                                            class="fas fa-user-plus"></i>
                                        Đăng ký</a>
                                    ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- END RIGHT -->
            </div>
        </div>
        <div class="container-fluid" style="background-color: #3aafa9;">
            <div class="container py-2 px-3">
                <div class="row align-items-center justify-content-around my-1">

                    <div class="col-md-3 col-3 d-flex justify-content-center">
                        <a href="/"> <img src="<?= '/images/logo/store.png'; ?>" alt="" style="width: 175px;"></a>
                    </div>

                    <div class="col-md-6 col-6 d-flex justify-content-end position-relative d-none d-md-block">
                        <form action="/book/search"> <input type="text" placeholder="Tìm Kiếm" name="tu_khoa"
                                class="w-100 py-2 px-1 border-0 px-3 rounded-5" style="width: 150px; outline: none;">
                            <i class="fa-solid fa-magnifying-glass position-absolute"
                                style="top: 12px; right: 30px;"></i>
                        </form>
                    </div>

                    <div class="dropdown col-md-3 col-3 text-center d-flex d-md-block justify-content-center"
                        id="dropdown">
                        <a href="/cart" class="position-relative" aria-expanded="false">
                            <span class="fs-3"><i class="fa-solid fa-cart-shopping text-white"></i></span>
                            <span
                                class="cart-quantity position-absolute top-0 start-80 translate-middle badge rounded-pill bg-dark">
                                0
                            </span>
                        </a>

                        <div class="cart dropdown-menu row d-none d-md-none" id="dropdown-menu" style="right: 3%;">
                            <div class="top d-flex text-center" style="background-color: white;">
                                <p class="opacity-75" href="#">Sản phẩm mới thêm</p>
                            </div>

                            <ul class="cart-list overflow-y-scroll overflow-x-hidden" style="height: 400px;"></ul>

                            <div class="bottom w-100 text-end pe-3 pb-2">
                                <a href="/cart" class="btn btn-dark">
                                    Xem giỏ hàng
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 position-relative d-block d-md-none mb-3">
                        <input type="text" placeholder="Tìm Kiếm" class="w-100 py-2 px-1 border-0 px-3 rounded-5"
                            style="width: 150px; outline: none;">
                        <i class="fa-solid fa-magnifying-glass position-absolute" style="top: 12px; right: 30px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>