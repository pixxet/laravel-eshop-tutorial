@extends('layouts.app')
 
@section('Digital shop', 'Page Title')
 
@section('sidebar')
    @parent
@endsection
 
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-4">
                    <div class="card" >
                        <img src="/storage/{{$product->imageurl}}" class="img-fluid">
                        <div class="card-header">
                            <h3>{{$product->name}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="/addProduct/{{$product->id}}" class="btn btn-success btn-product">
                                        Buy <span class="fa fa-shopping-cart"></span>
                                    </a>
                                </div>

                                <div class="col-md-6 col-6 price">
                                    <h3>
                                        <label>{{CURRENCY}} {{$product->price}}</label>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
 
@endsection
 