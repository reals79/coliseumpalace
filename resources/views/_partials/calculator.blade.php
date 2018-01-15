<div id="calculator">
	<form class="form-inline" onsubmit="return false">
        <label for="app_price" class="mr-sm-2">{{ trans('apartment.enter_price_apartment') }} </label>
        <div class="input-group mb-2 mb-sm-0 mr-sm-2">
	        <div class="input-group-addon">&euro;</div>
			<input id="app_price" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'placeholder': '0', 'allowMinus': false, 'autoUnmask': true" class="text-right" required autofocus>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="calc_leasing">{{ trans('apartment.calculate') }}</button>
	</form>
	<div id="calculator_process" class="text-center d-none"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">{{ trans('apartment.calculation') }}</span></div>
	<div id="results" class="mt-4">
		<div id="initial_amount">{{ trans('apartment.initial_fee') }} <span class="font-weight-bold"></span></div>
		<table class="table table-sm table-striped">
		  <thead>
		    <tr class="text-center">
		      <th width="80">{{ trans('apartment.period') }}</th>
		      <th width="100">{{ trans('apartment.payment_date') }}</th>
		      <th class="text-right">{{ trans('apartment.payment_quart') }}</th>
		      <th class="text-right">{{ trans('apartment.amount_rest') }}</th>
		    </tr>
		  </thead>
		  <tbody>

		  </tbody>
		  <tfoot>
		  	
		  </tfoot>
		</table>
	</div>
</div>
