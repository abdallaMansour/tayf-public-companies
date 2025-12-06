<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DomainRequest;
use App\Models\WebmasterSection;
use Auth;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Redirect;

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

        //List of domain requests
        if (@Auth::user()->permissionsGroup->view_status) {
            $DomainRequests = DomainRequest::where('created_by', '=', Auth::user()->id)
                ->orderby('id', 'desc')
                ->paginate(config('smartend.backend_pagination'));
        } else {
            $DomainRequests = DomainRequest::orderby('id', 'desc')
                ->paginate(config('smartend.backend_pagination'));
        }

        $search_word = "";

        return view("dashboard.domain_requests.list",
            compact("DomainRequests", "GeneralWebmasterSections", "search_word"));
    }

    public function search(Request $request)
    {
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            if ($request->q != "") {
                //find Domain Requests
                $DomainRequests = DomainRequest::where('created_by', '=', Auth::user()->id)
                    ->where('domain', 'like', '%'.$request->q.'%')
                    ->orwhere('username', 'like', '%'.$request->q.'%')
                    ->orderby('id', 'desc')
                    ->paginate(config('smartend.backend_pagination'));
            } else {
                //List of all domain requests
                $DomainRequests = DomainRequest::where('created_by', '=', Auth::user()->id)
                    ->orderby('id', 'desc')
                    ->paginate(config('smartend.backend_pagination'));
            }
        } else {
            if ($request->q != "") {
                //find Domain Requests
                $DomainRequests = DomainRequest::where('domain', 'like', '%'.$request->q.'%')
                    ->orwhere('username', 'like', '%'.$request->q.'%')
                    ->orderby('id', 'desc')
                    ->paginate(config('smartend.backend_pagination'));
            } else {
                //List of all domain requests
                $DomainRequests = DomainRequest::orderby('id', 'desc')
                    ->paginate(config('smartend.backend_pagination'));
            }
        }

        $search_word = $request->q;

        return view("dashboard.domain_requests.list",
            compact("DomainRequests", "GeneralWebmasterSections", "search_word"));
    }

    public function create()
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->add_status) {
            return Redirect::to(route('NoPermission'))->send();
        }

        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        return view("dashboard.domain_requests.create",
            compact("GeneralWebmasterSections"));
    }

    public function store(Request $request)
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->add_status) {
            return Redirect::to(route('NoPermission'))->send();
        }

        // Validation
        $this->validate($request, [
            'domain' => 'required|string|max:255',
        ]);

        // Get username from Helper
        $username = getTenantPrefix();

        // Get admin connection
        adminConnectionDatabase();

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

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Accept-Language' => app()->getLocale(),
            ])->post($adminUrl . '/api/domains', $data);

            if ($response->successful()) {
                // Save to local database
                $DomainRequest = new DomainRequest;
                $DomainRequest->domain = strip_tags($request->domain);
                $DomainRequest->username = $username;
                $DomainRequest->status = 0; // pending
                $DomainRequest->created_by = Auth::user()->id;
                $DomainRequest->save();

                return redirect()->action([DomainRequestController::class, 'index'])
                    ->with('doneMessage', __('backend.saveDone'));
            } else {
                return redirect()->back()
                    ->with('error', 'Failed to submit domain request: ' . ($response->json()['message'] ?? 'Unknown error'));
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error submitting domain request: ' . $e->getMessage());
        }
    }

    public function updateAll(Request $request)
    {
        if ($request->ids != "") {
            if ($request->action == "activate") {
                DomainRequest::wherein('id', $request->ids)
                    ->update(['status' => 1]);
            } elseif ($request->action == "block") {
                DomainRequest::wherein('id', $request->ids)
                    ->update(['status' => 0]);
            }
        }

        return redirect()->action([DomainRequestController::class, 'index'])
            ->with('doneMessage', __('backend.saveDone'));
    }
}

