<?php $this->load->view('data/head'); ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <h2><?= $title;?></h2>
                                <hr>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <a href="<?= base_url();?>admin/penjualan" class="btn btn-success"><i class="mdi mdi-plus-box"></i> Add Pesanan</a>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <a href="#" class="btn btn-info float-right"><i class="mdi mdi-printer"></i> Print</a>
                                        </div>
                                    </div>
                                <hr>
                                    <div class="form-group">
                                        <div class="alert alert-success" id="berhasil"><i class="mdi mdi-check-circle"></i> <span id="text_berhasil"></span></div>
                                    <div class="alert alert-danger" id="gagal"><i class="mdi mdi-close-circle"></i> <span id="text_gagal"></span></div>
                                </div>
                                <div class="table-responsive">
                                    <table id="tableData" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama User</th>
                                                <th>Jumlah Pesanan</th>
                                                <th>Total Omset</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_omset_user">
                                            <?php 
                                                foreach ($omset as $data) {
                                                    echo '<tr>
                                                            <td>'.$data->nama_user.'</td>
                                                            <td>'.$data->jumlah_penjualan.'</td>
                                                            <td>Rp '.number_format($data->omset).'</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-3">
                                                                        <div class="dropdown show">
                                                                            <a class="btn btn-primary btn-sm dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</a>
                                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                                <a class="dropdown-item" href="#">Lihat Penjualan</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('data/foot'); ?>