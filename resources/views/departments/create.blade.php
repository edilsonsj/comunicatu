@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Cadastro de Departamento</h1>
        <form action="/departments" method="POST" id="departmentForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nome do Departamento:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email do Departamento:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="assignments">Funções do Departamento:</label>
                <input type="text" name="assignments" id="assignments" class="form-control"
                    placeholder="Digite o nome de uma função e pressione Enter para adicionar">
                <small class="form-text text-muted">Digite o nome de uma função e pressione Enter para adicionar. Você pode
                    adicionar várias funções.</small>
                <div id="assignmentsContainer"></div> <!-- Container para campos ocultos de assignments -->
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
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
                    hiddenAssignment.name = 'assignments[]'; // Adicione os colchetes para enviar como um array
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
