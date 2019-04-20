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
                                    <a href="<?= base_url();?>admin/data_produk" class="btn btn-danger text-white float-right"><i class="mdi mdi-arrow-left-bold-circle"></i> Kembali</a>
                                </div>
                            </div>
                        <hr>
                        <!-- Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('data/foot'); ?>