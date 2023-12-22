<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FormEditor from '@/Pages/Forms/partials/FormEditor.vue';
import { IFormData, IFormFieldDefinition } from '@/types/form/form.type';
import { useForm } from '@inertiajs/vue3';

const form = useForm<IFormData>({
  name: 'My form',
  fields: [defaultField()],
})

function defaultField(): IFormFieldDefinition {
  return {
    label: 'First name',
    type: 'text',
    required: false,
  }
}
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $t('Forms') }} / Create new form</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

          <FormEditor v-model:form="form" @submit.prevent="form.post('/forms/new')" />

        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
