<?php $this->load->view('head'); ?>
	<div class="main-panel">
        <div class="content-wrapper">
        	<div class="row">
        		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
        			<div class="card card-statistics">
        				<div class="card-body">
        					<h2><?= $title;?></h2>
        					<hr>
        					<a href="<?= base_url();?>admin/add_produk"><i class="mdi mdi-plus-box"></i> Add Produk</a>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
<?php $this->load->view('foot'); ?>