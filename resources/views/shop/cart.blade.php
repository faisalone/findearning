@extends('layout.layout')

@php
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>';
    $title='Cart';
    $subTitle = 'Shop';
    $subTitle2 = 'Cart';
    $script = '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>';
@endphp

@section('content')

    <!-- ..::Cart Section Start Here::.. -->
    <div class="rts-cart-section">
        <div class="container">
            <h4 class="section-title">Product List</h4>
            <div class="row justify-content-between">
                <div class="col-xl-7">
                    <div class="cart-table-area">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <!-- ...existing header columns... -->
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr id="cart-row-{{ $item['product']->id }}" data-price="{{ $item['product']->price }}">
                                        <td>
                                            <div class="product-thumb">
                                                @if(isset($item['product']->imagePaths[0]['url']))
                                                    <img src="{{ $item['product']->imagePaths[0]['url'] }}" alt="product-thumb" style="width: 100px; height: auto;">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-title-area">
                                                @if(isset($item['product']->category))
                                                    <span class="pretitle">{{ $item['product']->category->title }}</span>
                                                @endif
                                                <h4 class="product-title">{{ $item['product']->title }}</h4>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="product-price">{{ $item['product']->price }}</span>
                                        </td>
                                        <td>
                                            <div class="cart-edit">
                                                <div class="quantity-edit" data-product-id="{{ $item['product']->id }}">
                                                    <button class="button minus"><i class="fal fa-minus"></i></button>
                                                    <input type="text" class="input cart-quantity" value="{{ $item['quantity'] }}" />
                                                    <button class="button plus"><i class="fal fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="last-td">
                                            <button class="remove-btn" data-product-id="{{ $item['product']->id }}">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="checkout-box">
                        <div class="checkout-box-inner">
                            @php
                                $subtotal = 0;
                                foreach($cartItems as $item) {
                                    $subtotal += $item['product']->price * $item['quantity'];
                                }
                            @endphp
                            <div class="subtotal-area">
                                <span class="title">Subtotal</span>
                                <span class="subtotal-price">${{ number_format($subtotal, 2) }}</span>
                            </div>
                        </div>
                        <a href="{{ route('checkOut') }}" class="procced-btn">Procced To Checkout</a>
                        <a href="{{ route('shop') }}" class="continue-shopping"><i class="fal fa-long-arrow-left"></i> Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ..::Cart Section End Here::.. -->

    <script>
    // New function to recalculate subtotal dynamically
    function recalcSubtotal() {
        let subtotal = 0;
        document.querySelectorAll('tr[id^="cart-row-"]').forEach(function(row) {
            let price = parseFloat(row.getAttribute('data-price')) || 0;
            let quantity = parseInt(row.querySelector('.cart-quantity').value) || 0;
            subtotal += price * quantity;
        });
        document.querySelector('.subtotal-area .subtotal-price').textContent = '$' + subtotal.toFixed(2);
    }

    document.querySelectorAll('.remove-btn').forEach(function(button){
        button.addEventListener('click', function(){
            let productId = this.getAttribute('data-product-id');
            let row = document.getElementById('cart-row-' + productId);
            fetch("{{ route('shop.removeFromCart') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    // update header counters
                    if(document.getElementById('cart-count')){
                        document.getElementById('cart-count').textContent = data.count;
                    }
                    if(document.getElementById('mobile-cart-count')){
                        document.getElementById('mobile-cart-count').textContent = data.count;
                    }
                    // remove the row from DOM
                    row.remove();
                    recalcSubtotal();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    document.querySelectorAll('.quantity-edit').forEach(function(container) {
        let productId = container.getAttribute('data-product-id');
        let inputField = container.querySelector('.cart-quantity');
        let minusButton = container.querySelector('.minus');
        let plusButton = container.querySelector('.plus');

        function updateQuantity(newQty) {
            fetch("{{ route('shop.updateCart') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({ product_id: productId, quantity: newQty })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    inputField.value = data.newQuantity;
                    // update header counters
                    if(document.getElementById('cart-count')){
                        document.getElementById('cart-count').textContent = data.count;
                    }
                    if(document.getElementById('mobile-cart-count')){
                        document.getElementById('mobile-cart-count').textContent = data.count;
                    }
                    recalcSubtotal();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        minusButton.addEventListener('click', function() {
            let currentQty = parseInt(inputField.value);
            if(currentQty > 1) {
                updateQuantity(currentQty - 1);
            }
        });

        plusButton.addEventListener('click', function() {
            let currentQty = parseInt(inputField.value);
            updateQuantity(currentQty + 1);
        });

        // Optionally update on manual input change
        inputField.addEventListener('change', function() {
            let newQty = parseInt(inputField.value) || 1;
            updateQuantity(newQty);
        });
    });

    // Initial subtotal calculation on page load
    recalcSubtotal();
    </script>

@endsection