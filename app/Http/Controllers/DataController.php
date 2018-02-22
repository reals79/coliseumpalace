<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use org\majkel\dbase\Table;

use App\User;
use App\UserRecords;

class DataController extends Controller
{
    //
    public function dataProcess()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $results = [];

        $file_name_clients = 'chead.DBF';
        $file_path_clients = storage_path('app/' . $file_name_clients);

        $file_name_records = 'crows.DBF';
        $file_path_records = storage_path('app/' . $file_name_records);
        $exists_records = Storage::exists($file_name_records);
        if ($exists_records) {
            $table_records = Table::fromFile($file_path_records);
        }

        if (Storage::exists($file_name_clients)) {
            $table_clients = Table::fromFile($file_path_clients);
            
            foreach ($table_clients as $record_client) {
                $idno = trim($record_client->CLIENTID);
                $contract = trim($record_client->CONTRACT);
                $contract_at = $record_client->CONTRDTA->format('Y-m-d');
                $name = $record_client->NAME;
                $name_arr = preg_split('/ /', $name);
                $last_name = trim(array_shift($name_arr));
                $first_name = trim(implode(' ', $name_arr));
                $tbl_data = [
                    'idno' => $idno,
                    'contract_at' => (($contract_at == '1970-01-01') ? null : $contract_at),
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'total_amount_leasing' => $record_client->TCORP,
                    'total_amount_leasing_period' => $record_client->TRATAGR,
                    'total_amount_stavka' => $record_client->TDOBGR,
                    'total_amount_fine' => $record_client->TPEN,
                    'total_amount_pay' => $record_client->TACHIT,
                    'total_amount_sold' => $record_client->TNEACHIT,
                    'total_amount_debt' => $record_client->CDATORIA,
                ];
                if (!empty($contract))
                	$tbl_data['contract'] = $contract;
                
                $user = User::where('idno', $idno)->first();

                if (!$user) {
                	$user = User::create($tbl_data);
                } else {
                	$user->update($tbl_data);
                }

                if ($exists_records) {
                    foreach ($table_records as $record) {
                		$idno_r = trim($record->CLIENTID);
                		if ($idno_r == $idno) {
                			$record_data = [
	                			'number_period' => $record->NRRATA,
	                			'pay_at' => $record->CRDATA->format('Y-m-d'),
	                			'amount_leasing' => $record->CRSUMA,
	                			'amount_leasing_period' => $record->CRCORP,
	                			'amount_stavka' => $record->CRDOB,
	                			'amount_fine' => $record->CRPEN,
	                			'amount_sold' => $record->CRCSOLD,
	                			'amount_pay' => $record->CRACHIT
                			];

                			$user_record = $user->records()->where('number_period', $record_data['number_period'])->first();
                			if ($user_record) {
                				$user_record->update($record_data);
                			} else {
                				$user->records()->create($record_data);
                			}
                		}
                	}
                }
            }

            $results['success'] = true;
        }

    	return $results;
    }
}
