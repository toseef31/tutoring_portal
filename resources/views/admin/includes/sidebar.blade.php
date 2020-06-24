<div class="sidebar" data-color="#072f44" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo" style="background: white;">
        <a href="{{url('/')}}" class="simple-text logo-mini" style="width: 34%;float: none;margin-left: 75px;margin-bottom: -16px;">
          <div class="logo-image-small">
            <img src="{{asset('/frontend-assets/images/logo.png')}}" alt="Logo">
          </div>
        </a>
        <br>
        <!-- <a href="{{url('/')}}" class="simple-text logo-normal" style="font-size:13px;color: black; ">
          Smart Cookie Tutors

        </a> -->
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
        @if(auth()->user()->role =='admin')
          <!-- <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{url('/dashboard')}}">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li> -->
          <li class="{{ request()->is('dashboard/view_admins') ? 'active' : '' }}">
            <a href="#admin"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="admin">
              <i class="nc-icon nc-single-02"></i>
              <p>Admins</p>
            </a>
            <ul class="collapse" id="admin">
              <li><a href="{{url('dashboard/view_admins')}}">View Admin</a></li>
            </ul>

          </li>
          <li class="{{ request()->is('dashboard/view_customers') ? 'active' : '' }}">
            <a href="#customer"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="admin">
              <i class="nc-icon nc-single-02"></i>
              <p>Customers</p>
            </a>
            <ul class="collapse" id="customer">
              <li><a href="{{url('dashboard/view_customers')}}">View Customers</a></li>
            </ul>

          </li>
          <li class="{{ request()->is('dashboard/view_students') ? 'active' : '' }}">
            <a href="#student"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="admin">
              <i class="nc-icon nc-circle-10"></i>
              <p>Students</p>
            </a>
            <ul class="collapse" id="student">
              <li><a href="{{url('dashboard/view_students')}}">View Students</a></li>
            </ul>

          </li>
          <li class="{{ request()->is('dashboard/view_tutors') ? 'active' : '' }}">
            <a href="#tutor"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="admin">
              <i class="nc-icon nc-badge"></i>
              <p>Tutor</p>
            </a>
            <ul class="collapse" id="tutor">
              <li><a href="{{url('dashboard/view_tutors')}}">View Tutors</a></li>
            </ul>

          </li>
          <li>
            <a href="#certification"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="admin">
              <i class="nc-icon nc-bell-55"></i>
              <p>Sessions</p>
            </a>
            <ul class="collapse" id="certification">
              <li><a href="{{url('dashboard/view_certification')}}">Sessions</a></li>
            </ul>

          </li>
          @endif
          @if(auth()->user()->role =='admin')
          <li>
            <a href="#manageJobs"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="manageJobs">
              <i class="nc-icon nc-bell-55"></i>
              <p>Agreement</p>
            </a>
            <ul class="collapse" id="manageJobs">
              <li><a href="{{url('dashboard/job_management')}}">Agreement</a></li>
              <!-- <li><a href="{{url('dashboard/closed_jobs')}}">Closed Jobs</a></li> -->
            </ul>

          </li>
           @endif
          <li>

          @if(auth()->user()->role =='admin')
            <a  data-toggle="collapse" href="#manageQuote"  role="button" aria-expanded="false" aria-controls="manageQuote">
              <i class="nc-icon nc-pin-3"></i>
              <p>Time Sheets</p>
            </a>
            <ul class="collapse" id="manageQuote">
              <li><a href="{{url('dashboard/quotes')}}">Time Sheets</a></li>
              <!-- <li><a href="{{url('dashboard/pending-quotes')}}">Pending Quotes</a></li> -->
            </ul>
          </li>
           @endif
           @if(auth()->user()->role =='admin')
          <li>
            <a class="" data-toggle="collapse" href="#customer" role="button" aria-expanded="false" aria-controls="customer">
              <i class="nc-icon nc-diamond"></i>
              <p>FAQ</p>
            </a>
            <ul class="collapse" id="customer">
              <li><a href="{{url('dashboard/customer-message')}}">FAQ</a></li>
              <!-- <li><a href="">Archieved</a></li> -->
              <!-- <li><a href="">Completed</a></li> -->
            </ul>
          </li>
          <!-- <li>
            <a class="" data-toggle="collapse" href="#blog" role="button" aria-expanded="false" aria-controls="customer">
              <i class="nc-icon nc-diamond"></i>
              <p>Blogs</p>
            </a>
            <ul class="collapse" id="blog">
              <li><a href="{{url('/dashboard/blogs')}}">Blogs</a></li>
            </ul>
          </li> -->
          <!-- <li>
            <a href="#manageUsers"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="manageUsers">
              <i class="nc-icon nc-single-02"></i>
              <p>User Management</p>
            </a>
            <ul class="collapse" id="manageUsers">
              <li><a href="{{url('dashboard/user_management')}}">Add New User </a></li>
            </ul>
          </li> -->
          <!-- <li>
            <a class="" data-toggle="collapse" href="#accounts" role="button" aria-expanded="false" aria-controls="accounts">
              <i class="nc-icon nc-bell-55"></i>
              <p>Account</p>
            </a>
            <ul class="collapse" id="accounts">
              <li><a href="{{url('/dashboard/show_invoices')}}">Invoice</a></li>
              <li><a href="{{url('/dashboard/refund_cases')}}">Refund Cases</a></li>
            </ul>
          </li> -->
          <!-- <li>
            <a href="{{url('dashboard/user')}}">
              <i class="nc-icon nc-single-02"></i>
              <p>Profile Management</p>
            </a>
          </li> -->
          <!-- <li>
            <a href="{{url('dashboard/tables')}}">
              <i class="nc-icon nc-tile-56"></i>
              <p>Blogs</p>
            </a>
          </li> -->
          <!-- <li>
            <a class="" data-toggle="collapse" href="#messages" role="button" aria-expanded="false" aria-controls="messages">
              <i class="nc-icon nc-caps-small"></i>
              <p>Messages</p>
            </a>
            <ul class="collapse" id="messages">
              <li><a href="{{url('')}}">Expert Mesages</a></li>
              <li><a href="{{url('')}}">Customer Messages</a></li>
            </ul>
          </li> -->
          @endif
           @if(auth()->user()->role =='admin')
           <!-- <li>
             <a href="#managepayment"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="manageJobs">
               <i class="nc-icon nc-single-02"></i>
               <p>Payments</p>
             </a>
             <ul class="collapse" id="managepayment">
               <li><a href="{{url('dashboard/payment_management')}}">View Payments</a></li>
             </ul>

           </li> -->
          @endif
           @if(auth()->user()->role =='admin')
          <!-- <li>
            <a href="{{url('dashboard/help-menu')}}">
              <i class="nc-icon nc-single-02"></i>
              <p>Help Menu</p>
            </a>
          </li> -->
          @endif
        </ul>
      </div>
    </div>
