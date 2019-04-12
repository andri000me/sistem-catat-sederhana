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
                                            <a href="javascript:void(0);" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="mdi mdi-plus-box"></i> Add Kategori Produk</a>
                                        </div>
                                        <!-- <div class="col-md-6 col-sm-12">
                                            <a href="<?= base_url();?>admin/produk" class="btn btn-info float-right"><i class="mdi mdi-printer"></i> Print</a>
                                        </div> -->
                                    </div>
                                <hr>
                                 <div class="form-group">
                                    <div class="alert alert-success" id="berhasil_dlt"><i class="mdi mdi-check-circle"></i> <span id="text_berhasil_dlt"></span></div>
                                    <div class="alert alert-danger" id="gagal_dlt"><i class="mdi mdi-close-circle"></i> <span id="text_gagal_dlt"></span></div>
                                </div>
                            <table id="tableData" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama Kategori Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="data_kategori_produk">
                                    <?php
                                        foreach ($kategori as $data) {
                                            echo '<tr>
                                                 <td>'.$data->nama_kategori_produk.'</td>
                                                 <td>
                                                    <div class="row">
                                                     <div class="col-md-3 col-sm-3">
                                                          <div class="dropdown show">
                                                              <a class="btn btn-primary btn-sm dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</a>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#myModalEdit" onclick="get_kategori('.$data->id_kategori_produk.');">Edit Kategori</a>
                                                                <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="delete_kategori('.$data->id_kategori_produk.');">Delete</a>
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

        <!-- Modal Tambah Kategori -->
        <form method="post">
            <div class="modal fade" id="myModal">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Add Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="form-group">
                        <div class="alert alert-success" id="berhasil"><i class="mdi mdi-check-circle"></i> <span id="text_berhasil"></span></div>
                        <div class="alert alert-danger" id="gagal"><i class="mdi mdi-close-circle"></i> <span id="text_gagal"></span></div>
                    </div>
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama_kategori_produk" id="nama_kategori_produk" class="form-control" placeholder="Nama Kategori">
                    </div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <input type="submit" name="submit" id="btnSimpanKategori" class="btn btn-success btn-block" value="Simpan Kategori Produk">
                  </div>

                </div>
              </div>
            </div>
        </form>

        <!-- Modal Edit Kategori -->
        <form method="post">
            <div class="modal fade" id="myModalEdit">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Add Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="form-group">
                        <div class="alert alert-success" id="berhasil_edit"><i class="mdi mdi-check-circle"></i> <span id="text_berhasil_edit"></span></div>
                        <div class="alert alert-danger" id="gagal_edit"><i class="mdi mdi-close-circle"></i> <span id="text_gagal_edit"></span></div>
                    </div>
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="edit_nama_kategori_produk" id="edit_nama_kategori_produk" class="form-control" placeholder="Nama Kategori">
                        <input type="hidden" name="id_edit_kategori_produk" id="id_edit_kategori_produk">
                    </div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <input type="submit" name="submit" id="btnEditKategori" class="btn btn-success btn-block" value="Simpan Kategori Produk">
                  </div>

                </div>
              </div>
            </div>
        </form>
<?php $this->load->view('data/foot'); ?>