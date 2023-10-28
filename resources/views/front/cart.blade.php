<x-front-layout title="Cart">
   
    <x-slot:breadcrumb>

            <div class="breadcrumbs">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="breadcrumbs-content">
                                <h1 class="page-title">Cart</h1>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <ul class="breadcrumb-nav">
                                <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>
                                <li><a href="{{route('products.index')}}">Shop</a></li>
                                
                            </ul>
                        </div>
                    </div>
            </div>
        </div>

    </x-slot:breadcrumb>

<div class="shopping-cart section">
    <div class="container">
            <div class="cart-list-head">
                <div class="cartlist-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">
                            <p></p>
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
        
                @forEach($cart->get() as $item)
                    <div class="cart-single-list">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="{{route('product.details', $item->product->slug)}}">
                                    <img src="{{$item->product->image_url}}" alt="">
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name">
                                    <a href="{{route('product.details',$item->product->slug)}}">
                                    {{$item->product->name}}
                                    </a>
                                </h5>
                                <p class="product-des">
                                    <span><em>Type:</em> Mirrorless</span>
                                    <span><em>Color:</em> Black</span>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="count-input">
                                    <input class="form-control" value="{{$item->quantity}}">
                                </div> 
                            </div>
                        
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{Currency::format($item->quantity * $item->product->price)}}</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{Currency::format(0)}}</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <a href="javascrpt:void(0)" class="remove-item"><i class="lni lni-close"></i></a>
                            </div>
                        </div>
                    </div>
                
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input type="text" name="coupon" placeholder="Enter your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal <span>{{Currency::format($cart->total())}}</span></li>
                                        <li>Shipping <span>free</span></li>
                                        <li>You Save <span>$29.00</span></li>
                                        <li class="last"> You Pay <span>$251.00</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="" class="btn">Checkout</a>
                                        <a href="" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    
                </div>
            </div>
    </div>
   
</div>
   
</x-front-layout>