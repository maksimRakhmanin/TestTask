@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-5" style="margin-right: 35px">
            Форма добавления категорий
            <form class="form-horizontal" method="post" id="form_category" action="{{ route('admin') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="category" placeholder="Введите название категории" value="{{ old('category') }}">
                    @if ($errors->has('category'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" name="addCategory" value="Добавить категорию в список" class="btn btn-success">
                    @if(session('success_category'))
                        <span class="help-block alert alert-success">
                            <strong>{{ session('success_category') }}</strong>
                        </span>
                    @endif
                </div>
            </form>
        </div>
        @if(count($categories) < 1)

        @else
        <div class="col-md-5">
            Форма удаления категорий
            <form class="form-horizontal" method="post" id="delete_category" action="{{ route('admin') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <select class="form-control" name="click_category">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-danger" name="del_category" value="Удалить категорию из списка">
                    @if(session('deleted'))
                        <span class="help-block alert alert-danger">
                            <strong>{{ session('deleted') }}</strong>
                        </span>
                    @endif
                </div>
            </form>
        </div>
        @endif
    </div>
    <div class="row">
            <hr/>
@if(count($categories) < 1)
           <div class="col-md-5 alert alert-danger">Список категорий пуст,добавьте категорию для добавления товаров</div>
@else
        <div class="col-md-5">
            Форма добавления товара
            <form class="form-horizontal" method="post" id="form_item" action="{{ route('admin') }}">
                {{ csrf_field() }}
            <div class="row">
                @foreach($categories as $category)
                    <label class="checkbox-inline">
                        <input type="checkbox" name="check_{{$category->id}}" value="{{$category->id}}"> {{ $category->category }}
                    </label>
                @endforeach
            </div>
            <div class="form-group{{ $errors->has('item') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="item" placeholder="Введите название товара" value="{{ old('item') }}">
                @if ($errors->has('item'))
                    <span class="help-block">
                        <strong>{{ $errors->first('item') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
                <textarea class="form-control" name="info" rows="3" value="{{ old('info') }}"></textarea>
                @if ($errors->has('info'))
                    <span class="help-block">
                        <strong>{{ $errors->first('info') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="submit" name="addItem" class="btn btn-success" value="Добавить товар">
                @if(session('success_item'))
                    <span class="help-block alert alert-success">
                            <strong>{{ session('success_item') }}</strong>
                        </span>
                @endif
            </div>
            </form>
        </div>
@endif
        @if(count($categories) < 1)

        @else
        @if(count($items) < 1)

        @else
            <div class="col-md-5">
                <form class="form-horizontal" method="post" id="form_item" action="{{ route('admin') }}">
                    {{ csrf_field() }}
                    <select name="id_cat" id="id_cat" onchange="cang('#id_cat','{{ route('admin') }}')">
                        <option value selected>Выберите категорию</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                    <div class="col-md-5">Выберите категорию</div>
                <table class="table" id="table">
                    <th>Название товара</th> <th>Удалить</th>

                </table>
                    </form>

            </div>

        @endif
        @endif
    </div>

    <div class="row">


    </div>


@endsection