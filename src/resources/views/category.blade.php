@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="category_alert">
    @if(session ('message'))
    <div class="category_alert-success">
        {{ session('message') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="category_alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="category_content">
    <form class= "create_form" action="/categories" method="post"  >
        @csrf
        <div class="create_form-item">
            <input class="create_form-item_input" type="text" name="name" value="{{ old('name') }}">
        </div>
        <div class="create_form-button">
            <button class="create_form-button_submit" type="submit">作成</button>
        </div>
    </form>
    <div class="category_table">
        <table class="category_table-inner">
            <tr class="category_table-row">
                <th class="category_table-header">category</th>
            </tr>
            @foreach($categories as $category)
            <tr class="category_table-row">
                <td class="category_table-item">
                    <form class="update_form" action="/categories/update" method="post" >
                        @method('patch')
                        @csrf
                        <div class="update_form-item">
                            <input class="update_form-item_input" type="text" name='name' value="{{ $category['name'] }}">
                            <input type="hidden" name="id" value="{{ $category['id'] }}">
                        </div>
                        <div class="update_form-button">
                            <button class="update_form-button_submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="category_table-item">
                    <form class="delete_form" action="/categories/delete" method="post">
                        @method('delete')
                        @csrf
                        <div class="delete_form-button">
                            <input type="hidden" name="id" value="{{ $category['id'] }}">
                            <button class="delete_form-button_submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection