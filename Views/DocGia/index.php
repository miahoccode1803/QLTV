<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Mã độc giả</th>
            <th>Loại độc giả</th>
            <th>Mã thẻ thư viện</th>
            <th>Họ Tên</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Mã độc giả</th>
            <th>Loại độc giả</th>
            <th>Mã thẻ thư viện</th>
            <th>Họ Tên</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Chức năng</th>
        </tr>
    </tfoot>
    <tbody>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php
            foreach ($data as $reader){    
        ?>
        <tr>
            <td><?php echo $reader->getMaDG();?></td>
            <td><?php echo $reader->getLoaiDG();?></td>
            <td><?php echo $reader->getMaTTV();?></td>
            <td><?php echo $reader->getHoTen();?></td>
            <td><?php echo $reader->getNgaySinh();?></td>
            <td><?php echo $reader->getDiaChi();?></td>
            <td><?php echo $reader->getSdt();?></td>
            <td>
                <a class="btn btn-primary" href="index.php?controller=docgia&action=edit&id=<?php echo $reader->getMaDG();?>">Sửa</a>
                <button class="xoa btn btn-danger" data-id="<?php echo $reader->getMaDG();?>">Xóa</button>
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
                    title: 'Bạn có chắc chắn muốn xóa độc giả này không?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#e74a3b',
                    confirmButtonText: 'Xóa',
                    cancelButtonColor: '#858796',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controller=docgia&action=delete&id=" + idNguoiDung;
                    }
                });
            });
        });
        </script>
    </tbody>
</table>