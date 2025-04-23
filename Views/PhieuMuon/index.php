
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>    
            <th>Mã phiếu mượn</th>
            <th>Mã thẻ thư viện</th>
            <th>Mã nhân viên</th>
            <th>Ngày mượn</th>
            <th>Ngày trả</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Mã phiếu mượn</th>
            <th>Mã thẻ thư viện</th>
            <th>Mã nhân viên</th>
            <th>Ngày mượn</th>
            <th>Ngày trả</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </tfoot>
    <tbody>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php
            foreach ($data as $pm){    
        ?>
        <tr>
            <td><?php echo $pm->getMaPM();?></td>
            <td><?php echo $pm->getMaTTV();?></td>
            <td><?php echo $pm->getMaNV();?></td>
            <td><?php echo $pm->getNgayMuon();?></td>
            <td><?php echo $pm->getNgayTra();?></td>
            <td><?php echo $pm->getTrangThai();?></td>
            
            <td>
                <?php
                    if ($pm->getTrangThai() == "Đang mượn"){
                ?>
                    <a class="btn btn-success" href="index.php?controller=phieumuon&action=update&id=<?php echo $pm->getMaPM();?>">Cập nhật</a>
                <?php
                    } else if ($pm->getTrangThai() == "Quá hạn") {
                ?>
                    <a class="btn btn-danger" href="index.php?controller=phieumuon&action=createPP&id=<?php echo $pm->getMaPM();?>">Tạo phiếu phạt</a>
                <?php
                    } else {
                ?>
                <button class="xoa btn btn-danger" data-id="<?php echo $pm->getMaPM();?>">Xóa</button>
                <?php } ?>

                <a class="btn btn-primary" href="index.php?controller=phieumuon&action=details&id=<?php echo $pm->getMaPM();?>">Xem</a>
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
                    title: 'Bạn có chắc chắn muốn xóa phiếu mượn này không?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#e74a3b',
                    confirmButtonText: 'Xóa',
                    cancelButtonColor: '#858796',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controller=phieumuon&action=delete&id=" + idNguoiDung;
                    }
                });
            });
        });
        </script>
    </tbody>
</table>