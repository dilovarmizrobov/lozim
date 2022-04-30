@extends('admin.layout')

@section('content')
	<div class="container py-4">
        <h4 class="mb-4">Отзыв #{{ $feedback->id }}</h4>
        <table class="table">
            <tr>
                <td>Обращения</td>
                <td>{{ $feedback->appeal }}</td>
            </tr>
            <tr>
                <td>Тип обращения</td>
                <td>{{ $feedback->categoryAppeal }}</td>
            </tr>
            <tr>
                <td>Имя</td>
                <td>{{ $feedback->name }}</td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td>{{ $feedback->phone }}</td>
            </tr>
            <tr>
                <td>Почта</td>
                <td>{{ $feedback->email }}</td>
            </tr>
            <tr>
                <td>Дата обращения</td>
                <td>{{ $feedback->data }}</td>
            </tr>
            <tr>
                <td>Отзыв</td>
                <td>{{ $feedback->review }}</td>
            </tr>
        </table>
        <form action="{{ route('admin.feedback.destroy', $feedback->id)}}" method="post" class="mt-5 text-center">
            @csrf

            <input type="hidden" name="_method" value="delete" />
            <button class="btn btn-danger w-25" type="submit">Удалить</button>
        </form>
	</div>
@endsection
