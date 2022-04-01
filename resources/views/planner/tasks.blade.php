@extends('layouts.main')

@section('content')
<drag-and-drop :trip='@json($tasks)' />

@endsection