<div id="apartment_types" class="d-inline-block dropdown">
	<a href="#" class="btn btn-link dropdown-toggle" id="dpApartmentTypes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Выберите квартиры</a>
	<div class="dropdown-menu" aria-labelledby="dpApartmentTypes">
	    @foreach ($apartment_types as $apType)
	        <a href="{{ route('apartment', $apType->id) }}" class="dropdown-item">{{ $apType->name }}</a>
	    @endforeach
	</div>
</div>
