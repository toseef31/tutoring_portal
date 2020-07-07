@extends('frontend.dashboard.layout.master')
@section('content')
<style>
  .wrapper {
    background: white;
  }

</style>
<div class="container">
       <h1 class="text-center pt-5">Payment Information</h1>
    <div class="row justify-content-center my-5" style="margin-bottom:9.6rem;">
        <div class="col-md-4 my-5">
          <img src="{{asset('frontend-assets/images/CreditCard.png')}}" width="100%" class="mt-5">
        </div>
        <div class="col-md-6 my-5">
            <div class="">
                <p class="mb-4 font-weight-bold">You will be charged  ${{ number_format($total, 2) }} for buy {{$credit_balance}} Credit  </p>
                <!-- <p class="mb-4 font-weight-bold">£85 monthly membership fee after the trial period</p> -->
            </div>
            <div class="card">
                <form action="{{ url('user-portal/subscribe_process') }}" method="post" id="payment-form">
                     {{ csrf_field() }}
                     <input type="hidden" name="credit_id" value="{{$credit_id}}">
                     <input type="hidden" name="credit_balance" value="{{$credit_balance}}">
                     <input type="hidden" name="credit_cost" value="{{$credit_cost}}">
                     <input type="hidden" name="total" value="{{$total}}">
                    <div class="form-group">
                        <div class="card-header">
                            <label for="card-element">
                                Enter your credit card information
                            </label>
                        </div>
                        <div class="card-body">
                            <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>

                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-dark w-49 p-2" onclick="window.history.go(-1); return false;">Back</button>
                        <button class="btn btn-danger p-2 w-49" type="submit">Pay</button>
                    </div>
                </form>
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
