<script setup lang="ts">
defineProps<{
  value?: string;
  required?: boolean
}>();
</script>

<template>
    <label class="block font-medium text-sm text-gray-700">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
        <span v-if="required" class="ml-1 text-red-500">*</span>
    </label>
</template>
