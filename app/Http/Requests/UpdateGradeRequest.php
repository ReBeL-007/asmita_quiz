<?php

namespace App\Http\Requests;

use App\Grade;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateGradeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('grade-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }
}
