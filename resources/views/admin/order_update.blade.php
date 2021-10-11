@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('admin.orders.update') }}">
        @csrf

        <div class="form-group row">
            <label  class="col-md-4 col-form-label text-md-right">ID Товара</label>

            <div class="col-md-6">
                <input name="product_id" value={{$order->product_id}}>
            </div>
            <label  class="col-md-4 col-form-label text-md-right">Почта пользователя</label>

            <div >
                <input name="user_email"  value="{{$order->user_email}}">
            </div>
            <div >
                <input name="id"  type="hidden" value="{{$id}}">
            </div>


        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Обновить
                </button>
            </div>
        </div>
    </form>
@endsection
