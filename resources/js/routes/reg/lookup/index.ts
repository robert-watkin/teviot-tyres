import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\VehicleLookupController::search
* @see app/Http/Controllers/VehicleLookupController.php:27
* @route '/reg-lookup'
*/
export const search = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: search.url(options),
    method: 'post',
})

search.definition = {
    methods: ["post"],
    url: '/reg-lookup',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\VehicleLookupController::search
* @see app/Http/Controllers/VehicleLookupController.php:27
* @route '/reg-lookup'
*/
search.url = (options?: RouteQueryOptions) => {
    return search.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\VehicleLookupController::search
* @see app/Http/Controllers/VehicleLookupController.php:27
* @route '/reg-lookup'
*/
search.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: search.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\VehicleLookupController::search
* @see app/Http/Controllers/VehicleLookupController.php:27
* @route '/reg-lookup'
*/
const searchForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: search.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\VehicleLookupController::search
* @see app/Http/Controllers/VehicleLookupController.php:27
* @route '/reg-lookup'
*/
searchForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: search.url(options),
    method: 'post',
})

search.form = searchForm

const lookup = {
    search: Object.assign(search, search),
}

export default lookup