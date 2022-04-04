<div class="card">
    <div class="card-header">
        <h1 class="h3 text-center">Peringatan Dini</h5>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs md-tabs" role="tablist">
            <?php foreach($data['weather']['timerange'] as $index=>$v) { ?>
            <li class="nav-item">
                <a class="nav-link <?= $index == 0 ? 'active' : '' ?>" data-toggle="tab" href="#<?= $v['@attributes']['datetime'] ?>" role="tab"><?= parserDatetime($v['@attributes']['datetime']) ?></a>
                <div class="slide"></div>
            </li>
            <?php } ?>
            
        </ul>
        <div class="tab-content card-block">
            <?php foreach($data['weather']['timerange'] as $index=>$v) { ?>
            <div class="tab-pane <?= $index == 0 ? 'active' : '' ?>" id="<?= $v['@attributes']['datetime'] ?>" role="tabpanel">
                <div class="weather-wrapper">
                    <div class="weather-header">
                        <h3><?= parserWheather($v['value']) ?></h3>
                    </div>
                    <div class="weather-body">
                        <span class="weather w-<?= parserWheatherIcon($v['value'])?>"></span>
                        <h5 class="temp"><?= $data['t']['timerange'][$index]['value'][0] ?>&#8451</h5>
                        <h5 class="humidity">Kelembaban : <?= $data['humidity']['timerange'][$index]['value'] ?>&nbsp;%</h5>
                        <h5 class="speed">Kecepatan Angin : <?= $data['ws']['timerange'][$index]['value'][2] ?>&nbsp;km/jam</h5>
                        <h5 class="wind-direction">Arah Angin : <?= parserWindDirection($data['wd']['timerange'][$index]['value'][1])?></h5>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>