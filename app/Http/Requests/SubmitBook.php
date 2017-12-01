<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitBook extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'book_name'     => 'required',
            'excerption'    => 'required',
            'author_id'     => 'required',
            'book_cover'    => 'image',
            'book_file'     => 'required|mimetypes:text/plain,application/pdf',
            'total_pages'   => 'required|numeric'
        ];
    }

    public function messages()
    {
        return[
            'book_name.required'            =>  'Задължително поле',
            'excerption.required'           =>  'Информация за книгата е задължително поле',
            'author_id.required'            =>  'Задължително трябва да изберете автор',
            'book_cover.image'              =>  'Позволени са само графични файлове за "Обложка/Корица"',
            'book_file.required'            =>  'Задължително трябва да изберете файл (PDF, TXT или DOC',
            'book_file.mimestypes'          =>  'Задължително трябва да изберете файл (PDF, TXT или DOC',
            'total_pages.required'          =>  'Брой страници е задължително поле',
            'total_pages.numeric'           =>  'Брой страници може да бъде само число'
        ];
    }
}
