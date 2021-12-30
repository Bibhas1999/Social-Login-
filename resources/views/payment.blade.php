@extends('layouts.app')

@section('content')

    @php
    $user_name = App\User::where('id', $user->id)->first();
    @endphp
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12 border">
                <h5 class="text-center bg-olive border-rounded shadow-lg py-2 ">Make Payment
                    <a href="{{ route('home') }}" class="text-md mt-1 float-left btn btn-primary btn-sm">
                        </i><i class="fas fa-arrow-left"></i> Back
                    </a>
                </h5>
                <form role="form" method="POST" action="{{ route('payments.store', $user->id) }}" id="myForm"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Enter Name</label>
                                <input type="hidden" name="user_id" value="{{$user_name->id}}">
                                <input type="text" class="form-control form-control-sm" placeholder="Enter name" name="name"
                                    id="name" value="{{ $user_name->name }}">
                                <font class="text-danger">
                                    {{ $errors->has('name') ? $errors->first('name') : '' }}</font>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Enter Amount</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Enter Amount"
                                    name="amount" id="amount">
                                <font class="text-danger">
                                    {{ $errors->has('amount') ? $errors->first('amount') : '' }}</font>
                            </div>
                        </div>

                    </div>
                    <div class="form-group pt-2">
                        <input type="submit" value="Submit" class="btn btn-md btn-primary px-4">
                    </div>
                </form>
            </div>
        </div>
        
      @if (Session::has('amount'))
      <form action="/pay" method="POST">
        @csrf
        <script
            src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="rzp_test_te73WTCByzECk2"  
            data-amount="{{Session::get('amount')}}" 
            data-currency="INR"
            data-order_id="{{Session::get('order_id')}}" 
            data-buttontext="Pay with Razorpay"
            data-name="Acme Corp"
            data-description="A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami"
            data-image="https://example.com/your_logo.jpg"
            data-prefill.name="Gaurav Kumar"
            data-prefill.email="gaurav.kumar@example.com"
            data-theme.color="#F37254"
        ></script>
        <input type="hidden" custom="Hidden Element" name="hidden">
        </form>
      @endif
    </div>

    
@endsection

{{-- id rzp_test_te73WTCByzECk2 --}}
{{-- secret key 34m7Y9FIo1gbMvwxIPc159p3 --}}
