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
	                                		<!-- <a href="<?= base_url();?>admin/add_produk" class="btn btn-success"><i class="mdi mdi-plus-box"></i> Add Produk</a> -->
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
										    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-mdi-file-find"></i></span>
										  </div>
										  <input type="text" class="form-control" placeholder="Search produk ..." aria-label="Search" aria-describedby="basic-addon1">
										</div>
		                            </div>
                            	</div>
                            	<div class="col-md-3">
                            		<h3>AAA</h3>
                            	</div>
                            </div>
                        </div>
                    </div>
        		</div>
        	</div>
        </div>
<?php $this->load->view('data/foot'); ?>