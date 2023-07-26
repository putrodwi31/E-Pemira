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
                                      <input type="submit" name="upload" class="btn btn-success" value="Tambah">
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
                                                      <td><a class="btn btn-danger btn-circle" onclick="return confirm('Yakin hapus data ini !!!')" href="hapus_dpt.php?nim=<?php echo $dn['nim']; ?>">Hapus</a>
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