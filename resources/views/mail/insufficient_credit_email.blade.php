<html>
<head>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"/>
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
        <img src="{{SCT::GetLogoUrl()}}" width='20%' >
        <!-- <h2> {{$user->first_name}} {{$user->last_name}}. </h2> -->
      </center>
      <hr>
      <p class='bg-gray'>Dear {{$tutor->first_name}} ,</p>
      <p class="bg-gray">The below session has been canceled due to Insufficient client credits</p>
      <p class='bg-gray'> Session Details: </p>
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
            @foreach($sessions as $session)
            <tr>
              <td>{{$tutor->first_name}} {{$tutor->last_name}}</td>
              <td>{{SCT::getStudentName($session->student_id)->student_name}}</td>
              <td>{{$session->subject}}</td>
              <td>{{$session->duration}}</td>
              <td>
                <?php
                $time = date('h:i a', strtotime($session->time));
                $date = date('M d, Y', strtotime($session->date));
                ?>
                {{$date}} {{$time}}</td>
                <td>{{$session->location}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <br>
        <center>
          <!-- <a href="{{url('/user-portal/credits')}}" class='btn pt-2'>
          Please purchase more credits here
        </a> -->
      </center>
      <p class="regards">Regards,<br>Smart Cookie Tutors</p>
      <br>
      <hr>
      <p class="footer">— This is an automated message. If you have any questions please reach out to sofi@smartcookietutors.com —</p>
      <p class="footer">© 2020 Smart Cookie Tutors All rights reserved.</p>
    </div>
  </div>
</body>
</html>
