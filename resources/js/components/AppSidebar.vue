<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarGroup,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from '@/components/ui/sidebar';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import { urlIsActive } from '@/lib/utils';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { LayoutGrid, BarChart3, Users, Car, Shield, ChevronRight } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import AppLogo from './AppLogo.vue';

const page = usePage();
const user = computed(() => page.props.auth?.user);
const isAdmin = computed(() => user.value?.is_admin || false);
const isOwner = computed(() => user.value?.is_owner || false);

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
];

const adminNavItems: NavItem[] = [
    {
        title: 'Analytics',
        href: '/admin',
        icon: BarChart3,
    },
    {
        title: 'Users',
        href: '/admin/users',
        icon: Users,
    },
    {
        title: 'Vehicles',
        href: '/admin/vehicles',
        icon: Car,
    },
];

const ownerNavItems: NavItem[] = [
    {
        title: 'Manage Admins',
        href: '/admin/manage-admins',
        icon: Shield,
    },
];

const footerNavItems: NavItem[] = [];

const adminDropdownOpen = ref(true);
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" :show-label="false" />
            
            <!-- Admin Section (only visible to admins) -->
            <SidebarGroup v-if="isAdmin">
                <SidebarMenu>
                    <Collapsible v-model:open="adminDropdownOpen" as-child default-open class="group/collapsible">
                        <SidebarMenuItem>
                            <CollapsibleTrigger as-child>
                                <SidebarMenuButton :tooltip="'Admin'">
                                    <Shield />
                                    <span>Admin</span>
                                    <ChevronRight class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                                </SidebarMenuButton>
                            </CollapsibleTrigger>
                            <CollapsibleContent>
                                <SidebarMenuSub>
                                    <SidebarMenuSubItem v-for="item in adminNavItems" :key="item.title">
                                        <SidebarMenuSubButton
                                            as-child
                                            :is-active="urlIsActive(item.href, page.url)"
                                        >
                                            <Link :href="item.href">
                                                <component :is="item.icon" />
                                                <span>{{ item.title }}</span>
                                            </Link>
                                        </SidebarMenuSubButton>
                                    </SidebarMenuSubItem>
                                    <SidebarMenuSubItem v-if="isOwner" v-for="item in ownerNavItems" :key="item.title">
                                        <SidebarMenuSubButton
                                            as-child
                                            :is-active="urlIsActive(item.href, page.url)"
                                        >
                                            <Link :href="item.href">
                                                <component :is="item.icon" />
                                                <span>{{ item.title }}</span>
                                            </Link>
                                        </SidebarMenuSubButton>
                                    </SidebarMenuSubItem>
                                </SidebarMenuSub>
                            </CollapsibleContent>
                        </SidebarMenuItem>
                    </Collapsible>
                </SidebarMenu>
            </SidebarGroup>
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
