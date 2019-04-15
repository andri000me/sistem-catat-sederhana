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
                                                <th>Nomor Pesanan</th>
                                                <th>Tanggal Pesanan</th>
                                                <th>Pembeli</th>
                                                <th>Nomor Telepon</th>
                                                <th>Ongkos Kirim</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_penjualan">
                                            <?php 
                                                foreach ($penjualan as $data) {
                                                    echo '<tr>
                                                            <td>'.$data->kode_penjualan.'</td>
                                                            <td>'.$data->tanggal_penjualan.'</td>
                                                            <td>'.$data->nama_pembeli.'</td>
                                                            <td>'.$data->nomor_telepon.'</td>
                                                            <td>Rp '.number_format($data->ongkos_kirim).'</td>
                                                            <td>Rp '.number_format($data->total).'</td>
                                                            <td>'.$data->status.'</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-3">
                                                                        <div class="dropdown show">
                                                                            <a class="btn btn-primary btn-sm dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</a>
                                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                                <a class="dropdown-item" href="'.base_url().'admin/cetak_nota/'.$data->id_penjualan.'">Cetak Nota</a>
                                                                                <a class="dropdown-item" href="'.base_url().'transaction/detail_penjualan/'.$data->id_penjualan.'">Detail Penjualan</a>
                                                                                <a class="dropdown-item" href="#">Edit Penjualan</a>
                                                                                <a class="dropdown-item text-danger" href="#" onclick="delete_penjualan('.$data->id_penjualan.')">Delete</a>
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