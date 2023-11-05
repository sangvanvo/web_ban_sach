   <footer class="text-center" style="background-color: #def2f1 !important;">
       <div class="text-center p-3 fw-semibold">
           © Copyright © 2023:
           <a class="text-dark fw-semibold" href="#">Bookstore</a>
       </div>
   </footer>

   <script>
       $().ready(() => {
           $('.btn-delete').on('click', function() {
               Swal.fire({
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
                       const deleteBtn = $(this);
                       const bookId = $(this).parent().find('#book_id').val();

                       $.ajax({
                           url: '/admin/delete/' + bookId,
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
                               })

                               deleteBtn.closest('.book').remove();
                           },
                           error: function(error) {
                               console.log(error);
                           }
                       })

                   }
               })
           })
       })
   </script>
   </body>

   </html>