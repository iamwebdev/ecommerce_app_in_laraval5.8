@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="shopping-cart">
      <div class="title">
        Shopping Cart
      </div>
      @if (isset($cartItems) && count($cartItems) < 1)
        <div class="d-flex justify-content-center mt-5 mb-5">
              <h1>No item(s) in your cart</h1>
        </div>
      @endif
      @if (isset($cartItems))
        @foreach($cartItems as $cartItem)
          <div class="item">
            <div class="buttons">
              <a href="/remove-cart-item/{{ $cartItem['id'] }}"><span class="delete-btn"></span></a>
            </div>
            <div class="image">
              <img src="{{ asset($cartItem['image']) }}" height="100" width="100" alt="" />
            </div>
            <div class="description">
              <span>{{ $cartItem['name'] }}</span>
              <strong>Rs. {{ $cartItem['price'] }}</strong>
            </div>
            <div class="quantity" id="{{ $cartItem['id'] }}">
              <button class="plus-btn" type="button" name="button">
                <img src="{{ asset('svg/plus.svg') }}" alt="" />
              </button>
              <input type="text" name="qty" value="{{ $cartItem['qty'] }}">
              <button class="minus-btn" type="button" name="button">
                <img src="{{ asset('svg/minus.svg') }}" alt="" />
              </button>
            </div>
            <div class="total-price">Total Price: Rs.{{ $cartItem['total_price'] }}</div>
          </div>
        @endforeach
      @endif    
</div>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.shopping-cart').on('click', '.minus-btn', function(e) {
            console.log('ajax')
            e.preventDefault();
            var $this = $(this);
            var $input = $this.closest('div').find('input');
            var value = parseInt($input.val());      
            if (value > 1) {
                value = value - 1;
            } else {
                value = 1;
            }
            $input.val(value);
            var itemId = $this.parent().attr('id');
            updateCart(itemId, value);
        });

        $('.shopping-cart').on('click','.plus-btn', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $input = $this.closest('div').find('input');
            var value = parseInt($input.val());
            if (value < 100) {
            value = value + 1;
            }
            $input.val(value);
            var itemId = $this.parent().attr('id');
            updateCart(itemId, value);
        });
    })
</script>
<script type="text/javascript">
  function updateCart(cartItemId, qty) {
    $.ajax({
      url: '/update-cart',
      data: {'itemId': cartItemId, 'qty': qty},
      type: 'GET',
      success:function(data) {
        var result = Object.keys(data).map(function(key) {
          return [Number(key), data[key]];
        });
        console.log(result)
        var tempHtml= "<div class='title'>Shopping Cart</div>";
        // for (var i = 1;)
        $(result).each(function(index){
          // console.log(result[index][1]['id']);
          tempHtml += '<div class="item"><div class="buttons"><a href="/remove-cart-item/'+result[index][1]["id"]+'"><span class="delete-btn"></span></a></div><div class="image"><img src="'+result[index][1]["image"]+'" height="100" width="100" alt="" /></div><div class="description"><span>'+result[index][1]["name"]+'</span><strong>Rs. '+result[index][1]["price"]+'</strong></div><div class="quantity" id="'+result[index][1]["id"]+'"><button class="plus-btn" type="button" name="button"><img src="svg/plus.svg" alt=""/></button><input type="text" name="qty" value="'+result[index][1]['qty']+'"><button class="minus-btn" type="button" name="button"><img src="svg/minus.svg" alt="" /></button></div><div class="total-price">Total Price: Rs.'+result[index][1]['total_price']+'</div></div>';
        });
        $('.shopping-cart').html(tempHtml);
      }
    })
  }
</script>
@endsection
