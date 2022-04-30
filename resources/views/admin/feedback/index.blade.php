@extends('admin.layout')

@section('content')
	<div class="container my-4">
        <h3 class="font-weight-normal">
            <a class="text-dark" href="{{ route('admin.feedback.index') }}">Отзывы</a>
        </h3>
		<div class="mt-4">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
		    <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Обращения</th>
                        <th scope="col">Тип обращения</th>
                        <th scope="col">Дата обращения</th>
                        <th scope="col">Отзыв</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
		        <tbody>
                    @forelse($feedbacks as $feedback)
                        <tr>
                            <th scope="row">{{ $feedback->id }}</th>
                            <td><a href="{{ route('admin.feedback.show', $feedback->id)}}">{{ $feedback->appeal }}</a></td>
                            <td>{{ $feedback->categoryAppeal }}</td>
                            <td>{{ $feedback->date }}</td>
                            <td>{{ $feedback->review }}</td>
                            <td>
                                <form style="display: inline-block;" action="{{ route('admin.feedback.destroy', $feedback->id)}}" method="post">
                                    @csrf

                                    <input type="hidden" name="_method" value="delete" />
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="99">
                                <div class="my-5 py-5 text-center">
                                    <h6 class="mb-3 font-weight-normal">Ничего не найдено</h6>
                                </div>
                            </td>
                        </tr>
                    @endforelse
		        </tbody>
		    </table>
		</div>
	</div>
@endsection
