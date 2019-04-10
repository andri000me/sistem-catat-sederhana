<title><?= $title;?></title>
<style type="text/css">
    #total tr td{
        font-size: 20px;
    }
</style>
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
                                </div>
                            <hr>
                                <h4>Data Pembeli</h4>
                                    <table width="100%"> 
                                        <tr>
                                            <td>Nama Pembeli</td>
                                            <td>:</td>
                                            <td><?= $detail->nama_pembeli;?></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Telepon</td>
                                            <td>:</td>
                                            <td><?= $detail->nomor_telepon;?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td><?= $detail->alamat_pembeli;?></td>
                                        </tr>
                                    </table>
                                <hr>
                            <div class="row">
                            	<div class="col-md-9 col-sm-9 verticalLine">
                                    <h4>Produk</h4>
                                        <table border="1" style="border-collapse: collapse;" width="100%">
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
                                                    foreach ($detail_produk as $data) {
                                                        echo '<tr>
                                                        <td>'.$data->kode_produk.'</td>
                                                        <td>'.$data->nama_produk.'</td>
                                                        <td>Rp '.number_format($data->harga_produk).'</td>
                                                        <td>'.$data->quantity.'</td>
                                                        <td>'.$data->size.'</td>
                                                        <td>'.$data->subtotal.'</td>
                                                      </tr>';
                                                    }
                                                ?>
                                            </tbody>
                                         </table>
                                    </div>
                                </div>
                            <br>
                        <hr>
                            <div style="float: right;margin-top: 20px;">
                                <table width="50%" id="total">
                                       <tr>
                                            <td style="text-align: right;">Ongkos Kirim</td>
                                            <td>:</td>
                                            <td>Rp <?= number_format($detail->ongkos_kirim);?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;"><b>TOTAL</b></td>
                                            <td>:</td>
                                            <td>Rp <?= number_format($detail->total);?></td>
                                        </tr>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                	</div>
                </div>
            </div>