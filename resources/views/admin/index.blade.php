@extends('layouts.app')

@section('content')
    <a href={{route('admin.products.index')}} class="nav-list__item__link">Товары</a>
    <a href={{route('admin.categories.index')}} class="nav-list__item__link">Категории</a>
    <a href={{route('admin.orders.index')}} class="nav-list__item__link">Заказы</a>
@endsection
