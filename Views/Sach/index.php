
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            
            <th>Tên Sách</th>
            <th>Tác giả</th>
            <th>Thể loại</th>
            <th>Số lượng</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            
            <th>Tên Sách</th>
            <th>Tác giả</th>
            <th>Thể loại</th>
            <th>Số lượng</th>
            <th>Chức năng</th>
        </tr>
    </tfoot>
    <tbody>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php
            foreach ($data as $book){    
        ?>
        <tr>
            <td><?php echo $book->getTenDS();?></td>
            <td><?php echo $book->getTenTG();?></td>
            <td><?php echo $book->getTheLoai()->getTenTL();?></td>
            <td><?php echo $book->getSoLuong();?></td>
            
            <td>
                <a class="btn btn-success" href="index.php?controller=sach&action=detail&id=<?php echo $book->getMaDS();?>">Xem</a>
                <a class="btn btn-primary" href="index.php?controller=sach&action=edit&id=<?php echo $book->getMaDS();?>">Sửa</a>
                <button class="xoa btn btn-danger" data-id="<?php echo $book->getMaDS();?>">Xóa</button>
                
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
                    title: 'Bạn có chắc chắn muốn xóa đầu sách này không?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#e74a3b',
                    confirmButtonText: 'Xóa',
                    cancelButtonColor: '#858796',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controller=sach&action=delete&id=" + idNguoiDung;
                    }
                });
            });
        });
        </script>
    </tbody>
</table>