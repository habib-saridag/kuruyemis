@extends('yonetim.layout.app')


@section('modul')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Ürünler</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">AnaSayfa</a></li>
                    <li class="breadcrumb-item active">Ürünler</li>
                </ol>
                <button type="button" onclick="window.location.href='{{route('yonetim.product.create')}}'"
                        class="btn btn-success d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Ürün Ekle
                </button>
            </div>
        </div>
    </div>

@endsection

@section('content')

    <div class="table-responsive">
        <table id="datatable" class="table table-striped table-hover">
            <thead class="">
            <tr>
                <th scope="col">ID</th>
                <th scope="col"></th>
                <th scope="col">Ürün Adı</th>
                <th scope="col">Kategori</th>
                <th scope="col">Marka</th>
                <th scope="col">Fiyatı</th>
                <th scope="col">Durum</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            {{$index=1}}
            @foreach($products as $key)
                <tr id="">
                    <th scope="row">{{$index++}}</th>
                    <td><img src="{{$key->image}}" width="50" height="50px"/></td>
                    <td>{{$key->name}}</td>
                    <td>{{$key->categoryId == 0 ? "---yok---":$key->category->name}}</td>
                    <td>{{$key->brandId == 0 ? "---yok---":$key->brand->name}}</td>
                    <td>
                        @if($key->discountedPrice == null)
                            {{$key->price}}
                        @else
                            <s>{{$key->price}} TL</s><br> {{ $key->discountedPrice }}
                        @endif

                        TL
                    </td>
                    <td width="2%" style="text-align: center">
                        <button type=""
                                class="btn waves-effect waves-light btn-sm btn-{{$key->status==1?'warning':'secondary'}}">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </td>
                    <td width="2%">
                        @if($key->status==1)
                            <a href="{{$key->url}}" target="_blank" title="sitede göster"><i style="color: black;"
                                                                                             class="ti-shopping-cart"></i></a>
                        @endif
                    </td>
                    <td width="2%">
                        <a href="{{ route('yonetim.product.edit',$key->id)}}"><i style="color: blue;"
                                                                                 class="fas fa-pencil-alt"></i></a>
                    </td>

                    <td width="2%">
                        <a href="javascript:void(0)">
                            <i id="{{$key->id}}" class="fas fa-trash-alt delete">
                            </i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>


    <script>
        $(".delete").click(function () {
            destroy_id = $(this).attr('id');
            alertify.confirm('Silme işlemini onaylayın!', 'Bu işlem geri alınamaz',
                function () {
                    location.href = "/yonetim/product/delete/" + destroy_id;
                },
                function () {
                    alertify.error('Silme işlemi iptal edildi')
                }
            )
        });

    </script>





@endsection
