<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentAssignment;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('assignments')->get();

        return view('departments.show', ['departments' => $departments]);
    }



    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'assignments.*' => 'nullable|string|max:255', // Validação para cada função
        ]);

        // Criação do departamento
        $department = Department::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Verifica se foram fornecidas funções
        if ($request->filled('assignments')) {
            // Processamento das funções inseridas pelo usuário
            foreach ($validatedData['assignments'] as $assignmentName) {
                // Cria uma nova entrada na tabela de junção para cada função
                $department->assignments()->create([
                    'assignment' => $assignmentName,
                ]);
            }
        }

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->route('departments.index')->with('msg', 'Departamento criado com sucesso.');
    }


    public function edit($id)
    {
        $department = Department::with('assignments')->findOrFail($id);

        return view('departments.edit', ['department' => $department]);
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'new_assignments.*' => 'nullable|string|max:255', // Validação para novas funções
        ]);

        // Encontra o departamento pelo ID
        $department = Department::findOrFail($id);

        // Atualiza os dados do departamento
        $department->name = $validatedData['name'];
        $department->email = $validatedData['email'];
        $department->save();

        // Verifica se foram fornecidas novas funções
        if ($request->filled('new_assignments')) {
            foreach ($validatedData['new_assignments'] as $assignmentName) {
                // Cria uma nova associação na tabela de junção
                $department->assignments()->create([
                    'assignment' => $assignmentName,
                ]);
            }
        }

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->route('departments.index')->with('msg', 'Departamento atualizado com sucesso.');
    }

    public function destroy($id)
    {
        DepartmentAssignment::findOrFail($id)->delete();
        return redirect()->route('departments.index')->with('msg', 'Assignment excluído com sucesso.');
    }

    public function destroyAssignment($id)
    {
        $assignment = DepartmentAssignment::findOrFail($id);
        $assignment->delete();

        return redirect()->back()->with('msg', 'Assignment excluído com sucesso.');
    }
}
