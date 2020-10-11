<?php

namespace App\Repositories;
use App\Evento;
use DB;

//HELPERS
use App\Helpers\Helper;

class EventosRepositorie
{
	protected $helper;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function agregarEvento($request)
    {
        DB::beginTransaction();
        $evento                     = new Evento();
        $evento->nombre             = $request->nombre_evento;
        $evento->video_bienvenida   = $request->video_bienvenida;
        $evento->descripcion        = $request->descripcion;
        $evento->fecha_lanzamiento  = $request->fecha_inicio." ".$request->hora_inicio;
        $evento->tipo_evento_id     = $request->select_tipo;

        if ($evento->save()) {
            $evento->slug           = $this->helper->createSlug($request->nombre_evento, $evento->id, "maptve");
            $rootImg                = $request->file('img_evento')->store('public/eventos/'.$evento->id.'/img_principal/');
            $evento->img_evento     = $rootImg;

            if ($evento->save()) {

                if (!$this->insertInstructor($evento->id, $request->select_instructores)) {
                    DB::rollback();
                    return back()->withInput()->with("status.newEvento", "error");
                }

                DB::commit();
                return back()->with("status.newEvento", "success");
            }

            DB::rollback();
            return back()->withInput()->with("status.newEvento", "error");
        }

        DB::rollback();
        return back()->withInput()->with("status.newEvento", "error");
    }


    public function actualzarEvento($request, $id)
    {
        DB::beginTransaction();
        $evento                     = Evento::findOrFail($id);
        $evento->nombre             = $request->nombre_evento;
        $evento->video_bienvenida   = $request->video_bienvenida;
        $evento->descripcion        = $request->descripcion;
        $evento->fecha_lanzamiento  = $request->fecha_inicio." ".$request->hora_inicio;
        $evento->tipo_evento_id     = $request->select_tipo;

        if ($evento->save()) {
            //SLUG DE EVENTO
            $evento->slug            = $this->helper->createSlug($request->nombre_evento, $evento->id, "maptve");

            //SUBIR IMAGEN DEL EVENTO
            if ( $request->hasFile('img_evento') ) {
                $this->eliminarImagen($evento->img_evento);
                $rootImg = $request->file('img_evento')->store('public/eventos/'.$evento->id.'/img_principal/');
                $evento->img_evento = $rootImg;
            }

            if ($evento->save()) {

                /* ACTUALIZAR INSTRUCTOR */
                if (!$this->eliminarInstructor($id)) {
                    DB::rollback();
                    $this->eliminarImagen($evento->img_evento);
                    return back()->withInput()->with("status.updateEvento", "error");
                }

                if (!$this->insertInstructor($evento->id, $request->select_instructores)) {
                    DB::rollback();
                    $this->eliminarImagen($evento->img_evento);
                    return back()->withInput()->with("status.updateEvento", "error");
                }
                /* ACTUALIZAR INSTRUCTOR \\ */


                DB::commit();
                return back()->with("status.updateEvento", "success");
            }

            DB::rollback();
            return back()->withInput()->with("status.updateEvento", "error");
        }

        DB::rollback();
        return back()->withInput()->with("status.updateEvento", "error");
    }


    protected function insertInstructor($evento_id, $instructors)
    {
        foreach ($instructors as $instructor) {
            $insertInstruct = DB::table('eventos_instructors')->insert(
                ["evento_id" => $evento_id,
                "instructor_id" => $instructor]
            );

            if (!$insertInstruct) {
                return false;
            }
        }

        if (!$insertInstruct) {
            return false;
        }

        return true;
    }


    protected function eliminarInstructor($evento_id)
    {
        $eliminarInstructor = DB::table('eventos_instructors')
                                ->where('evento_id', $evento_id)->delete();
        return true;
    }


    protected function eliminarImagen($file)
    {
        return \Storage::delete($file);
    }

}