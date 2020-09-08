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
                <table class="table table-bordered hidden-xs hidden-sm">
                  <thead>
                    <tr>
                      <th>Student Name</th>
                      <th>Credit Balance</th>
                      <th>Tutoring Subject</th>
                      <!-- <th>Initial Session</th> -->
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
                      <td>@if(SCT::getClientCredit($session->user_id) !='')
                        {{SCT::getClientCredit($session->user_id)->credit_balance}}
                        @else
                        0
                        @endif
                      </td>
                      <td>{{$session->subject}}</td>
                      <!-- <td>
                        @if($session->session_type =='First Session')
                        YES
                        @else
                        NO
                        @endif
                      </td> -->
                      <?php
                      if ($session->added_by == 'Admin') {
                        $tutor_timezone = $session->admin_timezone;
                        $admin_timezone =SCT::getClientName($session->tutor_id)->time_zone;
                        // Check session time zone and admin time zone
                        if ($tutor_timezone == $admin_timezone) {
                          $time = date('h:i a', strtotime($session->time));
                          $date = date('M d, ', strtotime($session->date));
                        }else {
                            if ($tutor_timezone == 'Pacific Time') {
                              date_default_timezone_set("America/Los_Angeles");
                            }elseif ($tutor_timezone == 'Mountain Time') {
                              date_default_timezone_set("America/Denver");
                            }elseif ($tutor_timezone == 'Central Time') {
                              date_default_timezone_set("America/Chicago");
                            }elseif ($tutor_timezone == 'Eastern Time') {
                              date_default_timezone_set("America/New_York");
                            }
                            $time1 = date('h:i a', strtotime($session->time));
                            $date = date('M d, ', strtotime($session->date));
                            $time_zone =SCT::getClientName($session->tutor_id)->time_zone;
                            // dd($time_zone);
                            $db_time = $session->date." ".$time1;
                            $datetime = new DateTime($db_time);
                            if ($time_zone == 'Pacific Time') {
                              $la_time = new DateTimeZone('America/Los_Angeles');
                              $datetime->setTimezone($la_time);
                            }elseif ($time_zone == 'Mountain Time') {
                              $la_time = new DateTimeZone('America/Denver');
                              $datetime->setTimezone($la_time);
                            }elseif ($time_zone == 'Central Time') {
                              $la_time = new DateTimeZone('America/Chicago');
                              $datetime->setTimezone($la_time);
                            }elseif ($time_zone == 'Eastern Time') {
                              $la_time = new DateTimeZone('America/New_York');
                              $datetime->setTimezone($la_time);
                            }
                            $newdatetime = $datetime->format('Y-m-d h:i a');
                            $get_datetime = explode(' ',$newdatetime);
                            $time2 = $get_datetime[1];
                            $time3 = $get_datetime[2];
                            $time = $time2." ".$time3;
                        }
                      }else {
                        // Added by Tutor
                        $tutor_timezone =SCT::getClientName($session->tutor_id)->time_zone;
                      if ($tutor_timezone == 'Pacific Time') {
                        date_default_timezone_set("America/Los_Angeles");
                      }elseif ($tutor_timezone == 'Mountain Time') {
                        date_default_timezone_set("America/Denver");
                      }elseif ($tutor_timezone == 'Central Time') {
                        date_default_timezone_set("America/Chicago");
                      }elseif ($tutor_timezone == 'Eastern Time') {
                        date_default_timezone_set("America/New_York");
                      }
                      $time1 = date('h:i a', strtotime($session->time));
                      $date = date('M d, ', strtotime($session->date));
                      $time_zone =SCT::getClientName($session->tutor_id)->time_zone;
                      // dd($time_zone);
                      $db_time = $session->date." ".$time1;
                      $datetime = new DateTime($db_time);
                      if ($time_zone == 'Pacific Time') {
                        $la_time = new DateTimeZone('America/Los_Angeles');
                        $datetime->setTimezone($la_time);
                      }elseif ($time_zone == 'Mountain Time') {
                        $la_time = new DateTimeZone('America/Denver');
                        $datetime->setTimezone($la_time);
                      }elseif ($time_zone == 'Central Time') {
                        $la_time = new DateTimeZone('America/Chicago');
                        $datetime->setTimezone($la_time);
                      }elseif ($time_zone == 'Eastern Time') {
                        $la_time = new DateTimeZone('America/New_York');
                        $datetime->setTimezone($la_time);
                      }
                      $newdatetime = $datetime->format('Y-m-d h:i a');
                      $get_datetime = explode(' ',$newdatetime);
                      $time2 = $get_datetime[1];
                      $time3 = $get_datetime[2];
                      $time = $time2." ".$time3;
                    }
                      ?>
                      <td>{{$date}}</td>
                      <td>{{$time}}</td>
                      <td>{{$session->duration}}</td>
                      <td>{{$session->location}}</td>
                      <td>{{$session->recurs_weekly}}</td>
                      <td>
                        <?php
                          if ($session->status == 'Confirm') {
                            $status = 'Confirmed';
                          }elseif ($session->status == 'Cancel') {
                            $status = 'Canceled';
                          }elseif ($session->status == 'End'){
                            $status = 'Completed';
                          }else {
                            $status = $session->status;
                          }
                         ?>
                        {{$status}}
                      </td>
                      <td style="text-align: center;">
                        @if($session->status == 'Confirm')
                        <?php
                        // date_default_timezone_set("Asia/Karachi");
                        $tutor_timezone = SCT::getClientName($session->tutor_id)->time_zone;
                        if ($tutor_timezone == 'Pacific Time') {
                          date_default_timezone_set("America/Los_Angeles");
                        }elseif ($tutor_timezone == 'Mountain Time') {
                          date_default_timezone_set("America/Denver");
                        }elseif ($tutor_timezone == 'Central Time') {
                          date_default_timezone_set("America/Chicago");
                        }elseif ($tutor_timezone == 'Eastern Time') {
                          date_default_timezone_set("America/New_York");
                        }
                        $show='';
                        $date1 =date("Y-m-d");
                        $date2 = date("Y-m-d", strtotime($session->date));
                        if ($date1 == $date2) {
                          $time1 = date("h:i");
                          $time2 = date("h:i", strtotime($session->time));
                          if ($time1 >=$time2) {
                            $show = 'show';
                          }
                        }
                         ?>
                        @if($show !='')
                        <!-- <a href="javascript:;" onclick="EndSession('{{ $session->session_id }}')" class="btn btn-green" data-toggle="tooltip" data-original-title="Update">End Session</a>&nbsp;&nbsp;&nbsp; -->
                        @endif
                        <a href="{{ url('user-portal/session/edit/'.$session->session_id) }}" class="btn btn-green" data-toggle="tooltip" data-original-title="Update" style="margin-top: 4px;">Edit Session</a>&nbsp;&nbsp;&nbsp;
                        <a href="javascript:;" onclick="CancelSession('{{ $session->session_id }}')" class="btn btn-danger" data-toggle="tooltip" data-original-title="Delete" style="margin-top: 4px;">Cancel Session</i></a>
                        @elseif($session->status == 'Insufficient Credit' || $session->status == 'Cancel')
                        <a href="javascript:;" onclick="CancelSession('{{ $session->session_id }}')" class="btn btn-danger" data-toggle="tooltip" data-original-title="Delete" style="margin-top: 4px;">Cancel Session</i></a>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>

                <table class="table table-bordered hidden-md hidden-lg">
                  <thead>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Student Name</td>
                      <td>{{SCT::getStudentName($session->student_id)->student_name}}</td>
                    </tr>
                    <tr>
                      <td>Credit Balance</td>
                      <td>@if(SCT::getClientCredit($session->user_id) !='')
                        {{SCT::getClientCredit($session->user_id)->credit_balance}}
                        @else
                        0
                        @endif
                      </td>
                    </tr>
                      <tr>
                        <td>Tutoring Subject</td>
                        <td>{{$session->subject}}</td>
                      </tr>
                      <?php
                      $time = date('h:i a', strtotime($session->time));
                      $date = date('M d, Y', strtotime($session->date));
                       ?>
                       <tr>
                         <td>Date</td>
                         <td>{{$date}}</td>
                       </tr>
                       <tr>
                         <td>Time</td>
                         <td>{{$time}}</td>
                       </tr>
                       <tr>
                         <td>Duration</td>
                         <td>{{$session->duration}}</td>
                       </tr>
                       <tr>
                         <td>Location</td>
                         <td>{{$session->location}}</td>
                       </tr>
                       <tr>
                         <td>Recurs Weekly</td>
                         <td>{{$session->recurs_weekly}}</td>
                       </tr>
                       <tr>
                         <td>Status</td>
                         <td>
                           <?php
                           if ($session->status == 'Confirm') {
                             $status = 'Confirmed';
                           }elseif ($session->status == 'Cancel') {
                             $status = 'Canceled';
                           }elseif ($session->status == 'End'){
                             $status = 'Completed';
                           }else {
                             $status = $session->status;
                           }
                           ?>
                           {{$status}}
                         </td>
                       </tr>
                       <tr>
                         <td>Action</td>
                         <td style="text-align: center;">
                           @if($session->status == 'Confirm')
                           <?php
                           $tutor_timezone = SCT::getClientName($session->tutor_id)->time_zone;
                           if ($tutor_timezone == 'Pacific Time') {
                             date_default_timezone_set("America/Los_Angeles");
                           }elseif ($tutor_timezone == 'Mountain Time') {
                             date_default_timezone_set("America/Denver");
                           }elseif ($tutor_timezone == 'Central Time') {
                             date_default_timezone_set("America/Chicago");
                           }elseif ($tutor_timezone == 'Eastern Time') {
                             date_default_timezone_set("America/New_York");
                           }
                           // date_default_timezone_set("Asia/Karachi");
                           $show='';
                           $date1 =date("Y-m-d");
                           $date2 = date("Y-m-d", strtotime($session->date));
                           if ($date1 == $date2) {
                             $time1 = date("h:i");
                             $time2 = date("h:i", strtotime($session->time));
                             if ($time1 >=$time2) {
                               $show = 'show';
                             }
                           }
                            ?>
                           @if($show !='')
                           <a href="javascript:;" onclick="EndSession('{{ $session->session_id }}')" class="btn btn-green" data-toggle="tooltip" data-original-title="Update">End Session</a>&nbsp;&nbsp;&nbsp; <br>
                           @endif
                           <a href="{{ url('user-portal/session/edit/'.$session->session_id) }}" class="btn btn-green" data-toggle="tooltip" data-original-title="Update" style="margin-top: 4px;">Edit Session</a>&nbsp;&nbsp;&nbsp; <br>
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
                        <form method="post" action="{{ url('user-portal/cancel-session') }}">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="session_id" class="actionId">
                            <div class="form-group">
                              <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="notify_client" id="notify_client" value="1" checked> Notify client of cancellation
                              </label>
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
function CancelSession(sessionId){
    $('.actionId').val(sessionId);
    $('#modal-cancelsession').modal();
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
