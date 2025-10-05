import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
export const lookup = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: lookup.url(options),
    method: 'get',
})

lookup.definition = {
    methods: ["get","head"],
    url: '/reg-lookup',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
lookup.url = (options?: RouteQueryOptions) => {
    return lookup.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
lookup.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: lookup.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
lookup.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: lookup.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
const lookupForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: lookup.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
lookupForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: lookup.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
lookupForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: lookup.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

lookup.form = lookupForm

const reg = {
    lookup: Object.assign(lookup, lookup),
}

export default reg