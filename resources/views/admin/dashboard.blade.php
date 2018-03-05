<div class="row">
    @foreach ($apartmentsStat as $stat)
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon info-box-title @if($stat['type'] == 'apartment') bg-green @else bg-purple @endif ">{{ $stat['name'] }}</span>

            <div class="info-box-content">
                <span class="info-box-text">Не продано</span>
                <span class="info-box-number">{{ $stat['available'] }}</span>
                <span class="info-box-text text-danger">Продано</span>
                <span class="info-box-number text-danger">{{ $stat['solded'] }}</span>
            </div>
        </div>
    </div>
    @endforeach
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua info-box-title text-uppercase">Всего</span>

            <div class="info-box-content">
                <span class="info-box-text">Не продано</span>
                <span class="info-box-number">{{ $totalsStat['available'] }}</span>
                <span class="info-box-text text-danger">Продано</span>
                <span class="info-box-number text-danger">{{ $totalsStat['solded'] }}</span>
            </div>
        </div>
    </div>
</div>
