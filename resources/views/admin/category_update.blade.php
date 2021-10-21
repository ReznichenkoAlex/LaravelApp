@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('admin.categories.update') }}">
        @csrf

        <div class="form-group row">
            <label  class="col-md-4 col-form-label text-md-right">Категория</label>

            <div class="col-md-6">
                <input name="category" value={{$category->name}}>
            </div>
            <label  class="col-md-4 col-form-label text-md-right">Описание</label>

            <div >
                <input name="description"  value="{{$category->description}}">
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
