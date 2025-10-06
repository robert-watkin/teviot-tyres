<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        // Most saved vehicles
        $topVehicles = Vehicle::select('registration', DB::raw('COUNT(*) as save_count'))
            ->groupBy('registration')
            ->orderByDesc('save_count')
            ->limit(10)
            ->get();

        // Recent users
        $recentUsers = User::latest()->limit(5)->get();

        // Recent vehicles
        $recentVehicles = Vehicle::with('user')->latest()->limit(5)->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'totalUsers' => $totalUsers,
                'usersThisWeek' => $usersThisWeek,
                'usersGrowth' => $usersGrowth,
                'totalVehicles' => $totalVehicles,
                'vehiclesThisWeek' => $vehiclesThisWeek,
                'vehiclesGrowth' => $vehiclesGrowth,
            ],
            'topVehicles' => $topVehicles,
            'recentUsers' => $recentUsers,
            'recentVehicles' => $recentVehicles,
        ]);
    }

    /**
     * Show the users management page
     */
    public function users(Request $request): Response
    {
        $search = $request->get('search');
        $roleFilter = $request->get('role');
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

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
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        $vehicles = Vehicle::with('user')
            ->when($search, fn($q) => $q->where('registration', 'like', "%{$search}%"))
            ->orderBy($sortBy, $sortDirection)
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
     * Show the manage admins page (owner only)
     */
    public function manageAdmins(Request $request): Response
    {
        $search = $request->get('search');

        // Get all admins
        $admins = User::where('role', 'admin')
            ->withCount('vehicles')
            ->get();

        // Search for users to promote (only regular users)
        $searchResults = $search
            ? User::where('role', 'user')
                ->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                })
                ->limit(10)
                ->get()
            : collect();

        return Inertia::render('Admin/ManageAdmins', [
            'admins' => $admins,
            'searchResults' => $searchResults,
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
