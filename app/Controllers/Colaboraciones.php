<?php namespace App\Controllers;


use App\Models\TareaColaborador;
use CodeIgniter\Controller;

class Colaboraciones extends Controller
{
    protected $colaboracionModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $tareaColaboradorModel = new TareaColaborador();
}

   
        
public function agregar_colaborador()
{
    helper(['form', 'url']);

     $tareaColaboradorModel = new TareaColaborador();
        
        $rules = [
            'correo' => 'required|valid_email',
            'tipo_colaboracion' => 'required|in_list[lectura,edicion]'
        ];

        if (!$this->validate($rules)) {
            // Retornar con errores de validación
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $id= $this->request->getPost('t_id');
        $correo = $this->request->getPost('correo');
        $permiso = $this->request->getPost('tipo_colaboracion');

        // Buscar usuario por correo
        $usuarioModel = new \App\Models\Usuario();
        $usuario = $usuarioModel->where('u_email', $correo)->first();

        if (!$usuario) {
            // Usuario no encontrado, mostrar error
             return redirect()->to(base_url('ver_tarea/' . $id))->with('error', 'No se encontró un usuario con ese correo.');
        }

        $datos = [
            't_id' => $id,
            'u_id' => $usuario['u_id'],
            'permiso' => $permiso
        ];

        $tareaColaboradorModel = new \App\Models\TareaColaborador();

        $existe = $tareaColaboradorModel->where('t_id', $id)
                                       ->where('u_id', $usuario['u_id'])
                                       ->first();

        if ($existe) {
            return redirect()->back()->withInput()->with('error', 'El usuario ya es colaborador de esta tarea.');
        }

        // Guardar colaboración
        if ($tareaColaboradorModel->insert($datos)) {
             return redirect()->to(base_url('ver_tarea/' . $id))->with('mensaje', 'Colaborador agregado correctamente.');
        } else {
            return redirect()->to(base_url('ver_tarea/' . $id))->with('error', 'No se pudo agregar el colaborador. Intenta nuevamente.');
        }
    }

    

    
    
}

    

