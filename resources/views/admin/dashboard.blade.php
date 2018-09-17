
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <button type="button" data-toggle="leasing" class="btn btn-default navbar-btn">Обновить лизинговые платежи</button>
          </li>
          <li>
            <button type="button" data-toggle="communal" class="btn btn-default navbar-btn">Обновить коммунальные платежи</button>
          </li>
        </ul>
    </div>  
</nav>

<div class="panel panel-default">
    <div class="panel-heading">Квартиры</div>
    <div class="panel-body">
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
                        <span class="info-box-number">{{ $totalStats['available'] }}</span>
                        <span class="info-box-text text-danger">Продано</span>
                        <span class="info-box-number text-danger">{{ $totalStats['solded'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Клиенты</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua info-box-title text-uppercase">Всего</span>
                    <div class="info-box-content">
                        <span class="info-box-number">{{ $totalClients['available'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green info-box-title">Зарегистри-рованных</span>
                    <div class="info-box-content">
                        <span class="info-box-number">{{ $totalClients['registered'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-fuchsia info-box-title">Активных</span>
                    <div class="info-box-content">
                        <span class="info-box-number">{{ $totalClients['activited'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
