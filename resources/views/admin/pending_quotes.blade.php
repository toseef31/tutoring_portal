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
          <a class="navbar-brand" href="#pablo">Manage Quotes</a>
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
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"> Quotes</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Quote ID</th>
                      <th>Quote by</th>
                      <th>Quote_date</th>
                      <th>Quote_Services</th>
                      <th>Quote_price</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($quotes as $jobqoute)
                    <tr class="tbl_show{{$jobqoute->id}}">
                      <td>{{$jobqoute->id}}</td>
                      <td>{{$jobqoute->partner->name}}</td>
                      <td>{{$jobqoute->created_at}}</td>
                      <td><?php
                        foreach(@json_decode($jobqoute->q_services) as $service){
                          echo $service. '</br>';
                        }
                      ?></td>
                      <td><?php
                        foreach(@json_decode($jobqoute->quote_price) as $price){
                          echo $price. '</br>';
                        }
                      ?></td>
                      <td>{{$jobqoute->count_status}}</td>
                    <td>
                      <a href="javascript:void(0);" onclick="change_status({{$jobqoute->id}})" class="btn btn-success">Acive</a>
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
  <script>
  function mark(id){
    var value='';
    if($('#check'+id).prop('checked') == true){
    //o something
      value='1';
    }
    else{
       value='0';
    }
	 $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
  $.ajax({
          type: "post",
          url: "{{ url('dashboard/mark') }}",
          data:{id:id,value:value},
          success: function(data){
            //$('#treeviews').html(data);
            if(data ==1){
            toastr.success("Status Update");

            }
            console.log(data);
          }

    });
}
    function visitFunction(id) {
        event.preventDefault();
        var visit_id=id;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            $.ajax({
                type: 'post',
                url: "{{ url('quotes/visit')}}",
                data: { visit_id : visit_id},
                success: function(response){
                    console.log(response);
//                     $('#table1').append(response);
                    location.reload();

                },
                error: function (error) {
                    console.log(error)
                    alert("data not saved");

                }
            });


    }

    function change_status(id){
      // alert(id);

     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
            type: "post",
            url: "{{ url('dashboard/change-quotes-status') }}/"+id,
            data:{id:id},
            success: function(data){
              //$('#treeviews').html(data);
              if(data ==1){
              toastr.success("Status Update");
              location.reload();

              }
              console.log(data);
            }

      });
  }
  </script>
@endsection
