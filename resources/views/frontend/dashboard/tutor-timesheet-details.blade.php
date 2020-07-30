@extends('frontend.dashboard.layout.master')

@section('title', 'Timesheet Details')

@section('styling')

@endsection
@section('content')

@include('frontend.dashboard.menu.menu')

<div class="main-panel">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar bar1"></span>
        <span class="icon-bar bar2"></span>
        <span class="icon-bar bar3"></span>
        </button>
        <a class="navbar-brand" href="#">Timesheet Details</a>
      </div>
    </div>
  </nav>
  <div class="content">
    <div class="container-fluid app-view-mainCol">
      <div class="row">
        <!-- <div class="col-lg-4 col-md-5 app-view-mainCol">
          <div class="cards cards-user">
            <div class="image">
              <img src="{{asset('frontend-assets/images/dashboard/background.jpg')}}" alt="...">
            </div>
            <div class="content">
              <div class="author">
                <div class="re-img-box">
                  <img class="avatar border-white" src="" alt="...">
                  <div class="re-img-toolkit">
                    <div class="re-file-btn">
                      Change <i class="fa fa-camera"></i>
                      <input type="file" class="upload" id="imageFile"  name="image"  onchange="uploadpicture(this)">
                    </div>
                  </div>
                </div>
                <h4 class="title" id="userName">Zeeshan<br>
                </h4>
              </div>
            </div>
            <hr>
            <div class="text-center">
              <div class="row">
              </div>
            </div>
          </div>
        </div> -->
        <div class="col-lg-12 col-md-12 app-view-mainCol">
          <div class="cards">
            <div class="header">
              <h3 class="title">Timesheet Details</h3>
              <hr>
              @include('frontend.dashboard.menu.alerts')
              @if(Session::has('message'))
        			<div class="alert alert-success">
        				 {{ Session::get('message') }}
        				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        				 <span aria-hidden="true">&times;</span>
        				 </button>
        			</div>
        			@endif
            </div>
            <div class="content hidden-sm hidden-xs">
              <div class="table-responsive">
                <table class="table  table-bordered">
                  <thead>
                    <tr>
                      <th>Student Name</th>
                      <th>Date</th>
                      <th>Duration</th>
                      <th>Session Description</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{SCT::getStudentName($timesheet->student_id)->student_name}}</td>
                      <td>{{$timesheet->date}}</td>
                      <td>{{$timesheet->duration}}</td>
                      <td>{{$timesheet->description}}</td>
                      <td>
                        <a href="{{ url('user-portal/timesheet/edit/'.$timesheet->timesheet_id) }}" data-toggle="tooltip" data-original-title="Update"><i class="ti-pencil"></i></a>&nbsp;&nbsp;&nbsp;
                        <a href="javascript:;" onclick="deleteTimesheet('{{ $timesheet->timesheet_id }}')" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="hidden-md hidden-lg">
            <table class="table table-bordered ">
              <thead>
              </thead>
              <tbody>
                <tr>
                  <td>Student Name</td>
                  <td>{{SCT::getStudentName($timesheet->student_id)->student_name}}</td>
                </tr>
                <tr>
                  <td>Date</td>
                  <td>{{$timesheet->date}}</td>
                </tr>
                  <tr>
                    <td>Duration</td>
                    <td>{{$timesheet->duration}}</td>
                  </tr>
                   <tr>
                     <td>Session Description</td>
                     <td>{{$timesheet->description}}</td>
                   </tr>
                   <tr>
                     <td>Action</td>
                     <td>
                       <a href="{{ url('user-portal/timesheet/edit/'.$timesheet->timesheet_id) }}" data-toggle="tooltip" data-original-title="Update"><i class="ti-pencil"></i></a>&nbsp;&nbsp;&nbsp;
                       <a href="javascript:;" onclick="deleteTimesheet('{{ $timesheet->timesheet_id }}')" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>
                     </td>
                   </tr>
              </tbody>
            </table>
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="modal-deleteTimesheet" role="dialog" class="modal fade in" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content bg-warning animated bounceIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <span class="icon icon-exclamation-triangle icon-5x"></span>
                    <h3>Are you sure?</h3>
                    <p>You will not be able to undo this action.</p>

                    <div class="m-t-lg">
                        <form method="post" action="{{ url('user-portal/delete-timesheet') }}">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="timesheet_id" class="actionId">
                            <button class="btn btn-danger" type="submit">Continue</button>
                            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
function EndSession(sessionId){
    $('.actionId').val(sessionId);
    $('#modal-endsession').modal();
}
// function doAction(){
//     var userId = $('.actionId').val();
//     if(userId != ''){
//         alert('delete this '+userId);
//     }
// }
function deleteTimesheet(sessionId){
    $('.actionId').val(sessionId);
    $('#modal-deleteTimesheet').modal();
}

$("#end_session").submit(function (e) {
  e.preventDefault();
  var formvalue = $('form#end_session');
	form = new FormData(formvalue[0]);
  console.log(form);
  var actionUrl = "{{ url('/user-portal/end-session')}}";

  $.ajax({
    type: "POST",
    url: actionUrl,
    data: form,
		cache: false,
		contentType: false,
		processData: false,
    success: function(data){
      window.location.reload();
    },
    error: function() {
      alert("Error posting feed");
    }
  });
  //return false;
});

</script>
@endsection
