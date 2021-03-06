<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
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
        Builder::macro('whereLike', function ($attributes, string $searchInput){
            foreach ( $attributes as $attribute) {
                 $this->orWhere($attribute, 'LIKE', "%{$searchInput}%");
            }
            $this->where('state', '<>', 'Private');
            return $this;

        });

        /*Builder::macro('myQuery', function (){
            $this->orderBy('created_at','desc')->paginate(5);
            return $this;
        });*/

    }
}
