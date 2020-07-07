@extends('frontend.dashboard.layout.master')

@section('title', 'Session Details')

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
        <a class="navbar-brand" href="#">Session Details</a>
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
              <h3 class="title">Session Details</h3>
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
            <div class="content">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Student Name</th>
                      <th>Credit Balance</th>
                      <th>Tutoring Subject</th>
                      <th>Initial Session</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Duration</th>
                      <th>Location</th>
                      <th>Recurs Weekly</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{SCT::getStudentName($session->student_id)->student_name}}</td>
                      <td>{{SCT::getClientCredit($session->user_id)->credit_balance}}</td>
                      <td>{{$session->subject}}</td>
                      <td>
                        @if($session->session_type =='First Session')
                        YES
                        @else
                        NO
                        @endif
                      </td>
                      <td>{{$session->date}}</td>
                      <?php
                      $time = date('h:i a', strtotime($session->time))
                       ?>
                      <td>{{$time}}</td>
                      <td>{{$session->duration}}</td>
                      <td>{{$session->location}}</td>
                      <td>{{$session->recurs_weekly}}</td>
                      <td>{{$session->status}}</td>
                      <td style="text-align: center;">
                        @if($session->status == 'Confirm')
                        <a href="javascript:;" onclick="EndSession('{{ $session->session_id }}')" class="btn btn-green" data-toggle="tooltip" data-original-title="Update">End Session</a>&nbsp;&nbsp;&nbsp;
                        <a href="javascript:;" onclick="CancelSession('{{ $session->session_id }}')" class="btn btn-danger" data-toggle="tooltip" data-original-title="Delete" style="margin-top: 4px;">Cancel Session</i></a>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="modal-endsession" role="dialog" class="modal fade in" data-backdrop="static" data-keyboard="false">
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
                    <h3>End Session</h3>
                    <p>Did you conduct the session and want to end session.</p>
                    <div class="m-t-lg">
                        <form method="post" id="end_session" action="">
                          {{csrf_field()}}
                            <input type="hidden" name="session_id" class="actionId">
                            <div class="form-group">
        											<label style="float:left;">Duration</label>
                              <select class="form-control border-input" name="duration" id="duration">
        												<option value="0:30" {{$session->duration == '0:30' ? 'selected=="selected"':''}}>0:30</option>
        												<option value="1:00" {{$session->duration == '1:00' ? 'selected=="selected"':''}}>1:00</option>
        												<option value="1:30" {{$session->duration == '1:30' ? 'selected=="selected"':''}}>1:30</option>
        												<option value="2:00" {{$session->duration == '2:00' ? 'selected=="selected"':''}}>2:00</option>
        											</select>
                            </div>
                            <button class="btn btn-green" id="end-btn" type="submit">Continue</button>
                            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<div id="modal-warning" role="dialog" class="modal fade in" data-backdrop="static" data-keyboard="false">
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
                        <form method="post" action="{{ url('user-portal/student/delete') }}">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="session_id" class="actionId">
                            <button class="btn btn-danger" type="button">Continue</button>
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
function doAction(){
    var userId = $('.actionId').val();
    if(userId != ''){
        alert('delete this '+userId);
    }
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
