<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanDetails;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class LoanController extends Controller
{
   

    /**
     * Private function
     */

    private function doLogic() {

        Schema::dropIfExists('emi_details');
        if (!Schema::hasTable('emi_details'))
        {
            Schema::connection('mysql')->create('emi_details', function($table)
            {
                $table->increments('id');
                $table->integer('clientid');
                $table->integer('number_of_payment');
                $table->longText('emi_paid');
                $table->longText('amount_of_emi');
                $table->float('loan_amount');
                $table->float('total_emi_paid');
                $table->date('created_at');
            });   
        }

        $datesF = DB::table('loan_details')
            ->select(DB::raw("MIN(first_payment_Date) AS FPD,MAX(last_payment_Date) AS LPD,loan_amount,clientid,number_of_payment"))
            ->first();

        $resultDates = LoanDetails::select('clientid','first_payment_Date','last_payment_date','number_of_payment','loan_amount')
             ->where('first_payment_Date', '>=',$datesF->FPD )
             ->where('last_payment_Date', '<=',$datesF->LPD)
             ->get();  
        
        $newArray = [];     
        foreach($resultDates as $key1=>$rst){
            $period = CarbonPeriod::create($rst->first_payment_Date, '1 month', $rst->last_payment_date);
            $newArray[$key1]['clientid'] = $rst->clientid;
            $newArray[$key1]['loan_amount']=$rst->loan_amount;
            $newArray[$key1]['number_of_payment'] = $rst->number_of_payment;
            $amountPaidEmi = $rst->loan_amount/$rst->number_of_payment;
            
            $sumOf = 0;
            foreach($period as $key2=>$month) { 
                $newArray[$key1]['emi_paid'][$key2] = $month->format('Y_M')."<br>";
                $newArray[$key1]['amount_of_emi'][$key2] = round($amountPaidEmi, 2)."<br>";
                $sumOf = $sumOf+$amountPaidEmi;
                $sumOf++;
            }
            $newArray[$key1]['total_emi_paid'] = round($sumOf, 2);
        }


        // Insert data into emi_details table
        if(isset($newArray)) {
            $insertArray =[];
            foreach($newArray as $key=>$vle) {
                $insertArray = [
                    'clientid'=>$vle['clientid'],
                    'emi_paid'=>implode(',', $vle['emi_paid']),
                    'amount_of_emi'=>implode(',', $vle['amount_of_emi']),
                    'total_emi_paid'=>$vle['total_emi_paid'],
                    'number_of_payment'=>$vle['number_of_payment'],
                    'loan_amount'=>$vle['loan_amount'],
                    'created_at'=>date('Y-m-d')
                ];
                DB::table('emi_details')->insert($insertArray);
            }
        }


        return $newArray;

    } 

    /**
     * Display Loan detail information
     */

    public function loandetail(Request $request) {
        $displayLoanData = LoanDetails::get(); 
        
        return view('loandetail',compact('displayLoanData'));
    } 

    /**
     * Proccess detail page
     */

    public function processdetail(Request $request) {
        return view('blank');
    }
    
    /**
     * Proccess data after button click
     */

    public function processbuttonclick(Request $request) {
               
        $newArray = $this->doLogic();

        return response()->json(['finalResult'=> $newArray], 200);
    } 
}
