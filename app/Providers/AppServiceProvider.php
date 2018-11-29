<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);
        // \Validator::extend('phone_validator', function($attribute, $value, $parameters) {
            // return preg_match("/^\+?\d[0-9-]{9,12}/", $value);
            // return preg_match("/^[1-9][0-9-]{9,12}/", $value);
        // });
        // Validator::replacer('phone_validator', function($message, $attribute, $rule, $parameters) {
        //     return str_replace(':attribute',$attribute, ':attribute is invalid phone number');
        // });
        // \Validator::extend("emails", function($attribute, $value, $parameters) {
        //     $rules = [
        //         'email' => 'required|email',
        //         'to_email' => 'required|emails'
        //     ];
        //     foreach ($value as $email) {
        //         $data = [
        //             'email' => $email
        //         ];
        //         $validator = Validator::make($data, $rules);
        //         if ($validator->fails()) {
        //             return false;
        //         }
        //     }
        //     return true;
        // });
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
