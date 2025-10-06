import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
import users48860f from './users'
import vehicles094842 from './vehicles'
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

const admin = {
    index: Object.assign(index, index),
    users: Object.assign(users, users48860f),
    vehicles: Object.assign(vehicles, vehicles094842),
    manageAdmins: Object.assign(manageAdmins, manageAdmins),
}

export default admin