@extends('layouts.app')

@section('content')
    <!-- Content -->
    <section id="content">
        <div class="jumbotron content">
            <div class="container">
    			<ol class="breadcrumb mb-0 pl-0">
                    <li class="breadcrumb-item dropdown">
                        <a href="#" class="btn btn-link dropdown-toggle" id="dpApartmentTypes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('app.menu.appartments') }}</a>
                        <div class="dropdown-menu" aria-labelledby="dpApartmentTypes">
                            @foreach ($apartment_types as $apType)
                                <a href="{{ route('apartment', $apType->id) }}" class="dropdown-item {{ (($apartmentType->id == $apType->id) ? 'active' : '') }}">{{ $apType->name }}</a>
                            @endforeach
                        </div>
                    </li>
    			    <li class="breadcrumb-item active"></li>
    			</ol>
                <h4 class="text-primary">{{ $apartmentType->name }}</h4>
                <hr class="my-4">
                    
                @if ($apartment)
                    <div class="media">
                        <a href="{{ url($apartment->image) }}" data-toggle="lightbox" class="col-6 mt-5"><img class="mr-3 img-fluid" src="{{ url($apartment->image) }}" alt="{{ trans('apartment.layout') }}"></a>
                        <div class="media-body ml-5 mt-5">
                            <div class="">
                                <ul class="list-group border rounded">
                                    <li class="m-2">{{ trans('apartment.building') }}:
                                        <a href="#" class="dropdown-toggle font-weight-bold" id="dpBuildings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $apartment->building->name }}</a>
                                        <div class="dropdown-menu" aria-labelledby="dpBuildings">
                                            @foreach ($buildings as $apBuilding)
                                                <a href="{{ route('apartment', ['apartmentType' => $apartmentType->id, 'building_id' => $apBuilding->id]) }}" class="dropdown-item {{ (($building_id == $apBuilding->id) ? 'active' : '') }}">{{ $apBuilding->name }}</a>
                                            @endforeach
                                            <a href="{{ route('apartment', ['apartmentType' => $apartmentType->id]) }}" class="dropdown-item {{ ((!$building_id) ? 'active' : '') }}">{{ trans('apartment.all') }}</a>
                                        </div>
                                    </li>
                                    @if ($apartment->number_rooms > 0)
                                        <li class="m-2">{{ trans('apartment.number_rooms') }}: <span class="text-primary font-weight-bold">{{ $apartment->number_rooms }}</span></li>
                                    @endif
                                    @if ($apartment->total_area > 0)
                                        <!-- <li class="m-2">{{ trans('apartment.total_area') }}: <span class="text-primary font-weight-bold">{{ $apartment->total_area }}</span> <small>m<sup>2</sup></small></li> -->
                                    @endif
                                    @if ($apartment->living_area > 0)
                                        <li class="m-2">{{ trans('apartment.living_area') }}: <span class="text-primary font-weight-bold">{{ $apartment->living_area }}</span> <small>m<sup>2</sup></small></li>
                                    @endif
                                    @if ($apartment->hall > 0)
                                        <li class="m-2">{{ trans('apartment.hall') }}: <span class="text-primary font-weight-bold">{{ $apartment->hall }}</span> <small>m<sup>2</sup></small></li>
                                    @endif
                                    @if ($apartment->living_room > 0)
                                        <li class="m-2">{{ trans('apartment.living_room') }}: <span class="text-primary font-weight-bold">{{ $apartment->living_room }}</span> <small>m<sup>2</sup></small></li>
                                    @endif
                                    @if ($apartment->kitchen > 0)
                                        <li class="m-2">{{ trans('apartment.kitchen') }}: <span class="text-primary font-weight-bold">{{ $apartment->kitchen }}</span> <small>m<sup>2</sup></small></li>
                                    @endif
                                    @if ($apartment->wardrobe > 0)
                                        <li class="m-2">{{ trans('apartment.wardrobe') }}: <span class="text-primary font-weight-bold">{{ $apartment->wardrobe }}</span> <small>m<sup>2</sup></small></li>
                                    @endif
                                    @if ($apartment->terrace > 0)
                                        <li class="m-2">{{ trans('apartment.terrace') }}: <span class="text-primary font-weight-bold">{{ $apartment->terrace }}</span> <small>m<sup>2</sup></small></li>
                                    @endif
                                </ul>
                                @if (!empty($apartment->bedrooms))
                                <ul class="list-group border rounded mt-1">
                                    @foreach($apartment->bedrooms as $key => $value)
                                        <li class="m-2">{{ trans('apartment.bedroom') }} {{ $key }}: <span class="text-primary font-weight-bold">{{ $value }}</span> <small>m<sup>2</sup></small></li>
                                    @endforeach
                                </ul>
                                @endif
                                @if (!empty($apartment->bathrooms))
                                <ul class="list-group border rounded mt-1">
                                    @foreach($apartment->bathrooms as $key => $value)
                                        <li class="m-2">{{ trans('apartment.bathroom') }} {{ $key }}: <span class="text-primary font-weight-bold">{{ $value }}</span> <small>m<sup>2</sup></small></li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            <div class="mt-5">
                                <br><br><br>
                                <h5 class="text-primary">{{ trans('apartment.in_stock') }}:</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ trans('apartment.apartment_number') }}</th>
                                            <th class="text-center">{{ trans('apartment.floor') }}</th>
                                            <th class="text-center">{{ trans('apartment.total_area') }}</th>
                                            <th class="text-right">{{ trans('apartment.price') }}</th>
                                            <th class="text-center">{{ trans('apartment.program_finance') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($number_apartments as $key => $value)
                                        <?php
                                            $is_sold = in_array($value, $sold_apartments);
                                        ?>
                                        <tr @if ($is_sold) class="font-weight-bold font-italic text-primary" @endif>
                                            <td class="text-center">{{ $value }}</td>
                                            <td class="text-center">{{ $floors[$key] }}</td>
                                            <td class="text-center">{{ $total_areas[$key] }} <small>m<sup>2</sup></small></td>
                                            <td class="text-right text-primary font-weight-bold">&euro;{{ number_format($prices[$key], 0) }}</td>
                                            <td class="text-center">
                                                @if ($is_sold)
                                                    <span>{{ trans('apartment.sold') }}</span>
                                                @else
                                                    <a href="#" data-price="{{ number_format((($prices[$key] / $total_areas[$key]) + 100) * $total_areas[$key], 0) }}" data-toggle="calc-apartment">{{ trans('apartment.calculate') }}</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div id="calculator_content" class="d-none">
                        @include('_partials.calculator')
                    </div>
                @endif

                @if ($apartments->count())
                    <hr class="mt-5">

                    <div class="apartments">
                        <h3 class="text-primary">{{ trans('apartment.similar') }}</h3>
                        <ol class="apartment-list owl-carousel owl-theme">
                            @foreach($apartments as $apart)
                            <?php 
                                $areas = explode(',', $apart->total_area); sort($areas, SORT_NUMERIC);
                                $prices = explode(',', $apart->price); sort($prices, SORT_NUMERIC);
                            ?>
                                <li>
                                    <div class="card">
                                        <img class="card-img-top p-2" src="{{ url($apart->image) }}" alt="" height="230">
                                        <div class="card-body">
                                            <p class="card-text">
                                                {!! trans('apartment.area_between', ['from' => '<span class="text-primary">' . $areas[0] . '</span> <small>m<sup>2</sup></small>', 'to' => '<span class="text-primary">' . end($areas) . '</span> <small>m<sup>2</sup></small>']) !!}
                                            </p>
                                            <p class="card-text">
                                                {!! trans('apartment.price_between', ['from' => '<span class="text-primary">&euro;' . number_format($prices[0], 0) . '</span> ', 'to' => '<span class="text-primary">&euro;' . number_format(end($prices), 0) . '</span>']) !!}
                                            </p>
                                        </div>
                                        <div class="card-footer text-right">
                                            <a href="{{ route('apartment', ['apartmentType' => $apart->apartment_type_id, 'building_id' => 0, 'apartment' => $apart->id]) }}" class="btn btn-primary">{{ trans('app.buttons.more') }}</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @else
                    <div class="bd-callout bd-callout-danger">
                        <h4><i class="fa fa-exclamation mr-2" aria-hidden="true"></i> {{ trans('apartment.sale') }}</h4>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
