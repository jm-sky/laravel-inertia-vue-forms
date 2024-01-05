<script setup lang="ts">
import ButtonLink from '@/Components/ButtonLink.vue';
import FaIcon from '@/Components/FaIcon.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { IForm } from '@/types/form/form.type'
import { Link, router } from '@inertiajs/vue3';

defineProps<{
  forms: IForm[]
}>()

function deleteForm(form: IForm) {
  if (!confirm('Are You sure?')) return

  router.visit(route('forms.delete', { form }), { method: 'delete' })
}
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="flex row justify-between items-center font-semibold text-xl text-gray-800 leading-tight">
        {{ $t('Forms') }}

        <ButtonLink :href="route('forms.create')" class="-my-2">
          <FaIcon icon="plus" mr /> Create
        </ButtonLink>
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">

          <table class="table-auto w-full">
            <thead>
              <th class="p-2 text-left w-32">Id</th>
              <th class="p-2 text-left">Name</th>
              <th class="p-2 text-left w-64">Actions</th>
            </thead>
            <tbody>
              <tr v-if="!forms.length">
                <td colspan="4" class="px-2 py-4 text-gray-500">
                  <FaIcon icon="info-circle" mr />
                  Pusto
                </td>
              </tr>

              <tr v-for="form in forms" :key="form.id">
                <td class="p-2">{{ form.id }}</td>
                <td class="p-2">
                  <Link :href="route('forms.show', { form })" class="font-semibold hover:text-blue-500">{{ form.name }}</Link>
                </td>
                <td class="p-2 flex gap-3 text-gray-500">
                  <Link :href="route('forms.edit', { form })"><FaIcon icon="edit" mr /></Link>
                  <button type="button" @click="deleteForm(form)" class="hover:text-red-600"><FaIcon icon="trash" mr /></button>
                </td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style lang="scss">
table {
  thead th {
    @apply border-b-2;
  }

  tbody tr {
    @apply border-b;

    &:nth-child(even) {
      @apply bg-gray-50;
    }

    &:hover {
      @apply bg-gray-100/80;
    }
  }
}
</style>
