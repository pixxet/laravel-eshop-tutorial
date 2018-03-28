@extends('layouts.app')
 
@section('Digital shop', 'Page Title')
 
@section('sidebar')
    @parent
@endsection
 
@section('boxed_content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Product</th>
            <th></th>
            <th class="text-center"></th>
            <th class="text-center">Total</th>
            <th> </th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td class="col-sm-8 col-md-6">
                    <div class="media">
                        <a class="thumbnail pull-left" href="#"> <img class="media-object" src="/storage/{{$item->product->imageurl}}" style="max-width: 100px; max-height: 72px; margin-right: 10px"> </a>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="#">{{$item->product->name}}</a></h4>
                        </div>
                    </div></td>
                <td class="col-sm-1 col-md-1" style="text-align: center">
                </td>
                <td class="col-sm-1 col-md-1 text-center"></td>
                <td class="col-sm-1 col-md-1 text-center"><strong>{{CURRENCY}} {{$item->product->price}}</strong></td>
                <td class="col-sm-1 col-md-1">
                    <a href="/removeItem/{{$item->id}}"> <button type="button" class="btn btn-danger">
                            <span class="fa fa-remove"></span> Remove
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach

        <tr>
            <td>   </td>
            <td>   </td>
            <td>   </td>
            <td><h3>Total</h3></td>
            <td class="text-right"><h3><strong>{{CURRENCY}} {{$total}}</strong></h3></td>
        </tr>
        <tr>
            <td>   </td>
            <td>   </td>
            <td>   </td>
            <td>
                <a href="/"> <button type="button" class="btn btn-default">
                        Continue Shopping<span class="ml-2 fa fa-shopping-cart"></span>
                    </button>
                </a></td>
            <td>


        <form action="/checkout" method="POST">
            {!! csrf_field() !!}
            <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="{{ config('services.stripe.key') }}"
                    data-amount="{{ $total*100 }}"
                    data-name="{{ config('app.name') }}"
                    data-description="Products"
                    data-image="https://shop.marc-o-polo.com/on/demandware.static/Sites-MOP-Site/-/default/dwcb48eb03/images/logo/logo_mop_signet.svg"
                    data-locale="auto"
                    data-currency="{{ CURRENCY_CODE }}"
                    data-email="{{Auth::user()->email}}"
                    >
            </script>
        </form>
            </td>
        </tr>
        </tbody>
    </table>
@append
 