<div class="card">
    <div class="card-header">
        <h1 class="h3 text-center">Peta Kerawanan</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <?php foreach($data as $index=>$val) { ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img src="<?= base_url('assets/images/map-kediri.jpg') ?>" class="img-fluid" style="width:100%" alt="Peta Kota Kediri"/>
                    </div>
                        
                    <div class="card-footer text-center">
                        <h6><a href="<?= base_url('peta?q='. $val->nama) ?>"><?= strtoupper($val->nama); ?></a></h6>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>