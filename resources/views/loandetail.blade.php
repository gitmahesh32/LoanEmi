@extends('layouts.app')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Loan Detail Table</div>
            <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">ClientId</th>
                    <th scope="col">NumberOfPayment</th>
                    <th scope="col">FirstPaymentDate</th>
                    <th scope="col">LastPaymentDate</th>
                    <th scope="col">LoanAmount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($displayLoanData as $detail)
                    <tr>
                    <th scope="row">{{$detail->id}}</th>
                    <td>{{$detail->clientid}}</td>
                    <td>{{$detail->number_of_payment}}</td>
                    <td>{{$detail->first_payment_date}}</td>
                    <td>{{$detail->last_payment_date}}</td>
                    <td>{{$detail->loan_amount}}</td>
                    
                    </tr>
                    @endforeach
                    
                </tbody>
                </table>          
            </div>
        </div>
    </div>    
</div>
    
@endsection