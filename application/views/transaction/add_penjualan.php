<?php $this->load->view('data/head'); ?>
	<div class="main-panel">
        <div class="content-wrapper">
        	<div class="row">
        		<div class="col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
        			<div class="card card-statistics">
                        <div class="card-body">
                            <h2><?= $title;?></h2>
                                <hr>
                                	<div class="row">
	                                	<div class="col-md-6 col-sm-12">
	                                		
	                                	</div>
	                                	<div class="col-md-6 col-sm-12">
	                                		<a href="<?= base_url();?>admin/add_produk" class="btn btn-info float-right"><i class="mdi mdi-printer"></i> Print</a>
	                                	</div>
                                	</div>
                                <hr>
                            <div class="row">
                            	<div class="col-md-8 verticalLine">
		                            <div class="form-group">
		                            	<div class="input-group mb-3">
										  <div class="input-group-prepend">
										    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-file-find"></i></span>
										  </div>
										  <input type="text" class="form-control" placeholder="Search produk ..." aria-label="Search" aria-describedby="basic-addon1">
										</div>
		                            </div>
                                    <hr>
                                    <table class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Size</th>
                                                <th>Jenis</th>
                                                <th>Harga Produk</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pesanan">
                                            <tr>
                                                <td>Kode Produk</td>
                                                <td>Nama Produk</td>
                                                <td>Size</td>
                                                <td>Jenis</td>
                                                <td>Harga Produk</td>
                                                <td>Qty</td>
                                                <td>Subtotal</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            	</div>
                            	<div class="col-md-4">
                                    <div class="form-group">
                                        <h3>Data Pembeli</h3>
                                    </div>
                            		<div class="form-group">
                                        <label>Nama Pembeli</label>
                                        <input type="text" name="nama_pembeli" class="form-control" placeholder="Nama Pembeli">
                                    </div>
                                    <div class="form-group">
                                        <label>No.Telepon</label>
                                        <input type="text" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="alamat_pembeli" placeholder="Alamat Lengkap"></textarea>
                                    </div>
                            	</div>
                            </div>
                        </div>
                    </div>
        		</div>
        	</div>
        </div>
<?php $this->load->view('data/foot'); ?>