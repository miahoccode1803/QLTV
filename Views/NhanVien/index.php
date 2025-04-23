
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Mã nhân viên</th>
            <th>Họ Tên</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Tài khoản</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Mã nhân viên</th>
            <th>Họ Tên</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Tài khoản</th>
            <th>Chức năng</th>
        </tr>
    </tfoot>
    <tbody>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php
            foreach ($data as $staff){    
        ?>
        <tr>
            <td><?php echo $staff->getMaNV();?></td>
            <td><?php echo $staff->getHoTen();?></td>
            <td><?php echo $staff->getNgaySinh();?></td>
            <td><?php echo $staff->getDiaChi();?></td>
            <td><?php echo $staff->getSdt();?></td>
            <td><?php echo $staff->getTaiKhoan()->getTaiKhoan();?></td>
            <td>
                <a class="btn btn-primary" href="index.php?controller=nhanvien&action=edit&id=<?php echo $staff->getMaNV();?>">Sửa</a>
                <button class="xoa btn btn-danger" data-id="<?php echo $staff->getMaNV();?>">Xóa</button>
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
                    title: 'Bạn có chắc chắn muốn xóa nhân viên này không?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#e74a3b',
                    confirmButtonText: 'Xóa',
                    cancelButtonColor: '#858796',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controller=nhanvien&action=delete&id=" + idNguoiDung;
                    }
                });
            });
        });
        </script>
    </tbody>
</table>