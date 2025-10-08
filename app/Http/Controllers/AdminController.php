<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    /**
     * Show the admin analytics dashboard
     */
    public function index(): Response
    {
        // Total users
        $totalUsers = User::count();
        $usersThisWeek = User::where('created_at', '>=', now()->subWeek())->count();
        $usersLastWeek = User::whereBetween('created_at', [now()->subWeeks(2), now()->subWeek()])->count();
        $usersGrowth = $usersLastWeek > 0 ? round((($usersThisWeek - $usersLastWeek) / $usersLastWeek) * 100, 1) : 0;

        // Total vehicles
        $totalVehicles = Vehicle::count();
        $vehiclesThisWeek = Vehicle::where('created_at', '>=', now()->subWeek())->count();
        $vehiclesLastWeek = Vehicle::whereBetween('created_at', [now()->subWeeks(2), now()->subWeek()])->count();
        $vehiclesGrowth = $vehiclesLastWeek > 0 ? round((($vehiclesThisWeek - $vehiclesLastWeek) / $vehiclesLastWeek) * 100, 1) : 0;

        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'totalUsers' => $totalUsers,
                'usersThisWeek' => $usersThisWeek,
                'usersGrowth' => $usersGrowth,
                'totalVehicles' => $totalVehicles,
                'vehiclesThisWeek' => $vehiclesThisWeek,
                'vehiclesGrowth' => $vehiclesGrowth,
            ],
        ]);
    }

    /**
     * Show the users management page
     */
    public function users(Request $request): Response
    {
        $search = $request->get('search');
        $roleFilter = $request->get('role');
        $allowedUserSorts = ['name', 'email', 'role', 'vehicles_count', 'created_at'];
        $allowedDirections = ['asc', 'desc'];

        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        if (!in_array($sortBy, $allowedUserSorts, true)) {
            $sortBy = 'created_at';
        }

        if (!in_array($sortDirection, $allowedDirections, true)) {
            $sortDirection = 'desc';
        }

        $users = User::withCount('vehicles')
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%"))
            ->when($roleFilter, fn($q) => $q->where('role', $roleFilter))
            ->orderBy($sortBy, $sortDirection)
            ->paginate(20)
            ->withQueryString();

        // Get all user emails for "Email All" button (only regular users)
        $allEmails = User::where('role', 'user')
            ->pluck('email')
            ->implode(',');

        return Inertia::render('Admin/Users', [
            'users' => $users,
            'allEmails' => $allEmails,
            'filters' => [
                'search' => $search,
                'role' => $roleFilter,
                'sort' => $sortBy,
                'direction' => $sortDirection,
            ],
        ]);
    }

    /**
     * Show the vehicles management page
     */
    public function vehicles(Request $request): Response
    {
        $search = $request->get('search');
        $allowedVehicleSorts = [
            'registration',
            'created_at',
            'user_name',
            'vehicle_make',
            'vehicle_colour',
            'vehicle_year',
        ];
        $allowedDirections = ['asc', 'desc'];

        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        if (!in_array($sortBy, $allowedVehicleSorts, true)) {
            $sortBy = 'created_at';
        }

        if (!in_array($sortDirection, $allowedDirections, true)) {
            $sortDirection = 'desc';
        }

        $vehiclesQuery = Vehicle::query()
            ->with('user')
            ->when($search, fn($q) => $q->where('registration', 'like', "%{$search}%"));

        if ($sortBy === 'user_name') {
            $vehiclesQuery
                ->leftJoin('users', 'vehicles.user_id', '=', 'users.id')
                ->select('vehicles.*')
                ->orderBy('users.name', $sortDirection);
        } elseif ($sortBy === 'vehicle_make') {
            $vehiclesQuery
                ->orderByRaw("LOWER(COALESCE(JSON_UNQUOTE(JSON_EXTRACT(vehicle_data, '$.make')), '')) {$sortDirection}")
                ->orderByRaw("LOWER(COALESCE(JSON_UNQUOTE(JSON_EXTRACT(vehicle_data, '$.model')), '')) {$sortDirection}");
        } elseif ($sortBy === 'vehicle_colour') {
            $vehiclesQuery->orderByRaw("LOWER(COALESCE(JSON_UNQUOTE(JSON_EXTRACT(vehicle_data, '$.colour')), '')) {$sortDirection}");
        } elseif ($sortBy === 'vehicle_year') {
            $vehiclesQuery->orderByRaw("CAST(COALESCE(JSON_UNQUOTE(JSON_EXTRACT(vehicle_data, '$.year_of_manufacture')), '0') AS UNSIGNED) {$sortDirection}");
        } else {
            $vehiclesQuery->orderBy("vehicles.{$sortBy}", $sortDirection);
        }

        $vehicles = $vehiclesQuery
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('Admin/Vehicles', [
            'vehicles' => $vehicles,
            'filters' => [
                'search' => $search,
                'sort' => $sortBy,
                'direction' => $sortDirection,
            ],
        ]);
    }

    /**
     * Show a specific user's details
     */
    public function showUser(User $user): Response
    {
        $user->load(['vehicles' => fn($q) => $q->latest()]);
        $user->loadCount('vehicles');

        return Inertia::render('Admin/UserDetail', [
            'user' => $user,
        ]);
    }

    /**
     * Show the manage admins page (owner only)
     */
    public function manageAdmins(Request $request): Response
    {
        $search = $request->get('search');

        // Get all admins
        $admins = User::where('role', 'admin')
            ->withCount('vehicles')
            ->get();

        // Get all regular users (paginated, with optional search filter)
        $users = User::where('role', 'user')
            ->withCount('vehicles')
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/ManageAdmins', [
            'admins' => $admins,
            'users' => $users,
            'search' => $search,
        ]);
    }

    /**
     * Delete a user
     */
    public function deleteUser(User $user)
    {
        // Prevent deleting owner
        if ($user->isOwner()) {
            return back()->with('error', 'Cannot delete the owner account.');
        }

        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    /**
     * Delete a vehicle
     */
    public function deleteVehicle(Vehicle $vehicle)
    {
        $vehicle->delete();

        return back()->with('success', 'Vehicle deleted successfully.');
    }

    /**
     * Promote a user to admin (owner only)
     */
    public function promoteToAdmin(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'User is already an admin.');
        }

        $user->update(['role' => 'admin']);

        return back()->with('success', "User {$user->name} has been promoted to admin.");
    }

    /**
     * Demote an admin to user (owner only)
     */
    public function demoteToUser(User $user)
    {
        if (!$user->isAdmin()) {
            return back()->with('error', 'User is not an admin.');
        }

        if ($user->isOwner()) {
            return back()->with('error', 'Cannot demote the owner.');
        }

        // Prevent self-demotion
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot demote yourself.');
        }

        $user->update(['role' => 'user']);

        return back()->with('success', "User {$user->name} has been demoted to user.");
    }
}
