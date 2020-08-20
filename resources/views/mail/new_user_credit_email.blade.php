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
    .table1{
      display: none !important;
    }
    .table2{
      display: block !important;
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
    @media only screen and (min-device-width: 690px) {
      .table2{
        display: none;
      }
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
        <!-- <h2> {{$user->first_name}} {{$user->last_name}}. </h2> -->
      </center>
      <hr>
      <p class="bg-gray">{{$user->first_name}} {{$user->last_name}} have successfully purchased first credits and new credit balance is {{$credit->credit_balance}}.</p>
      <p class='bg-gray'> Client Details: </p>
      <div class="table-responsive">
        <table class='table table1'>
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>City</th>
              <th>State</th>
              <th>Zip</th>
            </tr>
          </thead>
          <tbody align='center'>
            <tr>
              <td>{{$user->first_name}} {{$user->last_name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->phone}}</td>
              <td>{{$user->address}}</td>
              <td>{{$user->city}}</td>
              <td>{{$user->state}}</td>
              <td>{{$user->zip}}</td>
            </tr>
          </tbody>
        </table>
        <table class='table table2'>
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>City</th>
            </tr>
          </thead>
          <tbody align='center'>
            <tr>
              <td>{{$user->first_name}} {{$user->last_name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->phone}}</td>
              <td>{{$user->address}}</td>
              <td>{{$user->city}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <br>
      <p class="regards">Regards,<br>Smart Cookie Tutors</p>
      <br>
      <hr>
      <center>
        <!--  <a href='$site_url/admin/index?view_proposals' class='btn pt-2'>
        Click To View All Proposals
      </a> -->
    </center>
    <p class="footer">— This is an automated message. If you have any questions please reach out to sofi@smartcookietutors.com —</p>
    <p class="footer">© 2020 Smart Cookie Tutors All rights reserved.</p>
  </div>
</div>
</body>
</html>
