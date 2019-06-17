<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/css/custom_css.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h2 class="txt-center">List Unit Nama Properti</h2>
        <div class="page-title">
            <small class="title">Belum Terjual : </small>
            <small class="subtitle"><?= $belum->belum_terjual ?></small>
        </div>
        <div class="page-title">
            <small class="title">Total Terjual : </small>
            <small class="subtitle"><?= $terjual->sudah_terjual ?></small>
        </div>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Unit</th>
                    <th>Type</th>
                    <th>Luas Tanah</th>
                    <th>Luas Bangunan</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no= 1; foreach ($unit as $key => $value) { ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $value->nama_unit; ?></td>
                        <td><?= $value->type; ?></td>
                        <td><?= $value->luas_tanah; ?></td>
                        <td><?= $value->luas_bangunan; ?></td>
                        <td><?= number_format($value->harga_unit,2,',','.'); ?></td>
                        <td><img src="<?php echo FCPATH."assets/uploads/images/unit_properti/".$value->foto_unit ?>" alt=""></td>
                        <td><?= $value->status_unit; ?></td>
                    </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </div>
</body>
</html>