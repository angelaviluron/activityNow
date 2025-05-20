<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Subtarea;
//use App\Models\SubtareaResponsable;

class Subtareas extends BaseController
{
    public function guardar_subtarea()
    {
        // ✅ Si el usuario no está logueado, redirigir al login
        if (!session()->has('u_id')) {
            return redirect()->to(base_url('mostrarFormularioLogin'))->with('mensaje', 'Debes iniciar sesión para crear una subtarea.');
        }
        $idTarea=$this->request->getPost('st_tarea_id');

        // ✅ Reglas de validación
        $rules = [
            'st_asunto' => 'required|min_length[3]',
            'st_descripcion' => 'required|min_length[3]',
            'st_fechaVenc'   => 'required|valid_date',
            'st_prioridad'   => 'required'
        ];

        // ✅ Mensajes personalizados
        $messages = [
            'st_asunto' => [
                'required'    => 'El asunto es obligatorio.',
                'min_length'  => 'El asunto debe tener al menos 3 caracteres.'
            ],
            'st_descripcion' => [
                'required'    => 'La descripción es obligatoria.',
                'min_length'  => 'La descripción debe tener al menos 3 caracteres.'
            ],
            'st_fechaVenc' => [
                'required'    => 'La fecha de vencimiento es obligatoria.',
                'valid_date'  => 'Debes ingresar una fecha válida.'
            ],
            'st_prioridad' => [
                'required' => 'Debes seleccionar una prioridad.',
                
            ]
        ];

        if (!$this->validate($rules, $messages)) {
    return redirect()->to(base_url('ver_tarea/' . $idTarea))
        ->withInput() 
        ->with('errors', $this->validator->getErrors())
        ->with('abrirModal', true);
}


        $subtareaModel = new Subtarea();

        $data = [
            't_id'           => $idTarea,
            'u_id'           => session()->get('u_id'),
            'st_asunto' => $this->request->getPost('st_asunto'),
            'st_descripcion' => $this->request->getPost('st_descripcion'),
            'st_estado'      =>1,
            'st_prioridad'   => $this->request->getPost('st_prioridad'),
            'st_fechaVenc'   => $this->request->getPost('st_fechaVenc'),
            'st_comentario'  => $this->request->getPost('st_comentario')
        ];

        $subtareaModel->insert($data);

       return redirect()->to(base_url('ver_tarea/' . $idTarea))->with('mensaje', 'Subtarea creada con éxito.');
    }

    public function asignar_responsable()
{
    $idTarea= $this->request->getPost('tarea_id');
    $subtareaId = $this->request->getPost('subtarea_id');
    $responsableId = $this->request->getPost('responsable_id');

    if (!$subtareaId || !$responsableId) {
        return redirect()->to(base_url('ver_tarea/' . $idTarea))->with('error', 'Debes seleccionar un responsable.');
    }

    $subtareaModel = new Subtarea();

    // Asegurate de que tu modelo permita actualización de este campo
    $subtareaModel->update($subtareaId, [
        'st_responsable' => $responsableId
    ]);

    return redirect()->to(base_url('ver_tarea/' . $idTarea))->with('mensaje', 'Responsable asignado correctamente.');
}

public function completar_subtarea($id = null, $idTarea = null)
{
    $subtareaModel = new \App\Models\Subtarea();
    $tareaModel = new \App\Models\Tarea();

    // Buscar la subtarea
    $subtarea = $subtareaModel->find($id);

    if (!$subtarea) {
         return redirect()->to(base_url('ver_tarea/' . $idTarea))->with('error', 'Subtarea no encontrada.');
    }

    // Actualizar el estado de la subtarea a 3 (completada)
    $subtareaModel->update($id, ['st_estado' => 3]);

    // También actualizar la tarea relacionada a estado 2 (en proceso)
    $tareaModel->update($subtarea['t_id'], ['t_estado' => 2]);

     return redirect()->to(base_url('ver_tarea/' . $idTarea))->with('mensaje', '¡Subtarea completada!');
}

public function borrar_subtarea($subtareaId = null, $tareaId = null)
{
    $subtareaModel = new Subtarea();

    if ($subtareaModel->find($subtareaId)) {
        $subtareaModel->delete($subtareaId);
        return redirect()->to(base_url('ver_tarea/' . $tareaId))
                         ->with('mensaje', 'Subtarea eliminada correctamente.');
    } else {
        return redirect()->back()->with('error', 'Subtarea no encontrada.');
    }
}

public function actualizar_subtarea()
{
    $subtareaModel = new Subtarea();
    

    $data = [
        'st_asunto' => $this->request->getPost('st_asunto'),
        'st_descripcion'=> $this->request->getPost('st_descripcion'),
        'st_prioridad' => $this->request->getPost('st_prioridad'),
        'st_fechaVenc' => $this->request->getPost('st_fechaVenc'),
        'st_comentario' => $this->request->getPost('st_comentario')
    ];

    $subtareaModel->update($this->request->getPost('st_id'), $data);

    return redirect()->to(base_url('ver_tarea/' . $this->request->getPost('st_tarea_id')))
                     ->with('mensaje', 'Subtarea actualizada correctamente.');
}



}
