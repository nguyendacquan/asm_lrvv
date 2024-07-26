@extends('layouts.admin')


@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý dang mục sản phẩm</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('admins.danhmucs.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Tên dang mục</label>
                                            <input type="text" id="ten_danh_muc" name="ten_danh_muc"
                                                class="form-control @error('ten_danh_muc') is-invalid @enderror"
                                                value="{{ old('ten_danh_muc') }}" placeholder="Tên dang mục">
                                            @error('ten_danh_muc')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-sm-10 mb-3 d-flex gap-2">
                                            <label for="trang_thai" class="form-label">Trạng thái</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="trang_thai"
                                                    id="gridRadios1" value="0" checked>
                                                <label class="form-check-label text-danger" for="gridRadios1">
                                                    Ẩn
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="trang_thai"
                                                    id="gridRadios2" value="1">
                                                <label class="form-check-label text-success" for="gridRadios2">
                                                    Hiển thị
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Hình Ảnh</label>
                                            <input type="file" id="hinh_anh" name="hinh_anh" class="form-control"
                                                onchange="showImage(event)">
                                            <img id="img_danh_muc" src="" alt="Hình ảnh sản phẩm"
                                                style="width: 150px; display:none">

                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button style="submit"
                                            class="btn btn-primary justify-content-center">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div> <!-- container-fluid -->
    </div>
@endsection


@section('js')
    <script>
        function showImage(event) {
            const img_danh_muc = document.getElementById('img_danh_muc');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                img_danh_muc.src = reader.result;
                img_danh_muc.style.display = 'block';
            }

            if(file){
                reader.readAsDataURL(file)
            }
        }
    </script>
@endsection
