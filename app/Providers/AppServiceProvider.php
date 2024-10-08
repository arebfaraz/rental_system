<?php

namespace App\Providers;

use App\Livewire\Admin\Property\CreatePropertyWizard;
use App\Livewire\Admin\Property\PropertyAddressStepComponent;
use App\Livewire\Admin\Property\PropertyDetailsStepComponent;
use App\Livewire\Admin\Property\PropertyExtrasStepComponent;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Paginator::useBootstrapFive();

        Livewire::component('property-wizard', CreatePropertyWizard::class);
        Livewire::component('property-details-step', PropertyDetailsStepComponent::class);
        Livewire::component('property-extras-step', PropertyExtrasStepComponent::class);
        Livewire::component('property-address-step', PropertyAddressStepComponent::class);
//        Livewire::component('property-units-step', PropertyUnitsStepComponent::class);

        //default schema
        Schema::defaultStringLength(191);


        Blade::directive('formatDate', function ($expression) {
            //($expression)->locale('es')->format('M F, Y')
            return "<?php echo ($expression) ? \Carbon\Carbon::parse($expression)->locale('es')->format('M d, Y')  : ''; ?>";
        });

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Admin') ? true : null;
        });
    }
}
