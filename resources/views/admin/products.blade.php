@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form enctype="multipart/form-data" method="POST" action="{{ route('admin.products.create') }}">
        @csrf
        <div class="cart-product-list__item">
            <div class="form-group row">
                <div><label  class="col-md-4 col-form-label text-md-right">Название Товара</label></div>
                @if ($errors->has('name'))
                    <div >{{$errors->first('name')}}</div>
                @endif
                    <input name="name">
                <div><label  class="col-md-4 col-form-label text-md-right">ID категории</label></div>
                @if ($errors->has('category_id'))
                    <div >{{$errors->first('category_id')}}</div>
                @endif
                    <input name="category_id">
                <div><label  class="col-md-4 col-form-label text-md-right">Цена</label></div>
                @if ($errors->has('price'))
                    <div >{{$errors->first('price')}}</div>
                @endif
                    <input name="price">
                <div><label  class="col-md-4 col-form-label text-md-right">Описание</label></div>
                @if ($errors->has('description'))
                    <div >{{$errors->first('description')}}</div>
                @endif
                    <input name="description">
                <div><label  class="col-md-4 col-form-label text-md-right">Картинка товара</label></div>
                @if ($errors->has('image'))
                    <div >{{$errors->first('image')}}</div>
                @endif
                    <input name="image" type="file">
            </div>
            <div class="cart-product__item__product-price">
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Создать
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </form>
    <div class="cart-product-list">
        @foreach($products as $product)
            <div class="cart-product-list__item">
                <div class="cart-product__item__product-photo"><img src="{{$product->image}}" class="cart-product__item__product-photo__image"></div>
                <div class="cart-product__item__product-name">
                    <div class="cart-product__item__product-name__content">{{$product->name}}</div>
                </div>
            <div class="cart-product__item__product-price"><span class="product-price__value">{{$product->price}}</span></div>
                <form method="POST" action={{ route('admin.products.delete') }}>
                    @csrf
                    <input name="product_id" type="hidden" value={{$product->id}}>
                    <button type="submit" class="btn btn-primary">Удалить</button>
                </form>
                <form method="POST" action={{ route('admin.products.read') }}>
                    @csrf
                    <input name="product_id" type="hidden" value="{{$product->id}}">
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </form>
            </div>
        @endforeach
    </div>

    <div class="content-footer__container">
        <ul class="page-nav">
            {{ $products->links() }}
        </ul>
    </div>
@endsection
