<?php

namespace App\Controllers;

use App\Services\AuthService;
use Core\Classes\Controller;
use Core\Classes\View;

class AuthController extends Controller {
    private AuthService $service;

    public function __construct() {
        $this->service = new AuthService();
    }

    public function signIn() {
        $this->view('auth.sign-in');
    }

    public function signUp() {
        $this->view('auth.sign-up');
    }
}