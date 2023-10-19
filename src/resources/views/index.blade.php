@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="todo_alert">
    @if (session('message'))
    <div class="todo_alert-success">
        {{ session('message')}}
    </div>
    @endif
    @if ($errors->any())
    <div class="todo_alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="todo_content">
    <div class="section__title">
        <h2>新規作成</h2>
    </div>
    <form class="create-form" action="/todos" method="post">
        @csrf
        <div class="create-form__item">
            <input class="create-form__item-input" type="text" name="content" value="{{ old('content') }}"/>
            <select class="create-form__item-select" name=""category_id">
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>
    <div class="section__title">
        <h2>Todoの検索</h2>
    </div>
    <form class="search-form">
        <div class="search-form__item">
            <input class="search-form__item-input" type="text" />
            <select class="search-form__item-select">
                <option value="">カテゴリ</option>
            </select>
        </div>
        <div class="search-form__button">
            <button class="search-form__button-submit" type="submit">検索</button>
        </div>
    </form>
    <div class="todo_table">
        <table class="todo_table-inner">
            <tr class="todo_table-row">
                <th class="todo_table-header">
                    <span class="todo-table_header-span">Todo</span>
                    <span class="todo-table_header-span">カテゴリ</span>
                </th>
            </tr>
            @foreach($todos as $todo)
            <tr class="todo_table-row">
                <td class="todo_table-item">
                    <form class="update_form" action="/todos/update" method="post">
                        @method('patch')
                        @csrf
                        <div class="update_form-item">
                            <input class="update_form-item__input" type="text" name="content" value="{{ $todo['content'] }}">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>
                        <div class="update-form_item">
                            <p class="update-form_item-p">{{ $todo['category'] ['name'] }}</p>
                        </div>
                        <div class="update_form-button">
                            <button class="update_form-button__submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo_table-item">
                    <form class="delete_form" action="/todos/delete" method="post">
                        @method('delete')
                        @csrf
                        <div class="delete_form-button">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                            <button class="delete_form-button__submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
