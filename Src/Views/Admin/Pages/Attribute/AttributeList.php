<?php

namespace App\Views\Admin\Pages\Category;

use App\Views\BaseView;

class AttributeList extends BaseView
{
    public static function render($data = null)
    {


        ?>



        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách Loại thuộc tính</h4>
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
                                        <th>
                                            Tên Loại thuộc tính
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
                                                <?= $item['status'] == 1 ? 'Hoạt động' : 'Không hoạt động' ?>

                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <a href="/admin/edit-category/<?= $item['id'] ?>"
                                                        class="btn btn-success btn-sm btn-icon-text mr-3">
                                                        Sửa
                                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                                    </a>

                                                    <a href="/admin/delete-category/<?= $item['id'] ?>"
                                                        onclick="return confirm('Bạn chắc chứ?')"
                                                        class="btn btn-danger btn-sm btn-icon-text">
                                                        Xóa
                                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                    </a>
                                                </div>
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