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
              <div class="row">
                <div class=col-10">
                  <select class="form-control" id="phase" onchange=ch_phase();>
                    @foreach($phases as $phase)
                      <option value={{$phase->id}}>{{$phase->name}}</option>
                    @endforeach
                  </select>
                  <p class="text-danger" id="ph_err"></p>
                </div>
              </div>
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
                    <td><a href="javascript:void(0);" onclick=navigate({{$rank->id}}); class="btn btn-primary btn-sm">View Config</a></td>
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
<script>
  function ch_phase() {
    $('#ph_err').html('');
    let phaseid = $('#phase').val();
    if (phase_id < 1) {
      $('#ph_err').html('Please select phase');
    }
  }
  
  function navigate(rankid) {
    $('#ph_err').html('');
    let phaseid = $('#phase').val();
    // console.log(phase_id);
    if (phaseid && (phaseid > 0)) {
      $('#ph_err').html('');
      let url = "{{ route('add_config', ['rankid' => ':rankid', 'phaseid' => ':phaseid']) }}";
      url = url.replace(':rankid', rankid);
      url = url.replace(':phaseid', phaseid);
      window.location.href = url;
    } else {
      $('#ph_err').html('Please select phase');
    }
  }
</script>
@endsection

