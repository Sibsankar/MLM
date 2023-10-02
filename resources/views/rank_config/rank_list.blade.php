@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ranks</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Ranks</th>
                    <th style="width: 70px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($ranks as $key =>$rank)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{ $rank->rank_name}}</td>
                    <td><a href="{{ route('add_config', ['rankid' => $rank->id]) }}" class="btn btn-primary btn-sm">Add Config</a></td>
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

