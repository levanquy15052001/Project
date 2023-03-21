<?php

namespace App\Providers;

use App\Models\Brand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Shoping\ShopingRepository;
use App\Repositories\Shoping\ShopingRepositoryInterface;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        ///Customer
        $this->app->singleton(
            abstract:CustomerRepositoryInterface::class,
            concrete:CustomerRepository::class
        );
         ///Infomation
         $this->app->singleton(
            abstract:InforationRepositoryInterface::class,
            concrete:InforationRepository::class
        );

        //Cart

        $this->app->singleton(
            abstract:CartRepositoryInterface::class,
            concrete:CartRepository::class
        );

        // Shoping
        $this->app->singleton(
            abstract:ShopingRepositoryInterface::class,
            concrete:ShopingRepository::class
        );
        

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
   
    public function boot()
    {
        Paginator::useBootstrap();

        view()->composer('include.menuside',function($view){
            $category = Category::where('category_status',2)
                            ->where('del_flag',0)
                            ->get();
            $view->with('category',$category);
        });

        view()->composer('include.menuside',function($view){
            $brand = Brand::where('brand_status',2)
                            ->where('del_flag',0)
                            ->get();
            $view->with('brand',$brand);
        });


        view()->composer('page.cart.include_cart.menusidecart',function($view){
            $category = Category::where('category_status',2)
                            ->where('del_flag',0)
                            ->get();
            $view->with('category',$category);
        });

        view()->composer('page.cart.include_cart.menusidecart',function($view){
            $brand = Brand::where('brand_status',2)
                            ->where('del_flag',0)
                            ->get();
            $view->with('brand',$brand);
        });
        // $category = Category::where('category_status',2)
        //                     ->where('del_flag',0)
        //                     ->get();

        // $brand = Brand::where('brand_status',2)
        //                     ->where('del_flag',0)
        //                     ->get();
                           
        // View::share('brand',$brand->toArray());
        // View::share('category',$category->toArray());
    }
}
