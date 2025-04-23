
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            
            <th>Tài khoản</th>
            <th>Mật khẩu</th>
            <th>Loại</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            
            <th>Tài khoản</th>
            <th>Mật khẩu</th>
            <th>Loại</th>
            <th>Chức năng</th>
        </tr>
    </tfoot>
    <tbody>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php
            foreach ($data as $user){    
        ?>
        <tr>
            <td><?php echo $user->getTaiKhoan();?></td>
            <td><?php echo $user->getMatKhau();?></td>
            <td><?php echo $user->getLoaitk();?></td>
            
            <td>
                <a class="btn btn-primary" href="index.php?controller=taikhoan&action=edit&id=<?php echo $user->getTaiKhoan();?>">Sửa</a>
                <button class="xoa btn btn-danger" data-id="<?php echo $user->getTaiKhoan();?>">Xóa</button>
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
                    title: 'Bạn có chắc chắn muốn xóa tài khoản này không?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#e74a3b',
                    confirmButtonText: 'Xóa',
                    cancelButtonColor: '#858796',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controller=taikhoan&action=delete&id=" + idNguoiDung;
                    }
                });
            });
        });
        </script>
    </tbody>
</table>