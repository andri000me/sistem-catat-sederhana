<?php $this->load->view('data/head'); ?>
	<div class="main-panel">
        <div class="content-wrapper">
        	<div class="row">
        		<div class="col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
        			<div class="card card-statistics">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <h2><?= $title;?></h2>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <a href="<?php echo base_url();?>admin/data_penjualan" class="btn btn-danger text-white float-right"><i class="mdi mdi-arrow-left-bold-circle"></i> Kembali</a>
                                    </div>
                                </div>
                            <hr>
                        <form method="post">
                            <div class="row">
                            	<div class="col-md-9 col-sm-9 verticalLine">
		                            <div class="form-group">
		                            	<div class="form-group has-feedback has-search">
                                        <!-- <span class="mdi mdi-file-find form-control-feedback"></span> -->
                                          <input name="search_data" class="form-control" id="search_data" placeholder="Search / Scan Produk" type="text" onkeyup="scan_data();">
                                                <div id="suggestions">
                                                    <div id="autoSuggestionsList">
                                                    </div>
                                                </div>
                                            </div>
    		                            </div>
                                    <hr>
                                <div class="scroll-transaction">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>Kode Produk</th>
                                                    <th>Nama Produk</th>
                                                    <th>Harga Produk</th>
                                                    <th>Quantity</th>
                                                    <th>Size /item</th>
                                                    <th>Subtotal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="pesanan">
                                    
                                            </tbody>
                                         </table>
                                    </div>
                                </div>  
                            </div>
                            	<div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <h4>Data Pembeli <span class="text-danger"> *required</span></h4>
                                    </div>
                            		<div class="form-group">
                                        <label>Nama Pembeli</label>
                                        <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" placeholder="Nama Pembeli">
                                    </div>
                                    <div class="form-group">
                                        <label>No.Telepon</label>
                                        <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control" placeholder="Nomor Telepon">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="alamat_pembeli" id="alamat_pembeli" placeholder="Alamat Lengkap"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Kota/Kabupaten</label>
                                        <select name="kota_tujuan" class="form-control" id="kota_tujuan">
                                            <option value=""> - Kota / Kabupaten -</option>
                                            <?php
                                                foreach ($city['rajaongkir']['results'] as $data) {
                                                    echo '<option value="'.$data['city_id'].'">'.$data['type'].' '.$data['city_name'].'</div>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <h4>Admin</h4>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nama_user" class="form-control" value="<?= $this->session->userdata('nama_user');?>" readonly>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <h4>TOTAL</h4>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="total" class="form-control" placeholder="Total" id="total">
                                    </div>
                            	</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                   <div class="form-group">
                                       <input type="submit" name="submit" value="Simpan Pesanan" id="btnSimpanPesanan" class="btn btn-success btn-block btn-lg mt-3"> 
                                   </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        	</div>
        </div>
    </div>
<?php $this->load->view('data/foot'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/transaksi.js"></script>