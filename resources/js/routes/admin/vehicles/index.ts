import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\AdminController::deleteMethod
* @see app/Http/Controllers/AdminController.php:172
* @route '/admin/vehicles/{vehicle}'
*/
export const deleteMethod = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteMethod.url(args, options),
    method: 'delete',
})

deleteMethod.definition = {
    methods: ["delete"],
    url: '/admin/vehicles/{vehicle}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\AdminController::deleteMethod
* @see app/Http/Controllers/AdminController.php:172
* @route '/admin/vehicles/{vehicle}'
*/
deleteMethod.url = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
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

    return deleteMethod.definition.url
            .replace('{vehicle}', parsedArgs.vehicle.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::deleteMethod
* @see app/Http/Controllers/AdminController.php:172
* @route '/admin/vehicles/{vehicle}'
*/
deleteMethod.delete = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteMethod.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\AdminController::deleteMethod
* @see app/Http/Controllers/AdminController.php:172
* @route '/admin/vehicles/{vehicle}'
*/
const deleteMethodForm = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteMethod.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::deleteMethod
* @see app/Http/Controllers/AdminController.php:172
* @route '/admin/vehicles/{vehicle}'
*/
deleteMethodForm.delete = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteMethod.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

deleteMethod.form = deleteMethodForm

const vehicles = {
    delete: Object.assign(deleteMethod, deleteMethod),
}

export default vehicles