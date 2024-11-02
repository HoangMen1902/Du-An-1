        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Mã giảm giá</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Tên
                                    </th>

                                    <th>Mã giảm giá</th>
                                    <th>
                                        Giá giảm
                                    </th>

                                    <th>Giảm với đơn trên</th>
                                    <th>
                                        Ngày tạo
                                    </th>
                                    <th>
                                        Ngày hết hạn
                                    </th>
                                    <th>
                                        Trạng thái
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if ($data) :
                                    foreach ($data as $voucher) :
                                ?>
                                        <tr>
                                            <td>
                                                <?= $voucher['id'] ?>
                                            </td>
                                            <td>
                                                <?= $voucher['name'] ?>
                                            </td>
                                            <td>
                                                <?= $voucher['code'] ?>
                                            </td>
                                            <td>
                                                <?= number_format($voucher['discountAmount'])  ?>
                                            </td>

                                            <td>
                                                <?= number_format($voucher['orderValueDiscount'])  ?>
                                            </td>
                                            <td><?= $voucher['createdAt'] ?></td>
                                            <td><?= $voucher['dueAt'] ?></td>
                                            <td>
                                                <?= $voucher['status'] == 1 ? 'Hoạt động' : 'Không hoạt động' ?>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="/admin/edit-voucher/<?= $voucher['id'] ?>" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                        Sửa
                                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                                    </a>
                                                    <a href="/admin/delete-voucher/<?= $voucher['id'] ?>" onclick="return confirm('Bạn chắc chứ?')" class="btn btn-danger btn-sm btn-icon-text">
                                                        Xóa
                                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
