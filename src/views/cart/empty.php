<?php include_once VIEWS_DIR . "/layouts/header/index.php"; ?>

<style>
    body {
        background: #f5f5f5;
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

    .cart-empty-img {
        background: url('/images/cart/empty-cart.png') center no-repeat;
        background-size: 150px;
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

<main class="container d-flex flex-column justify-content-center overflow-hidden" style="min-height: 70vh;">
    <div class="cart-empty-img" style="height: 10rem;"></div>
    <div class="row text-center justify-content-center">
        <p>Giỏ hàng của bạn còn trống</p>
        <a href="/" class="btn btn-hover-dark col-4 col-md-2 fw-semibold text-white" style="background: #3aafa9;">Mua
            ngay</a>
    </div>
</main>

<?php include_once VIEWS_DIR . "/layouts/footer/index.php"; ?>