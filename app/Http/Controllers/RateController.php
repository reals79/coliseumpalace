<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use XmlParser;

use App\Rate;

class RateController extends Controller
{
    //
	protected $url = 'http://www.bnm.md/ru/official_exchange_rates?get_xml=1&date=';
	protected $valutes = [978, 840, 643, 946, 980];

	public function __construct(Request $request)
	{
		$this->url .= Carbon::now()->format('d.m.Y');
	}

	public function importRates(Request $request)
	{
		$xml = XmlParser::load($this->url);
		$parsed_rates = $xml->parse([
			'date_at' => ['uses' => '::Date'],
			'rates' => ['uses' => 'Valute[::ID>ID,NumCode,CharCode,Nominal,Name,Value]'],
		]);
		$parsed_rates['rates'] = array_filter($parsed_rates['rates'], function($v, $k) {
			return in_array($v['NumCode'], $this->valutes);
		}, ARRAY_FILTER_USE_BOTH);

		$rates = Rate::ratesAt($parsed_rates['date_at'])->get();

		if ($rates->count() == 0) {
			foreach ($parsed_rates['rates'] as $value) {
				Rate::create([
					'num_code' => $value['NumCode'],
					'char_code' => $value['CharCode'],
					'nominal' => $value['Nominal'],
					'name' => $value['Name'],
					'value' => $value['Value'],
				]);
			}
			return "Rates imported for " . $parsed_rates['date_at'];
		} else {
			foreach ($rates as $rate) {
				$idx = array_search($rate->num_code, array_column($parsed_rates['rates'], 'NumCode'));
				$rate->update(['value' => $parsed_rates['rates'][$idx]['Value']]);
			}
			return "Rates updated for " . $parsed_rates['date_at'];
		}
	}

	public function getRates(Request $request)
	{
		$rates = Rate::currentRates()->get();

		return $rates;
	}

}
