@extends('layouts.app')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">Emi details table</div>
            <div class="card-body" style="overflow-x:auto;">
                <button class='btn btn-primary processbtn'>Process Data</button>

                <table class="table table-bordered" id="mytable1" >
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ClientId</th>
                            <th scope="col">NumberOfPayment</th>
                            <th scope="col">EmiDates</th>
                            <th scope="col">EmiAmount</th>
                            <th scope="col">LoanAmount</th>
                            <th scope="col">TotalEmiPaid</th>
                        </tr>
                    </thead>
                    
                </table>
                <span id="msg">**Note:- Please click the process button**</span>
            </div>
        </div>
    </div>    
</div>
    
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

$(function() {
    $('.processbtn').click(function(){
        $("#mytable1 > tbody").html("");
        $("#msg").html('');
        $.ajax({
               type:'POST',
               url:"{{route('processbuttonclick')}}",
               data: {"_token": "{{ csrf_token() }}"},
               success:function(data) {
                  //$("#newTable").html(data.finalResult);
                  $.each(data.finalResult, function(key, value){
                    $("#mytable1").append(
                        "<tbody><tr><td>"+1+"</td><td>"+value.clientid+"</td><td>"+value.number_of_payment+"</td><td>"+value.emi_paid+"</td><td>"+value.amount_of_emi+"</td><td>"+value.loan_amount+"</td><td>"+value.total_emi_paid+"</td></tr></tbody>"
                    );
                                  
                });
               }
        });
    });

   
});
</script>