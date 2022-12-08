@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать товар</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Главная</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <input type="text" name="title" value="{{ old('title') ?? $product->title }}" class="form-control" placeholder="Наименование">
                    </div>
                    <div class="form-group">
                        <input type="text" name="description" value="{{ old('description') ?? $product->description }}" class="form-control" placeholder="Описание">
                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" cols="30" rows="10" placeholder="Контент">{{ old('content') ?? $product->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="price" value="{{ old('price') ?? $product->price }}" class="form-control" placeholder="Цена">
                    </div>
                    <div class="form-group">
                        <input type="text" name="count" value="{{ old('count') ?? $product->count }}" class="form-control" placeholder="Количество на складе">
                    </div>

                    <img src="{{ url('storage/' . $product->preview_image) }}" alt="main_image" class="w-50">

                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == old('category_id', $product->category_id) ? ' selected' : '' }}>
                                {{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="tags[]" class="tags" multiple="multiple" data-placeholder="Выберите тег" style="width: 100%;">
                            @if(is_array(old('tags')))
                                @foreach($tags as $tag)
                                    <option {{ in_array($tag->id, old('tags')) ? ' selected' : '' }} value="{{ $tag->id }}">{{ $tag->title }}</option>
                                @endforeach
                            @else
                                @foreach($tags as $tag)
                                    <option {{ in_array($tag->id, $product->tags->pluck('id')->toArray()) ? ' selected' : '' }} value="{{ $tag->id }}"> {{ $tag->title }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="colors[]" class="colors" multiple="multiple" data-placeholder="Выберите цвет" style="width: 100%;">
                            @if(is_array(old('colors')))
                                @foreach($colors as $color)
                                    <option {{ in_array($color->id, old('colors')) ? ' selected' : '' }} value="{{ $color->id }}">
                                        {{ $color->title }}
                                    </option>
                                @endforeach
                            @else
                                @foreach($colors as $color)
                                    <option {{ in_array($color->id, $product->colors->pluck('id')->toArray()) ? ' selected' : '' }} value="{{ $color->id }}">
                                        {{ $color->title }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group w-50">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Редактировать">
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
