@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css')}}">
@endsection


@section('content')
<body>
    <div class="container">
        <div class="product_index">
            <a href="{{ route('index') }}">商品一覧</a> >{{$product->name}}
        </div>

        <div class="row_mt-4">
            <form class="update-form" action="{{ route('update', ['productId' => $product->id]) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf

            <div class="container-up">
                <div class="product__image">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{$product->name}}" class="img-fluid">
                    <input class="form_control-file" type="file" name="image" accept="image/*">
                    @error('image')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <h3 class="mt-4">商品名</h3>
                    <input type="text" class="form_product" name="name"  value="{{ old('name',$product->name) }}" >
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror

                    <div class="show-form__price">
                        <h3 class="mt-4">値段</h3>
                        <input type="text" class="form_product" name="price" value="¥{{ old('price',$product->price) }}" >
                        @error('price')
                        <p class="text-danger">{{$message}}</p>
                            @enderror
                    </div>

                    <div class="show-form__season">
                        <h3 class="mt-4">季節</h3>
                        <div class="season_check">
                            @foreach($seasons as $season)
                                <label class=" register-form__season-label">
                                    <input type="checkbox" name="season[]" id="" value="{{ $season->id }}" {{ in_array($season->id, old('season', $selectedSeasons ?? [])) ? 'checked' : '' }}>{{$season->name}}</label>
                            @endforeach
                            @error('season')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            
            <div class="show-form__description">
                <h3 class="mt-4">商品説明</h3>
                <textarea class="form_product-description" name="description" rows="5" >{{ old('description',$product->description) }}</textarea>
                @error('description')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="justify-content-between">
                <input class="products_back" type="submit" value="戻る" name="back">
                <input class="products_update" type="submit" value="変更を保存" name="send">
            </div>
        </form>
    </div>


        <form class="delete-form" action="{{ route('delete', ['productId' => $product->id]) }}" method="post">
            @method('DELETE')
            @csrf
            <div class="delete-form__button">
                <input type="hidden" name="id" value="{{$product['id'] }}">
                <button class="delete-form__button-submit" type="submit"><img src=" {{ asset('images/react-icons/TiTrash.png') }}" alt="削除" class="delete-button__icon"></button>
            </div>
        </form>
</body>
@endsection


