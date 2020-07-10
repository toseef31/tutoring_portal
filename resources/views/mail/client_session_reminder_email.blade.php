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
<body class='is-responsive'>
  <div class='container'>
    <div class='box'>
      <center>
        <img src='http://203.99.61.173/demos/tutoring_portal/public/frontend-assets/images/logo.png' width='20%' >
        <!-- <h2> {{$user->first_name}} {{$user->last_name}}. </h2> -->
      </center>
      <hr>
      <p style="color:#74787e;">Hello {{$user->first_name}} {{$user->last_name}} ,</p>
      <p style="color:#74787e;">You receive this email for Reminding of session which will conduct after 30 hours</p>
      <p class='lead'> Session Details: </p>
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
              ?>
              {{$session->date}} {{$time}}</td>
              <td>{{$session->location}}</td>
            </tr>
          </tbody>
        </table>
        <br>
        <center>
          @if($credit->credit_balance == 0)
          <a href="{{url('/user-portal/credits')}}" class='btn pt-2'>
            Please purchase more credits here
          </a>
          @endif
        </center>
        <p style="color:#74787e;">Your Remaining Credit Balance is {{$credit->credit_balance}}</p>
        @if($credit->credit_balance == 0)
        <p style="color:#74787e;">Your session will be cancelled in 6 hours because you have no credits left</p>
        @endif
        <br>

        <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">Regards,<br>Smart Cookie Tutors</p>
        <hr>
        <table class="m_1888394735623576276footer" align="center" width="620" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:0 auto;padding:0;text-align:center;width:620px"><tbody><tr>
          <td class="m_1888394735623576276content-cell" align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px 0">
            @if($user->role == 'customer')
            <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center">Click to <a href="{{url('user-portal/unsubscribe-email')}}">Unsubscribe</a>  </p>
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
