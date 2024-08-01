@extends('layouts.client')




@section('content')
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">my-account</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
    <!-- my account wrapper start -->
    <div class="my-account-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="myaccount-content">
                        <h5>Orders</h5>
                        <div class="myaccount-table text-center">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Ngày đặt</th>
                                                <th>Trạng thái</th>
                                                <th>Tổng tiền</th>
                                                <th>Hành động</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($donHang as $item)
                                              <tr>
                                                <td>{{$item->ma_don_hang}}</td>
                                                <td>{{$item->created_at->format('d-m-y')}}</td>
                                                <td>{{$trangThaiDonHang[$item->trang_thai_don_hang]}}</td>
                                                <td>{{number_format($item->tong_tien,0,'','.')}} đ</td>
                                               
                                                <td class="d-flex justify-content-center">

                                                    <a href="{{route('donhangs.show',$item->id)}}" class="btn btn-sqr me-3" >View</a>
                                                    <form action="{{route('donhangs.update',$item->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                            @if ($item->trang_thai_don_hang === $type_cho_xac_nhan)
                                                                <input type="hidden" name="huy_don_hang" value="1">
                                                                <button  style="margin-top:20px " type="submit" class="btn btn-sqr bg-darker" onclick="return confirm('Bạn có muốn hủy đơn hàng không ?')">Hủy</button>
                                                            @elseif($item->trang_thai_don_hang === $type_dang_van_chuyen)
                                                            <input type="hidden" name="da_giao_hang bg-success" value="1">
                                                            <button type="submit" class="btn btn-sqr " onclick="return confirm('Bạn có muốn hủy đơn hàng không ?')">Đã nhận hàng</button>
                                                            @endif
                                                        </form>
                                                </td>
                                              </tr>
                                          @endforeach
                                            
                                        </tbody>
                                    </table>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

    <!-- my account wrapper end -->
    

   
</main>
@endsection