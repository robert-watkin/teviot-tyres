<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { store } from '@/routes/password/confirm';
import { Form, Head, router } from '@inertiajs/vue3';
import { ArrowLeft, LoaderCircle } from 'lucide-vue-next';

const fallbackRoute = '/dashboard';

const goBack = () => {
    if (window.history.length > 1) {
        window.history.back();
        return;
    }

    router.visit(fallbackRoute);
};
</script>

<template>
    <AuthLayout
        title="Confirm your password"
        description="This is a secure area of the application. Please confirm your password before continuing."
    >
        <Head title="Confirm password" />

        <template #header-actions>
            <div class="flex w-full justify-start">
                <Button
                    type="button"
                    variant="ghost"
                    class="inline-flex items-center gap-2 px-0 text-sm text-muted-foreground hover:text-foreground"
                    @click="goBack"
                >
                    <ArrowLeft class="h-4 w-4" />
                    Back
                </Button>
            </div>
        </template>

        <Form
            v-bind="store.form()"
            reset-on-success
            v-slot="{ errors, processing }"
        >
            <div class="space-y-6">
                <div class="grid gap-2">
                    <Label htmlFor="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="current-password"
                        autofocus
                    />

                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center">
                    <Button
                        class="w-full"
                        :disabled="processing"
                        data-test="confirm-password-button"
                    >
                        <LoaderCircle
                            v-if="processing"
                            class="h-4 w-4 animate-spin"
                        />
                        Confirm Password
                    </Button>
                </div>
            </div>
        </Form>
    </AuthLayout>
</template>
