<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

export type TColorType = 'primary' | 'danger' | 'success'

const classVariants: Record<TColorType, string> = {
    primary: 'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500',
    danger: 'bg-red-800 text-white hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:ring-indigo-500',
    success: 'bg-green-800 text-white hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:ring-indigo-500',
}

withDefaults(
    defineProps<{
        href: string
        color?: TColorType
    }>(),
    {
        color: 'primary',
    }
)
</script>

<template>
    <Link
        :href="href"
        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150"
        :class="classVariants[color]"
    >
        <slot />
    </Link>
</template>
