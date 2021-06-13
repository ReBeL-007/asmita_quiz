@extends('admin.backend.layouts.master')
@section('title','View Question')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.question.title_singular') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.questions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.id') }}
                        </th>
                        <td>
                            {{ $question->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.quiz') }} Title
                        </th>
                        <td>
                            @foreach($question->quizzes as $i=>$q) {{ $q->title ?? '' }} @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.options') }}
                        </th>
                        <td>
                            @foreach($question->questionOptions as $key=>$options) <label
                                class=" @if($options->points !== 0) badge badge-success @else badge badge-secondary @endif">
                                <div class="readonly-editor" id="o{{ $key}}">{{ $options->option_text ?? '' }}</div>
                            </label> @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.question.fields.question_text') }}
                        </th>
                        <td>
                            <div class="readonly-editor" id="q{{ $i}}">{{ $question->question_text }}</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.questions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
