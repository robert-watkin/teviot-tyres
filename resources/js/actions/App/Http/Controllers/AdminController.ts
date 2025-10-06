import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:17
* @route '/admin'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:17
* @route '/admin'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:17
* @route '/admin'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:17
* @route '/admin'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:17
* @route '/admin'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:17
* @route '/admin'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:17
* @route '/admin'
*/
indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

index.form = indexForm

/**
* @see \App\Http\Controllers\AdminController::users
* @see app/Http/Controllers/AdminController.php:62
* @route '/admin/users'
*/
export const users = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: users.url(options),
    method: 'get',
})

users.definition = {
    methods: ["get","head"],
    url: '/admin/users',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\AdminController::users
* @see app/Http/Controllers/AdminController.php:62
* @route '/admin/users'
*/
users.url = (options?: RouteQueryOptions) => {
    return users.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::users
* @see app/Http/Controllers/AdminController.php:62
* @route '/admin/users'
*/
users.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: users.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::users
* @see app/Http/Controllers/AdminController.php:62
* @route '/admin/users'
*/
users.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: users.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\AdminController::users
* @see app/Http/Controllers/AdminController.php:62
* @route '/admin/users'
*/
const usersForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: users.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::users
* @see app/Http/Controllers/AdminController.php:62
* @route '/admin/users'
*/
usersForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: users.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::users
* @see app/Http/Controllers/AdminController.php:62
* @route '/admin/users'
*/
usersForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: users.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

users.form = usersForm

/**
* @see \App\Http\Controllers\AdminController::vehicles
* @see app/Http/Controllers/AdminController.php:97
* @route '/admin/vehicles'
*/
export const vehicles = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: vehicles.url(options),
    method: 'get',
})

vehicles.definition = {
    methods: ["get","head"],
    url: '/admin/vehicles',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\AdminController::vehicles
* @see app/Http/Controllers/AdminController.php:97
* @route '/admin/vehicles'
*/
vehicles.url = (options?: RouteQueryOptions) => {
    return vehicles.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::vehicles
* @see app/Http/Controllers/AdminController.php:97
* @route '/admin/vehicles'
*/
vehicles.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: vehicles.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::vehicles
* @see app/Http/Controllers/AdminController.php:97
* @route '/admin/vehicles'
*/
vehicles.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: vehicles.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\AdminController::vehicles
* @see app/Http/Controllers/AdminController.php:97
* @route '/admin/vehicles'
*/
const vehiclesForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: vehicles.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::vehicles
* @see app/Http/Controllers/AdminController.php:97
* @route '/admin/vehicles'
*/
vehiclesForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: vehicles.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::vehicles
* @see app/Http/Controllers/AdminController.php:97
* @route '/admin/vehicles'
*/
vehiclesForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: vehicles.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

vehicles.form = vehiclesForm

/**
* @see \App\Http\Controllers\AdminController::deleteUser
* @see app/Http/Controllers/AdminController.php:152
* @route '/admin/users/{user}'
*/
export const deleteUser = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteUser.url(args, options),
    method: 'delete',
})

deleteUser.definition = {
    methods: ["delete"],
    url: '/admin/users/{user}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\AdminController::deleteUser
* @see app/Http/Controllers/AdminController.php:152
* @route '/admin/users/{user}'
*/
deleteUser.url = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { user: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { user: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            user: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        user: typeof args.user === 'object'
        ? args.user.id
        : args.user,
    }

    return deleteUser.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::deleteUser
* @see app/Http/Controllers/AdminController.php:152
* @route '/admin/users/{user}'
*/
deleteUser.delete = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteUser.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\AdminController::deleteUser
* @see app/Http/Controllers/AdminController.php:152
* @route '/admin/users/{user}'
*/
const deleteUserForm = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteUser.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::deleteUser
* @see app/Http/Controllers/AdminController.php:152
* @route '/admin/users/{user}'
*/
deleteUserForm.delete = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteUser.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

deleteUser.form = deleteUserForm

/**
* @see \App\Http\Controllers\AdminController::deleteVehicle
* @see app/Http/Controllers/AdminController.php:172
* @route '/admin/vehicles/{vehicle}'
*/
export const deleteVehicle = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteVehicle.url(args, options),
    method: 'delete',
})

deleteVehicle.definition = {
    methods: ["delete"],
    url: '/admin/vehicles/{vehicle}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\AdminController::deleteVehicle
* @see app/Http/Controllers/AdminController.php:172
* @route '/admin/vehicles/{vehicle}'
*/
deleteVehicle.url = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { vehicle: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { vehicle: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            vehicle: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        vehicle: typeof args.vehicle === 'object'
        ? args.vehicle.id
        : args.vehicle,
    }

    return deleteVehicle.definition.url
            .replace('{vehicle}', parsedArgs.vehicle.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::deleteVehicle
* @see app/Http/Controllers/AdminController.php:172
* @route '/admin/vehicles/{vehicle}'
*/
deleteVehicle.delete = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteVehicle.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\AdminController::deleteVehicle
* @see app/Http/Controllers/AdminController.php:172
* @route '/admin/vehicles/{vehicle}'
*/
const deleteVehicleForm = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteVehicle.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::deleteVehicle
* @see app/Http/Controllers/AdminController.php:172
* @route '/admin/vehicles/{vehicle}'
*/
deleteVehicleForm.delete = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteVehicle.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

deleteVehicle.form = deleteVehicleForm

/**
* @see \App\Http\Controllers\AdminController::manageAdmins
* @see app/Http/Controllers/AdminController.php:122
* @route '/admin/manage-admins'
*/
export const manageAdmins = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: manageAdmins.url(options),
    method: 'get',
})

manageAdmins.definition = {
    methods: ["get","head"],
    url: '/admin/manage-admins',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\AdminController::manageAdmins
* @see app/Http/Controllers/AdminController.php:122
* @route '/admin/manage-admins'
*/
manageAdmins.url = (options?: RouteQueryOptions) => {
    return manageAdmins.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::manageAdmins
* @see app/Http/Controllers/AdminController.php:122
* @route '/admin/manage-admins'
*/
manageAdmins.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: manageAdmins.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::manageAdmins
* @see app/Http/Controllers/AdminController.php:122
* @route '/admin/manage-admins'
*/
manageAdmins.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: manageAdmins.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\AdminController::manageAdmins
* @see app/Http/Controllers/AdminController.php:122
* @route '/admin/manage-admins'
*/
const manageAdminsForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: manageAdmins.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::manageAdmins
* @see app/Http/Controllers/AdminController.php:122
* @route '/admin/manage-admins'
*/
manageAdminsForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: manageAdmins.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::manageAdmins
* @see app/Http/Controllers/AdminController.php:122
* @route '/admin/manage-admins'
*/
manageAdminsForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: manageAdmins.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

manageAdmins.form = manageAdminsForm

/**
* @see \App\Http\Controllers\AdminController::promoteToAdmin
* @see app/Http/Controllers/AdminController.php:182
* @route '/admin/users/{user}/promote'
*/
export const promoteToAdmin = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: promoteToAdmin.url(args, options),
    method: 'post',
})

promoteToAdmin.definition = {
    methods: ["post"],
    url: '/admin/users/{user}/promote',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AdminController::promoteToAdmin
* @see app/Http/Controllers/AdminController.php:182
* @route '/admin/users/{user}/promote'
*/
promoteToAdmin.url = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { user: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { user: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            user: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        user: typeof args.user === 'object'
        ? args.user.id
        : args.user,
    }

    return promoteToAdmin.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::promoteToAdmin
* @see app/Http/Controllers/AdminController.php:182
* @route '/admin/users/{user}/promote'
*/
promoteToAdmin.post = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: promoteToAdmin.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::promoteToAdmin
* @see app/Http/Controllers/AdminController.php:182
* @route '/admin/users/{user}/promote'
*/
const promoteToAdminForm = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: promoteToAdmin.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::promoteToAdmin
* @see app/Http/Controllers/AdminController.php:182
* @route '/admin/users/{user}/promote'
*/
promoteToAdminForm.post = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: promoteToAdmin.url(args, options),
    method: 'post',
})

promoteToAdmin.form = promoteToAdminForm

/**
* @see \App\Http\Controllers\AdminController::demoteToUser
* @see app/Http/Controllers/AdminController.php:196
* @route '/admin/users/{user}/demote'
*/
export const demoteToUser = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: demoteToUser.url(args, options),
    method: 'post',
})

demoteToUser.definition = {
    methods: ["post"],
    url: '/admin/users/{user}/demote',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AdminController::demoteToUser
* @see app/Http/Controllers/AdminController.php:196
* @route '/admin/users/{user}/demote'
*/
demoteToUser.url = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { user: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { user: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            user: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        user: typeof args.user === 'object'
        ? args.user.id
        : args.user,
    }

    return demoteToUser.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::demoteToUser
* @see app/Http/Controllers/AdminController.php:196
* @route '/admin/users/{user}/demote'
*/
demoteToUser.post = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: demoteToUser.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::demoteToUser
* @see app/Http/Controllers/AdminController.php:196
* @route '/admin/users/{user}/demote'
*/
const demoteToUserForm = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: demoteToUser.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::demoteToUser
* @see app/Http/Controllers/AdminController.php:196
* @route '/admin/users/{user}/demote'
*/
demoteToUserForm.post = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: demoteToUser.url(args, options),
    method: 'post',
})

demoteToUser.form = demoteToUserForm

const AdminController = { index, users, vehicles, deleteUser, deleteVehicle, manageAdmins, promoteToAdmin, demoteToUser }

export default AdminController