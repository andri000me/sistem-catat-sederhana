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
                            	<div class="col-md-9 col-sm-9 verticalLine">
		                            <div class="form-group">
		                            	<div class="input-group mb-3">
										  <div class="input-group-prepend">
										    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-file-find"></i></span>
										  </div>
										  <input type="text" class="form-control" placeholder="Search produk ..." aria-label="Search" aria-describedby="basic-addon1">
										</div>
		                            </div>
                                    <hr>
                                <div class="scroll-transaction">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Kode Produk</th>
                                                    <th>Nama Produk</th>
                                                    <th>Harga Produk</th>
                                                    <th>Quantity</th>
                                                    <th>Size bisa > 1</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody id="pesanan">
                                                <?php

                                                for ($i=0; $i<10 ; $i++){ 
                                                   echo '<tr>
                                                    <td><input type="text" name="" class="form-control input-sm" placeholder="dummy"></td>
                                                    <td><input type="text" name="" class="form-control input-sm" placeholder="dummy"></td>
                                                    <td><input type="text" name="" class="form-control input-sm" placeholder="dummy"></td>
                                                    <td><input type="text" name="" class="form-control input-sm" placeholder="dummy"></td>
                                                    <td><input type="text" name="" class="form-control input-sm" placeholder="dummy"></td>
                                                    <td><input type="text" name="" class="form-control input-sm" placeholder="dummy"></td>
                                                </tr>';
                                                }
                                                
                                                ?>
                                            </tbody>
                                         </table>
                                    </div>
                                </div>  
                            </div>
                            	<div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <h4>Data Pembeli</h4>
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
                                    <hr>
                                    <div class="form-group">
                                        <h4>Admin</h4>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user');?>">
                                        <input type="text" name="nama_user" class="form-control" value="<?= $this->session->userdata('nama_user');?>" readonly>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <h4>TOTAL</h4>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="total" class="form-control" placeholder="Total">
                                    </div>
                            	</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                   <div class="form-group">
                                       <input type="submit" name="submit" value="Simpan Pesanan" class="btn btn-success btn-block mt-3"> 
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
        		</div>
        	</div>
        </div>
<?php $this->load->view('data/foot'); ?>