import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\VehicleLookupController::index
* @see app/Http/Controllers/VehicleLookupController.php:18
* @route '/reg-lookup'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/reg-lookup',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\VehicleLookupController::index
* @see app/Http/Controllers/VehicleLookupController.php:18
* @route '/reg-lookup'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\VehicleLookupController::index
* @see app/Http/Controllers/VehicleLookupController.php:18
* @route '/reg-lookup'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\VehicleLookupController::index
* @see app/Http/Controllers/VehicleLookupController.php:18
* @route '/reg-lookup'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\VehicleLookupController::index
* @see app/Http/Controllers/VehicleLookupController.php:18
* @route '/reg-lookup'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\VehicleLookupController::index
* @see app/Http/Controllers/VehicleLookupController.php:18
* @route '/reg-lookup'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\VehicleLookupController::index
* @see app/Http/Controllers/VehicleLookupController.php:18
* @route '/reg-lookup'
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
* @see \App\Http\Controllers\VehicleLookupController::lookup
* @see app/Http/Controllers/VehicleLookupController.php:26
* @route '/reg-lookup'
*/
export const lookup = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: lookup.url(options),
    method: 'post',
})

lookup.definition = {
    methods: ["post"],
    url: '/reg-lookup',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\VehicleLookupController::lookup
* @see app/Http/Controllers/VehicleLookupController.php:26
* @route '/reg-lookup'
*/
lookup.url = (options?: RouteQueryOptions) => {
    return lookup.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\VehicleLookupController::lookup
* @see app/Http/Controllers/VehicleLookupController.php:26
* @route '/reg-lookup'
*/
lookup.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: lookup.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\VehicleLookupController::lookup
* @see app/Http/Controllers/VehicleLookupController.php:26
* @route '/reg-lookup'
*/
const lookupForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: lookup.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\VehicleLookupController::lookup
* @see app/Http/Controllers/VehicleLookupController.php:26
* @route '/reg-lookup'
*/
lookupForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: lookup.url(options),
    method: 'post',
})

lookup.form = lookupForm

const VehicleLookupController = { index, lookup }

export default VehicleLookupController