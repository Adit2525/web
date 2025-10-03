<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// If Fortify is installed, we can integrate. Otherwise keep provider no-op.

class FortifyServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		//
	}

	public function boot(): void
	{
        // Intentionally left no-op when Fortify is not installed.
	}
}
