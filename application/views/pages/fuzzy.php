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
                                echo '<option value="'.$i.'" >'.$i.'</option>';
                            }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                
            </div>
        </div>
        
        <table class="table table-striped">
            <thead class="bg-info">
                <tr>
                    <th rowspan="2">ID</th>
                    <th rowspan="2">Tahun</th>
                    <th rowspan="2">Kelurahan</th>
                    <th colspan="5">Bencana Hidrometeorologi</th>
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
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>