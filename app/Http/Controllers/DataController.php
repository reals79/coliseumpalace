<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use XBase\Table;

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
        	$table_records = new Table($file_path_records);
        }

        if (Storage::exists($file_name_clients)) {
            $table_clients = new Table($file_path_clients);
            
            while ($record_client = $table_clients->nextRecord()) {
                $idno = trim($record_client->clientid);
                $contract = trim($record_client->contract);
                $contract_at = $record_client->getDate('contrdta');
                $name = $record_client->name;
                $tbl_data = [
                    'idno' => $idno,
                    'contract_at' => ($contract_at > 0) ? date('Y-m-d', $contract_at) : null,
                    'first_name' => '',
                    'last_name' => '',
                    'total_amount_leasing' => $record_client->tcorp,
                    'total_amount_leasing_period' => $record_client->tratagr,
                    'total_amount_stavka' => $record_client->tdobgr,
                    'total_amount_fine' => $record_client->tpen,
                    'total_amount_pay' => $record_client->tachit,
                    'total_amount_sold' => $record_client->tneachit,
                    'total_amount_debt' => $record_client->cdatoria,
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
                	$table_records->moveTo(0);
                	while ($record = $table_records->nextRecord()) {
                		$idno_r = trim($record->clientid);
                		if ($idno_r == $idno) {
                			$record_data = [
	                			'number_period' => $record->nrrata,
	                			'pay_at' => date('Y-m-d', $record->getDate('crdata')),
	                			'amount_leasing' => $record->crsuma,
	                			'amount_leasing_period' => $record->crcorp,
	                			'amount_stavka' => $record->crdob,
	                			'amount_fine' => $record->crpen,
	                			'amount_sold' => $record->crcsold,
	                			'amount_pay' => $record->crachit
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
