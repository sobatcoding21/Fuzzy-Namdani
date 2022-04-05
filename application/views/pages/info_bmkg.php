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
                <div class="weather-wrapper" >
                    <div class="weather-header">
                        <h3><?= parserWheather($v['value']) ?></h3>
                    </div>
                    <div class="weather-body">
                        <span class="weather w-<?= parserWheatherIcon($v['value'])?>"></span>
                        <h5 class="temp mb-2"><?= $data['t']['timerange'][$index]['value'][0] ?>&#8451</h5>
                        <ul>
                            <li class="h5"><i class="fa fa-tint"></i> <?= $data['humidity']['timerange'][$index]['value'] ?>&nbsp;%</li>
                            <li class="h5"><i class="fa fa-flag-o"></i> <?= $data['ws']['timerange'][$index]['value'][2] ?>&nbsp;km/jam</li>
                            <li class="h5"><i class="fa fa-location-arrow"></i> <?= parserWindDirection($data['wd']['timerange'][$index]['value'][1])?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>