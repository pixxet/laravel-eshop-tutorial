@extends('layouts.app')
 
@section('Digital shop', 'Page Title')
 
@section('sidebar')
    @parent
@endsection
 
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Order num : {{$order->id}}</h3>
                <h3>Made on : {{$order->created_at}}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="w-60">Name</th>
                        <th class="w-20">Price</th>
                    </tr>
                    </thead>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td>
                                <div class="media">
                                    <a class="thumbnail pull-left" href="#"> <img class="media-object" src="/storage/{{$item->product->imageurl}}" style="max-width: 100px; max-height: 72px; margin-right: 10px"> </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="#">{{$item->product->name}}</a></h4>
                                    </div>
                                </div>
                            </td>
                            <td>{{CURRENCY}} {{number_format(intval($item->product->price),2,',','')}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
 