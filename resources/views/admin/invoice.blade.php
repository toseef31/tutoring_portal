@extends('admin.layouts.master')
@section('content')
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
          <a class="navbar-brand" href="#pablo">Invoices</a>
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
                {{Session::get('fa_admin')->name}}
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
          <form class="form-inline" action="" method="">
            <div class="form-group" style="width: 100%">
              <input type="text" class="form-control" placeholder="Search" style="height: 40px; width: 90%;">
              <input type="button" name="search_btn" class="btn btn-primary" value="Search">
            </div>
          </form>
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Invoices</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                @if(session()->has('message'))
                <div class="row">
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <strong>Message:</strong>{{session()->get('message')}}
                  </div>
                </div>
                @endif
                <table class="table">
                  <thead class=" text-primary">
                    <th>Payment_id id</th>
                    <th>Partner id</th>
                    <th>Quote_id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Adress</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Trial Period</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    @foreach($allpayment as $payment)
                    <tr>
                      <td> {{$payment->payment_id}}</td>
                      <td> {{$payment->p_id}}</td>
                      <td> {{$payment->q_id}}</td>
                      <td> {{$payment->name}}</td>
                      <td> {{$payment->email}}</td>
                      <td> {{$payment->address}}</td>
                      <td> {{$payment->city}}</td>
                      <td> {{$payment->state}}</td>
                      <td> {{$payment->zip}}</td>
                      <td> {{$payment->amount}} £</td>
                      <td> {{$payment->method}}</td>
                      <td> {{$payment->trial_period_days}}</td>
                      <td>
                        @if($payment->link !="")
                        <a target="_blank" href="{{url($payment->link)}}" class="btn btn-primary">View Receipt</a>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@endsection
