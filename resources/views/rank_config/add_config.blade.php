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
    <label class="bold">Rank - &nbsp;</label>{{ $rank->rank_name }}
    @csrf
    
    <div class="row border mt-2 p-2">
      <div class="col-6">
        <label>Performance Target</label>
        <input type="text" class="form-control" value="" name="performance_target" placeholder="Enter config value">
      </div>

      <div class="col-6">
        <label>Multiple By</label>
        <input type="text" class="form-control" value="" name="multiple_by" placeholder="Enter config value">
      </div>
    </div>

    <div class="row border mt-2 p-2">
      <div class="col-6">
        <label>Guaranteed Prize</label>
        <input type="text" class="form-control" value="" name="guaranteed_prize" placeholder="Enter config value">
      </div>

      <div class="col-6">
        <label>Conveyance</label>
        <input type="text" class="form-control" value="" name="conveyance" placeholder="Enter config value">
      </div>
    </div>
    <div class="text-right">
      <button type="button" class="btn btn-success mt-2 add-commsec"><i class="fa fa-plus"> Add Config </i></button>
    </div>
    <div class="form-body">
      <div class="mt-2 comm-sec" id="comm_sec">
        <div class="row border p-2 comm-subsec" id="comm_subsec_1">
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
            <input type="text" class="form-control mt-2" value="" name="percentage[]" placeholder="Enter config value">
          </div>

          <!-- <div class="col-1">
            <button type="button" onclick="removeCommsubsec(1)" class="btn btn-danger mt-5 del-commsec"><i class="fa fa-minus"></i></button>
          </div> -->
        </div>

      </div>



      <input type="hidden" name="rank_id" value="{{$rank->id}}">
      <!-- /.card-body -->
    </div>
    <div class="card-footer mt-2">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>

</div>
<script>
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
    let counter = $('#comm_sec .comm-subsec').length;
    counter = parseInt(counter)+1;
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
      $("#comm_sec").last().append(commHtml);
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

