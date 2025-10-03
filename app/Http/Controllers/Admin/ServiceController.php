<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$services = Service::query()
			->latest('id')
			->paginate(10);

		return view('admin.services.index', compact('services'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.services.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$validated = $request->validate([
			'nama_layanan' => ['required', 'string', 'max:255'],
			'deskripsi' => ['nullable', 'string'],
			'harga' => ['required', 'numeric', 'min:0'],
			'satuan' => ['required', 'in:kg,pcs'],
		]);

		Service::create($validated);

		return redirect()
			->route('admin.services.index')
			->with('success', 'Layanan berhasil ditambahkan.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Service $service)
	{
		return view('admin.services.show', compact('service'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Service $service)
	{
		return view('admin.services.edit', compact('service'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Service $service)
	{
		$validated = $request->validate([
			'nama_layanan' => ['required', 'string', 'max:255'],
			'deskripsi' => ['nullable', 'string'],
			'harga' => ['required', 'numeric', 'min:0'],
			'satuan' => ['required', 'in:kg,pcs'],
		]);

		$service->update($validated);

		return redirect()
			->route('admin.services.index')
			->with('success', 'Layanan berhasil diperbarui.');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Service $service)
	{
		$service->delete();

		return redirect()
			->route('admin.services.index')
			->with('success', 'Layanan berhasil dihapus.');
	}
}
