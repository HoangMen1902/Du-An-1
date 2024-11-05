<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="adsProduct-wrapper">
        <div class="container">
            <div class="row adsProducts_height ">
                <div class="col-3 col-md-3 col-md-3  col-xxl-3 d-flex flex-column p-3 position-relative bdrdu-20"
                    style="background-color: #FFFFFF; ">
                    <h3>APPLE</h3>
                    <h2>Siêu mỏng</h2>
                    <button class="btn   col-12 col-md-12 col-xxl-6 adsProducts_height_fix1">Mua ngay</button>
                    <div class="position-absolute adsProducts_image  col-12 col-md-12 col-xxl-8  ">
                        <img src="https://theme.hstatic.net/1000359786/1001101456/14/hc_img_3.png?v=234"
                            alt="Hình ảnh Apple" class="img-fluid">
                    </div>

                </div>

                <div class="col-6 col-md-6 col-xxl-6 px-4">
                    <div class="adsProducts_height_2  p-3 mb-3 position-relative bdrdu-20 "
                        style="background-color:#f82935 ; color: white;">
                        <h3>APPLE</h3>
                        <h2>Siêu mỏng</h2>
                        <button class="btn  col-7 col-md-6 col-xxl-3">Mua ngay</button>
                        <div class="position-absolute adsProducts_image2">
                            <img src="<?= $_ENV['APP_URL'] ?>/public\Assets\Client\Images\Home\banner2.png"
                                alt="Hình ảnh Apple" class="img-fluid">
                        </div>


                    </div>
                    <div class="adsProducts_height_2  p-3 mt-3 position-relative  bdrdu-20  "
                        style="background-color:#090909 ; color: white;">

                        <h3>APPLE</h3>
                        <h2>Siêu mỏng</h2>
                        <button class="btn  col-7 col-md-6 col-xxl-3">Mua ngay</button>
                        <div class="position-absolute adsProducts_image2">

                            <img src="<?= $_ENV['APP_URL'] ?>/public\Assets\Client\Images\Home\banner3.png"
                                alt="Hình ảnh Apple" class="img-fluid">
                        </div>


                    </div>
                </div>

                <div class="col-3 col-md-3 col-xxl-3 d-flex flex-column p-3 position-relative bdrdu-20"
                    style="background-color: #017BC4; ">
                    <h3>APPLE</h3>
                    <h2>Siêu mỏng</h2>
                    <button class="btn  col-12 col-md-12 col-xxl-6">Mua ngay</button>
                    <div class="position-absolute adsProducts_image col-md-12 col-xxl-8">

                        <img src="<?= $_ENV['APP_URL'] ?>/public\Assets\Client\Images\Home\banner4.png"
                            alt="Hình ảnh Apple" class="img-fluid">
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>