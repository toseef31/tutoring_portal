@extends('frontend.dashboard.layout.master')

@section('title', 'Timesheets Management')

@section('styling')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/fullcalendar.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/fullcalendar.print.min.css') }}" media='print'>
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css"> -->
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
td {
  padding: 2px 15px;
  white-space: nowrap;
  /* OUT FOR FULL CALENDAR */
  /* overflow: hidden; */
  text-overflow: ellipsis;
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
        <a class="navbar-brand" href="#">Timesheets</a>
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
              <!-- <a href="{{url('user-portal/session/add')}}" class="btn btn-green pull-right">Schedule New Session</a> -->
              <h3 class="title">Timesheets</h3>
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

              <!-- Calendar Start -->
              <div id='calendar'></div>
              <!-- Calendar Ends -->
              <h3>Timesheets Record</h3>
              <div class="table-responsive">
                <table class="table  table-bordered">
                  <thead>
                    <tr>
                      <th>Student Name</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Duration</th>
                      <th>Session Description</th>
                      <!-- <th>Action</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($timesheets as $timesheet)
                    <tr>
                      <td>{{SCT::getStudentName($timesheet->student_id)->student_name}}</td>
                      <td>{{SCT::getSessionDetails($timesheet->session_id)->date}}</td>
                      <td>{{SCT::getSessionDetails($timesheet->session_id)->time}}</td>
                      <td>{{$timesheet->duration}}</td>
                      <td>{{$timesheet->description}}</td>
                      <!-- <td>
                        <a href="{{ url('user-portal/view_agreement/'.$timesheet->timesheet_id) }}" class="btn btn-green" data-toggle="tooltip" data-original-title="Update">View</a>&nbsp;&nbsp;&nbsp;
                      </td> -->
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{$timesheets->render()}}
              </div>
            </div>
            <hr>
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
                        <form method="post" action="{{ url('user-portal/student/delete') }}">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="student_id" class="actionId">
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script> -->
<script src="{{asset('/frontend-assets/js/moment.min.js')}}"></script>
<script src="{{asset('/frontend-assets/js/fullcalendar.min.js')}}"></script>
<script src="{{asset('/frontend-assets/js/jquery-ui.min.js')}}"></script>
<script>
var days = moment().daysInMonth();
var halfmonth = Math.round(days/2);
// var date = moment("halfmonth", "MM-DD-YYYY");
console.log(days,halfmonth);
$(document).ready(function() {

  $('#calendar').on('click', '.fc-day-grid-event', function(){
    $('.file_menu').css('display','block');
  });


  var intervalStart, intervalEnd;
  $('#calendar').fullCalendar({
    editable: true,
    eventLimit: true,
    showNonCurrentDates:false,
    views: {
      week: {
        type: 'basic', /* 'basicWeek' ?? */
        duration: { weeks: 2, }
        // duration: { days: 15, }
      }
    },
    events: function(start, end, timezone, callback,) {
      $.ajax({
        url: "{{url('/user-portal/gettutorTimesheetsCallenderData')}}",
        datatype : 'json',
        success: function(doc) {
          // console.log(doc);
          var events = [];
          $.each(JSON.parse(doc), function(k, v) {

            if (v.timesheet !=null) {
              events.push({
                id : v.session_id,
                title: v.subject+' session',
                // start: v.date, // will be parsed
                start: v.date+'T'+v.time,
                // start: '2020-07-08T16:00:00',
                url: "{{url('/user-portal/timesheet/edit')}}/"+v.session_id+'/'+v.timesheet.timesheet_id,
              });
            }else{
            events.push({
              id : v.session_id,
              title: v.subject+' session',
              // start: v.date, // will be parsed
              start: v.date+'T'+v.time,
              url: "{{url('/user-portal/timesheet/add')}}/"+v.session_id,
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
    contentHeight: 'auto',
    defaultView: 'week',
    eventColor: '#10C5A7',
    timeFormat: 'h:mma',
    // defaultDate: moment().startOf("month").startOf("isoweek"),
    // defaultDate:  moment().startOf("month").startOf(halfmonth),

  });
});

// $(document).ready(function() {
//
//
//   $('#calendar').on('click', '.fc-day-grid-event', function(){
//     $('.file_menu').css('display','block');
//   });
//
//
//
//   $('#calendar').fullCalendar({
//     editable: true,
//     // defaultView: 'agendaWeek',
//       eventLimit: true,
//       // views: {
//       //     basicTwoWeeks: {
//       //         buttonText: '2 Weeks',
//       //         type: 'basic',
//       //         duration: {
//       //             weeks: 2
//       //         }
//       //     }
//       // },
//       views: {
//        week: {
//            type: 'basic', /* 'basicWeek' ?? */
//            duration: { weeks: 2 }
//        }
//    },
//       /* Fullcalendar doesn't appear to support advancing calendar with default prev,next buttons
//         a different interval than the duration displayed by the view. So, we make our own buttons! */
//       // customButtons: {
//       //     mynext: {
//       //         text: 'Next',
//       //         click: function() {
//       //             var $cal = $('#calendar');
//       //             /* change to a lesser duration view (week, day).
//       //                 if you don't the 'next' button won't work as expected.
//       //                 comment out following line and see
//       //             */
//       //             $cal.fullCalendar('changeView', 'basicWeek');
//       //             $cal.fullCalendar('incrementDate', moment.duration(2, 'weeks'));
//       //             /* pop back to two-week view */
//       //             $cal.fullCalendar('changeView', 'basicTwoWeeks');
//       //         },
//       //     },
//       //     myprev: {
//       //         text: 'Prev',
//       //         click: function() {
//       //             $('#calendar').fullCalendar('incrementDate', moment.duration(-2, 'week'));
//       //         }
//       //     }
//       // },
//
//       events: function(start, end, timezone, callback,) {
//         $.ajax({
//           url: "{{url('/user-portal/gettutorTimesheetsCallenderData')}}",
//           datatype : 'json',
//           success: function(doc) {
//           // console.log(doc);
//             var events = [];
//
//             $.each(JSON.parse(doc), function(k, v) {
//               if (v.status == 'Cancel' || v.status == 'Insufficient Credit') {
//                 events.push({
//                  id : v.session_id,
//                      className : 'cancel',
//                      title: v.subject+' session',
//                      // start: v.date, // will be parsed
//                      start: v.date+'T'+v.time,
//                      // start: '2020-07-08T16:00:00',
//                      url: "{{url('/user-portal/tutor-sessions-details')}}/"+v.session_id,
//                    });
//               }
//               else if (v.credit == 0.5) {
//                 events.push({
//                  id : v.session_id,
//                      className : 'low-credit',
//                      title: v.subject+' session',
//                      // start: v.date, // will be parsed
//                      start: v.date+'T'+v.time,
//                      // start: '2020-07-08T16:00:00',
//                      url: "{{url('/user-portal/tutor-sessions-details')}}/"+v.session_id,
//                    });
//               }
//               else {
//                   events.push({
//                    id : v.session_id,
//                        title: v.subject+' session',
//                        // start: v.date, // will be parsed
//                        start: v.date+'T'+v.time,
//                        // start: '2020-07-08T16:00:00',
//                        url: "{{url('/user-portal/tutor-sessions-details')}}/"+v.session_id,
//                      });
//               }
//
//         });
//
//             callback(events);
//
//           }
//         });
//       },
//       header: {
//             left: '',
//             center: 'prev title next',
//             right: ''
//         },
//         contentHeight: 'auto',
//         defaultView: 'week',
//         eventColor: '#10C5A7',
//         timeFormat: 'h:mma',
//         // defaultView: 'basicWeek',
//         //     eventColor: '#10C5A7',
//         //     timeFormat: 'h:mma',
//
//
// });
// });

</script>
@endsection
