<?php

namespace App\Repositories;
use App\Instructor;
use DB;

//HELPERS
use App\Helpers\Helper;

class InstructoresRepositorie
{
	protected $helper;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

	public function agregarInstructor($request)
	{
		DB::beginTransaction();
		$instructor 				= new Instructor();
		$instructor->nombres 		= $request->nombre_instructor;
		$instructor->apellidos 		= $request->apellido_instructor;
		$instructor->email 			= $request->email;
		$instructor->especialidad 	= $request->especialidad;
		$instructor->bibliografia 	= $request->bibliografia;

		if ($instructor->save()) {
			$rootImg                = $request->file('avatar')->store('public/instructores/'.$instructor->id.'/');
			$instructor->img     	= $rootImg;

			if ($instructor->save()) {
				DB::commit();
            	return back()->with("status.newInstructor", "success");
			}

			DB::rollback();
        	return back()->withInput()->with("status.newInstructor", "error");
		}

		DB::rollback();
        return back()->withInput()->with("status.newInstructor", "error");

	}


	public function actualizarInstructor($request, $id)
	{
		DB::beginTransaction();
		$instructor 				= Instructor::findOrFail($id);
		$instructor->nombres 		= $request->nombre_instructor;
		$instructor->apellidos 		= $request->apellido_instructor;
		$instructor->email 			= $request->email;
		$instructor->especialidad 	= $request->especialidad;
		$instructor->bibliografia 	= $request->bibliografia;

		if ($instructor->save()) {

			if ($request->hasFile("avatar")) {
				$this->eliminarImagen($instructor->img);
				$rootImg                = $request->file('avatar')->store('public/instructores/'.$instructor->id.'/');
				$instructor->img     	= $rootImg;
			}
			

			if ($instructor->save()) {
				DB::commit();
            	return back()->with("status.updateInstructor", "success");
			}

			DB::rollback();
        	return back()->withInput()->with("status.updateInstructor", "error");
		}

		DB::rollback();
        return back()->withInput()->with("status.updateInstructor", "error");
	}


	protected function eliminarImagen($file)
    {
        return \Storage::delete($file);
    }
}