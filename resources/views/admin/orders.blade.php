@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.orders.create') }}">
        @csrf

        <div class="form-group row">
            <label  class="col-md-4 col-form-label text-md-right">ID Товара</label>
            @if ($errors->has('product_id'))
                <div >{{$errors->first('product_id')}}</div>
            @endif
            <div class="col-md-6">
                <input name="product_id">
            </div>
            <label  class="col-md-4 col-form-label text-md-right">Почта пользователя</label>
            @if ($errors->has('user_email'))
                <div >{{$errors->first('user_email')}}</div>
            @endif
            <div class="col-md-6">
                <input name="user_email">
            </div>

        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Создать
                </button>
            </div>
        </div>
    </form>
    @foreach($orders as $order)
        <li class="sidebar-category__item"><a class="sidebar-category__item__link" ><b>Товар:</b>{{$order->product->name}} <b>Цена:</b>{{$order->product->price}} <b>Заказчик:</b>{{$order->user_email}}</a>
            <div>
                <form method="POST" action={{ route('admin.orders.delete') }}>
                    @csrf
                    <input name="order_id" type="hidden" value={{$order->id}}>
                    <button type="submit" class="btn btn-primary">Удалить</button>
                </form>
            </div>
            <div>
                <form method="POST" action={{ route('admin.orders.read') }}>
                    @csrf
                    <input name="order_id" type="hidden" value="{{$order->id}}">
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </form>
            </div>

    @endforeach
            <div class="content-footer__container">
                <ul class="page-nav">
                    {{ $orders->links() }}
                </ul>
            </div>
@endsection
