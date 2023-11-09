@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="padding-left: 200px;">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Collections</h3>
              <div class="text-right"><a href="{{ route('collection_create') }}" class="btn btn-primary btn-sm">Create <i class="fa fa-plus" aria-hidden="true"></i></a></div>
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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Ranks</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Aadhar</th>
                    <th>Segment</th>
                    <th>Amount</th>
                    <th>TXN ID</th>
                    <th>Approved?</th>
                    @if(\Auth::user()->type == 'admin')<th>Entered By</th>@endif
                    <th style="width: 70px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($collections as $key =>$collection)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{ $collection->name}}</td>
                    <td>{{ $collection->phone}}</td>
                    <td>{{ $collection->address}}</td>
                    <td>{{ $collection->aadhar}}</td>
                    <td>{{ $collection->segment}}</td>
                    <td>{{ $collection->amount}}</td>
                    <td>{{ $collection->txnid}}</td>
                    <td>{{ $collection->is_approved}}</td>
                    @if(\Auth::user()->type == 'admin')<td>{{ $collection->user_id}}</td>@endif
                    <td>
                      <a href="{{ route('collection_edit', ['id' => $collection->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>  
                      <a onclick="return confirm('Are you sure to delete?')" href="{{ route('collection_delete', ['id' => $collection->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          
          </div>
          <!-- /.card -->
      </div>
    </div>
</div>
@endsection

