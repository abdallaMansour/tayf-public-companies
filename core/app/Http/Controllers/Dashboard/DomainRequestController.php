<?php

namespace App\Http\Controllers\Dashboard;

use Auth;
use Redirect;
use Illuminate\Http\Request;
use App\Models\DomainRequest;
use App\Models\WebmasterSection;
use App\Http\Controllers\Controller;

class DomainRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->view_status) {
            return redirect()->route("NoPermission");
        }

        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        // Connect to admin database
        $q = adminConnectionDatabase();

        //List of domain requests
        $DomainRequest = DomainRequest::on($q)->where('username', getTenantPrefix())->first();

        return view(
            "dashboard.domain_requests.list",
            compact("DomainRequest", "GeneralWebmasterSections")
        );
    }

    public function create()
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->add_status) {
            return Redirect::to(route('NoPermission'))->send();
        }

        // Connect to admin database
        $q = adminConnectionDatabase();
        $username = getTenantPrefix();

        // Check if user already has a domain request
        $existingRequest = DomainRequest::on($q)
            ->where('username', $username)
            ->first();
        if ($existingRequest) {
            return redirect()->action([DomainRequestController::class, 'index'])
                ->with('error', __('backend.domainRequestAlreadyExists'));
        }

        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        return view(
            "dashboard.domain_requests.create",
            compact("GeneralWebmasterSections")
        );
    }

    public function store(Request $request)
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->add_status) {
            return Redirect::to(route('NoPermission'))->send();
        }

        // Connect to admin database
        $q = adminConnectionDatabase();
        $username = getTenantPrefix();

        // Check if user already has a domain request
        $existingRequest = DomainRequest::on($q)
            ->where('username', $username)
            ->first();
        if ($existingRequest) {
            return redirect()->action([DomainRequestController::class, 'index'])
                ->with('error', __('backend.domainRequestAlreadyExists'));
        }

        // Validation
        $this->validate($request, [
            'domain' => 'required|string|max:255',
        ]);

        // Prepare data for API
        $data = [
            'username' => $username,
            'domain' => strip_tags($request->domain),
            'status' => 0, // pending status
        ];

        // Make API call
        try {
            $adminUrl = env('ADMIN_URL');
            if (!$adminUrl) {
                return redirect()->back()->with('error', 'ADMIN_URL is not configured');
            }

            // Save to admin database
            DomainRequest::on($q)->create([
                'domain' => strip_tags($request->domain),
                'username' => $username,
                'status' => 0, // pending
            ]);

            return redirect()->action([DomainRequestController::class, 'index'])
                ->with('doneMessage', __('backend.saveDone'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error submitting domain request: ' . $e->getMessage());
        }
    }

}
