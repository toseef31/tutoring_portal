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
          <a class="navbar-brand" href="#pablo">Refund Cases</a>
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
              <h4 class="card-title"> Refund Cases</h4>
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
                    <th>Refund id</th>
                    <th>Invoice id</th>
                    <th>Partner id</th>
                    <th>Payment id</th>
                    <th>Amount</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Reason</th>
                  </thead>
                  <tbody>
                    @foreach($refunds as $refund)
                    <tr>
                      <td> {{$refund->refund_id}}</td>
                      <td> {{$refund->invoice_id}}</td>
                      <td> {{$refund->p_id}}</td>
                      <td> {{$refund->payment_id}}</td>
                      <td> £{{$refund->amount}}</td>
                      <td><a target="_blank" href="{{url('/frontend-assets/images/partner/refund-reason/'.$refund->image)}}">show image/file</a> </td>
                      <td class="text-right" data-id="{{$refund->refund_id}}">
                        <select class="form-control">
                          <option value="Pending" <?php echo ($refund->status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                          <option value="Approved" <?php echo ($refund->status == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                          <option value="Rejected" <?php echo ($refund->status == 'Rejected') ? 'selected' : ''; ?>>Rejected</option>
                        </select>
                      </td>
                      <td> {{$refund->reason}}</td>

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
          url: "{{ url('dashboard/change_refund_status') }}",
          data: {refund_id:id,value:value},
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
