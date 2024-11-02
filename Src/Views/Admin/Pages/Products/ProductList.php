<?php

namespace App\Views\Admin\Pages\Products;

use App\Views\BaseView;

class ProductList extends BaseView
{
    public static function render($data = null)
    {


        ?>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách Sản phẩm </h4>
                    <?php
                    if (count($data)):
                        ?>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>

                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th >
                                            Tên Sản phẩm
                                        </th>
                                        <th >
                                            Hình ảnh
                                        </th>


                                        <th>
                                            Trạng thái
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($data as $item):
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $item['id'] ?>
                                            </td>
                                            <td>
                                                <?= $item['name'] ?>

                                            </td>
                                            <td>
                                                <img src="/public/uploads/<?= $item['image'] ?>" alt="" width="100%">

                                            </td>

                                            <td>
                                                <?= $item['status'] == 1 ? 'Hoạt động' : 'Không hoạt động' ?>

                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" style="display: flex;" href="/admin/edit-product/<?= $item['id'] ?>"><p >Sửa</p>
                                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                                        </a>
                                                        <a class="dropdown-item" href="/admin/delete-product/<?= $item['id'] ?>"
                                                            onclick="return confirm('Bạn chắc chứ?')"><p>Xóa</p>
                                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                        </a>
                                                        <a class="dropdown-item" href="/admin/product-detail/<?= $item['id'] ?>"><p>Chi
                                                            tiết</p>
                                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="/admin/add-product-detail/<?= $item['id'] ?>"><p>Thêm thông số kỹ  thuật</p>
                                                         
                                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;

                                    ?>
                                    <?php
                    else:

                        ?>
                                    <h4 class="text-center text-danger">Không có dữ liệu</h4>
                                    <?php
                    endif;

                    ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>





        <?php

    }
}

?>