@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="padding-left: 200px;">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Commission Type</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Type</th>
                    <th>Category</th>
                   
                    <th style="width: 40px">Status</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($typeData as $key =>$types)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{ $types->type_name}}</td>
                    <td>{{ $types->catName}}</td>
                    <?php if($types->status==1){?>
                    <td><span class="badge bg-success">Active</span></td>
                    <?php }else{ ?>
                      <td><span class="badge bg-danger">Inactive</span></td>
                      <?php } ?>
                    <td><a href="javascript:void(0)" onclick="editType('{{ $types->id }}','{{ $types->category_id }}','{{ $types->type_name }}','{{ $types->status }}')" class="btn btn-primary btn-sm">Edit</a></td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          
          </div>
          <!-- /.card -->

          
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <div class="row justify-content-center">
                <div class="col-md-12" >
                    <div class="card">
                        <div class="card-header">{{ __('Commission Type') }}</div>
        
                        <div class="card-body" style="max-height:75vh; overflow-y:scroll;">
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
                           
                                <p class="h4">Add Commission Type</p>
                                <!-- form start -->
                                <form method="POST" action="{{ route('addType') }}" enctype='multipart/form-data'>
                                @csrf
                                <div class="card-body">
                                  <div class="form-group">
                                    <label>Select Commission Category</label>
                                    <select class="form-control" name="category_id" id="comm_cat">
                                      <option value="0">Select</option>
                                      @foreach($catData as $cat)
                                      <option value="{{ $cat->id }}">{{ $cat->name }} </option>
                                    @endforeach
                                    </select>
                                  </div>
                                    
                                <div class="form-group">
                                    <label for="type_name">Commission Type</label>
                                    <input type="text" class="form-control" name="type_name" required id="type_name" placeholder="Enter Commission Type Name" value="">
                                </div>
                               
                                <div class="form-group">
                                    <label for="rank">Status</label>
                                    <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="active" name="status" value="1">
                                    <label for="active" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="inactive" name="status" value="0" >
                                    <label for="inactive" class="custom-control-label">Inactive</label>
                                    </div>
                                </div>
                                    
                             
                                <input type="hidden" name="update_Type_id" id="update_Type_id" value="">
                                <!-- /.card-body -->
        
                                <div class="card-footer mt-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                           
                           
                    
                        </div>
                    </div>
                </div>
            </div>
          <!-- /.card -->

          
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div>
</div>
<script>

  function editType(id,cat_id,name,status){
  //alert(name);
 $("#name").val(name);
 $("#update_Type_id").val(id);
 $("#comm_cat").val(cat_id);
 $("#type_name").val(name);
 //$("input[name=status][value='"+status+"']").prop("checked",true);
 $("input:radio[value='"+status+"']").prop('checked',true);
  //var cityId = $("#cityId").val();
  }
function getCity(stateCode){
    var cityId = $("#cityId").val();
    //alert(cityId);
    var url="{{ URL::to('') }}"+"/get-cities";
    var postForm = { //Fetch form data
            'state_code'     : stateCode,
            'cityId' : cityId
            
        };
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: url ,                
                data: postForm,
                datatype: 'JSON',
                success: (response) => {
                  console.log(response);
                  if(response!='0'){
                    $("#city_name").empty();
                  $("#city_name").append(response);                  

                  }else{
                    
                  }
                    
                },
                error: function(response){
                    
                }
           });

    }
    
    </script>
@endsection

