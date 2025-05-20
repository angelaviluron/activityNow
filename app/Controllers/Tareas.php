<?php
namespace App\Controllers;

use App\Models\Subtarea;
use CodeIgniter\Controller;
use App\Models\Tarea;
use \App\Models\Usuario;
use \App\Models\TareaColaborador;


class Tareas extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
        helper('notificaciones');

        
    }

    // Mostrar todas las tareas
    public function index()
{
    $tareaModel = new \App\Models\Tarea();
    $usuarioId = session()->get('u_id');

    $orden = $this->request->getGet('orden');

    // Aplicar ordenamiento
    switch ($orden) {
        case 'vencimiento_asc':
            $tareaModel->orderBy('t_fechaVenc', 'ASC');
            break;
        case 'vencimiento_desc':
            $tareaModel->orderBy('t_fechaVenc', 'DESC');
            break;
        case 'asunto_asc':
            $tareaModel->orderBy('t_asunto', 'ASC');
            break;
        case 'asunto_desc':
            $tareaModel->orderBy('t_asunto', 'DESC');
            break;
        case 'prioridad':
            $tareaModel->orderBy('t_prioridad', 'DESC');
            break;
        default:
            $tareaModel->orderBy('t_id', 'DESC');
            break;
    }

    // Obtener tareas del usuario (propias o en las que colabora), sin las archivadas
    $tareas = $tareaModel
        ->select('tarea.*') // Solo columnas de la tabla tarea
        ->join('tarea_colaboradores', 'tarea.t_id = tarea_colaboradores.t_id', 'left')
        ->groupStart()
            ->where('tarea.u_id', $usuarioId)
            ->orWhere('tarea_colaboradores.u_id', $usuarioId)
        ->groupEnd()
        ->where('tarea.t_estado !=', 4)
        ->findAll();

    // Notificaciones
    $tieneNotificaciones = tieneNotificaciones($usuarioId);

    $datos = [
        'tareas' => $tareas,
        'tieneNotificaciones' => $tieneNotificaciones,
        'header' => view('header', ['tieneNotificaciones' => $tieneNotificaciones]),
        'footer' => view('footer')
    ];

    return view('tareas/mostrar_tareas', $datos);
}



    // Cargar formulario para nueva tarea
    public function cargar()
    {
        $datos['header'] = view('header');
        $datos['footer'] = view('footer');
        if (!session()->get('usuario_logueado')) {
    session()->setFlashdata('mensaje', 'Debes iniciar sesión para crear una tarea.');
    return redirect()->to(base_url('mostrarFormularioLogin'));
}

        return view('tareas/cargar_tarea', $datos);
    }

    // Guardar tarea en la base de datos
   public function guardarTarea()
{
    $session = session();
    if (!$session->get('isLoggedIn')) {
        return redirect()->to(base_url('mostrarFormularioLogin'))->with('error', 'Debés iniciar sesión.');
    } 

    $tarea = new Tarea();

    $validacion = $this->validate([
        'titulo'            => 'required|min_length[3]',
        'descripcion'       => 'required|min_length[5]',
        'prioridad'         => 'required',
        'fecha_vencimiento' => 'required|valid_date',
        'color'             => 'required'
    ]);

    if (!$validacion) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $colores = [
        '1' => '#E6F4EA', // Verde pastel
        '2' => '#FFF3CD', // Amarillo suave
        '3' => '#E8EAF6', // Azul lavanda
        '4' => '#FDE2E2'  // Rosa claro
    ];

    $colorElegido = $this->request->getPost('color');

    $datos = [
        'u_id'          => $session->get('u_id'),
        't_asunto'      => $this->request->getPost('titulo'),
        't_descripcion' => $this->request->getPost('descripcion'),
        't_prioridad'   => $this->request->getPost('prioridad'),
        't_estado'      => 1, // Estado "Definido"
        't_fechaVenc'   => $this->request->getPost('fecha_vencimiento'),
        't_fechaRec'    => $this->request->getPost('fecha_recordatorio'),
        't_color'       => $colores[$colorElegido] ?? '#E6F4EA' // color por defecto si algo falla
    ];

    $tarea->insert($datos);

    return $this->response->redirect(base_url('/mostrar_tareas'));
}


    // Borrar una tarea por ID
    public function borrar($id = null)
    {
        $tarea = new Tarea();
        $tarea->delete($id);

        return $this->response->redirect(base_url('/mostrar_tareas'));
    }

    // Cargar formulario para editar una tarea existente
    public function editar($id = null)
{
    $tarea = new Tarea();
    $datos['tarea'] = $tarea->find($id); // Busca la tarea con el id proporcionado
    $datos['header'] = view('header');
    $datos['footer'] = view('footer');

    return view('tareas/editar_tarea', $datos); // Muestra la vista con la tarea
}

// Actualizar una tarea
public function actualizar()
{
    $tarea = new Tarea();

    $id = $this->request->getPost('t_id'); // Obtiene el ID de la tarea desde el formulario

    // Datos para actualizar
    $datos = [
        't_asunto'      => $this->request->getPost('titulo'),
        't_descripcion' => $this->request->getPost('descripcion'),
        't_prioridad'   => $this->request->getPost('prioridad'),
        't_fechaVenc'   => $this->request->getPost('fecha_vencimiento'),
        't_fechaRec'    => $this->request->getPost('fecha_recordatorio'),
        
    ];

    // Actualiza la tarea en la base de datos
    $tarea->updateTarea($id, $datos);

    // Redirige a la página de tareas
    return $this->response->redirect(base_url('/mostrar_tareas'));
}


public function ver_tarea($id = null)
{
    $tareaModel = new Tarea(); 
    $subtareaModel = new Subtarea();
    $usuarioModel= new Usuario();

//para pasar colab de esta tarea especidifca
    $colaboradoresModel = new \App\Models\TareaColaborador(); 
    $colaboradores = $colaboradoresModel->obtenerColaboradoresPorTarea($id); 
    $data['colaboradores'] = $colaboradores;



//para mostrar las subtareas
    $tarea = $tareaModel->find($id);
    $subtareas = $subtareaModel->where('t_id', $id)->findAll();
    
    foreach ($subtareas as &$sub) {
    if (!empty($sub['st_responsable'])) {
        $responsable = $usuarioModel->find($sub['st_responsable']);
        $sub['responsable'] = $responsable ? $responsable['u_user'] : 'Desconocido';
    } else {
        $sub['responsable'] = null;
    }
    }

    $usuarioId = session()->get('u_id');
$colaboradoresModel = new TareaColaborador();

foreach ($subtareas as &$sub) {
    $sub['es_dueno'] = ($usuarioId == $tarea['u_id']);

    // Asignar nombre del responsable (ya lo tenés arriba)
    if (!empty($sub['st_responsable']) && $sub['st_responsable'] == $usuarioId) {
        // Permiso de edición
        $permiso = $colaboradoresModel
            ->where('u_id', $usuarioId)
            ->where('t_id', $tarea['t_id'])
            ->select('permiso')
            ->first();

        $sub['permiso_edicion'] = ($permiso && $permiso['permiso'] === 'edicion');

        // Nuevo: puede completar si es responsable (sin importar permiso)
        $sub['es_responsable'] = true;
    } else {
        $sub['permiso_edicion'] = false;
        $sub['es_responsable'] = false;
    }

    // Nuevo campo: puede completar si es dueño o responsable
    $sub['puede_completar'] = ($sub['es_dueno'] || $sub['es_responsable']);
}
    $data['subtareas']=$subtareas;



//para agarrar todos losdatos de la tarea

    $tarea = $tareaModel->obtenerTareaPorId($id);
    $data['tarea'] = $tarea;

    if (!$tarea) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
$es_dueno = ($usuarioId == $tarea['u_id']);

// Verificamos si es colaborador con permiso de edición
$colaborador = $colaboradoresModel
    ->where('u_id', $usuarioId)
    ->where('t_id', $tarea['t_id'])
    ->select('permiso')
    ->first();

$permiso_edicion = ($colaborador && $colaborador['permiso'] === 'edicion');

// Pasamos los permisos a la vista
$data['es_dueno'] = $es_dueno;
$data['permiso_edicion'] = $permiso_edicion;

    
    $data['header'] = view('header');
    $data['footer'] = view('footer');

    
    

    return view(('tareas/ver_tarea'), $data);
}



public function archivar_tarea($id = null)
{
    $tareaModel = new Tarea();

    // Buscar la tarea por ID
    $tarea = $tareaModel->find($id);

    if (!$tarea) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    // Cambiar estado a 4 (archivada)
    $tareaModel->update($id, ['t_estado' => 4]);

    // Mensaje flash para confirmar acción
    session()->setFlashdata('mensaje', 'Tarea archivada correctamente.');

    // Redirigir a la lista de tareas (o donde prefieras)
    return redirect()->to(base_url('mostrar_tareas'));
}


public function mostrarArchivadas()
{
    $tareaModel = new \App\Models\Tarea();
    $usuarioId = session()->get('u_id'); // ID del usuario logueado

    $tareas = $tareaModel->where('t_estado', 4)
                         ->where('u_id', $usuarioId)
                         ->findAll();

    $data = [
        'tareas' => $tareas,
        'usuarioId' => $usuarioId,
        'header' => view('header'),
        'footer' => view('footer')
    ];

    return view('tareas/archivadas', $data);
}



public function tareasColaborando()
{
    $usuarioId = session()->get('u_id');
    $tareaColaboradorModel = new TareaColaborador();
    $tareaModel = new \App\Models\Tarea();

    $colaboraciones = $tareaColaboradorModel
        ->where('u_id', $usuarioId)
        ->findAll();

    $tareasIds = array_column($colaboraciones, 't_id');

    
    if (!empty($tareasIds)) {
    $tareas = $tareaModel->whereIn('t_id', $tareasIds)
                         ->where('t_estado !=', 4)
                         ->findAll();
} else {
    $tareas = []; // No hay tareas que mostrar
}

    $data['tareas'] = $tareas;
    $data['header'] = view('header');
    $data['footer'] = view('footer');

    return view('tareas/mostrar_tareas_colaborando', $data);
}

public function completar_tarea($tareaId)
{
    $tareaModel = new \App\Models\Tarea();
    $subtareaModel = new \App\Models\Subtarea();

    $tarea = $tareaModel->find($tareaId);

    if (!$tarea) {
        return redirect()->to(base_url('mostrar_tareas'))->with('error', 'Tarea no encontrada.');
    }

    // Verificar si la tarea tiene subtareas
    $subtareas = $subtareaModel->where('t_id', $tareaId)->findAll();

    if (!empty($subtareas)) {
        // Verificar si todas las subtareas están completadas (estado = 3)
        foreach ($subtareas as $sub) {
            if ($sub['st_estado'] != 3) {
                return redirect()->to(base_url('ver_tarea/' . $tareaId))
                                 ->with('error', 'No se puede completar la tarea. Aún hay subtareas pendientes.');
            }
        }
    }

    // Actualizar el estado de la tarea a 3 (completada)
    $tareaModel->update($tareaId, ['t_estado' => 3]);

    return redirect()->to(base_url('ver_tarea/' . $tareaId))
                     ->with('mensaje', '¡Tarea completada con éxito!');
}

public function tareas_proximas()
{
    $tareaModel = new \App\Models\Tarea();

    $usuarioId = session()->get('u_id');
    $hoy = date('Y-m-d');

    $tareas = $tareaModel
        ->where('u_id', $usuarioId)
        ->where('t_fechaRec <=', $hoy)
        ->where('t_estado !=', 3) // opcional: excluir completadas
        ->orderBy('t_fechaRec', 'asc')
        ->findAll();

    $data['tareas'] = $tareas;
    $data['header'] = view('header');
    $data['footer'] = view('footer');

    return view('tareas/tareas_proximas', $data);
}


private function tieneTareasParaHoy($usuarioId)
{
    $hoy = date('Y-m-d');
    $tareaModel = new \App\Models\Tarea();
    
    if ($this->tieneTareasParaHoy($usuarioId)) {
    session()->setFlashdata('notificacion', 'Tienes tareas con recordatorio para hoy.');
}

    return $tareaModel
        ->where('u_id', $usuarioId)
        ->where('t_fechaRec', $hoy)
        ->where('t_estado !=', 3) 
        ->countAllResults() > 0;
}



}
