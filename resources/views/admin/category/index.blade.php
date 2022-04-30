@extends('admin.layout')

@section('content')
    <div class="container my-4">
        <h3 class="font-weight-normal mb-4">
            <a class="text-dark" href="{{ route('admin.categories.index') }}">Каталог</a>
        </h3>
        @if(session()->get('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @elseif(session()->get('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}</div>
        @endif
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">Parent ID</th>
                <th scope="col">ID</th>
                <th scope="col">Slug</th>
                <th scope="col">Название</th>
                <th scope="col">Продукты</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @include('admin.category.category-row', ['categories'=>$categories->getIndexCategories()])
                @if($categories->getIndexCategories()->count() === 0)
                    <tr>
                        <td colspan="99">
                            <div class="my-5 py-5 text-center">
                                <h6 class="mb-3 font-weight-normal">Ничего не найдено</h6>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
