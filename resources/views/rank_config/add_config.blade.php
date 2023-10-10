@extends('layouts.app')

@section('content')
<div class="container">
  
  <h3>Add Config</h3>
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
  <form method="POST" action="{{ route('add_rank_config') }}" enctype='multipart/form-data' style="padding-left: 200px">
    <label class="h5">Rank - &nbsp;</label>{{ $rank->rank_name }} &nbsp; &nbsp; <label class="h5">Phase - &nbsp;</label>{{ $phase->name.' ('.date('jS F', strtotime($phase->start_date)).' - '.date('jS F', strtotime($phase->end_date)).')' }}
    @csrf
    <hr>
    <div class="row border mt-2 p-2">
      <div class="col-6">
        <label>Performance Target</label>
        <input type="text" class="form-control" name="performance_target" placeholder="Enter config value" value="{{(!empty($data->performance_target)) ? $data->performance_target : ''}}">
      </div>

      <div class="col-6">
        <label>Multiple By</label>
        <input type="text" class="form-control" name="multiple_by" placeholder="Enter config value" value="{{(!empty($data->multiple_by)) ? $data->multiple_by : ''}}">
      </div>
    </div>

    <div class="row border mt-2 p-2">
      <div class="col-6">
        <label>Guaranteed Prize</label>
        <input type="text" class="form-control" name="guaranteed_prize" placeholder="Enter config value" value="{{(!empty($data->guaranteed_prize)) ? $data->guaranteed_prize : ''}}">
      </div>

      <div class="col-6">
        <label>Conveyance</label>
        <input type="text" class="form-control" name="conveyance" placeholder="Enter config value" value="{{(!empty($data->conveyance)) ? $data->conveyance : ''}}">
      </div>
    </div>
    <div class="text-right">
      <button type="button" class="btn btn-success mt-2 add-commsec"><i class="fa fa-plus"> Add Config </i></button>
    </div>
    <div class="form-body">
      <div class="mt-2 comm-sec" id="comm_sec">
        <!-- start -->
        @if(!empty($data->commissions))
        @php $lcount = count($data->commissions);  @endphp
        @foreach($data->commissions as $key => $e_commission)
        <div class="row border mt-2 p-2 comm-subsec" id="comm_subsec_{{$lcount}}">
          <div class="col-6">
            <label>Select Commission Category</label>
            <select class="form-control" name="category_id[]" id="comm_cat_{{$lcount}}" onchange="getCommTypes({{$lcount}},this)">
              <option value="0">Select</option>
              @foreach($categories as $cat)
              <option value="{{ $cat->id }}" @if(($e_commission->commission_cat) && ($cat->id == $e_commission->commission_cat)) selected @endif>{{ $cat->name }} </option>
              @endforeach
            </select>
          </div>

          @if($e_commission->commission_type)
          <div class="col-5">
            <label>Select Commission Type</label>
            <select class="form-control" name="type_id[]" id="comm_type_{{$lcount}}">
              <!-- option will populate here from get types call -->
              @foreach($types as $type)
              @if($type->category_id == $e_commission->commission_cat)
              <option value="{{ $type->id }}" @if(($e_commission->commission_type) && ($type->id == $e_commission->commission_type)) selected @endif>{{ $type->type_name }}</option>
              @endif
              @endforeach
            </select>
            <input type="text" class="form-control mt-2" name="percentage[]" placeholder="Enter config value" value="{{(!empty($e_commission->percentage)) ? $e_commission->percentage : ''}}">
          </div>
          @endif
          <!-- <div class="col-1">
            <button type="button" onclick="removeCommsubsec(1)" class="btn btn-danger mt-5 del-commsec"><i class="fa fa-minus"></i></button>
          </div> -->
        </div>
        @php $lcount--; @endphp
        @endforeach
        @else
        <div class="row border mt-2 p-2 comm-subsec" id="comm_subsec_1">
          <div class="col-6">
            <label>Select Commission Category</label>
            <select class="form-control" name="category_id[]" id="comm_cat_1" onchange="getCommTypes(1,this)">
              <option value="0">Select</option>
              @foreach($categories as $cat)
              <option value="{{ $cat->id }}">{{ $cat->name }} </option>
              @endforeach
            </select>
          </div>

          <div class="col-5">
            <label>Select Commission Type</label>
            <select class="form-control" name="type_id[]" id="comm_type_1">
              <!-- option will populate here from get types call -->
            </select>
            <input type="text" class="form-control mt-2" name="percentage[]" placeholder="Enter config value" value="{{(!empty($e_commission->percentage)) ? $e_commission->percentage : ''}}">
          </div>
        </div>
        @endif
        <!-- end -->
      </div>



      <input type="hidden" name="rank_id" value="{{$rank->id}}">
      <input type="hidden" name="phase_id" value="{{$phase->id}}">
      <!-- /.card-body -->
    </div>
    <div class="card-footer mt-2">
        <button type="submit" onclick=validateForm() class="btn btn-primary">Submit</button>
    </div>
  </form>

</div>
<script>
  function validateForm() {

  }

  function getCommTypes(i, el){
    let catid = el.value;
    let url = "{{ route('get_types', ":catid") }}";
    url = url.replace(':catid', catid);
    var select = '';
    $.getJSON(url, function(jsonData){
        if(jsonData.length > 0) select = '<option value="">Select</option>';
        $.each(jsonData, function(i,data)
        {
          select +='<option value="'+data.id+'">'+data.type_name+'</option>';
        });
        $("#comm_type_"+i).html(select);
    });
  }

  function removeCommsubsec(i){
    $("div#comm_subsec_"+i).remove();
  }

  $('.add-commsec').on('click', function() { 
    let last_counter = $('.comm-subsec:first').attr('id');
    last_counter = last_counter.split('_');
    last_counter = last_counter[2];
    let counter = parseInt(last_counter)+1;
    console.log('click', counter);

    let url = "{{ route('get_cats') }}";
    var select = '<option value="0">Select</option>';
    $.getJSON(url, function(jsonData){
        if(jsonData.length > 0) select = '<option value="">Select</option>';
        $.each(jsonData, function(i,data)
        {
          select +='<option value="'+data.id+'">'+data.name+'</option>';
        });

        let commHtml = '<div class="row border mt-2 p-2 comm-subsec" id="comm_subsec_'+counter+'">'+
        '<div class="col-6">'+
          '<label>Select Commission Category</label>'+
          '<select class="form-control" name="category_id[]" id="comm_cat_'+counter+'" onchange="getCommTypes('+counter+',this)">'+
            select+
          '</select>'+
        '</div>'+

        '<div class="col-5">'+
          '<label>Select Commission Type</label>'+
          '<select class="form-control" name="type_id[]" id="comm_type_'+counter+'">'+
            '<!-- option will populate here from get types call -->'+
          '</select>'+
          '<input type="text" class="form-control mt-2" value="" name="percentage[]" placeholder="Enter config value">'+
        '</div>'+

        '<div class="col-1">'+
          '<button type="button" onclick="removeCommsubsec('+counter+')" class="btn btn-danger mt-5 del-commsec"><i class="fa fa-minus"></i></button>'+
        '</div>'+
      '</div>';
      $("#comm_sec").first().prepend(commHtml);
    });
    
  });
</script>
<style>
  .form-body {
    height: 400px;
    overflow-y: scroll;
    overflow-x: hidden;
  }
</style>
@endsection

