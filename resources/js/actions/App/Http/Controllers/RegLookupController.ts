import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
const RegLookupController = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: RegLookupController.url(options),
    method: 'get',
})

RegLookupController.definition = {
    methods: ["get","head"],
    url: '/reg-lookup',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
RegLookupController.url = (options?: RouteQueryOptions) => {
    return RegLookupController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
RegLookupController.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: RegLookupController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
RegLookupController.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: RegLookupController.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
const RegLookupControllerForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: RegLookupController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
RegLookupControllerForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: RegLookupController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\RegLookupController::__invoke
* @see app/Http/Controllers/RegLookupController.php:16
* @route '/reg-lookup'
*/
RegLookupControllerForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: RegLookupController.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

RegLookupController.form = RegLookupControllerForm

export default RegLookupController