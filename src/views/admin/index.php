<?php include_once VIEWS_DIR . "/admin/layouts/header/index.php"; ?>

<main class="p-2 container" style="min-height: 100vh;">

    <p class="fs-3 fw-semibold">Danh sách sản phẩm</p>
    <div class=" overflow-x-scroll">
        <table class="table table-responsive" style="min-width: 700px;">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>SẢN PHẨM</th>
                    <th class="text-center">GIÁ</th>
                    <th class="text-center">SALE</th>
                    <th class="text-center">HÀNH ĐỘNG</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $index => $book): ?>
                    <tr class="book">
                        <td class=" align-middle">
                            <?php echo $index + 1 ?>
                        </td>
                        <td class="align-middle">
                            <a href="/admin/edit" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                                <img src="<?= htmlspecialchars($book['anh_bia']) ?>" alt="" style="width: 70px;">
                                <p class=" mb-0">
                                    <?= htmlspecialchars($book['ten_sach']) ?>
                                </p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-decoration-line-through fw-semibold">
                            <?= htmlspecialchars(format_money($book['gia_goc'])) ?>
                        </td>
                        <td class="align-middle text-center text-danger fw-semibold">
                            <?= htmlspecialchars(format_money($book['gia_goc'])) ?>
                        </td>
                        <td class="align-middle text-center">
                            <input type="hidden" id="book_id" value="<?= htmlspecialchars($book['id']) ?>">
                            <a href="/admin/edit/<?= htmlspecialchars($book['id']) ?>"
                                class="btn btn-info text-white">Edit</a>
                            <button class="btn-delete btn btn-danger">Xóa</button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</main>

<?php include_once VIEWS_DIR . "/admin/layouts/footer/index.php"; ?>