<?php $this->load->view('data/head'); ?>
	<div class="main-panel">
        <div class="content-wrapper">
        	<div class="row">
        		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
        			<div class="card card-statistics">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <h2><?= $title;?></h2>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a href="<?= base_url();?>produk" class="btn btn-danger text-white float-right"><i class="mdi mdi-arrow-left-bold-circle"></i> Kembali</a>
                                </div>
                            </div>
                        <hr>
                            <form method="post" action="<?= base_url();?>transaction/edit_produk/<?= $this->uri->segment(3);?>" enctype="multipart/form-data">
                                <div class="row">
                                	<div class="col-md-8 verticalLine">
                                        <?php
                                            $berhasil = $this->session->flashdata('berhasil');
                                            $gagal = $this->session->flashdata('gagal');
                                            if(!empty($berhasil)){
                                                echo '<div class="alert alert-success"><i class="mdi mdi-check-circle"></i> '.$berhasil.'</div>';
                                            }

                                            if(!empty($gagal)){
                                                echo '<div class="alert alert-danger"><i class="mdi mdi-close-circle"></i> '.$gagal.'</div>';
                                            }
                                        ?>
                                        <div class="form-group">
                                          <label>Nama Produk</label>
                                          <input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Nama Produk" value="<?= $detail->nama_produk;?>">
                                          <input type="hidden" name="kode_produk" id="kode_produk" value="<?= $detail->kode_produk;?>">
                                        </div>
                                        <div class="form-group">
                                          <label>Kategori Produk</label>
                                          <select name="id_kategori_produk" class="form-control">
                                              <option value="<?= $detail->id_kategori_produk;?>"> <?= $detail->nama_kategori_produk;?></option>
                                              <?php
                                                foreach ($kategori as $data) {
                                                    echo '<option value="'.$data->id_kategori_produk.'">'.$data->nama_kategori_produk.'</option>';
                                                }
                                              ?>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label>Size Produk<span class="text-danger"> *pisahkan dengan (,) koma</span></label>
                                          <input type="text" name="size_produk" class="form-control" placeholder="Size" value="<?= $detail->size_produk;?>">
                                        </div>
                                        <div class="form-group">
                                          <label>Harga Produksi  <span class="text-danger"> *optional</span></label>
                                          <input type="text" name="harga_produksi" class="form-control" placeholder="Harga Produksi" value="<?= $detail->harga_produksi;?>">
                                        </div>
                                        <div class="form-group">
                                          <label>Harga Jual</label>
                                          <input type="text" name="harga_jual" class="form-control" placeholder="Harga Jual" value="<?= $detail->harga_jual;?>">
                                        </div>
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-1">
                                              <label>Warna</label>
                                            </div>
                                            <div class="col-md-4">
                                              <div style="height: 10px;width: 10px;background-color: black;border: 1px solid black" id="color_show"></div>
                                            </div>
                                          </div>
                                          <select name="warna" class="form-control" id="warna">
                                            <option value="<?= $detail->warna;?>"> <?= $detail->warna;?></option>
                                            <option value="Black">Black</option>
                                            <option value="White">White</option>
                                            <option value="Navy">Navy</option>
                                            <option value="Red">Red</option>
                                            <option value="Maroon">Maroon</option>
                                            <option value="Forest Green">Green Forest</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label>Stok</label>
                                          <input type="text" name="stok" class="form-control" placeholder="Stok" value="<?= $detail->stok;?>">
                                        </div>
                                	</div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Admin input</label>
                                            <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user');?>">
                                            <input type="text" name="nama_user" class="form-control" value="<?= $this->session->userdata('nama_user');?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                          <input type="submit" name="submit" value="Simpan produk" onclick="return confirm('Are you sure?');" class="btn btn-success btn-block mt-3">
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