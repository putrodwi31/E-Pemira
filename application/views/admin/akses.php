      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1><?= $title ?></h1>
              </div>
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                              <h4>Buat Akses User</h4>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-lg-6">
                                      <form action="<?= base_url('admin/akses'); ?>" method="post">
                                          <div class="form-group">
                                              <label>NIM</label>
                                              <input type="text" name="nim" required="required" placeholder="Masukan NIM..." class="form-control" autocomplete="off" maxlength="10">
                                          </div>
                                          <br>
                                          <div class="form-group" style="margin-top: -30px;">
                                              <input type="submit" class="btn btn-primary" name="akses" value="Filter" class="form-control">
                                          </div>
                                          <br>
                                      </form>

                                      <form action="<?= base_url('admin/buat_akses'); ?>" method="post">
                                          <div class="form-group" style="margin-top: -10px;">
                                              <input type="text" style="background-color: yellow; font-weight: bold; font-size:large" name="nim" placeholder="NIM" required="required" readonly class="form-control" value="<?= $nim; ?>">
                                          </div>
                                          <div class="form-group" style="margin-top: -10px;">
                                              <input type="text" style="background-color: yellow; font-weight: bold; font-size:large" name="email" placeholder="Email" required="required" readonly class="form-control" value="<?= $email; ?>">
                                          </div>
                                          <div class="form-group" style="margin-top: -10px;">
                                              <input type="text" style="background-color: yellow; font-weight: bold; font-size:large" name="kode_akses" required="required" readonly placeholder="Kode Akses" class="form-control" autocomplete="off" value="<?= $hasil; ?>">
                                          </div>
                                          <div class="form-group" style="margin-top: -10px;">
                                              <input type="submit" class="btn btn-success" name="simpan" value="Aktifkan" class="form-control">
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>