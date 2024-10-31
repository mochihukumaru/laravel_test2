@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection


@section('content')
<body>
    <div class="container">
        <div class="container__header">
            <h1 class="container__header-logo">商品一覧</h1>
            <form class="register" action="products/register" method="get">
            @csrf
                <button class="register__btn" type="submit">＋商品を追加</button>
            </form>
        </div>

        <div class="container__inner">
            <aside class="sidebar">
                <from action="{{ route('products.search') }}" method="get">
                    <input class="search-form__item-input" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名で検索">
                    <button class="search-form__item-btm" type="submit">検索</button>
                </form>
                
            </aside>

            <main>
                <div class="main__container">
                    <div class="main__container-row">
                        @foreach($products as $product)
                        <div class="col-md4">
                            <div class="card__shadow-sm">
                                <a class="image-send__show" href="{{ route('show', ['productId' => $product->id]) }}">
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{$product->name }}</h5>
                                    <p class="card-text">¥{{number_format($product->price) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </main>
        </div>

        <footer class="footer">
            <div class="pagination">
                {{ $products->appends(['search => $search'])->links('vendor.pagination.simple-pagination') }}
            </div>
        </footer>
    </div>
</body>
@endsection

