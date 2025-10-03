<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
	public function index()
	{
		$services = Service::orderBy('nama_layanan')->get();
		return view('home', compact('services'));
	}

	public function track(Request $request)
	{
		$order = null;
		$kode = trim((string) $request->query('kode_invoice', ''));
		if ($kode !== '') {
			$order = Order::with('customer')->where('kode_invoice', $kode)->first();
		}
		return view('track', compact('order', 'kode'));
	}

	public function contact()
	{
		return view('contact');
	}

	public function contactSubmit(Request $request)
	{
		$data = $request->validate([
			'nama' => ['required', 'string', 'max:255'],
			'email' => ['required', 'email'],
			'pesan' => ['required', 'string', 'max:2000'],
		]);

		// For now log the message; can be changed to Mail::to(...)->send(...)
		Log::info('Contact form submission', $data);

		return redirect()->route('contact')->with('success', 'Terima kasih! Pesan Anda sudah kami terima.');
	}

	public function services()
	{
		$services = Service::orderBy('nama_layanan')->paginate(12);
		$sidebarServices = Service::orderBy('nama_layanan')->get();
		return view('services.index', compact('services', 'sidebarServices'));
	}

	public function serviceShow(Service $service)
	{
		$sidebarServices = Service::orderBy('nama_layanan')->get();
		return view('services.show', compact('service', 'sidebarServices'));
	}
}
