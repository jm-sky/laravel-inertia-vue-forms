<script setup lang="ts">
import '@fortawesome/fontawesome-free/css/fontawesome.css'
import '@fortawesome/fontawesome-free/scss/solid.scss'
import '@fortawesome/fontawesome-free/css/regular.css'
import { computed } from 'vue';

const props = withDefaults(defineProps<{
    icon: string
    type?: 'solid' | 'regular'
    ml?: boolean
    mr?: boolean
    fw?: boolean
}>(), {
    type: 'solid'
})

const computedIcon = computed<string>(() => `fa-${props.icon}`)
const computedType = computed<string>(() => `fa-${props.type}`)
const computedFw = computed<string>(() => props.fw ? `fa-fw` : '')
</script>

<template>
    <i :class="[computedType, computedIcon, computedFw, ml ? 'ml-1' : '', mr ? 'mr-1' : '']"></i>
</template>

