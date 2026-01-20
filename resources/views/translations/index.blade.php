@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>All Translations</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Group</th>
                    <th>Key</th>
                    <th>Original Text (EN)</th>
                    <th>Hindi Translation</th>
                    <th>Gujarati Translation</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($translations as $translation)
                <tr>
                    <td>{{ $translation->id }}</td>
                    <td>{{ $translation->group }}</td>
                    <td>{{ $translation->key }}</td>
                    <td>{{ $translation->text }}</td>
                    <td>{{ $translation->getTranslation('hi') }}</td>
                    <td>{{ $translation->getTranslation('gu') }}</td>
                    <td>{{ $translation->created_at->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection