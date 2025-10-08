import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:153
* @route '/admin/users/{user}'
*/
export const show = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/users/{user}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:153
* @route '/admin/users/{user}'
*/
show.url = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
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

    return show.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:153
* @route '/admin/users/{user}'
*/
show.get = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:153
* @route '/admin/users/{user}'
*/
show.head = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:153
* @route '/admin/users/{user}'
*/
const showForm = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:153
* @route '/admin/users/{user}'
*/
showForm.get = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:153
* @route '/admin/users/{user}'
*/
showForm.head = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

show.form = showForm

/**
* @see \App\Http\Controllers\AdminController::deleteMethod
* @see app/Http/Controllers/AdminController.php:194
* @route '/admin/users/{user}'
*/
export const deleteMethod = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteMethod.url(args, options),
    method: 'delete',
})

deleteMethod.definition = {
    methods: ["delete"],
    url: '/admin/users/{user}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\AdminController::deleteMethod
* @see app/Http/Controllers/AdminController.php:194
* @route '/admin/users/{user}'
*/
deleteMethod.url = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
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

    return deleteMethod.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::deleteMethod
* @see app/Http/Controllers/AdminController.php:194
* @route '/admin/users/{user}'
*/
deleteMethod.delete = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteMethod.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\AdminController::deleteMethod
* @see app/Http/Controllers/AdminController.php:194
* @route '/admin/users/{user}'
*/
const deleteMethodForm = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see app/Http/Controllers/AdminController.php:194
* @route '/admin/users/{user}'
*/
deleteMethodForm.delete = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteMethod.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

deleteMethod.form = deleteMethodForm

/**
* @see \App\Http\Controllers\AdminController::promote
* @see app/Http/Controllers/AdminController.php:224
* @route '/admin/users/{user}/promote'
*/
export const promote = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: promote.url(args, options),
    method: 'post',
})

promote.definition = {
    methods: ["post"],
    url: '/admin/users/{user}/promote',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AdminController::promote
* @see app/Http/Controllers/AdminController.php:224
* @route '/admin/users/{user}/promote'
*/
promote.url = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
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

    return promote.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::promote
* @see app/Http/Controllers/AdminController.php:224
* @route '/admin/users/{user}/promote'
*/
promote.post = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: promote.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::promote
* @see app/Http/Controllers/AdminController.php:224
* @route '/admin/users/{user}/promote'
*/
const promoteForm = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: promote.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::promote
* @see app/Http/Controllers/AdminController.php:224
* @route '/admin/users/{user}/promote'
*/
promoteForm.post = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: promote.url(args, options),
    method: 'post',
})

promote.form = promoteForm

/**
* @see \App\Http\Controllers\AdminController::demote
* @see app/Http/Controllers/AdminController.php:238
* @route '/admin/users/{user}/demote'
*/
export const demote = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: demote.url(args, options),
    method: 'post',
})

demote.definition = {
    methods: ["post"],
    url: '/admin/users/{user}/demote',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AdminController::demote
* @see app/Http/Controllers/AdminController.php:238
* @route '/admin/users/{user}/demote'
*/
demote.url = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
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

    return demote.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::demote
* @see app/Http/Controllers/AdminController.php:238
* @route '/admin/users/{user}/demote'
*/
demote.post = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: demote.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::demote
* @see app/Http/Controllers/AdminController.php:238
* @route '/admin/users/{user}/demote'
*/
const demoteForm = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: demote.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::demote
* @see app/Http/Controllers/AdminController.php:238
* @route '/admin/users/{user}/demote'
*/
demoteForm.post = (args: { user: string | number | { id: string | number } } | [user: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: demote.url(args, options),
    method: 'post',
})

demote.form = demoteForm

const users = {
    show: Object.assign(show, show),
    delete: Object.assign(deleteMethod, deleteMethod),
    promote: Object.assign(promote, promote),
    demote: Object.assign(demote, demote),
}

export default users