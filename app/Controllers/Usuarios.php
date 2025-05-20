<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuario;

class Usuarios extends Controller{

    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function index(){

        $session = session();

    }

    public function mostrarFormularioRegistro(){

        if (session()->get('isLoggedIn')) { return redirect()->to(base_url()); }

        $datos['header'] = view('header');
        $datos['footer']= view('footer');
        return view('usuario/registro', $datos);

    }

    public function guardarRegistro()
    {
        helper(['form']);

        // Reglas de validación
        $rules = [
            'u_nombre' => 'required|min_length[2]',
            'u_apellido' => 'required|min_length[2]',
            'u_user' => 'required|min_length[3]|is_unique[usuario.u_user]',
            'u_email' => 'required|valid_email|is_unique[usuario.u_email]',
            'u_pwd' => 'required|min_length[8]'
        ];

        if (!$this->validate($rules)) {
            $datos['header'] = view('header');
            $datos['footer'] = view('footer');
            $datos['validation'] = $this->validator;
            return view('usuario/registro', $datos);
        }
        

        // Guardar datos
        $model = new Usuario();

        $data['header'] = view('header');
        $data['footer']= view('footer');
        $data = [
            'u_nombre' => $this->request->getPost('u_nombre'),
            'u_apellido' => $this->request->getPost('u_apellido'),
            'u_user' => $this->request->getPost('u_user'),
            'u_email' => $this->request->getPost('u_email'),
            'u_pwd' => password_hash($this->request->getPost('u_pwd'), PASSWORD_DEFAULT),
        ];
        
        $model->save($data);

        // Redireccionar con mensaje
        return redirect()->to(base_url('mostrarFormularioLogin'))->with('mensaje', 'Cuenta creada correctamente...');

    }

    public function mostrarFormularioLogin(){
        

        $datos['header'] = view('header');
        $datos['footer']= view('footer');
        return view('usuario/login', $datos);
}

    public function guardarLogin()
{
    helper(['form']);

    // Reglas de validación
    $rules = [
        'usuario' => 'required',
        'clave' => 'required'
    ];

    if (!$this->validate($rules)) {
        // Volver a mostrar el formulario con errores
        return redirect()->to(base_url('mostrarFormularioLogin'))
                         ->withInput()
                         ->with('validation', $this->validator);
    }

    $usuarioInput = $this->request->getPost('usuario');
    $claveInput = $this->request->getPost('clave');

    $usuarioModel = new Usuario();

    // Buscar por usuario o correo
    $usuario = $usuarioModel
        ->where('u_user', $usuarioInput)
        ->orWhere('u_email', $usuarioInput)
        ->first();

    if ($usuario && password_verify($claveInput, $usuario['u_pwd'])) {
        // Iniciar sesión
        $session = session();
        $session->set([
            'u_id' => $usuario['u_id'],
            'u_user'     => $usuario['u_user'],
            'u_email'    => $usuario['u_email'],
            'isLoggedIn' => true,
            'usuario_logueado'=> true,

        ]);

        return redirect()->to(base_url('/'));
    } else {
        // Usuario o clave inválidos
        return redirect()->to(base_url('mostrarFormularioLogin'))
                         ->withInput()
                         ->with('error', 'Usuario o contraseña incorrectos.');
    }
}


public function logout() { 
    session()->destroy(); return redirect()->to(base_url('mostrarFormularioLogin')); 
}

public function perfil()
    {
        $usuarioModel = new Usuario();
        $usuarioId = session()->get('u_id');

        $usuario = $usuarioModel->find($usuarioId);

        $data = [
            'header' => view('header'),
            'footer' => view('footer'),
            'usuario' => $usuario
        ];

        return view('usuario/perfil', $data);
    }

    public function actualizarPerfil()
{
    $usuarioModel = new Usuario();
    $usuarioId = session()->get('u_id');

    $data = [
        'u_nombre' => $this->request->getPost('u_nombre'),
        'u_apellido' => $this->request->getPost('u_apellido')
    ];

    $usuarioModel->update($usuarioId, $data);

    return redirect()->to(base_url('perfil'))->with('mensaje', 'Perfil actualizado correctamente.');
}


}