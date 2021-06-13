<?php

namespace App\Http\Requests;

use App\Group;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('group-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:groups,id',
        ];

    }
}