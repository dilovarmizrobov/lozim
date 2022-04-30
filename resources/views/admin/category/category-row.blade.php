@foreach($categories as $category)
    <tr>
        <th scope="row" class="{{ $loop->depth === 1 ? "bg-primary" : ($loop->depth === 2 ? "bg-dark" : ($loop->depth === 3 ? "bg-danger" : "bg-success")) }} text-white">{{ is_null($category->parent_id) ? '' : $category->parent_id }}</th>
        <td>{{ $category->id }}</td>
        <td>{{ $category->slug }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->products->count() }}</td>
        <td>
            <form action="{{ route('admin.categories.destroy', $category->id)}}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <a href="{{ route('admin.categories.create', ['parent_id'=>$category->id]) }}" class="btn btn-sm btn-primary">
                    <i class="la la-plus"></i>
                </a>
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">
                    <i class="la la-pen"></i>
                </a>
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="la la-remove"></i>
                </button>
            </form>
        </td>
    </tr>
    @if($category->children)
        @include('admin.category.category-row', ['categories'=>$category->children])
    @endif
@endforeach
