@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    Заявка на приобретение игры {{$product->name}} успешно сформирована и отправлена администратору. Ожидайте пока с вами свяжутся
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
