@extends('layouts.main')
@section('content')
    <div class="container">
        <br><br>
        <h1>Edite o departamento: {{ $department->name }}</h1>
        <br><br>
        <form action="{{ route('departments.update', $department->id) }}" method="POST" id="departmentForm"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome do Departamento:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $department->name }}"
                    required>
            </div>
            <br>
            <div class="form-group">
                <label for="email">Email do Departamento:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $department->email }}"
                    required>
            </div>
            <br>
            <div class="form-group">
                <label for="assignments">Adicione novas funções do Departamento:</label>
                <input type="text" name="assignments" id="assignments" class="form-control"
                    placeholder="Digite o nome de uma função e pressione Enter para adicionar">
                <small style="font-size: 10px; color=#000">Digite o nome de uma função e pressione Enter para adicionar.
                    Você pode adicionar várias funções.</small>
                <div id="assignmentsContainer"></div> <!-- Container para campos ocultos de assignments -->
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
        <h2>Atribuições</h2>
        @foreach ($department->assignments as $assignment_item)
            <p>
                <input type="text" name="existing_assignments[]" value="{{ $assignment_item->assignment }}">
            <form action="{{ route('departments_assignment.destroy', $assignment_item->id) }}" method="post">
                @csrf
                @method('DELETE')
                <input id="delete-button" type="submit" value="Excluir">
            </form>
            </p>
            <br>
        @endforeach
    </div>

    <script>
        document.getElementById('assignments').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                var assignmentsInput = document.getElementById('assignments');
                var assignmentValue = assignmentsInput.value.trim();
                if (assignmentValue !== '') {
                    var hiddenAssignment = document.createElement('input');
                    hiddenAssignment.type = 'hidden';
                    hiddenAssignment.name = 'new_assignments[]'; // Renomeie para 'new_assignments[]'
                    hiddenAssignment.value = assignmentValue;
                    document.getElementById('assignmentsContainer').appendChild(hiddenAssignment);

                    //Parte visual
                    var assignmentsList = document.createElement('div');
                    assignmentsList.classList.add('assignments-list');
                    var assignmentItem = document.createElement('span');
                    assignmentItem.textContent = assignmentValue;
                    assignmentsList.appendChild(assignmentItem);
                    document.getElementById('departmentForm').appendChild(assignmentsList);

                    assignmentsInput.value = '';
                }
            }
        });
    </script>
@endsection
