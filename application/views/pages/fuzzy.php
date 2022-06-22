<style>
    .table > thead > tr > th, .table > tbody > tr > td {
        padding: 2px 8px;
    }
</style>
<div class="card">
    <div class="card-header">
        <h1 class="h3 text-center">Data Fuzzy Mamdani</h5>
    </div>
    <div class="card-body">
        
        <div class="row">
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Pilih Tahun</label>
                    <div class="col-sm-8">
                        <select class="form-control">
                            <option value="" disabled >Pilih Tahun</option>
                            <?php for($i=2020;$i<=date("Y");$i++) {
                                echo '<option value="'.$i.'" '. ($year == $i ? 'selected' : '') .' >'.$i.'</option>';
                            }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <div id="chart1"></div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="bg-info">
                    <tr>
                        <th rowspan="4" style="vertical-align: middle;">No</th>
                        <th rowspan="4" style="vertical-align: middle;">Tahun</th>
                        <th rowspan="4" style="vertical-align: middle;">Kelurahan</th>
                        <th colspan="60" class="text-center">Jumlah Bencana Hidrometeorologi</th>
                    </tr>
                    <tr>
                        <?php foreach($jbencana as $b) { ?>
                        <th class="text-center bg-secondary" colspan="12"><?= $b->nama ?></th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php for($i=0;$i< count($jbencana);$i++) { ?>
                            <?php foreach($variable as $k=>$v) { ?>
                            <th class="text-center" colspan="3"><?= $v->name. '&nbsp;('.$v->code.')' ?></th>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php for($i=0;$i< count($jbencana);$i++) { ?>
                            <?php foreach($variable as $k=>$v) { ?>
                            <th class="text-center bg-secondary">Rendah</th>
                            <th class="text-center bg-warning text-dark">Sedang</th>
                            <th class="text-center bg-success">Tinggi</th>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=1;
                        foreach($data['results'] as $index=>$v) { ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $year ?></td>
                            <td><?= $index ?></td>
                            <?php foreach($jbencana as $b) { ?>
                                <?php foreach($variable as $k=>$var) { 
                                    $code = $var->code;    
                                ?>
                                <td class="text-center"><?= number_format($v[$b->nama][$var->name]['membership']['Rendah'],2,",",".") ?></td>
                                <td class="text-center"><?= number_format($v[$b->nama][$var->name]['membership']['Sedang'],2,",",".") ?></td>
                                <td class="text-center"><?= number_format($v[$b->nama][$var->name]['membership']['Tinggi'],2,",",".") ?></td>
                                <?php } ?>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
