<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaiVietRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tieu_de' =>'required|max:255',
            'hinh_anh' => 'image|mimes:png,jpg,jpeg,gif',
            'ngay_nhap' => 'required|date',
            'san_pham_id' => 'required|exists:san_phams,id',
        ];
    }

    public function messages(): array
    {
        return [
            'tieu_de.required' => 'không được bỏ trống',
            'hinh_anh.image' => 'Hình ảnh không hợp lệ',
            'hinh_anh.mimes' => 'Hình ảnh không hợp lệ',
            'ngay_nhap.required' => 'Ngày nhập bắt buộc điền',
            'ngay_nhap.date' => 'Ngày nhập sai định dạng',
            'san_pham_id.required' => 'Danh mục bắt buộc',
            'san_pham_id.exists' => 'Danh mục không hợp lệ',
        ];
    }
}
