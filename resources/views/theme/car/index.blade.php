@extends($theme)
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
@endsection
@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{route('home')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Cars</li>
  </ol>

  <!-- DataTables Example -->
  <div class="card mb-3 addCar" style="display: none;">
    <div class="card-header">
      <i class="fas fa-table"></i>Add Car
      <button class="float-right listCarBTN btn btn-warning">Car List</button>
    </div>
    <div class="card-body">
      {{ Form::open(array('id' => 'addCarForm','enctype' => 'multipart/form-data')) }}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('email', 'Car Name') }}
              {{Form::text('car_name', $value = null, $attributes = array('class' => 'form-control','required'))}}
            </div>
            <div class="form-group">
              {{ Form::label('type', 'Car Type') }}
              {{Form::text('car_type', $value = null, $attributes = array('class' => 'form-control','required'))}}
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Car Model No') }}
              {{Form::text('car_model_no', $value = null, $attributes = array('class' => 'form-control', 'required'))}}
            </div>
          </div>
          <div class="col-md-6">
            {{ Form::label('email', 'Image') }}
            <div class="input-group mb-3">
              <div class="custom-file">
                {{Form::file('car_img', $attributes = array('class' => 'custom-file-input','id' => 'inputGroupFile02', 'required'))}}
                {{ Form::label('Choose file', 'Car Image',$attributes = array('class' => 'custom-file-label','for' => 'inputGroupFile02')) }}
              </div>
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Car Color') }}
              {{Form::text('car_color', $value = null, $attributes = array('class' => 'form-control', 'required'))}}
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Car Company') }}
              {{Form::text('car_company', $value = null, $attributes = array('class' => 'form-control', 'required'))}}
            </div>
          </div>
        </div>
          <button type="submit" class="btn btn-success float-right">Add</button>
      {{ Form::close() }}
    </div>
  </div>


  <!-- DataTables Example -->
  <div class="card mb-3 editCar" style="display: none;">
    <div class="card-header">
      <i class="fas fa-table"></i>Add Car
      <button class="float-right listCarBTN btn btn-warning">Car List</button>
    </div>
    <div class="card-body">
      {{ Form::open(array('id' => 'editCarForm','enctype' => 'multipart/form-data')) }}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('email', 'Car Name') }}
              {{Form::text('car_name', $value = null, $attributes = array('class' => 'form-control car_name', 'required'))}}
            </div>
            <div class="form-group">
              {{ Form::label('type', 'Car Type') }}
              {{Form::text('car_type', $value = null, $attributes = array('class' => 'form-control car_type', 'required'))}}
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Car Model No') }}
              {{Form::text('car_model_no', $value = null, $attributes = array('class' => 'form-control car_model_no', 'required'))}}
            </div>
          </div>
          <div class="col-md-6">
            {{ Form::label('email', 'Image') }}
            <div class="input-group mb-3">
              <div class="custom-file">
                {{Form::file('car_img', $attributes = array('class' => 'custom-file-input','id' => 'inputGroupFile02'))}}
                {{ Form::label('Choose file', 'Car Image',$attributes = array('class' => 'custom-file-label','for' => 'inputGroupFile02')) }}
              </div>
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Car Color') }}
              {{Form::text('car_color', $value = null, $attributes = array('class' => 'form-control car_color', 'required'))}}
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Car Company') }}
              {{Form::text('car_company', $value = null, $attributes = array('class' => 'form-control car_company', 'required'))}}
            </div>
          </div>
        </div>
          <input type="hidden" class="car_id" name="id">
          {{Form::submit('Edit',$attributes = array('class' => 'btn btn-success float-right'))}}
      {{ Form::close() }}
    </div>
  </div>

  <div class="card mb-3 listCar">
    <div class="card-header">
      <i class="fas fa-table"></i>Car List
      <button class="float-right addCarBTN btn btn-warning">Add New Car</button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dt_basic" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="5%" data-hide="phone">ID</th>
              <th width="50px" data-class="expand"><i class="fa fa-fw fa-link text-muted hidden-md hidden-sm hidden-xs"></i>Image</th>
              <th data-class="expand"><i class="fa fa-fw fa-link text-muted hidden-md hidden-sm hidden-xs"></i>Name</th>
              <th data-class="expand"><i class="fa fa-fw fa-link text-muted hidden-md hidden-sm hidden-xs"></i>Type</th>
              <th data-hide="phone"><i class="fa fa-fw fa-link text-muted hidden-md hidden-sm hidden-xs"></i> Model No</th>
              <th data-hide="phone"><i class="fa fa-fw fa-link text-muted hidden-md hidden-sm hidden-xs"></i> Color</th>
              <th data-hide="phone,tablet"><i class="fa fa-fw fa-link text-muted hidden-md hidden-sm hidden-xs"></i> Company</th>
              <th width="100px" data-hide="phone,tablet"><i class="fa fa-fw fa-cog txt-color-blue hidden-md hidden-sm hidden-xs"></i> Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection
@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11 -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
<script type="text/javascript">
  getAllData();

  var responsiveHelper_dt_basic = undefined;
  
  var breakpointDefinition = {
    tablet : 1024,
    phone : 480
  };

  function getAllData()
  {
    $("#dt_basic").dataTable().fnDestroy();
    $('#dt_basic').dataTable({
      "processing": true,
      "serverSide": true,
      "ajax":{
                   "url": '{!!route('getCars')!!}',
                   "dataType": "json",
                   "type": "POST",
                   "data":{_token: "{{csrf_token()}}"}
                 },
          "columns": [
              { "data": "id" },
              { "data": "car_img" },
              { "data": "car_name" },
              { "data": "car_type" },
              { "data": "car_model_no" },
              { "data": "car_color" },
              { "data": "car_company" },
              { "data": "action" },
          ],
          responsive: true,
          order: [[0, 'desc']]
    });
  }

  $("body").on("click", ".listCarBTN", function(event){
    $('.addCar').hide();
    $('.editCar').hide();
    $('.listCar').slideDown("slow");
  });

  $("body").on("click", ".addCarBTN", function(event){
    $('input').val('');
    $('.listCar').hide();
    $('.addCar').slideDown("slow");
  }); 

  $("body").on("click", ".editCarBTN", function(event){
    $('.listCar').hide();
    $('.editCar').slideDown("slow");

    var id = $(this).attr('data-id');
    $.ajax({
      type: "POST",
      url: '{!!route('showCars')!!}',
      data: {id:id},
      dataType: "json",
      success: function( data ) {
        if(data)
        {
          $('.car_name').val(data.car_name);
          $('.car_type').val(data.car_type);
          $('.car_model_no').val(data.car_model_no);
          $('.car_color').val(data.car_color);
          $('.car_company').val(data.car_company);
          $('.car_id').val(data.id);
        }
        else
        {
          Swal.fire('Oops...', 'Something went wrong!', 'error');
        }
    }});

  }); 

  $("body").on("submit", "#addCarForm", function(event){
    event.preventDefault();

    $.ajax({
          type: "POST",
          url: '{!!route('addCars')!!}',
          data: new FormData(this),
          dataType:'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success: function( data ) {
            if(data)
            { 
              Swal.fire('Record added successfuly!');
              getAllData();
              $('.addCar').hide();
              $('.editCar').hide();
              $('.listCar').slideDown("slow");
            }
            else
            {
              Swal.fire('Oops...', 'Something went wrong!', 'error');
            }
        }});

  });

  $("body").on("submit", "#editCarForm", function(event){
    event.preventDefault();
    
    $.ajax({
          type: "POST",
          url: '{!!route('updateCar')!!}',
          data: new FormData(this),
          dataType: "json",
          contentType: false,
          cache: false,
          processData: false,
          success: function( data ) {
            if(data)
            { 
              Swal.fire('Record updated successfuly!');
              getAllData();
              $('.addCar').hide();
              $('.editCar').hide();
              $('.listCar').slideDown("slow");
            }
            else
            {
              Swal.fire('Oops...', 'Something went wrong!', 'error');
            }
        }});

  });

  $("body").on("click", ".delete_car", function(event){
    var id = $(this).attr('data-id');
    Swal.fire({
      title: 'Are you sure?',
      text: 'Delete this record!',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, keep it'
    }).then((result) => {
      if (result.value) {
          $(this).closest("tr").remove();
          $.ajax({
            type: "POST",
            url: '{!!route('deleteCars')!!}',
            data: {id:id},
            dataType: "json",
            success: function( data ) {
              if(data)
              { 
                Swal.fire('Record deleted successfuly!');
              }
              else
              {
                Swal.fire('Oops...', 'Something went wrong!', 'error');
              }
          }});
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire(
          'Cancelled',
          'Your record is safe :)',
          'error'
        )
      }
    })

  });
</script>
@endsection
