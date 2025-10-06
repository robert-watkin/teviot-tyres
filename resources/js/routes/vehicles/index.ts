import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../wayfinder'
/**
* @see \App\Http\Controllers\VehicleLookupController::save
* @see app/Http/Controllers/VehicleLookupController.php:73
* @route '/vehicles'
*/
export const save = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: save.url(options),
    method: 'post',
})

save.definition = {
    methods: ["post"],
    url: '/vehicles',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\VehicleLookupController::save
* @see app/Http/Controllers/VehicleLookupController.php:73
* @route '/vehicles'
*/
save.url = (options?: RouteQueryOptions) => {
    return save.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\VehicleLookupController::save
* @see app/Http/Controllers/VehicleLookupController.php:73
* @route '/vehicles'
*/
save.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: save.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\VehicleLookupController::save
* @see app/Http/Controllers/VehicleLookupController.php:73
* @route '/vehicles'
*/
const saveForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: save.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\VehicleLookupController::save
* @see app/Http/Controllers/VehicleLookupController.php:73
* @route '/vehicles'
*/
saveForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: save.url(options),
    method: 'post',
})

save.form = saveForm

/**
* @see \App\Http\Controllers\VehicleLookupController::destroy
* @see app/Http/Controllers/VehicleLookupController.php:107
* @route '/vehicles/{vehicle}'
*/
export const destroy = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/vehicles/{vehicle}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\VehicleLookupController::destroy
* @see app/Http/Controllers/VehicleLookupController.php:107
* @route '/vehicles/{vehicle}'
*/
destroy.url = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
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

    return destroy.definition.url
            .replace('{vehicle}', parsedArgs.vehicle.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\VehicleLookupController::destroy
* @see app/Http/Controllers/VehicleLookupController.php:107
* @route '/vehicles/{vehicle}'
*/
destroy.delete = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\VehicleLookupController::destroy
* @see app/Http/Controllers/VehicleLookupController.php:107
* @route '/vehicles/{vehicle}'
*/
const destroyForm = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\VehicleLookupController::destroy
* @see app/Http/Controllers/VehicleLookupController.php:107
* @route '/vehicles/{vehicle}'
*/
destroyForm.delete = (args: { vehicle: string | number | { id: string | number } } | [vehicle: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroy.form = destroyForm

const vehicles = {
    save: Object.assign(save, save),
    destroy: Object.assign(destroy, destroy),
}

export default vehicles