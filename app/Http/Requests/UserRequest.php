<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user()->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'dia_chi' => 'nullable|string|max:255',
            'ngay_sinh' => 'nullable|date',
            'so_dien_thoai' => 'nullable|string|max:15',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gioi_tinh' => ['nullable', Rule::in(['Nam', 'Nữ', 'Khác'])],
            'trang_thai' => 'nullable|boolean',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được quá 255 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không được quá 255 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'password.min' => 'Mật khẩu không được ít hơn 8 ký tự',
            'password.confirmed' => 'Mật khẩu không khớp',
            'dia_chi.max' => 'Địa chỉ không được quá 255 ký tự',
            'ngay_sinh.date' => 'Ngày sinh không đúng định dạng',
            'so_dien_thoai.max' => 'Số điện thoại không được quá 15 ký tự',
            'hinh_anh.image' => 'Hình ảnh không đúng định dạng',
            'hinh_anh.mimes' => 'Hình ảnh không đúng định dạng',
            'hinh_anh.max' => 'Hình ảnh không được quá 2048 ký tự',
            'gioi_tinh.in' => 'Giới tính không đúng định dạng',
            'trang_thai.boolean' => 'Trạng thái không đúng định dạng',
            ];
    }
}
