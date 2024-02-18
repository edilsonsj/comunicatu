@extends('layouts.main')
@section('content')
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Funções</th>
        </tr>
        @foreach ($departments as $department)
            <tr>
                <td>{{ $department->id }}</td>
                <td>{{ $department->name }}</td>
                <td>{{ $department->email }}</td>
                <td>
                    @foreach ($department->assignments as $assignment)
                        - {{ $assignment->assignment }} <br>
                    @endforeach
                </td>
                <td>
                    <a id="edit-button" href="/departments/edit/{{ $department->id }}">Editar</a>
                    <br>
                    <form action="/departments/{{ $department->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input id="delete-button" type="submit" value="Excluir">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
