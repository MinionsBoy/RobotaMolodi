@extends('newDesign.layouts.admin')

@section('ckeditor')
    @include('newDesign.layouts.includes.ckeditor')
@stop
@section('content')
    <h1>Редагувати новину</h1>

    {!! Form::model($newsOne, array(
        'method' => 'PUT',
        'route' => ['admin.news.update', $newsOne->id],
        'files'=>true))
    !!}
        @include('newDesign.admin.news._form')
    {!! Form::close() !!}

    <script type="text/javascript">
        CKEDITOR.replace('editor1');
    </script>
@stop