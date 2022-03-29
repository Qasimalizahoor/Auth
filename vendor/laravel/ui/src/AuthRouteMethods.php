<?php

namespace Laravel\Ui;

class AuthRouteMethods
{
    /**
     * Register the typical authentication routes for an application.
     *
     * @param  array  $options
     * @return callable
     */
    public function auth()
    {
        return function ($options = []) {
            $namespace = class_exists($this->prependGroupNamespace('Auth\User\LoginController')) ? null : 'App\Http\Controllers';

            $this->group(['namespace' => $namespace], function() use($options) {
                // Login Routes...
                if ($options['login'] ?? true) {
                    $this->get('login', 'Auth\User\LoginController@showLoginForm')->name('login');
                    $this->post('login', 'Auth\User\LoginController@login');
                }

                // Logout Routes...
                if ($options['logout'] ?? true) {
                    $this->post('logout', 'Auth\User\LoginController@logout')->name('logout');
                }

                // Registration Routes...
                if ($options['register'] ?? true) {
                    $this->get('register', 'Auth\User\RegisterController@showRegistrationForm')->name('register');
                    $this->post('register', 'Auth\User\RegisterController@register');
                }

                // Password Reset Routes...
                if ($options['reset'] ?? true) {
                    $this->resetPassword();
                }

                // Password Confirmation Routes...
                if ($options['confirm'] ??
                    class_exists($this->prependGroupNamespace('Auth\User\ConfirmPasswordController'))) {
                    $this->confirmPassword();
                }

                // Email Verification Routes...
                if ($options['verify'] ?? false) {
                    $this->emailVerification();
                }
            });
        };
    }

    /**
     * Register the typical reset password routes for an application.
     *
     * @return callable
     */
    public function resetPassword()
    {
        return function () {
            $this->get('password/reset', 'Auth\User\ForgotPasswordController@showLinkRequestForm')->name('password.request');
            $this->post('password/email', 'Auth\User\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
            $this->get('password/reset/{token}', 'Auth\User\ResetPasswordController@showResetForm')->name('password.reset');
            $this->post('password/reset', 'Auth\User\ResetPasswordController@reset')->name('password.update');
        };
    }

    /**
     * Register the typical confirm password routes for an application.
     *
     * @return callable
     */
    public function confirmPassword()
    {
        return function () {
            $this->get('password/confirm', 'Auth\User\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
            $this->post('password/confirm', 'Auth\User\ConfirmPasswordController@confirm');
        };
    }

    /**
     * Register the typical email verification routes for an application.
     *
     * @return callable
     */
    public function emailVerification()
    {
        return function () {
            $this->get('email/verify', 'Auth\User\VerificationController@show')->name('verification.notice');
            $this->get('email/verify/{id}/{hash}', 'Auth\User\VerificationController@verify')->name('verification.verify');
            $this->post('email/resend', 'Auth\User\VerificationController@resend')->name('verification.resend');
        };
    }
}
