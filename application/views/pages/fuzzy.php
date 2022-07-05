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
        
        <div class="row mb-4">
            <div class="col-md-12">
                <h4>Table Variable Fuzzy</h4>
                <table class="table ">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Variable Fuzzy</th>
                            <th colspan="3">Fuzzy Set Range</th>
                        </tr>
                        <tr>
                            <th>Rendah</th>
                            <th>Sedang</th>
                            <th>Tinggi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Bencana (di setiap kelurahan)</td>
                            <td>0-4</td>
                            <td>1-8</td>
                            <td>> 4</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kepadatan penduduk yang terdampak (di setiap kelurahan)</td>
                            <td>0-23269</td>
                            <td>2760-43778</td>
                            <td>> 23269</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Jumlah bangunan yang terdampak (di setiap kelurahan)</td>
                            <td>0-500 JT</td>
                            <td>500 JT -1 M</td>
                            <td>> 1 M</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Jumlah fasilitas kesehatan yang tersedia (di setiap kelurahan)</td>
                            <td>0-500 JT</td>
                            <td>500 JT - 1 M</td>
                            <td>> 1 M</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div id="chartD"></div>
            </div>
            <div class="col-md-3">
                <div id="chartPD"></div>
            </div>
            <div class="col-md-3">
                <div id="chartNB"></div>
            </div>
            <div class="col-md-3">
                <div id="chartHF"></div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12">
                <h4>Fungsi Derajat Keanggotaan Fuzzy</h4>
                <table class="table ">
                    <tr>
                        <td><b>uARendah[x]</b></td>
                        <td>:</td>
                        <td>1;</td>
                        <td>if x ≤ a</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>(b - x) / (b - a);</td>
                        <td>if a ≤ x < b</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>0;</td>
                        <td>if x ≥ b</td>
                    </tr>

                    <tr>
                        <td><b>uASedang[x]</b></td>
                        <td>:</td>
                        <td>0;</td>
                        <td>if x ≤ a or x ≥ c</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>(x - a) / (b - a);</td>
                        <td>if a ≤ x < b</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>(c - x) / (c - b);</td>
                        <td>if b ≤ x < c</td>
                    </tr>

                    <tr>
                        <td><b>uATinggi[x]</b></td>
                        <td>:</td>
                        <td>0;</td>
                        <td>if x ≤ b</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>(x - b) / (c - b);</td>
                        <td>if b ≤ x < c</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>1;</td>
                        <td>if x ≥ c</td>
                    </tr>

                </table>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <h4>Table Fuzzy Output Range</h4>
                <table class="table ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Range</th>
                            <th>Output</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>1-1.5</td>
                            <td>Rendah</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>1.5-2.5</td>
                            <td>Sedang</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2.5-3</td>
                            <td>Tinggi</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-responsive mb-4">
            <h4>Perhitungan Nilai Derajat Keanggotaan Fuzzy</h4>
            <table class="table table-striped">
                <thead class="bg-info">
                    <tr>
                        <th rowspan="4" style="vertical-align: middle;">No</th>
                        <th rowspan="4" style="vertical-align: middle;">Tahun</th>
                        <th rowspan="4" style="vertical-align: middle;">Kelurahan</th>
                        <th colspan="80" class="text-center">Jumlah Bencana Hidrometeorologi</th>
                    </tr>
                    <tr>
                        <?php foreach($jbencana as $b) { ?>
                        <th class="text-center bg-secondary" colspan="16"><?= $b->nama ?></th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php for($i=0;$i< count($jbencana);$i++) { ?>
                            <?php foreach($variable as $k=>$v) { ?>
                            <th class="text-center" colspan="4"><?= $v->name. '&nbsp;('.$v->code.')' ?></th>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php for($i=0;$i< count($jbencana);$i++) { ?>
                            <?php foreach($variable as $k=>$v) { ?>
                            <th class="text-center bg-secondary">Rendah</th>
                            <th class="text-center bg-warning text-dark">Sedang</th>
                            <th class="text-center bg-danger">Tinggi</th>
                            <th class="text-center bg-success">Predic</th>
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
                                <td class="text-center"><b><?= $v[$b->nama][$var->name]['nilai']. '&nbsp;('.$v[$b->nama][$var->name]['nilai_huruf'].')' ?></b></td>
                                <?php } ?>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <h4>IF THEN RULE</h4>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <?php foreach($jbencana as $index=>$val) { ?>
                        <a class="nav-item nav-link <?= $index == 0 ? 'active' : '' ?>" id="nav-<?= $index?>-tab" data-toggle="tab" href="#nav-<?= $index ?>" role="tab" aria-controls="nav-<?= $index?>" aria-selected="true"><?= $val->nama ?></a>
                        <?php } ?>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <?php foreach($jbencana as $index=>$val) { 
                    ?>
                    <div class="tab-pane fade show <?= $index == 0 ? 'active' : '' ?> card-body" id="nav-<?= $index?>" role="tabpanel" aria-labelledby="nav-<?= $index?>-tab">
                        
                        <ul>
                            <?php 
                                $i = 1;
                                foreach($data['rules'][$val->nama] as $k => $v) { ?>
                                <li><?= '[R'.($i++).']&nbsp;'. $v ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="table-responsive mb-4">
            <h4>Defuzzification</h4>
            <table class="table table-striped">
                <thead class="bg-info">
                    <tr>
                        <th rowspan="4" style="vertical-align: middle;">No</th>
                        <th rowspan="4" style="vertical-align: middle;">Tahun</th>
                        <th rowspan="4" style="vertical-align: middle;">Kelurahan</th>
                        <?php foreach($jbencana as $k=>$v) { ?>
                            <th class="text-center" ><?= $v->nama; ?></th>
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
                                <td class="text-center"><?= $data['defuzzy'][$index][$b->nama]['rumus'] ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>             
        </div>

        <div class="table-responsive mb-4">
            <h4>Output and Results</h4>
            <table class="table table-striped">
                <thead class="bg-info">
                    <tr>
                        <th rowspan="2" style="vertical-align: middle;">No</th>
                        <th rowspan="2" style="vertical-align: middle;">Tahun</th>
                        <th rowspan="2" style="vertical-align: middle;">Kelurahan</th>
                        <?php foreach($jbencana as $k=>$v) { ?>
                            <th class="text-center" colspan="2"><?= $v->nama; ?></th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php foreach($jbencana as $k=>$v) { ?>
                            <th class="text-center" >Crisp Output</th>
                            <th class="text-center" >Fuzzy Output</th>
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
                                <td class="text-center"><?= $data['defuzzy'][$index][$b->nama]['total'] ?></td>
                                <td class="text-center"><?= $data['defuzzy'][$index][$b->nama]['output'] ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>             
        </div>

    </div>
</div>
