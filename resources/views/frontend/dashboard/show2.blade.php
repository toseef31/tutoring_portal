@extends('frontend.dashboard.layout.master')

@section('title', 'Your Payment Information')

@section('styling')

@endsection
@section('content')

@include('frontend.dashboard.menu.menu')

<div class="main-panel">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar bar1"></span>
        <span class="icon-bar bar2"></span>
        <span class="icon-bar bar3"></span>
        </button>
        <a class="navbar-brand" href="#">Your Payment Information</a>
      </div>
    </div>
  </nav>
  <div class="content">
    <div class="container-fluid app-view-mainCol">
      <div class="row">
        <!-- <div class="col-lg-4 col-md-5 app-view-mainCol">
          <div class="cards cards-user">
            <div class="image">
              <img src="{{asset('frontend-assets/images/dashboard/background.jpg')}}" alt="...">
            </div>
            <div class="content">
              <div class="author">
                <div class="re-img-box">
                  <img class="avatar border-white" src="" alt="...">
                  <div class="re-img-toolkit">
                    <div class="re-file-btn">
                      Change <i class="fa fa-camera"></i>
                      <input type="file" class="upload" id="imageFile"  name="image"  onchange="uploadpicture(this)">
                    </div>
                  </div>
                </div>
                <h4 class="title" id="userName">Zeeshan<br>
                </h4>
              </div>
            </div>
            <hr>
            <div class="text-center">
              <div class="row">
              </div>
            </div>
          </div>
        </div> -->
        <div class="col-lg-9 col-md-9 app-view-mainCol">
          <div class="cards">
            <div class="header">
              <h3 class="title">Your Payment Information</h3>
              <hr>
              @include('frontend.dashboard.menu.alerts')
              @if(Session::has('message'))
        			<div class="alert alert-success">
        				 {{ Session::get('message') }}
        				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        				 <span aria-hidden="true">&times;</span>
        				 </button>
        			</div>
        			@endif
            </div>
            <div class="content">
              <h4>We Accept</h4>
              <img src="{{asset('frontend-assets/images/american-card.png')}}" width="10%" class="mt-5">
              <img src="{{asset('frontend-assets/images/visa-card.png')}}" width="10%" class="mt-5">
              <img src="{{asset('frontend-assets/images/master-card.png')}}" width="10%" class="mt-5">
              <img src="{{asset('frontend-assets/images/discover-card.png')}}" width="11%" class="mt-5">

              <p class="mb-4 font-weight-bold">You will be charged  ${{ number_format($total, 2) }} to buy {{$credit_balance}} @if($credit_balance ==1) credit @else credits @endif </p>
              <form action="{{ url('user-portal/subscribe_process') }}" method="post" id="payment-form">
                   {{ csrf_field() }}
                   <input type="hidden" name="credit_id" value="{{$credit_id}}">
                   <input type="hidden" name="credit_balance" value="{{$credit_balance}}">
                   <input type="hidden" name="credit_cost" value="{{$credit_cost}}">
                   <input type="hidden" name="total" value="{{$total}}">
                  <div class="form-group" style="margin-top:30px;">
                      <div class="card-header">
                          <label for="card-element">
                              Enter your credit card information
                          </label>
                      </div>
                      <div class="card-body">
                          <div id="card-element">
                          </div>
                          <div id="card-errors" role="alert"></div>

                      </div>
                  </div>

                  <div class="card-footer text-right">
                    <button class="btn btn-dark w-49 p-2" onclick="window.history.go(-1); return false;">Back</button>
                      <button class="btn btn-green p-2 w-49" type="submit">Pay</button>
                  </div>
              </form>
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Create a Stripe client.
var stripe = Stripe('pk_test_AZHJmyUnFodTZHqYT3DaUs4k0050uHKq8K');
//alert(stripe);
// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    lineHeight: '18px',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
@endsection
