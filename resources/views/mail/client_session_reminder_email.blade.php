<html>
<head>
  <style>
  .container {
    background: rgb(238, 238, 238);
    padding: 80px;
  }
  @media only screen and (max-device-width: 690px) {
    .container {
      background: rgb(238, 238, 238);
      width:100%;
      padding:1px;
    }
  }
  .box {
    background: #fff;
    margin: 0px 0px 30px;
    padding: 8px 20px 20px 20px;
    border:1px solid #e6e6e6;
    box-shadow:0px 1px 5px rgba(0, 0, 0, 0.1);
  }
  .lead {
    font-size:16px;
  }
  .btn{
    background:#10C5A7;
    margin-top:20px;
    color:white !important;
    text-decoration:none;
    padding:10px 16px;
    font-size:18px;
    border-radius:3px;
  }
  hr{
    margin-top:20px;
    margin-bottom:20px;
    border:1px solid #eee;
  }
  .table {
    width:100%;
    background-color:#fff;
    margin-bottom:20px;
  }
  .table thead tr th {
    border:1px solid #ddd;
    font-weight:bolder;
    padding:10px;
  }
  .table tbody tr td {
    border:1px solid #ddd;
    padding:10px;
  }
  </style>
</head>
<?php
  $base_url = 'http://203.99.61.173/demos/tutoring_portal/public';
 ?>
<body class='is-responsive'>
  <div class='container'>
    <div class='box'>
      <center>
        <img src='http://203.99.61.173/demos/tutoring_portal/public/frontend-assets/images/logo.png' width='20%' >
        <!-- <h2> {{$user->first_name}} {{$user->last_name}}. </h2> -->
      </center>
      <hr>
      <p style="color:#74787e;">Dear {{$user->first_name}} ,</p>
      <p style="color:#74787e;">You have a tutoring session coming up soon!</p>
      <p class='lead'> Session Details: </p>
      <div class="table-responsive">
      <table class='table'>
        <thead>
          <tr>
            <th>Tutor Name</th>
            <th>Student Name</th>
            <th>Subject</th>
            <th>Duration</th>
            <th>Date/Time</th>
            <th>Location</th>
          </tr>
        </thead>
        <tbody align='center'>
          <tr>
            <td>{{$tutor->first_name}} {{$tutor->last_name}}</td>
            <td>{{$student->student_name}}</td>
            <td>{{$session->subject}}</td>
            <td>{{$session->duration}}</td>
            <td>
              <?php
              $time = date('h:i a', strtotime($session->time));
              $time1 = date('h:i a', strtotime($session->time));
              $date = date('M d, Y', strtotime($session->date));
              $tutor_timezone = $tutor->time_zone;
              if ($tutor_timezone == 'Pacific Time') {
                date_default_timezone_set("America/Los_Angeles");
              }elseif ($tutor_timezone == 'Mountain Time') {
                date_default_timezone_set("America/Denver");
              }elseif ($tutor_timezone == 'Central Time') {
                date_default_timezone_set("America/Chicago");
              }elseif ($tutor_timezone == 'Eastern Time') {
                date_default_timezone_set("America/New_York");
              }
              $time_zone = $user->time_zone;
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
              ?>
              {{$date}} {{$time}}</td>
              <td>{{$session->location}}</td>
            </tr>
          </div>
          </tbody>
        </table>
        <br>

        <p style="color:#74787e;">You currently have {{$credit->credit_balance}} credits remaining. </p>
        @if($credit->credit_balance <= 0)
        <p style="color:#74787e;">Please note that your session will be automatically cancelled in 6 hours because you currently have no credits remaining.</p>
        @endif
        <br>
        <center>
          @if($credit->credit_balance <= 0)
          <a href="{{url('/user-portal/credits')}}" class='btn pt-2'>
            Please purchase more credits here
          </a>
          @endif
        </center>
        <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">Regards,<br>Smart Cookie Tutors</p>
        <hr>
        <table class="m_1888394735623576276footer" align="center" width="620" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:0 auto;padding:0;text-align:center;width:620px"><tbody><tr>
          <td class="m_1888394735623576276content-cell" align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px 0">
            @if($user->role == 'customer')
            <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center">Click to <a href="{{url('/user-portal/credits')}}/user-portal/unsubscribe-email')}}">Unsubscribe</a>  </p>
            @endif
            <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:left">— This is an automated message. If you have any questions please reach out to sofi@smartcookietutors.com —</p>
            <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center">© 2020 Smart Cookie Tutors All rights reserved.</p>
          </td>
        </tr></tbody>
      </table>
    </div>
  </div>
</body>
</html>
