<script setup>
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import FaIcon from '@/Components/FaIcon.vue';
</script>

<template>
  <Dropdown align="right" width="48">
    <template #trigger>
      <span class="inline-flex rounded-md">
        <button type="button"
          class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">

          <FaIcon icon="language" />
        </button>
      </span>
    </template>

    <template #content>
      <button
        v-for="language in $i18n.availableLocales"
        :key="language"
        type="button"
        class="flex justify-between items-center w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
        @click="$i18n.locale = language"
      >
        {{ language.toUpperCase() }}
        <FaIcon
          :icon="$i18n.locale == language ? 'square-check' : 'square'"
          type="regular"
          :class="{ 'text-blue-500' : $i18n.locale == language }"
          ml
          fw
        />
      </button>
    </template>
  </Dropdown>
</template>
