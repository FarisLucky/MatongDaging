        <div id="content-wrapper">

            <div class="container-fluid">
                <!-- DataTables -->
                <div class="card mb-3">
                    <div class="card-body">
                        <!-- tag php tadi -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <h1 class="card-title">Data Jenis Pembayaran</h1>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($jenispembayaran as $j) :
                                        ?>
                                        <tr>
                                            <td><?php echo $j->id_jenis ?></td>
                                            <td><?php echo $j->jenis_pembayaran ?></td>
                                            <td width="250">
                                                <a href="<?php echo site_url('index.php/jenis_pembayaran/edit/' . $j->id_jenis) ?>" class="btn btn-secondary btn-fw"></i> Edit</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>