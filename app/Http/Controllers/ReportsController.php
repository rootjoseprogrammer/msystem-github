<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maintenance;
use App\HardDrive;
use App\Motherboard;
use App\Microprocessor;
use App\NetCard;
use App\Ram;
use App\ReadDriver;
use App\Video;
use App\Equipment;
use App\Application;
use App\Component;
use Auth;

class ReportsController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
    	$department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

    	return view('reports.index', compact('messages'));
    }

    public function reportGeneral()
    {
        $eq = Equipment::EquipmentsPDF();
        $HardDrives = HardDrive::getPDF();
        $micros = Microprocessor::getPDF();
        $ms = Motherboard::getPDF();
        $nets = NetCard::getPDF();
        $rams = Ram::getPDF();
        $reads = ReadDriver::getPDF();
        $videos = Video::getPDF();
        $maints = Maintenance::getPDF();
				$displays = Component::getPDF('display');
				$printers = Component::getPDF('printer');

        $view = \View::make('reports.reportGeneral', compact('eq',
            'HardDrives', 'micros','ms', 'nets', 'rams' , 'reads', 'videos', 'maints', 'displays', 'printers'))->render();


        $pdf = \App::make('dompdf.wrapper')->setPaper('A4', 'landscape');

        $pdf->loadHTML($view);

        return $pdf->stream();

    }

		public function reportsDisplays()
    {
    	$displays = Component::getPDF('display');
			// dd($eq);

    	$view = \View::make('reports.reportDisplay', compact('displays'))->render();


    	$pdf = \App::make('dompdf.wrapper');

		$pdf->loadHTML($view)->setPaper('A4', 'landscape');

		return $pdf->stream();
    }

		public function reportsPrinters()
    {
    	$printers = Component::getPDF('printer');
			// dd($eq);

    	$view = \View::make('reports.reportPrinter', compact('printers'))->render();


    	$pdf = \App::make('dompdf.wrapper');

		$pdf->loadHTML($view)->setPaper('A4', 'landscape');

		return $pdf->stream();
    }

    public function reportsEquipments()
    {
    	$eq = Equipment::EquipmentsPDF();
			// dd($eq);

    	$view = \View::make('reports.reportEquipment', compact('eq'))->render();


    	$pdf = \App::make('dompdf.wrapper');

		$pdf->loadHTML($view)->setPaper('A4', 'landscape');

		return $pdf->stream();
    }

    public function reportsDrives()
    {
    	$HardDrives = HardDrive::getPDF();
			// dd($HardDrives);
    	$view = \View::make('reports.reportsDrives', compact('HardDrives'))->render();


    	$pdf = \App::make('dompdf.wrapper')->setPaper('A4', 'landscape');

		$pdf->loadHTML($view);

		return $pdf->stream();
    }

    public function reportsMicro()
    {
    	$micros = Microprocessor::getPDF();

    	$view = \View::make('reports.reportsMicro', compact('micros'))->render();


    	$pdf = \App::make('dompdf.wrapper')->setPaper('A4', 'landscape');

		$pdf->loadHTML($view);

		return $pdf->stream();
    }

    public function reportsMother()
    {
    	$ms = Motherboard::getPDF();

    	$view = \View::make('reports.reportsMother', compact('ms'))->render();


    	$pdf = \App::make('dompdf.wrapper')->setPaper('A4', 'landscape');

		$pdf->loadHTML($view);

		return $pdf->stream();
    }

    public function reportsNetCards()
    {
    	$nets = NetCard::getPDF();

    	$view = \View::make('reports.reportsNetCards', compact('nets'))->render();


    	$pdf = \App::make('dompdf.wrapper')->setPaper('A4', 'landscape');

		$pdf->loadHTML($view);

		return $pdf->stream();
    }

    public function reportsRams()
    {
    	$rams = Ram::getPDF();

    	$view = \View::make('reports.reportsRams', compact('rams'))->render();


    	$pdf = \App::make('dompdf.wrapper')->setPaper('A4', 'landscape');

		$pdf->loadHTML($view);

		return $pdf->stream();
    }

    public function reportsReadDrivers()
    {
    	$reads = ReadDriver::getPDF();

    	$view = \View::make('reports.reportsReadDrivers', compact('reads'))->render();


    	$pdf = \App::make('dompdf.wrapper')->setPaper('A4', 'landscape');

		$pdf->loadHTML($view);

		return $pdf->stream();
    }

    public function reportsVideos()
    {
    	$videos = Video::getPDF();

    	$view = \View::make('reports.reportsVideos', compact('videos'))->render();


    	$pdf = \App::make('dompdf.wrapper')->setPaper('A4', 'landscape');

		$pdf->loadHTML($view);

		return $pdf->stream();
    }

    public function reportsMaintenance()
    {
    	$maints = Maintenance::getPDF();

    	$view = \View::make('reports.reportsMaintenances', compact('maints'))->render();


    	$pdf = \App::make('dompdf.wrapper')->setPaper('A4', 'landscape');

		$pdf->loadHTML($view);

		return $pdf->stream();
    }
}
