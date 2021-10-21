@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.categories.create') }}">
        @csrf

        <div class="form-group row">
            <label  class="col-md-4 col-form-label text-md-right">Категория</label>
            @if ($errors->has('category'))
                <div >{{$errors->first('category')}}</div>
            @endif
            <div class="col-md-6">
                <input name="category">
            </div>
            <label  class="col-md-4 col-form-label text-md-right">Описание</label>
            @if ($errors->has('description'))
                <div >{{$errors->first('description')}}</div>
            @endif
            <div class="col-md-6">
                <input name="description">
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
    @foreach($categories as $category)
        <li class="sidebar-category__item"><a class="sidebar-category__item__link" >{{$category->name}}</a>
            <div>
                <form method="POST" action={{ route('admin.categories.delete') }}>
                    @csrf
                    <input name="category_id" type="hidden" value={{$category->id}}>
                    <button type="submit" class="btn btn-primary">Удалить</button>
                </form>
            </div>
            <div>
                <form method="POST" action={{ route('admin.categories.read') }}>
                    @csrf
                    <input name="category_id" type="hidden" value="{{$category->id}}">
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </form>
            </div>

        {{$category->description}}


    @endforeach
            <div class="content-footer__container">
                <ul class="page-nav">
                    {{ $categories->links() }}
                </ul>
            </div>
@endsection
