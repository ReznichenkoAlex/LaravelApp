@extends('layouts.app')

@section('content')
    <div class="content-middle">
        <div class="content-head__container">
            <div class="content-head__title-wrap">
                <?php /** @var \App\Models\Product $product */?>
                <div class="content-head__title-wrap__title bcg-title">{{$product->name}} из категории {{$product->category->name}}</div>
            </div>
            <div class="content-head__search-block">
                <div class="search-container">
                    <form class="search-container__form">
                        <input type="text" class="search-container__form__input">
                        <button class="search-container__form__btn">search</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="content-main__container">
            <div class="product-container">
                <div class="product-container__image-wrap"><img src={{$product->image}} class="image-wrap__image-product"></div>
                <div class="product-container__content-text">
                    <div class="product-container__content-text__title">{{$product->name}}</div>
                    <div class="product-container__content-text__price">
                        <div class="product-container__content-text__price__value">
                            Цена: <b>{{$product->price}}</b>
                            руб
                        </div><a href={{route('buy', ['product' => $product->id, 'user' => Auth::user()  ?? ' '])}} class="btn btn-blue">Купить</a>
                    </div>
                    <div class="product-container__content-text__description">
                        <p>
                            {{$product->description}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
