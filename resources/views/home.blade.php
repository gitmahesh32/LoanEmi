@extends('layouts.app')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">HomePage</div>
            <div class="card-body">
                <ul>
                    <li>
                        <a href="{{route('loandetail')}}" class="href">Go to loan detail page</a>
                    </li>
                    <li>
                        <a href="{{route('processdetail')}}" class="href">Go to process data page</a>
                    </li>
                </ul>

                <p>Steps needs to follow to setup in your end.</p>
                <p>1. After install laravel successfully.</p>
                <p>2. Copy the code into the folder anywhere</p>
                <p>3. Create database name 'loanemi'</p>
                <p>4. Run command 'php artisan migrate'</p>
                <p>5. Run command 'php artisan db:seed'</p>
                <p>6. Also run 'php artisan db:seed --class=UserSeeder'</p>
                <p>7. Also run 'php artisan db:seed --class=LoanDetailSeeder'</p>
                <p>8. Run the command 'php artisan serve'</p>
                <p>9. Then oprn url 'http://127.0.0.1:8000/' </p>
                
                
               
            </div>
        </div>
    </div>    
</div>
    
@endsection