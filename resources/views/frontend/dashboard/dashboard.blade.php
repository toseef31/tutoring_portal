@extends('frontend.dashboard.layout.master')

@section('title', 'User Portal')

@section('styling')
<style>
  .text-white{
    color: white;
  }
</style>
@endsection
@section('content')

@include('frontend.dashboard.menu.menu')

<div class="main-panel">
  <nav class="navbar navbar-default" style="position: initial !important;">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar bar1"></span>
        <span class="icon-bar bar2"></span>
        <span class="icon-bar bar3"></span>
        </button>
        <a class="navbar-brand" href="#">Dashboard</a>
      </div>
    </div>
  </nav>
  <div class="content">
    <div class="container-fluid app-view-mainCol">
      <div class="row main-row box-grid-row">
        <!-- <div class="col-lg-4 col-sm-6">
          <div class="cards">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big icon-warning text-center">
                    <i class="ti-panel"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('user-portal/dashboard')}}">
                    <div class="numbers">
                      Dashboard
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div> -->
        @if(auth()->user()->role == 'customer')
        <div class="col-lg-4 col-sm-6">
          <div class="cards" style="background-color: burlywood;">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big text-white text-center">
                    <i class="ti-user"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('user-portal/manage-profile')}}" class="text-white">
                    <div class="numbers">
                      Client Profile
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div>
        @else
        <div class="col-lg-4 col-sm-6">
          <div class="cards" style="background-color: #005fff;">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big text-white text-center">
                    <i class="ti-user"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('user-portal/manage-profile-tutor')}}" class="text-white">
                    <div class="numbers">
                      Tutor Profile
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div>
        @endif
        @if(auth()->user()->role == 'customer')
        <div class="col-lg-4 col-sm-6">
          <div class="cards" style="background-color: #7429b9e6;">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big text-white text-center">
                    <i class="ti-user"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('user-portal/students')}}" class="text-white">
                    <div class="numbers">
                      Students
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="cards" style="background-color: #ad29b9e6;">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big text-white text-center">
                    <i class="ti-user"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('user-portal/tutors')}}" class="text-white">
                    <div class="numbers">
                      Tutors
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="cards" style="background-color: #00ff28;">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big text-white text-center">
                    <i class="ti-calendar"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('user-portal/client-sessions')}}" class="text-white">
                    <div class="numbers">
                      Sessions
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div>
        @endif
        @if(auth()->user()->role == 'tutor' || auth()->user()->role == 'admin')
        <div class="col-lg-4 col-sm-6">
          <div class="cards" style="background-color: #ad29b9e6;">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big text-white text-center">
                    <i class="ti-user"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('user-portal/tutor-students')}}" class="text-white">
                    <div class="numbers">
                      Students
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="cards" style="background-color: #00ff28;">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big text-white text-center">
                    <i class="ti-calendar"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('user-portal/tutor-sessions')}}" class="text-white">
                    <div class="numbers">
                      Sessions
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="cards" style="background-color: #c7e427;">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big text-white text-center">
                    <i class="ti-calendar"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('user-portal/tutor-timesheets')}}" class="text-white">
                    <div class="numbers">
                      Timesheets
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div>
        @endif
        <div class="col-lg-4 col-sm-6">
          <div class="cards" style="background-color: #55c39e;">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big text-white text-center">
                    <i class="ti-files"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('/user-portal/agreements')}}" class="text-white">
                    <div class="numbers">
                      Agreements
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div>
        @if(auth()->user()->role == 'customer')
        <div class="col-lg-4 col-sm-6">
          <div class="cards" style="background-color: brown;">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big text-white text-center">
                    <i class="ti-book"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('/user-portal/faqs')}}" class="text-white">
                    <div class="numbers">
                      FAQs
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="cards" style="background-color: #e4be40;">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big text-white text-center">
                    <i class="ti-credit-card"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('/user-portal/credits')}}" class="text-white">
                    <div class="numbers">
                      Credits
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div>
        @endif
       <div class="col-lg-4 col-sm-6">
          <div class="cards" style="background-color: #0085c6;">
            <div class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="icon-big text-white text-center">
                    <i class="fas fa-sign-out-alt"></i>
                  </div>
                </div>
                <div class="col-xs-12">
                  <a href="{{url('/logout')}}" class="text-white">
                    <div class="numbers">
                      Logout
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="col-lg-4 col-sm-6">
          <div class="cards">
            <div class="content">
              <div class="row">
                <div class="col-xs-3">
                  <div class="icon-big icon-info text-center">
                    <i class="fa fa-car"></i>
                  </div>
                </div>
                <div class="col-xs-9">
                  <a href="{{url('/dashboard/user-rides')}}">
                    <div class="numbers">
                      My Rides
                    </div>
                  </a>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div> -->

        <!-- <div class="col-lg-4 col-sm-6">
          <div class="cards">
            <div class="content">
              <div class="row">
                <div class="col-xs-3">
                  <div class="icon-big icon-info text-center">
                    <i class="ti-comments"></i>
                  </div>
                </div>
                <div class="col-xs-9">
                  <div class="numbers">
                    Chat box
                  </div>
                </div>
              </div>
              <div class="footer">
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

@endsection
