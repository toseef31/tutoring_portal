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
              @if($session->status == 'Insufficient Credit')
              <h4>Insufficient credits remain for this session</h4>
              @else
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Student Name</th>
                      <th>Tutor</th>
                      <th>Tutoring Subject</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Duration</th>
                      <th>Location</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{SCT::getStudentName($session->student_id)->student_name}}</td>
                      <td>{{SCT::getClientName($session->tutor_id)->first_name}} {{SCT::getClientName($session->tutor_id)->last_name}}</td>
                      <td>{{$session->subject}}</td>
                      <td>{{$session->date}}</td>
                      <?php
                      $time = date('h:i a', strtotime($session->time))
                       ?>
                      <td>{{$time}}</td>
                      <td>{{$session->duration}}</td>
                      <td>{{$session->location}}</td>
                      <td>{{$session->status}}</td>
                      <td style="text-align: center;">
                        @if($session->status == 'Confirm')
                        <?php
                        // Eastern ........... America/New_York
                        // Central ........... America/Chicago
                        // Mountain .......... America/Denver
                        // Pacific ........... America/Los_Angeles
                        date_default_timezone_set("Asia/Karachi");
                        $cancel='';
                        $combinedDT = date('Y-m-d H:i:s', strtotime("$session->date $session->time"));
                        $date1 =date("Y-m-d H:i:s");
                        $date2 = date("Y-m-d H:i:s", strtotime('-24 hours',strtotime($combinedDT)));
                        // dd($date1,$date2,$combinedDT);
                        if ($date1 <= $date2) {
                          $cancel = 'yes';
                        }
                         ?>
                        @if($cancel !='')
                        <a href="javascript:;" onclick="CancelSession('{{ $session->session_id }}')" class="btn btn-danger" data-toggle="tooltip" data-original-title="Delete" style="margin-top: 4px;">Cancel Session</i></a>
                        @endif
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              @endif
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="modal-cancelsession" role="dialog" class="modal fade in" data-backdrop="static" data-keyboard="false">
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
                        <form method="post" action="{{ url('user-portal/client-cancel-session') }}">
                            <input type="hidden" name="_method" value="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="session_id" class="actionId">
                            <div class="form-group">
        											<label style="float:left;">Cancellation Reason</label>
                              <textarea name="reason" class="form-control" rows="4" cols="30" placeholder="Cancellation Reason" required></textarea>
                            </div>
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
// function doAction(){
//     var userId = $('.actionId').val();
//     if(userId != ''){
//         alert('delete this '+userId);
//     }
// }
function CancelSession(sessionId){
    $('.actionId').val(sessionId);
    $('#modal-cancelsession').modal();
}

</script>
@endsection
