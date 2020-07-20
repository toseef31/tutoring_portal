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
</style>
<?php
$searchBy = array('first_name' => 'Tutor First Name', 'last_name' => 'Tutor Last Name');
$s_app = Session()->get('timesheetsSearch');
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
            <a class="navbar-brand" href="#pablo">Timesheets</a>
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
                <h4 class="card-title"> Timesheets <!-- <a href="{{url('dashboard/session/add')}}" style="float:right;font-size: 15px;font-size: 12px; color:white;" type="button" class="btn btn-md btn-primary">Schedule New Session</a>  --> </h4>
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
var tutor_id = "{{Request::segment(3)}}";

  $('#calendar').on('click', '.fc-day-grid-event', function(){
    $('.file_menu').css('display','block');
  });

  $('#calendar').fullCalendar({
    editable: true,
    showNonCurrentDates:false,
    selectable: true,
    // defaultView: 'agendaWeek',
      eventLimit: true,

      events: function(start, end, timezone, callback) {
        $.ajax({
          url: "{{url('/dashboard/getTutorTimesheetCallenderData')}}/"+tutor_id,
          datatype : 'json',
          success: function(doc) {
          // console.log(doc);
            var events = [];

            $.each(JSON.parse(doc), function(k, v) {
              events.push({
                id : v.timesheet_id,
                title: v.date2+' session',
                start: v.date,
                // start: '2020-07-08T16:00:00',
                url: "{{url('/dashboard/timesheet-details')}}/"+v.timesheet_id,
              });

        });

            callback(events);

          }
        });
      },
      dayClick: function(date) {
          var event_date = date.format();
            window.location.href = "{{url('/dashboard/timesheet/add?date=')}}"+event_date;
        },
      header: {
            left: '',
            center: 'prev title next',
            right: ''
        },
        contentHeight: 'auto',
        // defaultView: 'basicWeek',
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
