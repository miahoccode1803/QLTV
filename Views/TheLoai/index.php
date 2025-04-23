
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            
            <th>Mã Thể Loại</th>
            <th>Tên thể loại</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Mã Thể Loại</th>
            <th>Tên thể loại</th>
            <th>Chức năng</th>
        </tr>
    </tfoot>
    <tbody>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php
            foreach ($data as $cate){    
        ?>
        <tr>
            <td><?php echo $cate->getMaTL();?></td>
            <td><?php echo $cate->getTenTL();?></td>
            
            <td>
              
                <a class="btn btn-primary" href="index.php?controller=theloai&action=edit&id=<?php echo $cate->getMaTL();?>">Sửa</a>
                <button class="xoa btn btn-danger" data-id="<?php echo $cate->getMaTL();?>">Xóa</button>
            
            </td>
        </tr>
        <?php } ?>

        <script>
        // Giả sử bạn đã thêm class 'xoa' vào nút xóa của mình
        let xoaButtons = document.querySelectorAll('.xoa');

        xoaButtons.forEach((btn) => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                // Lấy id của người dùng từ thuộc tính data-id của nút xóa
                let idNguoiDung = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa thể loại này không?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#e74a3b',
                    confirmButtonText: 'Xóa',
                    cancelButtonColor: '#858796',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controller=theloai&action=delete&id=" + idNguoiDung;
                    }
                });
            });
        });
        </script>
    </tbody>
</table>