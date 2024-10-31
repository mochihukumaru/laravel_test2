@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}" >
@endsection

@section('content')

<body>
    <div class="register-form">
        <h2 class="register-form__heading">商品登録</h2>
        <div class="register-form__inner">
            <form action="/products" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="register-form__group">
                    <label class="register-form__label-name" for="name">商品名<span class="product-form__required">必須</span></label>
                    <input class="register-form__input-name" type="text" name="name" id="name" value="{{ old('name')}}" placeholder="商品名を入力">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="register-form__group">
                    <label class="register-form__label-price" for="price">値段<span class="product-form__required">必須</span></label>
                    <input class="register-form__input-price" type="text" name="price" id="price" value="{{ old('price')}}" placeholder="値段を入力">
                    @error('price')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="register-form__group">
                     <label class="register-form__label-image" for="image">商品画像<span class="product-form__required">必須</span></label>
                    <input class="register-form__input-file" type="file" name="image" id="image" accept="image/*">
                    @error('image')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="register-form__group-season">
                    <label class="register-form__label-season" for="">季節<span class="product-form__required">必須</span><span class="select-text">複数選択可</span></label>
                    <div class="register-form__season-inputs">
                         <div class="register-form__season-option">
                             @foreach($seasons as $season)
                            <label class=" register-form__season-label">
                                <input type="checkbox" name="season[]" id="" value="{{ $season->id }}">{{$season->name}}</label>
                            @endforeach
                        </div>
                    </div>
                    @error('season')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="register-form__group">
                    <label class="register-form__label-description" for="description">商品説明<span class="product-form__required">必須</span></label>
                    <textarea class="register-form__input-description" name="description" id="" cols="30" rows="10" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                        @error('description')
                    <p class="text-danger">{{$message}}</p>
                        @enderror
                </div>
            
                <div class="register-form__btn-inner">
                    <button class="register-form__back-btn" type="submit" name="back">戻る</button>
                    <button class="register-form__send-btn" type="submit" name="send">登録</button>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection

