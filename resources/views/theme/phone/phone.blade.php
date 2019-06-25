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
    <li class="breadcrumb-item active">Cell Phone</li>
  </ol>

  <!-- DataTables Example -->
  <div class="card mb-3 addPhone" style="display: none;">
    <div class="card-header">
      <i class="fas fa-table"></i>Add Cell Phone
      <button class="float-right listPhoneBTN btn btn-warning">Cell Phone List</button>
    </div>
    <div class="card-body">
      {{ Form::open(array('id' => 'addPhoneForm','enctype' => 'multipart/form-data')) }}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('email', 'Cell Phone Name') }}
              {{Form::text('cp_name', $value = null, $attributes = array('class' => 'form-control','required'))}}
            </div>
            <div class="form-group">
              {{ Form::label('type', 'Cell Phone Type') }}
              {{Form::text('cp_color', $value = null, $attributes = array('class' => 'form-control','required'))}}
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Cell Phone Model No') }}
              {{Form::text('cp_model_no', $value = null, $attributes = array('class' => 'form-control', 'required'))}}
            </div>
          </div>
          <div class="col-md-6">
            {{ Form::label('email', 'Cell Phone Image') }}
            <div class="input-group mb-3">
              <div class="custom-file">
                {{Form::file('cp_img', $attributes = array('class' => 'custom-file-input','id' => 'inputGroupFile02', 'required'))}}
                {{ Form::label('Choose file', 'Car Image',$attributes = array('class' => 'custom-file-label','for' => 'inputGroupFile02')) }}
              </div>
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Cell Phone Color') }}
              {{Form::text('cp_price', $value = null, $attributes = array('class' => 'form-control', 'required'))}}
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Cell Phone Company') }}
              {{Form::text('cp_company', $value = null, $attributes = array('class' => 'form-control', 'required'))}}
            </div>
          </div>
        </div>
          <button type="submit" class="btn btn-success float-right">Add</button>
      {{ Form::close() }}
    </div>
  </div>


  <!-- DataTables Example -->
  <div class="card mb-3 editPhone" style="display: none;">
    <div class="card-header">
      <i class="fas fa-table"></i>Add Cell Phone
      <button class="float-right listPhoneBTN btn btn-warning">Cell Phone List</button>
    </div>
    <div class="card-body">
      {{ Form::open(array('id' => 'editPhoneForm','enctype' => 'multipart/form-data')) }}
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              {{ Form::label('email', 'Cell Phone Name') }}
              {{Form::text('cp_name', $value = null, $attributes = array('class' => 'form-control cp_name', 'required'))}}
            </div>
            <div class="form-group">
              {{ Form::label('type', 'Cell Phone Type') }}
              {{Form::text('cp_color', $value = null, $attributes = array('class' => 'form-control cp_color', 'required'))}}
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Cell Phone Model No') }}
              {{Form::text('cp_model_no', $value = null, $attributes = array('class' => 'form-control cp_model_no', 'required'))}}
            </div>
          </div>
          <div class="col-md-5">
            {{ Form::label('email', 'Cell Phone Image') }}
            <div class="input-group mb-3">
              <div class="custom-file">
                {{Form::file('cp_img', $attributes = array('class' => 'custom-file-input','id' => 'inputGroupFile02'))}}
                {{ Form::label('Choose file', 'Car Image',$attributes = array('class' => 'custom-file-label','for' => 'inputGroupFile02')) }}
              </div>
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Cell Phone Color') }}
              {{Form::text('cp_price', $value = null, $attributes = array('class' => 'form-control cp_price', 'required'))}}
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Cell Phone Company') }}
              {{Form::text('cp_company', $value = null, $attributes = array('class' => 'form-control cp_company', 'required'))}}
            </div>
          </div>
          <div class="col-md-2 show_img">

          </div>
        </div>
          <input type="hidden" class="phone_id" name="id">
          {{Form::submit('Edit',$attributes = array('class' => 'btn btn-success float-right'))}}
      {{ Form::close() }}
    </div>
  </div>

  <div class="card mb-3 listPhone">
    <div class="card-header">
      <i class="fas fa-table"></i>Cell phone List
      <button class="float-right addPhoneBTN btn btn-warning">Add New Cell phone</button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dt_basic" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="5%" data-hide="phone">ID</th>
              <th width="50px" data-class="expand"><i class="fa fa-fw fa-link text-muted hidden-md hidden-sm hidden-xs"></i>Image</th>
              <th data-class="expand"><i class="fa fa-fw fa-link text-muted hidden-md hidden-sm hidden-xs"></i>Name</th>
              <th data-class="expand"><i class="fa fa-fw fa-link text-muted hidden-md hidden-sm hidden-xs"></i>Color</th>
              <th data-hide="phone"><i class="fa fa-fw fa-link text-muted hidden-md hidden-sm hidden-xs"></i> Price</th>
              <th data-hide="phone"><i class="fa fa-fw fa-link text-muted hidden-md hidden-sm hidden-xs"></i> Model No</th>
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
                   "url": '{!!route('get_cell_phone')!!}',
                   "dataType": "json",
                   "type": "POST",
                   "data":{_token: "{{csrf_token()}}"}
                 },
          "columns": [
              { "data": "id" },
              { "data": "cp_img" },
              { "data": "cp_name" },
              { "data": "cp_color" },
              { "data": "cp_price" },
              { "data": "cp_model_no" },
              { "data": "cp_company" },
              { "data": "action" },
          ],
          responsive: true,
          order: [[0, 'desc']]
    });
  }

  $("body").on("click", ".listPhoneBTN", function(event){
    $('.addPhone').hide();
    $('.editPhone').hide();
    $('.listPhone').slideDown("slow");
  });

  $("body").on("click", ".addPhoneBTN", function(event){
    $('input').val('');
    $('.listPhone').hide();
    $('.addPhone').slideDown("slow");
  }); 

  $("body").on("click", ".editPhoneBTN", function(event){
    $('.listPhone').hide();
    $('.editPhone').slideDown("slow");

    var id = $(this).attr('data-id');
    $.ajax({
      type: "POST",
      url: '{!!route('show_cell_phone')!!}',
      data: {id:id},
      dataType: "json",
      success: function( data ) {
        console.log(data);
        if(data)
        {
          $('.cp_name').val(data.cp_name);
          $('.cp_color').val(data.cp_color);
          $('.cp_price').val(data.cp_price);
          $('.cp_model_no').val(data.cp_model_no);
          $('.cp_company').val(data.cp_company);
          $('.phone_id').val(data.id);
          if(data.cp_img != '')
          {
            $('.show_img').html('<img src="{!!asset('upload/phone/') !!}/'+data.cp_img+'" height="250px" width="100%">');
          }
          else
          {
            $('.show_img').html('<p style="margin-top: 34px;">Image not exist<p>');
          }
        }
        else
        {
          Swal.fire('Oops...', 'Something went wrong!', 'error');
        }
    }});

  }); 

  $("body").on("submit", "#addPhoneForm", function(event){
    event.preventDefault();

    $.ajax({
          type: "POST",
          url: '{!!route('add_cell_phone')!!}',
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
              $('.addPhone').hide();
              $('.editPhone').hide();
              $('.listPhone').slideDown("slow");
            }
            else
            {
              Swal.fire('Oops...', 'Something went wrong!', 'error');
            }
        }});

  });

  $("body").on("submit", "#editPhoneForm", function(event){
    event.preventDefault();
    
    $.ajax({
          type: "POST",
          url: '{!!route('update_cell_phone')!!}',
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
              $('.addPhone').hide();
              $('.editPhone').hide();
              $('.listPhone').slideDown("slow");
            }
            else
            {
              Swal.fire('Oops...', 'Something went wrong!', 'error');
            }
        }});

  });

  $("body").on("click", ".delete_phone", function(event){
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
            url: '{!!route('delete_cell_phone')!!}',
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
