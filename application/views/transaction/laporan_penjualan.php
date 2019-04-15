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
                                        <div class="col-md-8 col-sm-8">
                                           <div class="tgl">
                                                <form class="form-inline">
                                                    <div class="form-group">
                                                        <label>Dari Tanggal : </label>
                                                        <input type="text" name="from_date" id="from_date" class="form-control input-sm datepicker">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>s/d.</label>
                                                        <input type="text" name="to_date" id="to_date" class="form-control input-sm datepicker">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" id="btn-search" class="btn btn-primary btn-sm ml-3">Cari</button>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" id="btn-refresh" class="btn btn-warning btn-sm ml-3"><i class="mdi mdi-sync"></i></button>
                                                    </div>
                                                </form> 
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <a href="#" class="btn btn-info float-right" id="btnPrint"><i class="mdi mdi-printer"></i> Print</a>
                                        </div>
                                    </div>
                                <hr>
                                <!-- Laporan -->
                                <div class="row" id="printTable">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="scroll-laporan" id="detail_laporan" style="border: none">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('data/foot'); ?>