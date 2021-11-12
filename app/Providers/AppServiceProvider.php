<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Config;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  
  public function boot()
  {
    Schema::defaultStringLength(191);

	CarbonInterval::setLocale('ar');

	if (Schema::hasTable('configs')) { // append dynamic settings to app settings
		foreach (Config::all() as $setting) {
			\Illuminate\Support\Facades\Config::set($setting->key, $setting->value);
		}
	}

  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}
