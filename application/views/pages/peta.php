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
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126480.11382778184!2d111.94614706782542!3d-7.842246250958292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78570dfd6e0647%3A0x25037b968333d9b2!2sKediri%2C%20Kabupaten%20Kediri%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1649142676806!5m2!1sid!2sid" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                        
                    <div class="card-footer text-center">
                        <h6><a href="<?= base_url('peta?q='. $val->nama) ?>"><?= $val->nama; ?></a></h6>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>