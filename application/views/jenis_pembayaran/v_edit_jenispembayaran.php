<?php

// echo "<pre>";
// print_r($jenispembayaran);
// echo "</pre>";

?>
<div id="content-wrapper">

    <div class="container-fluid">
        <!-- Card  -->
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Edit Jenis Pembayaran</h1>

                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="input_jenis_pembayaran">Jenis Pembayaran</label>
                                <input type="text" class="form-control" id="input_jenis_pembayaran" name="edit_jenis_pembayaran" value="<?= $jenispembayaran[0]['jenis_pembayaran'] ?>" placeholder="Masukan Jenis Pembayaran" required>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>