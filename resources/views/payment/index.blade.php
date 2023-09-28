@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Create Payment</div>

                <div class="card-body">
                    <form method="POST" action="{{route('payment.checkout')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="money" name="money">
                        <button type="submit" class="btn btn-primary" > Checkout </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection