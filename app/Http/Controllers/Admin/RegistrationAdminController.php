<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\RegistrationModule\Contracts\RegistrationServiceInterface;

class RegistrationAdminController extends Controller
{
    public function __construct(private readonly RegistrationServiceInterface $service) {}

    public function index()
    {
        return view('admin.registrations.index', [
            'registrations' => $this->service->allForAdmin(),
        ]);
    }
}
