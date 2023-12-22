<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import FaIcon from '@/Components/FaIcon.vue';
</script>

<template>
  <Dropdown align="right" width="48">
    <template #trigger="{ open }">
      <span class="inline-flex rounded-md">
        <button type="button"
          class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
          {{ $page.props.auth.user.name }}

          <FaIcon icon="angle-down" class="transition-transform" :class="open ? 'rotate-180' : ''" ml fw />
        </button>
      </span>
    </template>

    <template #content>
      <DropdownLink :href="route('profile.edit')">{{ $t('Profile') }}</DropdownLink>
      <DropdownLink :href="route('logout')" method="post" as="button">
        {{ $t('Log Out') }}
      </DropdownLink>
    </template>
  </Dropdown>
</template>
