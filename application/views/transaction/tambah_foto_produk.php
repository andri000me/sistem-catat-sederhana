<?php $this->load->view('data/head');?>
	<div class="main-panel">
        <div class="content-wrapper">
        	<div class="row">
        		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
        			<div class="card card-statistics">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <h4><?php 
	                                    	$id = $this->uri->segment(3);
	                                    	$query = $this->db->query('SELECT * FROM ct_produk WHERE id_produk='.$id)->row();
	                                    	echo $title.' '.$query->nama_produk;
                                    	?>	
                                    </h4>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a href="<?= base_url();?>produk" class="btn btn-danger text-white float-right"><i class="mdi mdi-arrow-left-bold-circle"></i> Kembali</a>
                                </div>
                            </div>
                        <hr>
	                        <div class="row">
	                        	<div class="col-md-12 col-sm-12">
	                        		<?php
	                        			$berhasil = $this->session->flashdata('berhasil');

	                        			if(!empty($berhasil)){
	                        				echo '<div class="alert alert-success" id="berhasil_php"><i class="mdi mdi-check-circle"></i>'.$berhasil.'</div>';
	                        			} 
	                        		?>
	                        		<div class="form-group">
                                        <div class="alert alert-success" id="berhasil"><i class="mdi mdi-check-circle"></i><span id="text_berhasil"></span></div>
                                        <div class="alert alert-danger" id="gagal"><i class="mdi mdi-close-circle"></i> <span id="text_gagal"></span></div>
                                	</div>
	                        		<form method="post" action="<?= base_url();?>admin/img_upload/<?= $this->uri->segment(3);?>" enctype="multipart/form-data">
	                        			<div class="form-group">
	                        				<label>Upload File : <span class="text-danger">*Dapat lebih dari 1 foto</span></label>
	                        				<input type="file" name="img_produk[]" multiple="" class="form-control" id="img_produk" required="">
	                        			</div>
										<div class="form-group">
											<input type="submit" name="submit" class="btn btn-success" onclick="return confirm('Are you sure?');" value="Tambahkan Gambar">
										</div>
									</form>
	                        	</div>
	                        </div>
	                    <hr>
	                        <div class="row">
	                        	<div class="col-md-12 col-sm-12">
	                        		<h4>Foto Produk</h4>
	                        		<div class="row">
	                        			<?php
	                        			if(!empty($cek_foto)){
	                        				foreach ($cek_foto as $data) {
	                        					echo'<div class="col-md-4 col-sm-4 img-border">
	                        							<img src="'.base_url().'uploads/'.$data->img_produk.'" style="width:100px;height:100px">
	                        							<a href="javascript:void(0);" id="btnDeleteFoto" onclick="delete_foto_produk('.$data->id_detail_produk.')" class="btn btn-danger float-right"><i class="mdi mdi-delete"></i></a>
	                        						</div>';
	                        				}
	                        			}else{
	                        				echo '<div class="col-md-12 col-sm-12">
	                        						<label><span class="text-danger">*Produk ini belum memiliki foto</span></label>
	                        					</div>';
	                        			}
	                        			
	                        			?>
	                        		</div>
	                        	</div>
	                        </div>
                        </div>
                   	</div>
                </div>
            </div>
        </div>
<?php $this->load->view('data/foot'); ?>
