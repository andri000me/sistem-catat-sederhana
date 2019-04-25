<?php $this->load->view('data/head');?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Penjualan</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?= $count_penjualan;?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Total Sales
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Produk Terjual</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?= $count_produk_terjual;?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> All Product sales
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-location text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Team</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?= $count_user;?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Team Basic
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-7 grid-margin stretch-card">
              <!--weather card-->
              <div class="card card-weather">
                <div class="card-body">
                  <div class="weather-date-location">
                    <h3 id="day"></h3>
                    <p class="text-gray">
                      <span class="weather-date" id="date"></span>
                      <span class="weather-location"><span id="city"></span>, <span id="country"></span></span>
                    </p>
                  </div>
                  <div class="weather-data d-flex">
                    <div class="mr-auto">
                      <h4 class="display-3"><span id="temp"></span>
                        <span class="symbol">&deg;</span>C</h4>
                      <p id="weather_condition">
                        
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!--weather card ends-->
            </div>
            <div class="col-lg-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title text-primary mb-5">Omset</h2>
                  <div class="wrapper d-flex justify-content-between">
                    <div class="side-left">
                      <p class="mb-2">Omset Penjualan</p>
                      <p class="display-3 mb-4 font-weight-light"><?= 'Rp '.number_format($sum_omset);?></p>
                    </div>
                    <div class="side-right">
                      <small class="text-muted">All Time</small>
                    </div>
                  </div>
                  <div class="wrapper d-flex justify-content-between">
                    <div class="side-left">
                      <p class="mb-2">Profit Bersih</p>
                      <p class="display-3 mb-4 font-weight-light"><?= 'Rp '.number_format($sum_profit);?></p>
                    </div>
                    <div class="side-right">
                      <small class="text-muted">All Time</small>
                    </div>
                  </div>
                  <!-- <div class="wrapper d-flex justify-content-between">
                    <div class="side-left">
                      <p class="mb-2">Worst performance</p>
                      <p class="display-3 mb-5 font-weight-light">-35.3%</p>
                    </div>
                    <div class="side-right">
                      <small class="text-muted">2015</small>
                    </div>
                  </div> -->
                  <!-- <div class="wrapper">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Sales</p>
                      <p class="mb-2 text-primary">88%</p>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 88%" aria-valuenow="88"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div> -->
                  <div class="wrapper mt-4">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Visits</p>
                      <p class="mb-2 text-success">56%</p>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 56%" aria-valuenow="56"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
                  <div class="card card-statistics">
                      <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <h2>Data Statistik Penjualan</h2>
                                </div>
                            </div>
                        <hr>
                        <?php
                            foreach ($stats as $data) {
                              $jumlah[] = $data->m;
                              $nama[] = date('F Y',strtotime($data->d));
                            }
                          ?>
                        <canvas id="canvasjual" width="1000" height="280"></canvas>
                          <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
                          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                          <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                          <script src="<?php echo base_url();?>assets/js/Chart.min.js"></script>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                  var ctx = document.getElementById("canvasjual").getContext("2d");

                                  var myChart = new Chart(ctx, {
                                      type: 'bar',
                                        data: {
                                        labels: <?php echo json_encode($nama);?>,
                                        datasets: [{
                                                    label: 'Data Statistik Penjualan /bulan',
                                                    data: <?php echo json_encode($jumlah);?>,
                                                    backgroundColor : "lightblue",
                                                    borderColor : "lightblue",
                                                    fill : false,
                                                    lineTension : 0,
                                                    pointRadius : 5
                                                  }]
                                                },
                                      options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                        }
                                                      }]
                                                  }
                                               }
                                          });
                                    });
                          </script>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
<?php $this->load->view('data/foot');?>