@extends('admin.layouts.master')
@if($faqId != '')
    @section('title', 'Update FAQ')
@else
    @section('title', 'Add FAQ')
@endif
@section('content')
<link href="{{asset('/frontend-assets/js/ckeditor/css/samples.css')}}" rel="stylesheet" />
<style>
.form-horizontal .control-label {
  text-align: right;
  margin-bottom: 0;
  padding-top: 7px;
}
.form-horizontal .form-group {
    margin-left: -15px;
    margin-right: -15px;
}
.form-group {
    margin-bottom: 15px;
    display: flex;
  }
.form-horizontal .form-group:after, .form-horizontal .form-group:before {
    content: " ";
    display: table;
}
.col-md-6 {
    width: 50%;
    /* float: right; */
}
.card {
    background-color: #fff;
    border: 1px solid #f2f5f8;
    border-radius: 4px;
    -webkit-box-shadow: none;
    box-shadow: none;
    display: block;
    margin-bottom: 10px;
    position: relative;
}
.card-body {
    padding: 15px;
    position: relative;
}
.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
    color: black !important;
}
.custom-control {
    cursor: pointer;
    font-weight: 400;
    line-height: 14px;
    margin-bottom: 0;
    min-height: 14px;
    min-width: 14px;
    position: relative;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
    vertical-align: middle;
}
.radio-div {
  display: flex;
}
</style>
<?php
$faq_id = '';
$description = '';
  if ($faq !='') {
    $faq_id = $faq->faq_id;
    $description = $faq->description;
  }
 ?>
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
                  {{Session::get('sct_admin')->first_name}}
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

      <div class="content">
        <div class="row">
          <div class="col-md-12">
              @include('admin.includes.alerts')
              <div class="card">
                @if(session()->has('message'))
                  <div class="row">
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                      <strong>Message:</strong>{{session()->get('message')}}
                    </div>
                  </div>
                @endif
                  <div class="card-body">
                  <form class="form-horizontal employers-form" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="faq_id" value="{{$faq_id}}">
                      <div class="form-group">
                          <label class="control-label col-md-1 text-right">FAQ : </label>
                          <div class="col-md-10">
                            <textarea rows="40" cols="70" class="ckeditor" id="editor" name="description" required>{!! $description !!}</textarea>
                              <!-- <input type="text" class="form-control" name="first_name" required=""> -->
                          </div>
                      </div>
                      <!-- <div class="form-group">
                        <label>Description</label>
                        <textarea rows="100" cols="70" class="ckeditor" id="editor" name="body" required></textarea>
                      </div> -->
                      <div class="form-group">
                          <label class="control-label col-md-3 text-right">&nbsp;</label>
                          <div class="col-md-6">
                              <button class="btn btn-block btn-primary do-save" type="submit" name="save">Save</button>
                          </div>
                      </div>
                  </form>

                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script src="{{asset('/frontend-assets/js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('/frontend-assets/js/ckeditor/js/sample.js')}}"></script>
<script src="{{asset('/frontend-assets/js/ckeditor/js/sf.js')}}"></script>
<script>
$('select').on('change', function() {
  var value=this.value;
  var id=$(this).parent().attr("data-id");
   $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
  $.ajax({
          type: "POST",
          url: "{{ url('dashboard/post_portal') }}",
          data: {job_id:id,value:value},
          success: function(data){
            //$('#treeviews').html(data);
            if(data ==1){
            toastr.success("Status Update");
            }
            console.log(data);
          }

    });

});
</script>
@endsection
