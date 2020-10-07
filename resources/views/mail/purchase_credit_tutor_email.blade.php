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
    background:green;
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
        <img src="{{env('Logo_URL')}}" width='20%' >
        <!-- <h2> {{$user->first_name}} {{$user->last_name}}. </h2> -->
      </center>
      <hr>
      <p class='bg-gray'> Dear {{$tutor->first_name}} , </p>
      <p class="bg-gray">You have a new student! Please reach out to the parent/guardian of {{$student->student_name}} to schedule the first session. See the student profile for details and contact information.</p>
      <p class="bg-gray">Thank you!</p>
      <br>
      <p class="regards">Regards,<br>Smart Cookie Tutors</p>
      <br>
      <center>
        <!--  <a href='$site_url/admin/index?view_proposals' class='btn pt-2'>
        Click To View All Proposals
      </a> -->
    </center>
    <hr>
    <p class="footer">— This is an automated message. If you have any questions please reach out to sofi@smartcookietutors.com —</p>
    <p class="footer">© 2020 Smart Cookie Tutors All rights reserved.</p>
  </div>
</div>
</body>
</html>
