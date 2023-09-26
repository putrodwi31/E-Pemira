      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1><?= $title ?></h1>
              </div>
              <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                      <div class="card">
                          <div class="card-header">
                              <h4>Upload DPT</h4>
                              <button class="btn btn-primary" data-toggle="modal" data-target="#tautanModal">Tambah DPT</button>
                          </div>
                          <div class="card-body">
                              <form action="<?= base_url('admin/tambah_dpt'); ?>" method="post" enctype="multipart/form-data">
                                  <div class="form-group" style="margin-top: -30px;">
                                      <br>
                                      <label><b>Format File .XLSX</b></label>
                                      <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="customFile" name="file_dpt">
                                          <label class="custom-file-label" for="customFile">Pilih File</label>
                                      </div>
                                  </div>
                                  <br>
                                  <div class="form-group" style="margin-top: -30px;">
                                      <input type="submit" name="upload" class="btn btn-success" value="Upload">
                                  </div>
                                  <br>
                              </form>
                              <div class="card-header" style="margin-left: -20px;">
                                  <h4>DPT Belum Memilih</h4>
                              </div>
                              <div>
                                  <form method="post" action="<?= base_url('admin/dpt'); ?>" class="form-inline">
                                      <label class="sr-only" for="inlineFormInputName2">Cari</label>
                                      <input type="text" class="form-control mb-2 mr-sm-2" name="q" placeholder="Cari..." required>
                                      <select name="column" class="form-control mb-2 mr-sm-2" required>
                                          <option value="nim">NIM</option>
                                          <option value="nama_mhs">NAMA</option>
                                      </select>
                                      <input class="btn btn-primary mb-2 mr-sm-2" type="submit" name="submit" value="Cari">
                                  </form>
                                  <div class="table-responsive">
                                      <table class="table table-striped table-bordered table-hover" id="table-1">
                                          <thead>
                                              <tr>
                                                  <th>Nim</th>
                                                  <th>Nama</th>
                                                  <th>Status</th>
                                                  <th>Email</th>
                                                  <th>Opsi</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php
                                                foreach ($dptn as $dn) {
                                                ?>
                                                  <tr>
                                                      <td><?php echo $dn['nim']; ?></td>
                                                      <td style="text-transform: capitalize;"><?php echo $dn['nama_mhs']; ?></td>
                                                      <td><span class="badge badge-warning"><b><?php echo $dn['status']; ?></b></span></td>
                                                      <td><?php echo $dn['email']; ?></td>
                                                      <td><a class="btn btn-danger btn-circle text-white" id="hapusPaslon<?= $dn['nim']; ?>" onclick="getDel(<?= $dn['nim']; ?>)" data-link="<?= base_url() . 'admin/hapus_dpt/' . $dn['nim']; ?>" data-ntipe='DPT dengan NIM'>Hapus</a>
                                                      </td>
                                                  </tr>
                                              <?php } ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                      <div class="card">
                          <div class="card-header">
                              <h4>DPT Sudah Memilih</h4>
                          </div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-hover" id="table-2">
                                      <thead>
                                          <tr>
                                              <th>Nim</th>
                                              <th>Nama</th>
                                              <th>Status</th>
                                              <th>Waktu</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php foreach ($dpt as $d) { ?>
                                              <tr>
                                                  <td><?php echo $d['nim']; ?></td>
                                                  <td><?php echo $d['nama_mhs']; ?></td>
                                                  <td><span class="badge badge-success"><b><?php echo $d['status']; ?></b></span></td>
                                                  <td><?php echo $d['waktu']; ?></td>

                                              </tr>
                                          <?php } ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
      <div class="modal fade" id="tautanModal" tabindex="-1" aria-labelledby="tautanModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="tautanModalLabel">Tambah DPT</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" action="<?= base_url('admin/tambah_tdpt'); ?>" class="needs-validation" novalidate="">
                          <?= $this->session->flashdata('message'); ?>
                          <div class="form-group">
                              <label for="nama">Nama<span style="color: red!important;">*</span></label>
                              <input id="nama" type="text" class="form-control" name="nama" tabindex="1" required autofocus value="<?= set_value('nama'); ?>">
                              <div class="invalid-feedback">
                                  Silahkan masukan nama dpt anda
                              </div>
                          </div>
                          <div class="form-group mt-n4">
                              <label for="nim">NIM<span style="color: red!important;">*</span></label>
                              <input id="nim" type="number" class="form-control" name="nim" tabindex="1" required autofocus value="<?= set_value('nim'); ?>">
                              <div class="invalid-feedback">
                                  Silahkan masukan nim dpt anda
                              </div>
                          </div>
                          <div class="form-group mt-n4">
                              <label for="email">Email<span style="color: red!important;">*</span></label>
                              <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus value="<?= set_value('email'); ?>">
                              <div class="invalid-feedback">
                                  Silahkan masukan email dpt anda
                              </div>
                          </div>
                  </div>
                  <div class="modal-footer" style="margin-top: -20px;">
                      <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-link"></i> Tambah DPT</button>
                  </div>
                  </form>
              </div>
          </div>
      </div>