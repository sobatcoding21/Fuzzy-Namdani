<div class="card">
    <div class="card-header">
        <a href="<?= base_url('peta') ?>" class="btn btn-info"><i class="ti-back-left"></i> Kembali</a>
        <h1 class="h3 text-center">Peta Kerawanan <?= $title ?></h5>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="<?= base_url('peta') ?>">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Pilih Tahun</label>
                                <select class="form-control" id="tahun" name="tahun">
                                    <option value="" disabled >Pilih Tahun</option>
                                    <?php for($i=2020;$i<=date("Y");$i++) {
                                        echo '<option value="'.$i.'" '. ($tahun == $i ? 'selected' : '' )  .' >'.$i.'</option>';
                                    }?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tingkat Kerentanan</label>
                                <select class="form-control" id="indeks" name="indeks">
                                    <option value="" disabled >Pilih Indeks Bencana</option>
                                    <option value="Rendah" <?= $indeks == 'Rendah' ? 'selected' : '' ?>>Rendah</option>
                                    <option value="Sedang" <?= $indeks == 'Sedang' ? 'selected' : '' ?>>Sedang</option>
                                    <option value="Tinggi" <?= $indeks == 'Tinggi' ? 'selected' : '' ?>>Tinggi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="margin-top: 30px;">
                                <input type="hidden" id="q" name="q" value="<?= $key ?>" />
                                <button class="btn btn-primary" ><i class="ti-search"></i> Tampilkan Peta</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="map" class="border p-2" style="dsiplay:block;margin:0 auto;width:800px;height:800px"></div>
                
            </div>
                
            <div class="card-footer text-center">
            </div>
        </div>
    </div>
</div>