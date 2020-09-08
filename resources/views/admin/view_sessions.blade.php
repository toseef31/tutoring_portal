@extends('admin.layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/fullcalendar.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/fullcalendar.print.min.css') }}" media='print'>
<style>
#calendar {
  max-width: 900px;
  margin: 0 auto;
}
.past div.fc-time, .past div.fc-title {
            text-decoration: line-through;
        }
a.cancel .fc-content .fc-title ,a.cancel .fc-content .fc-time {
  text-decoration: line-through;
}
/* red event */
a.cancel .fc-content .fc-title ,a.low-credit .fc-content .fc-time {
  background: red !important;
  border: 1px solid red !important;
}
a.cancel  {
  border-color: red !important;
  background: red !important;
}
a.cancel .fc-content {
  border-color: red !important;
  background: red !important;
}
/* yellow event */
a.low-credit .fc-content .fc-title ,a.low-credit .fc-content .fc-time {
  background: #dcdc25 !important;
  border: 1px solid #dcdc25 !important;
}
a.low-credit  {
  border-color: #dcdc25 !important;
  background: #dcdc25 !important;
}
a.low-credit .fc-content {
  border-color: #dcdc25 !important;
  background: #dcdc25 !important;
}
.fc-day-grid-event > .fc-content {
    white-space: normal;
}
@media (max-width:767px){
.fc .fc-toolbar>*>* {
  font-size: 16px;
}
.fc-toolbar h2{
  margin-top: 12px;
}
}
</style>
<?php
$searchBy = array('first_name' => 'Tutor First Name', 'last_name' => 'Tutor Last Name');
$s_app = Session()->get('sessionsSearch');
?>
  <div class="wrapper">
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Sessions</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav">

              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{Session::get('sct_admin')->first_name}}
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{ url('dashboard/logout') }}">Logout</a>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-sm">


</div> -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              @include('admin.includes.alerts')
              <div class="card-header">
                <h4 class="card-title"> Sessions <a href="{{url('dashboard/session/add')}}" style="float:right;font-size: 15px;font-size: 12px; color:white;" type="button" class="btn btn-md btn-primary">Schedule New Session</a></h4>
              </div>

              <div class="card-body">
                  @if(session()->has('message'))
                    <div class="row">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {{session()->get('message')}}
                      </div>
                    </div>
                  @endif
                  <!-- Calendar Start -->
                  <div id='calendar'></div>
                  <!-- Calendar Ends -->
                  <div class="" style="margin-top:20px;">
                    @if(count($tutor_sessions) > 0)
                    <ul style="list-style-type: none;">
                      @foreach($tutor_sessions as $session)
                      <?php
                      // $time = date('h:i a', strtotime($session->time));
                      //  $date = date('M d, ', strtotime($session->date));
                      // Added By Admin
                      if ($session->added_by == 'Admin') {
                        $tutor_timezone = $session->admin_timezone;
                        $admin_timezone = Session::get('sct_admin')->time_zone;
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
                        $tutor_timezone = Session::get('sct_admin')->time_zone;
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
                       @if($session->status == 'Cancel' || $session->status == 'Insufficient Credit')
                       <li><a href="{{url('dashboard/session-details/'.$session->session_id)}}" style="background: red;color: white;border-radius: 4px;"><span style="padding: 10px;">@if($session->status == 'Cancel' || $session->status == 'Insufficient Credit') <strike>{{$session->tutor_name}} - {{$date}} {{$time}} - {{$session->student_name}}</strike> @else {{$session->tutor_name}} - {{$date}} {{$time}} - {{$session->student_name}} (half hour credit) @endif</span> </a></li>
                       @elseif(SCT::checkCredit($session->user_id)->credit_balance == 0.5)
                       <li><a href="{{url('dashboard/session-details/'.$session->session_id)}}" style="background: #dcdc25;color: white;border-radius: 4px;"><span style="padding: 10px;">@if($session->status == 'Cancel' || $session->status == 'Insufficient Credit') <strike>{{$session->tutor_name}} - {{$date}} {{$time}} - {{$session->student_name}}</strike> @else {{$session->tutor_name}} - {{$date}} {{$time}} - {{$session->student_name}} (half hour credit) @endif</span> </a></li>
                       @else
                       <li><a href="{{url('dashboard/session-details/'.$session->session_id)}}" style="background: #10C5A7;color: white;border-radius: 4px;"><span style="padding: 10px;">@if($session->status == 'Cancel' || $session->status == 'Insufficient Credit') <strike>{{$session->tutor_name}} - {{$date}} {{$time}} - {{$session->student_name}}</strike> @else {{$session->tutor_name}} - {{$date}} {{$time}} - {{$session->student_name}} @endif</span> </a></li>
                       @endif
                       @endforeach
                    </ul>
                    @else
                    <h4>No sessions scheduled</h4>
                    @endif
                  </div>
                  <div class="" style="margin-top:30px;">
                  <form method="post" action="{{ url('dashboard/view_sessions') }}">
                    <div class="row">
                      {{ csrf_field() }}
                      <div class="col-md-4">
                        <label>Search By</label>
                        <select class="form-control select2" name="searchBy">
                          @foreach($searchBy as $x => $y)
                          <option value="{{ $x }}" {{ $x == $s_app['searchBy'] ? 'selected="selected"' : '' }}>{{ $y }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label>Search String</label>
                        <input type="text" class="form-control" name="search" placeholder="Type here ..." value="{{ $s_app['search'] }}" style="line-height: 2;">
                      </div>
                      <div class="col-md-4" style="margin-top: -8px;">
                        <label style="display: block;">&nbsp;</label>
                        <button class="btn btn-primary" type="submit" name="filter">Search</button>
                        @if($s_app !=null)
                        <a class="btn btn-default" href="{{ url('dashboard/view_sessions?reset=true') }}">Reset</a>
                        @endif
                      </div>
                    </div>
                  </form>
                </div>
                <div class="table-responsive">
                  @if($type != 'session_search')
                  <h3>Tutor List</h3>
                  <ol>

                  @foreach($all_tutors as $tutor)
                  <li>
                    <!-- <a href="#tutor-{{$tutor->id}}" data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="customer"> -->
                    <a href="{{url('dashboard/tutor-sessions/'.$tutor->id)}}"  role="button" aria-expanded="false" aria-controls="customer">
                      <p>{{$tutor->first_name}} {{$tutor->last_name}}</p>
                    </a>
                  </li>
                  @endforeach
                </ol>
                {{$all_tutors->render()}}
                @endif
                </div>
              </div>
            </div>
          </div>
        </div>
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
                          <form method="post" action="{{ url('dashboard/cancel-session') }}">
                              <input type="hidden" name="_method" value="delete">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="session_id" class="actionId">
                              <div class="form-group">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" name="notify_client" id="notify_client" value="1" checked> <span style="margin-left:20px;">Notify client of cancellation</span>
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
<script src="{{asset('/frontend-assets/js/moment.min.js')}}"></script>
<script src="{{asset('/frontend-assets/js/fullcalendar.min.js')}}"></script>
<script src="{{asset('/frontend-assets/js/jquery-ui.min.js')}}"></script>
<script>
function deleteEmployer(userId){
    $('.actionId').val(userId);
    $('#modal-warning').modal();
}
function doAction(){
    var userId = $('.actionId').val();
    if(userId != ''){
        alert('delete this '+userId);
    }
}

</script>
<script>
$(document).ready(function() {


  $('#calendar').on('click', '.fc-day-grid-event', function(){
    $('.file_menu').css('display','block');
  });

  $('#calendar').fullCalendar({
    editable: true,
    defaultView: 'agendaWeek',
      eventLimit: true,

      events: function(start, end, timezone, callback) {
        $.ajax({
          url: "{{url('/dashboard/getAdminCallenderData')}}",
          datatype : 'json',
          success: function(doc) {
          // console.log(doc);
            var events = [];

            $.each(JSON.parse(doc), function(k, v) {
              if (v.status == 'Cancel' || v.status == 'Insufficient Credit') {
                events.push({
                 id : v.session_id,
                     className : 'cancel',
                     title: v.tutor_name+' - '+v.time+' '+v.student_name,
                     // title: v.subject+' session',
                     start: v.date, // will be parsed
                     // start: v.date+'T'+v.time,
                     // start: '2020-07-08T16:00:00',
                     url: "{{url('/dashboard/session-details')}}/"+v.session_id,
                   });
              }
              else if (v.credit == 0.5) {
                events.push({
                 id : v.session_id,
                     className : 'low-credit',
                     title: v.tutor_name+' - '+v.time+' '+v.student_name,
                     // title: v.subject+' session',
                     start: v.date, // will be parsed
                     // start: v.date+'T'+v.time,
                     // start: '2020-07-08T16:00:00',
                     url: "{{url('/dashboard/session-details')}}/"+v.session_id,
                   });
              }
              else {
                  events.push({
                   id : v.session_id,
                       title: v.tutor_name+' - '+v.time+' '+v.student_name,
                       // title: v.subject+' session',
                       start: v.date, // will be parsed
                       // start: v.date+'T'+v.time,
                       // start: '2020-07-08T16:00:00',
                       url: "{{url('/dashboard/session-details')}}/"+v.session_id,
                     });
              }

        });

            callback(events);

          }
        });
      },
      header: {
            left: '',
            center: 'prev title next',
            right: ''
        },
        // contentHeight: 'auto',
        contentHeight: 400,
        defaultView: 'basicWeek',
        eventColor: '#10C5A7',
        timeFormat: 'h:mma',
        // timeFormat: 'h(:mm)a',
        eventClick:  function(event, jsEvent, view) {

          var team_id = event.id;

          $.ajax({
          // url: "{{ url('/golf/getDateDetails/')}}/"+team_id,
          dataType: "json",
          success: function(res) {

            console.log(res);

            $('.file_menu').html("");

            if(res && res.length > 0) {

              $('#modalTitle').html(event.title);

              for (var i = 0; i < res.length; ++i) {

                 // $('.file_menu').append('<li><a href="{{url("golf/golf-booking/")}}/'+res[i].timing_id+'">'+event.start._i+' '+res[i].time+'<br>('+res[i].dimension_name+')</a></li>');

              }

              $('#modalDate').html(new Date(event.start._i).getDate());
              $('#fullCalModal').modal();

            }

           }

        });

        }

});
});
</script>
@endsection
