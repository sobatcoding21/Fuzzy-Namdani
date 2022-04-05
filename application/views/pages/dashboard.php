<div class="card">
    <div class="card-header">
        <h1 class="h3 text-center">Data Bencana Hidrometeorologi</h5>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Pilih Tahun</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="tahun">
                                <option value="" disabled >Pilih Tahun</option>
                                <?php for($i=2020;$i<=date("Y");$i++) {
                                    echo '<option value="'.$i.'" '. ($tahun == $i ? 'selected' : '' )  .' >'.$i.'</option>';
                                }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="btn-group mb-3">
                        <button type="submit" class="btn btn-primary btn-sm mr-1"><i class="ti-search"></i>&nbsp;Tampilkan Data</button>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-from" data-backdrop="static" data-keyboard="false"><i class="ti-plus"></i>&nbsp;Tambah Data</button>
                    </div>
                </div>
            </div>
        </form>
        <?php if( $this->session->userdata('_message') ) { ?>
            <div class="alert bg-<?= $this->session->userdata('_status') ?> mb-4">
                <?= $this->session->userdata('_message') ?>
            </div>
        <?php } ?>
        <table class="table table-striped">
            <thead class="bg-info">
                <tr>
                    <th rowspan="2">ID</th>
                    <th rowspan="2">Tahun</th>
                    <th rowspan="2">Kelurahan</th>
                    <th colspan="5">Jumlah Bencana Hidrometeorologi</th>
                </tr>
                <tr>
                    <th class="text-center">Tanah Longsor</th>
                    <th class="text-center">Kekeringan</th>
                    <th class="text-center">Banjir</th>
                    <th class="text-center">Cuaca Ekstrim</th>
                    <th class="text-center">Gempa Bumi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $index=>$v) { ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= $v->year ?></td>
                        <td><?= $v->nama ?></td>
                        <td class="text-center"><?= $v->tanah_longsor ?></td>
                        <td class="text-center"><?= $v->kekeringan ?></td>
                        <td class="text-center"><?= $v->banjir ?></td>
                        <td class="text-center"><?= $v->cuaca_ekstrim ?></td>
                        <td class="text-center"><?= $v->gempa_bumi ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="modal-from" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="<?= base_url('save-data-bencana') ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Form Data Bencana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Tahun</label>
                        <select class="form-control" name="tahun">
                            <option value="" disabled>Pilih Tahun</option>
                            <?php for($i=2020;$i<=date("Y");$i++) { ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Kelurahan</label>
                        <select class="form-control" name="id_kelurahan">
                            <option value="" disabled>Pilih Kelurahan</option>
                            <?php foreach($kelurahan as $index=>$v) { ?>
                                    <option value="<?= $v->id_kelurahan ?>"><?= $v->nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Jenis Bencana</label>
                        <select class="form-control" name="id_bencana">
                            <option value="" disabled>Pilih Jenis Bencana</option>
                            <?php foreach($jbencana as $index=>$v) { ?>
                                    <option value="<?= $v->id ?>"><?= $v->nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>