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
    .table-responsive {
      width: 100%;
      margin-bottom: 15px;
      overflow-y: hidden;
      -ms-overflow-style: -ms-autohiding-scrollbar;
      /* border: 1px solid #ddd; */
    }
  }
  .table-responsive{
    min-height: .01%;
    overflow-x: auto;
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
<body class='is-responsive'>
  <div class='container'>
    <div class='box'>
      <center>
        <img src='http://203.99.61.173/demos/tutoring_portal/public/frontend-assets/images/logo.png' width='20%' >
        <!-- <h2> New Agreement Available. </h2> -->
      </center>
      <hr>
      <p class='lead'> Dear {{$tutor->first_name}} , </p>
      <p style="color:#74787e;">We send you this email to update you about your timesheets.</p>
      <p class='lead'> Timesheet Details: </p>
      <div class="table-responsive">
        <table class='table'>
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Date</th>
              <th>Duration</th>
              <th>Session Description</th>
            </tr>
          </thead>
          <tbody align='center'>
            @foreach($timesheets as $timesheet)
            <tr>
              <td>{{$timesheet->student_name}}</td>
              <td>{{$timesheet->date}}</td>

              <td>{{$timesheet->duration}}</td>
              <td>{{$timesheet->description}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <br>
      <hr>
      <br>
      <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">Regards,<br>Smart Cookie Tutors</p>
      <center>
        <a href="{{url('/user-portal/tutor-timesheets')}}" class='btn pt-2'>
          Click To View Timesheets
        </a>
      </center>
      <div class="table-responsive">
        <table class="m_1888394735623576276footer" align="center" width="620" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:0 auto;padding:0;text-align:center;width:620px"><tbody><tr>
          <td class="m_1888394735623576276content-cell" align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px 0">
            @if($tutor->role == 'customer')
            <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center">Click to <a href="{{url('user-portal/unsubscribe-email')}}">Unsubscribe</a>  </p>
            @endif
            <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:left">— This is an automated message. If you have any questions please reach out to sofi@smartcookietutors.com —</p>
            <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center">© 2020 Smart Cookie Tutors All rights reserved.</p>
          </td>
        </tr></tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
