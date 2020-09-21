@extends('frontend.dashboard.layout.master')

@section('title', 'Session Details')

@section('styling')
<style>
::-webkit-scrollbar {
  -webkit-appearance: none;
}

::-webkit-scrollbar:vertical {
  width: 12px;
}

::-webkit-scrollbar:horizontal {
  height: 12px;
}

::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, .5);
  border-radius: 10px;
  border: 2px solid #ffffff;
}

::-webkit-scrollbar-track {
  border-radius: 10px;
  background-color: #ffffff;
}
</style>
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
                <table class="table table-bordered hidden-xs hidden-sm">
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
                      <?php
                      // Eastern ........... America/New_York
                      // Central ........... America/Chicago
                      // Mountain .......... America/Denver
                      // Pacific ........... America/Los_Angeles
                      if ($session->added_by == 'Admin') {
                        $tutor_timezone = $session->admin_timezone;
                        $admin_timezone =SCT::getClientName($session->user_id)->time_zone;
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
                            $time_zone =SCT::getClientName($session->user_id)->time_zone;
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
                      $time1 = date('h:i a', strtotime($session->time));
                      $date = date('M d, Y', strtotime($session->date));
                      $time_zone =SCT::getClientName($session->user_id)->time_zone;
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
                      // dd($time1,$time);
                       ?>
                      <td>{{$date}}</td>
                      <td>{{$time}}</td>
                      <td>{{$session->duration}}</td>
                      <td>{{$session->location}}</td>
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

                <table class="table table-bordered hidden-md hidden-lg">
                  <thead>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Student Name</td>
                      <td>{{SCT::getStudentName($session->student_id)->student_name}}</td>
                    </tr>
                      <tr>
                        <td>Tutor</td>
                        <td>{{SCT::getClientName($session->tutor_id)->first_name}} {{SCT::getClientName($session->tutor_id)->last_name}}</td>
                      </tr>
                      <tr>
                        <td>Tutoring Subject</td>
                        <td>{{$session->subject}}</td>
                      </tr>
                      <?php
                      // Eastern ........... America/New_York
                      // Central ........... America/Chicago
                      // Mountain .......... America/Denver
                      // Pacific ........... America/Los_Angeles
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
                      $time1 = date('h:i a', strtotime($session->time));
                      $date = date('M d, Y', strtotime($session->date));
                      $time_zone =SCT::getClientName($session->user_id)->time_zone;
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
                      // dd($time1,$time);
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
