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
                              <h4>Input Data</h4>
                          </div>
                          <div class="card-body">
                              <form action="<?= base_url('admin/data_paslon'); ?>" method="post" enctype="multipart/form-data">
                                  <div class="form-group">
                                      <div class="form-group">
                                          <label>No paslon</label>
                                          <input type="text" name="no_urut" required="required" class="form-control">
                                      </div>
                                      <label>NIM Calon Ketua</label>
                                      <input type="text" name="nim_ketua" required="required" class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label>Nama Calon Ketua</label>
                                      <input type="text" name="nm_paslon_ketua" required="required" autocomplete="off" class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label>Foto Ketua</label>
                                      <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="customFile" name="gambar1">
                                          <label class="custom-file-label" for="customFile">Foto Ketua</label>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label>NIM wakil</label>
                                      <input type="text" name="nim_wakil" required="required" class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label>Nama wakil</label>
                                      <input type="text" name="nm_paslon_wakil" required="required" autocomplete="off" class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label>Foto Wakil Ketua</label>
                                      <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="customFile" name="gambar2">
                                          <label class="custom-file-label" for="customFile">Foto Wakil</label>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label>Visi</label>
                                      <textarea class="form-control" name="visi" id="visi" required="required" style="height: 7em;"></textarea>
                                  </div>
                                  <div class="form-group">
                                      <label>Misi</label>
                                      <textarea class="form-control" name="misi" id="misi" required="required" style="height: 13em;"></textarea>
                                  </div>
                                  <div class="form-group">
                                      <input type="submit" class="btn btn-success" name="simpan" value="Input" class="form-control">
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                      <div class="card">
                          <div class="card-header">
                              <h4>Data Paslon</h4>
                          </div>
                          <div class="card-body">
                              <div class="table-responsiv">
                                  <table class="table table-striped table-bordered table-hover">
                                      <tr>
                                          <th>Nama Ketua</th>
                                          <th>No paslon</th>
                                          <th>Opsi</th>
                                      </tr>
                                      <?php
                                        foreach ($paslon as $d) {
                                        ?>
                                          <tr>
                                              <td><?php echo $d['nm_paslon_ketua']; ?></td>
                                              <td><?php echo $d['no_urut']; ?></td>
                                              <td><a class="btn btn-danger btn-circle text-white" id="hapusPaslon<?= $d['no_urut']; ?>" onclick="getDel(<?= $d['no_urut']; ?>)" data-link="<?= base_url() . 'admin/hapus_datapaslon/' . $d['no_urut']; ?> " data-ntipe='Paslon No Urut'>Hapus</a>
                                              </td>
                                          </tr>
                                      <?php } ?>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>