<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print SPR</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/css/custom_print.css">
    <!-- <style>
        body{
            margin:0px;
            padding:0px;
        }
        body .container{
            padding:20px;
        }
        .text-center{
            text-align:center;
        }
        .content{
            margin-bottom:10px;
        }
        .d-inline-block{
            display:inline-block;
        }
        .d-block{
            display:block;
        }
        .row {
            display:block; 
        }
        .font-weight{
            font-weight:600;
            font-size:15px;
        }
        .font-weight-1{
            font-weight:550;
            font-size:15px;
        }
        .mb-1{
            margin-bottom:10px;
        }
        .mr-2{
            margin-right:10px;
        }
        .text-indent{
            text-indent:10px;
        }
        .mt-2{
            margin-top:5px;
        }
        ol.inner{
            list-style:none;
        }
        ol li{
            margin-bottom:8px;
        }
        ol.list li:last-child{
            list-style:none;
        }
        p{
            font-size:13px;
            font-weight:500;
        }
    </style> -->
</head>
<body>
    <div class="container">
        <div class="title text-center">
            <h3>Surat Pemesanan Rumah</h3>
        </div>
        <div class="content">
            <small class="mb-1 d-inline-block">Yang bertanda tangan dibawah ini :</small>
            <ol class="inner">
                <li><small class="d-inline-block mr-2">Nama : </small><small class="font-weight d-inline-block"><?= $konsumen->nama_konsumen ?></small></li>
                <li><small class="d-inline-block mr-2">Alamat : </small><small class="font-weight d-inline-block"><?= $konsumen->alamat ?></small></li>
                <li><small class="d-inline-block mr-2"><?= $konsumen->nama_type ?> : </small><small class="font-weight d-inline-block"><?= $konsumen->id_card ?></small></li>
            </ol>
            <div class="row mt-2">
                <small class="d-inline-block">Dengan ini menyatakan telah memesan tanah dan atau bangunan kepada <small class="font-weight-1"><?= $unit->nama_properti ?></small> sebagai berikut :</small>
            </div>
                <ol class="list">
                    <li>
                        <small class="mr-2">Tahap Tanah : </small><small class="font-weight-1">Luas <?= $unit->luas_tanah ?></small>
                    </li>
                    <li> 
                        <small class="mr-2 mt-2">Tahap Bangunan : </small><small class="font-weight-1">Luas <?= $unit->luas_bangunan ?></small>
                    </li>
                    <li> 
                        <small class="mr-2">Yang terletak di kavling No. <small class="font-weight-1"><?= $unit->nama_unit ?></small></small>
                    </li>
                    <li> 
                        <small class="d-block">Dengan harga yang diperhitungkan sebagai berikut :</small>
                        <ol class="mt-2 inner">
                            <li>
                                <input type="checkbox"><small class="d-inline-block mr-2">Tanah dan/atau Bangunan : </small>
                            </li>
                            <li>
                                <input type="checkbox"><small class="d-inline-block mr-2">PPN (Pajak Pertambahan Nilai) : </small>
                            </li>
                            <li>
                                <input type="checkbox"><small class="d-inline-block mr-2">Biaya Akte Jual Beli (PPAT) : </small>
                            </li>
                            <li>
                                <input type="checkbox"><small class="d-inline-block mr-2">BBN (Bea Balik Nama) : </small>
                            </li>
                        </ol>
                    </li>
                    <li>
                        <small class="mr-2 font-weight-1"><?= $spr->setting_spr ?></small>
                    </li>
                </ol>
        </div>
    </div>
</body>
</html>