@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
@section('content')
<div class="content">
    <div class="container-xxl">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Quản lý Slide</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title align-content-center mb-0"></h5>
                        <a href="{{ route('admins.slider.create') }}" class="btn btn-success">
                            <i data-feather="plus-square"></i> Thêm Slider
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Tên Banner</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listBanner as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td><img src="{{url('storage/', $item->image)}}" alt="Banner Image" style="width: 150px;"></td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->status}}</td>
                                        <td>
                                            <a href="{{ route('admins.slider.edit', $item->id) }}">
                                                <i class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                            </a>
                                            <form action="{{ route('admins.slider.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có muốn xóa không')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border-0 bg-white">
                                                    <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- End of loop -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection