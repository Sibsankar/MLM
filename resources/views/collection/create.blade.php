@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row" style="padding-left: 170px;">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create Collection</h3>
        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if(session('successmessage'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('successmessage')}}
            </div>
        @endif
        @if(count($errors))
            @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$error}}
            </div>
            @endforeach
        @endif
        
        <form method="POST" action="{{ route('collection_add') }}" enctype='multipart/form-data' >
            @csrf
            <hr>
            <div class="row p-2">
                <label class="col-2 pt-1 text-right">Name</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="name" placeholder="Enter name" value="" required>
                </div>
            </div>
            <div class="row p-2">
                <label class="col-2 pt-1 text-right">Phone</label>
                <div class="col-10">
                    <input type="number" class="form-control" name="phone" placeholder="Enter phone number" value="" required>
                </div>
            </div>
            <div class="row p-2">
                <label class="col-2 pt-1 text-right">Address</label>
                <div class="col-10">
                    <textarea class="form-control" name="address" placeholder="Enter address" value="" required></textarea>
                </div>
            </div>
            <div class="row p-2">
                <label class="col-2 pt-1 text-right">Aadhar</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="aadhar" placeholder="Enter aadhar" value="" required>
                </div>
            </div>
            <div class="row p-2">
                <label class="col-2 pt-1 text-right">Segment</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="segment" placeholder="Enter segment" value="" required>
                </div>
            </div>
            <div class="row p-2">
                <label class="col-2 pt-1 text-right">Amount</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="amount" placeholder="Enter amount" value="" required>
                </div>
            </div>
            <div class="row p-2">
                <label class="col-2 pt-1 text-right">Transaction ID</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="txn_id" placeholder="Enter transaction id" value="" required>
                </div>
            </div>
            <div class="row p-2">
                <label class="col-2 pt-1 text-right">Payment Gateway</label>
                <div class="col-10">
                    <textarea class="form-control" name="payment_details" placeholder="Enter payment details" value="" required></textarea>
                </div>
            </div>
            <div class="row p-2">
                <label class="col-2 pt-1 text-right">Payment Screenshot</label>
                <div class="col-10">
                    <input type="file" class="form-control" name="payment_image" value="">
                </div>
            </div>
            
            <div class="card-footer mt-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

        </div>
    </div>
</div>
<script>
</script>
<style>
  .form-body {
    height: 400px;
    overflow-y: scroll;
    overflow-x: hidden;
  }
</style>
@endsection

