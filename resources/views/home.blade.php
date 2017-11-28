@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::guest())
        <div class="alert alert-warning">Зарегистрируйтесь чтоб увидеть админку</div>
    @endif
    @if(count($categories) < 1)
        <div class="alert alert-danger">Зайдите в админку и добавьте товары</div>
        @else
            <table class="table table-responsive">
                <th>Название товара</th> <th>Информация о товаре</th>
            @foreach($items as $item)

                  <tr>  <td>{{$item->item}}</td> <td>{{$item->info}}</td> </tr>


                @endforeach
            </table>
    @endif

</div>
@endsection
