@extends('admin.layout')

@section('content')
    <div class="container">
        <h4 class="font-weight-normal my-4">Создание категории</h4>
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <form action="{{ route('admin.categories.store', ['parent_id'=>request()->parent_id]) }}" method="post">
            {{ csrf_field() }}
            <div class="mb-4">
                <div class="form-group row">
                    <div class="col-lg-2">Название</div>
                    <div class="col-7 col-lg-4">
                        <input class="form-control form-control-sm" name="name" value="{{ old('name') }}" type="text">
                        @if ($errors->has('name'))
                            <span class="font-weight-bold small">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <button class="btn btn-sm btn-primary shadow" type="submit">Создать</button>
        </form>
    </div>
@endsection
