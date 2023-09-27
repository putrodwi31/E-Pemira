      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1><?= $title ?></h1>
              </div>
              <div class="row">
                  <div class="col">
                      <div class="card">
                          <div class="card-header">
                              <h4>Ubah DPT - <?= $dpt['nama_mhs'] ?></h4>
                          </div>
                          <div class="card-body">
                              <form method="POST" action="" class="needs-validation" novalidate="">
                                  <?= $this->session->flashdata('message'); ?>
                                  <div class="form-group">
                                      <label for="nama">Nama<span style="color: red!important;">*</span></label>
                                      <input id="nama" type="text" class="form-control" name="nama" tabindex="1" required autofocus value="<?= $dpt['nama_mhs']; ?>">
                                      <div class="invalid-feedback">
                                          Silahkan masukan nama dpt anda
                                      </div>
                                  </div>
                                  <div class="form-group mt-n4">
                                      <label for="nim">NIM<span style="color: red!important;">*</span></label>
                                      <input id="nim" type="number" class="form-control" name="nim" tabindex="1" required autofocus value="<?= $dpt['nim']; ?>" readonly>
                                      <div class="invalid-feedback">
                                          Silahkan masukan nim dpt anda
                                      </div>
                                  </div>
                                  <div class="form-group mt-n4">
                                      <label for="email">Email<span style="color: red!important;">*</span></label>
                                      <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus value="<?= $dpt['email']; ?>">
                                      <div class="invalid-feedback">
                                          Silahkan masukan email dpt anda
                                      </div>
                                  </div>
                                  <a href="javascript:history.back()" class="btn btn-danger">Kembali</a>
                                  <button type="submit" class="btn btn-primary"><i class="fas fa-link"></i> Ubah DPT</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>