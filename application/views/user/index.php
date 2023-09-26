      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-body">
                  <?php if ($user['status'] != 'Sudah Memilih') { ?>
                      <div class="card">
                          <div class="card-body" style="background-color : #47c363">
                              <br>
                              <br>
                              <h4 class="m-0 font-weight-bold text-center" style="color : white;">SURAT SUARA</h4>
                              <h4 class="m-0 font-weight-bold text-center" style="color : white;">PEMILIHAN RAYA</h4>
                          </div>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                              <path fill="#47c363" fill-opacity="1" d="M0,96L60,106.7C120,117,240,139,360,138.7C480,139,600,117,720,106.7C840,96,960,96,1080,85.3C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
                          </svg>
                          <div class="card-body" style="margin-top: -4rem;">
                              <h4 class="m-0 font-weight-bold text-center" style="color : dark;">DEBAT PASLON PRESIDEN DAN WAKIL PRESIDEN MAHASISWA</h4>
                              <h4 class="mb-3 font-weight-bold text-center" style="color : dark;">UNIVERSITAS BINA INSANI 2023/2024</h4>
                          </div>
                          <div class="card-body">
                              <!-- <div class="videowrapper" style="float: none; clear: both; width: 100%; position: relative; padding-bottom: 56.25%; padding-top: 25px; height: 0;">
                                  <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" width="660" height="371" class="video_bem" src="https://www.youtube.com/embed/lcT6spQSDr0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div> -->
                          </div>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                              <path fill="#47c363" fill-opacity="1" d="M0,288L60,272C120,256,240,224,360,224C480,224,600,256,720,266.7C840,277,960,267,1080,250.7C1200,235,1320,213,1380,202.7L1440,192L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
                          </svg>
                          <div class="card-body" style="background-color: #47c363;">
                              <h4 class="m-0 font-weight-bold text-center" style="color: white;">CALON PRESIDEN DAN WAKIL PRESIDEN MAHASISWA</h4>
                              <h4 class="m-0 font-weight-bold text-center" style="color: white;">UNIVERSITAS BINA INSANI 2023/2024</h4>
                              <div class="text-center">
                                  <br>
                                  <br>
                                  <br>
                                  <br>
                              </div>
                          </div>
                          <div class="card-body">
                              <form action=" <?= base_url('admin'); ?>" method="post">
                                  <div class="row">
                                      <?php foreach ($paslon as $d) { ?>
                                          <div class="col-sm-12 col-md-6 table-responsive-sm">
                                              <table class="table">
                                                  <tr>
                                                      <td colspan="2" style="background-color: #fffff; color: black; font-size: 50px; text-align: center;"><b><?php echo $d['no_urut']; ?></b></td>
                                                  </tr>
                                                  <tr>
                                                      <td><img class="img-fluid" style="text-align: center; max-width: 90%; height: auto;" src="<?= base_url('assets/foto/') . $d['gambar1']; ?>"></td>
                                                      <td><img class="img-fluid" style="text-align: center; max-width: 90%; height: auto;" src="<?= base_url('assets/foto/') . $d['gambar2']; ?>"></td>
                                                  </tr>
                                                  <tr>
                                                      <td align="center">
                                                          <h5><?php echo $d['nm_paslon_ketua']; ?></h5>
                                                      </td>
                                                      <td align="center">
                                                          <h5><?php echo $d['nm_paslon_wakil']; ?></h5>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td colspan="2" style="text-align: center;">
                                                          <button type="button" class="userinfo btn btn-primary <?= $d['no_urut'] != '1' ? 'trigger--fire-modal-1' : ''; ?>" data-id='<?php echo $d['id']; ?>' data-toggle="modal" data-target="#visimisiModal">Lihat Visi & Misi</button>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td colspan="3" style="text-align: center; padding: 20px; background-color: white;">
                                                          <input type="radio" class="form-check-input" required name="nomor_paslon" value="<?php echo $d['no_urut']; ?>" style="height:30px; width:30px; vertical-align: middle;">
                                                      </td>
                                                  </tr>
                                              </table>
                                          </div>
                                      <?php } ?>
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-12">
                                          <a style="width: 100%;" class="btn btn-lg btn-success text-white" data-toggle="modal" data-target="#voteModal">Vote</a>
                                      </div>
                                  </div>
                          </div>
                      </div>
                  <?php } else { ?>
                      <div class="card">
                          <div class="card-body" style="background-color : #47c363">
                              <br>
                              <br>
                              <h4 class="m-0 font-weight-bold text-center" style="color : white;">TERIMA KASIH</h4>
                              <h4 class="m-0 font-weight-bold text-center" style="color : white;">SUDAH MENGGUNAKAN HAK PILIH ANDA</h4>
                          </div>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                              <path fill="#47c363" fill-opacity="1" d="M0,96L60,106.7C120,117,240,139,360,138.7C480,139,600,117,720,106.7C840,96,960,96,1080,85.3C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
                          </svg>
                      </div>
                  <?php } ?>
          </section>
      </div>
      <div class="modal fade" id="voteModal" tabindex="-1" aria-labelledby="voteModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="voteModalLabel">Peringatan!</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p style="font-size: medium;">Apakah anda yakin dengan pilihan anda?</p>
                  </div>
                  <div class="modal-footer" style="margin-top: -20px;">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-success">Vote</button>
                  </div>
              </div>
          </div>
      </div>
      <!-- View Modal -->
      <div class="modal fade" id="visimisiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">VISI DAN MISI</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body visi-misi-mod">
                      <h4 class="id_view"></h4>
                      <h4 class="fname_view"></h4>
                      <h4 class="lname_view"></h4>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  </div>
              </div>
          </div>
      </div>
      </form>