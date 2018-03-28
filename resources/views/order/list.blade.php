@extends('layouts.app')
 
@section('Digital shop', 'Page Title')
 
@section('sidebar')
    @parent
@endsection
 
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Your past orders</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="w-60">Id</th>
                        <th class="w-40">Date</th>
                        <th></th>
                    </tr>
                    </thead>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td><a href="/order/{{$order->id}}"> {{$order->created_at}}</a></td>
                            <td><a href="/order/{{$order->id}}"><i class="fa fa-search-plus"></i></a></td>
                        </tr>
                    @endforeach
     
                </table>
            </div>
        </div>
    </div>
@endsection
 