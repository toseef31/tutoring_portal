<html>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"/>
<head>
  <style>
  .container {
    background: rgb(238, 238, 238);
    padding: 80px;
  }
  @media only screen and (max-device-width: 690px) {
    .container {
      background: rgb(238, 238, 238);
      width:100% !important;
      padding:1px;
    }
    .table{
      padding-right: 10px !important;
    }
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
    color:#74787e;
  }
  .table tbody tr td {
    border:1px solid #ddd;
    padding:10px;
    color:#74787e;
  }
  .bg-gray {
    color:#74787e;
  }
  .regards{
    color:#74787e;
    text-align:left;
  }
  .footer {
    box-sizing:border-box;
    line-height:1.5em;
    margin-top:0;
    color:#aeaeae;
    font-size:12px;
    text-align:center;
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
      <p class='bg-gray'> Dear {{$tutor->first_name}} , </p>
      <?php
      $date = date('Y-m-d');
      $mid_date = date('Y-m-15');
      $end_date =date('Y-m-t');
      if ($date<=$mid_date) {
        $period = date('F 1').'  -  '.date('F 15');
      }else {
        $period = date('F 16').'  -  '.date('F t');
      }
      ?>
      <p class="bg-gray">If you have not already done so, please make sure to submit your timesheet for the {{$period}} pay period by the end of the day today.</p>
      @if(count($timesheets) >0)
      <p class='bg-gray'> Timesheet Details: </p>
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
              <td>
                <?php
                $date = date('M d, Y', strtotime($timesheet->date));
                ?>
                {{$date}}</td>

                <td>{{$timesheet->duration}}</td>
                <td>{{$timesheet->description}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @endif
        <br>
        <center>
          <a href="{{url('/user-portal/tutor-timesheets')}}" class='btn pt-2'>
            Click To View Timesheets
          </a>
        </center>
        <br>
        <p class="regards">Regards,<br>Smart Cookie Tutors</p>
        <br>
        <hr>
        @if($tutor->role == 'customer')
        <p class="footer">Click to <a href="{{url('user-portal/unsubscribe-email')}}">Unsubscribe</a>  </p>
        @endif
        <p class="footer">— This is an automated message. If you have any questions please reach out to sofi@smartcookietutors.com —</p>
        <p class="footer">© 2020 Smart Cookie Tutors All rights reserved.</p>
      </div>
    </div>
  </body>
  </html>
