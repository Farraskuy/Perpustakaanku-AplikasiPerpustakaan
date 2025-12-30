<?php

namespace Config;

use Myth\Auth\Config\Auth as AuthConfig;

class Auth extends AuthConfig
{
    /**
     * ------------------------------------
     * Views
     * ------------------------------------
     * Custom Views untuk halaman Auth
     */
    public $views = [
        'login'           => 'App\Views\auth\login',
        'register'        => 'App\Views\auth\register',
        'forgot'          => 'Myth\Auth\Views\forgot',
        'reset'           => 'Myth\Auth\Views\reset',
        'emailForgot'     => 'Myth\Auth\Views\emails\forgot',
        'emailActivation' => 'Myth\Auth\Views\emails\activation',
    ];

    /**
     * ------------------------------------
     * Layout untuk Views
     * ------------------------------------
     */
    public $viewLayout = 'Myth\Auth\Views\layout';

    /**
     * ------------------------------------
     * Allow Registration
     * ------------------------------------
     */
    public $allowRegistration = true;

    /**
     * ------------------------------------
     * Require Activation by Email
     * ------------------------------------
     */
    public $requireActivation = false;

    /**
     * ------------------------------------
     * Allow Remembering (Remember Me)
     * ------------------------------------
     */
    public $allowRemembering = true;

    /**
     * ------------------------------------
     * Remember Length (in seconds)
     * ------------------------------------
     * 30 days default
     */
    public $rememberLength = 30 * DAY;

    /**
     * ------------------------------------
     * Silent Mode
     * ------------------------------------
     * Tidak memunculkan error untuk keamanan
     */
    public $silent = true;

    /**
     * ------------------------------------
     * User Model
     * ------------------------------------
     */
    public $userModel = 'Myth\Auth\Models\UserModel';

    /**
     * ------------------------------------
     * Hash Algorithm
     * ------------------------------------
     */
    public $hashAlgorithm = PASSWORD_BCRYPT;

    /**
     * ------------------------------------
     * Hash Memory Cost (for Argon2)
     * ------------------------------------
     */
    public $hashMemoryCost = 2048;

    /**
     * ------------------------------------
     * Hash Time Cost (for Argon2)
     * ------------------------------------
     */
    public $hashTimeCost = 4;

    /**
     * ------------------------------------
     * Hash Threads (for Argon2)
     * ------------------------------------
     */
    public $hashThreads = 4;

    /**
     * ------------------------------------
     * Hash Cost (for Bcrypt)
     * ------------------------------------
     */
    public $hashCost = 10;

    /**
     * ------------------------------------
     * Minimum Password Length
     * ------------------------------------
     */
    public $minimumPasswordLength = 6;

    /**
     * ------------------------------------
     * Default User Group
     * ------------------------------------
     * Group yang auto-assign saat register
     */
    public $defaultUserGroup = 'anggota';

    /**
     * ------------------------------------
     * Auth Gateway
     * ------------------------------------
     */
    public $authGateway = 'session';

    /**
     * ------------------------------------
     * Personal Fields
     * ------------------------------------
     */
    public $personalFields = [];

    /**
     * ------------------------------------
     * Valid Fields
     * ------------------------------------
     */
    public $validFields = [
        'email',
        'username',
    ];

    /**
     * ------------------------------------
     * Redirect after login
     * ------------------------------------
     */
    public $redirects = [
        'login'  => '/',
        'logout' => '/',
    ];
}
