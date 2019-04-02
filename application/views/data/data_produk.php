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
                                            <a href="<?= base_url();?>admin/produk" class="btn btn-success"><i class="mdi mdi-plus-box"></i> Add Produk</a>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <a href="<?= base_url();?>admin/produk" class="btn btn-info float-right"><i class="mdi mdi-printer"></i> Print</a>
                                        </div>
                                    </div>
                                <hr>
                                    <div class="form-group">
                                        <div class="alert alert-success" id="berhasil"><i class="mdi mdi-check-circle"></i> <span id="text_berhasil"></span></div>
                                    <div class="alert alert-danger" id="gagal"><i class="mdi mdi-close-circle"></i> <span id="text_gagal"></span></div>
                                </div>
                            <table id="tableData" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga Produksi</th>
                                        <th>Harga Jual</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($produk as $data) {
                                        echo'
                                        <tr>
                                            <td>'.$data->kode_produk.'</td>
                                            <td>'.$data->nama_produk.'</td>
                                            <td>'.$data->nama_kategori_produk.'</td>
                                            <td>Rp '.number_format($data->harga_produksi).'</td>
                                            <td>Rp '.number_format($data->harga_jual).'</td>
                                            <td>'.$data->stok.'</td>
                                            <td>
                                            <div class="row">
                                                <div class="col-md-3 col-sm-3">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Aksi
                                                    <span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="'.base_url().'admin/tambah_foto_produk/'.$data->id_produk.'">Tambah Foto Produk</a></li>
                                                            <li><a href="#">Detail Produk</a></li>
                                                            <li><a href="#">Edit Produk</a></li>
                                                            <li><a href="#" onclick="delete_produk('.$data->id_produk.')">Delete</a></li>
                                                        </ul>
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
        <!-- <div class="row mt-1">
                                                    <div class="col-md-3 col-sm-3">
                                                        <a href="'.base_url().'admin/tambah_foto_produk/'.$data->id_produk.'"class="btn btn-success btn-sm text-white"><i class="mdi mdi-pencil-box"></i> Tambah Foto Produk</a>
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-3 col-sm-3">
                                                        <a class="btn btn-primary btn-sm text-white"><i class="mdi mdi-check-circle"></i> Detail Produk</a>
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-3 col-sm-3">
                                                        <a class="btn btn-warning btn-sm"><i class="mdi mdi-pencil-box"></i> Edit Produk</a>
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-3 col-sm-3">
                                                    <a class="btn btn-danger btn-sm text-white" onclick="delete_produk('.$data->id_produk.')"><i class="mdi mdi-delete"></i> Delete</a>
                                                    </div>
                                                </div> -->
<?php $this->load->view('data/foot'); ?>