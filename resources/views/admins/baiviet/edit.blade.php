@extends('layouts.admin')


@section('css')
    <link href="{{ asset('assets/admin/libs/quill/quill.core.js') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý bài viết</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('admins.baiviet.update', $baiviet->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_san_pham" class="form-label">Tiêu đề</label>
                                            <input type="text" id="tieu_de" name="tieu_de"
                                                class="form-control @error('tieu_de') is-invalid @enderror"
                                                value="{{ $baiviet->tieu_de }}" placeholder="Tiêu đề">
                                            @error('tieu_de')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Hình Ảnh</label>
                                            <input type="file" id="hinh_anh" name="hinh_anh" class="form-control"
                                                onchange="showImage(event)">
                                            <img id="img_san_pham" src="{{ url('storage/', $baiviet->hinh_anh) }}"
                                                alt="Hình ảnh sản phẩm" style="width: 150px;">
                                        </div>


                                      
                                       
                                        <div class="mb-3">
                                            <label for="san_pham_id" class="form-label">Sản phẩm</label>
                                            <select name="san_pham_id"
                                                class="form-select @error('san_pham_id') is-invalid @enderror">
                                                <option selected>Chọn danh mục</option>
                                                @foreach ($listsanpham as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $baiviet->san_pham_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->ten_san_pham }}</option>
                                                @endforeach
                                            </select>
                                            @error('san_pham_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="ngay_nhap" class="form-label">Ngày nhập</label>
                                            <input type="date" id="ngay_nhap" name="ngay_nhap"
                                                class="form-control @error('ngay_nhap') is-invalid @enderror"
                                                value="{{ $baiviet->ngay_nhap }}" placeholder="Ngày nhập">
                                            @error('ngay_nhap')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    <div class="col-lg-100">
                                        <div class="mb-3">
                                            <label class="form-label" for="hinh_anh">Nội dung bài viết</label>
                                            <div id="quill-editor" style="height: 400px;">

                                            </div>
                                            <textarea name="noi_dung" id="noi_dung_content" class="d-none"></textarea>

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
    <script src="{{ asset('assets/admin/libs/quill/quill.core.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/quill/quill.min.js') }}"></script>

    <script>
        function showImage(event) {
            const img_san_pham = document.getElementById('img_san_pham');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                img_san_pham.src = reader.result;
                img_san_pham.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file)
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill("#quill-editor", {
                theme: "snow",

            })
            // hien thi noio dung cu
            var old_content = `{!! $baiviet->noi_dung !!}`;
            quill.root.innerHTML = old_content

            // cap nhat lai textaria an khi noi dung quill_editor thay doi
            quill.on('text-change', function() {
                var html = quill.root.innerHTML;
                document.getElementById('noi_dung_content').value = html
            })
        })
    </script>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = {{ count($baiviet->hinhAnhSanPham) }};

            document.getElementById('add-row').addEventListener('click', function() {

                var tableBody = document.getElementById('image-table-body')

                var newRow = document.createElement('tr');

                newRow.innerHTML =
                    ` <td class="d-flex align-items-center">
                    <img id="preview_${rowCount}"
                    src="{{ asset('assets/admin/images/svg/alnum.svg') }}"
                    alt="Hình ảnh sản phẩm" style="width: 45px"
                    class="me-3">
                    <input type="file" id="hinh_anh"
                    name="list_hinh_anh[id_${rowCount}]" class="form-control"
                    onchange="previewImage(this,${rowCount})">
                    </td>
                    <td>
                    <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"
                    style="cursor: pointer" onclick="romoveRow(this)"></i>
                    </td>`;

                tableBody.appendChild(newRow);
                rowCount++;
            })



        });

        function previewImage(input, rowIndex) {

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(`preview_${rowIndex}`).setAttribute('src', e.target.result)
                }
                reader.readAsDataURL(input.files[0])

            }
        }

        function romoveRow(item) {
            var row = item.closest('tr');
            row.remove();
        }
    </script> --}}
@endsection
