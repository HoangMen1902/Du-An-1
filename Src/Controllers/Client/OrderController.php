<?php

namespace Src\Controllers\Client;

use Dompdf\Dompdf;
use Dompdf\Options;
use Src\Controllers\BaseController;
use Src\Models\Client\AddressModel;
use Src\Models\Client\OrderModel;
use Src\Notifications\Notification;

class OrderController extends BaseController
{

    public function showDetails($params)
    {
        $order_id = $params['id'];
        $user_id = $_SESSION['user']['id'];

        $OrderModel = new OrderModel();
        $order = $OrderModel->getOneOrdersAllDetails($order_id, $user_id);


        if ($order === false) {
            Notification::error('Đã có lỗi xảy ra', 'Có lỗi xảy ra khi truy vấn đơn hàng');
            header('location: /profile/orders-list');
            exit();
        }

        if (empty($order) || !isset($order)) {
            Notification::error('Đơn hàng không hợp lệ', 'Đơn hàng này không hợp lệ');
            header('location: /profile/orders-list');
            exit();
        }




        echo $this->view->render('Client/Pages/UserProfile/UserOrderDetails/UserOrderDetails', ['data' => $order]);
    }


    public function exportInvoice($params)
    {
        $order_id = $params['id'];
        $user_id = $_SESSION['user']['id'];

        $OrderModel = new OrderModel();
        $order = $OrderModel->getOneOrdersAllDetails($order_id, $user_id);


        if ($order === false) {
            Notification::error('Đã có lỗi xảy ra', 'Có lỗi xảy ra khi truy vấn đơn hàng');
            header('location: /profile/orders-list');
            exit();
        }

        if (empty($order) || !isset($order)) {
            Notification::error('Đơn hàng không hợp lệ', 'Đơn hàng này không hợp lệ');
            header('location: /profile/orders-list');
            exit();
        }

        $imageUrl = 'https://cdn.discordapp.com/attachments/1153530045764206623/1315564312495915008/logobeesmol.png?ex=6757de3e&is=67568cbe&hm=871160211ade60cf26f2a101e01812c1b0376f69da25b4467ef86e1b8fb0261b&';

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $html = '<html>
<head>
    <meta charset="utf-8" />
    <title>Hóa đơn thanh toán tại BeeTechNova</title>

    <style>
    body {
        font-family: "DejaVu Sans", sans-serif;
    }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: "DejaVu Sans", sans-serif;

            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: "DejaVu Sans", sans-serif;

        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img
                                src="' . $imageUrl . '"
                                    style="width: 100%; max-width: 300px"
                                />
                            </td>

                            <td>
                                Hóa đơn #: ' . $order[0]['order_id'] . '<br />
                                Tạo ngày: ' . $order[0]['order_date'] . '<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                BeeTechNova, Inc.<br />
                                KDC Hoàng Quân<br />
                                Cái Răng Cần Thơ
                            </td>

                            <td>
                                ' . $_SESSION['user']['fullname'] . '.<br />
                                ' . $order[0]['customer_address'] . '<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Thanh toán</td>

                <td>Đã thanh toán #</td>
            </tr>

            <tr class="details">
                <td>Số tiền</td>

                <td>' . number_format($order[0]['total_price'], 0, '.', ',') . ' VNĐ</td>
            </tr>

            <tr class="heading">
                <td>Sản phẩm</td>

                <td>Giá tiền</td>
            </tr>

            ';
        foreach ($order as $index => $item) {
            if ($index === array_key_last($order)) {
                $html .= '
                <tr class="item last">
                    <td>' . $item['sku_code'] .  " (x" . $item['sku_quantity'] . ")" . '</td>
                    <td>' . number_format($item['sku_price'], 0, '.', ',') . ' VNĐ</td>
                </tr>
                    ';
                continue;
            }
            $html .= '
            <tr class="item">
                <td>' . $item['sku_code'] .  " (x" . $item['sku_quantity'] . ")" . '</td>
                <td>' . number_format($item['sku_price'], 0, '.', ',') . ' VNĐ</td>
            </tr>
                ';
        }

        $html .= '
                    <tr class="total">
                        <td></td>

                        <td>Tổng: ' . number_format($order[0]['total_price'], 0, '.', ',') . ' VNĐ</td>
                    </tr>
                </table>
            </div>
        </body>
        </html>';

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream("sample.pdf", ["Attachment" => false]);
    }
}
