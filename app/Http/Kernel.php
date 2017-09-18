<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'App\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => 'App\Http\Middleware\Authenticate',
        'deny.admin' => 'App\Http\Middleware\DepriveWatcher',
		'dashboard' => 'App\Http\Middleware\DashboardVisibility',
		'eligible' => 'App\Http\Middleware\CaseEligible',
		'notification' => 'App\Http\Middleware\Notification',
		'user.editable' => 'App\Http\Middleware\UserEditable',
		'org.editable' => 'App\Http\Middleware\OrganizationEditable',
		'task.visibility' => 'App\Http\Middleware\TaskVisibility',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',
	];

}
