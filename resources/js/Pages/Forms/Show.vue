<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { IFormData, IFormFieldDefinition } from '@/types/form/form.type';
import { useForm } from '@inertiajs/vue3';
import { refAutoReset } from '@vueuse/core'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { computed } from 'vue';
import { onMounted } from 'vue';

const props = defineProps<{
  form: IFormData
}>()

function getDefaults() {
  const data: any = {}

  formFields.value.forEach((field) => {
    if (field.type === 'boolean') {
      data[field.label] = false
    } else {
      data[field.label] = ''
    }
  })

  return data
}

const message = refAutoReset('', 3000)
const formData = useForm<any>({})
const formFields = computed(() => props.form.fields.map((field) => ({
  ...field,
  id: field.label.replaceAll(/[^a-z0-9]/gi, '-').toLowerCase(),
})))

async function save() {
  await formData.post(route('forms.fill', { form: formData }))
  message.value = 'Saved'
}
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ form.name }}</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form @submit.prevent="save" class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">

          <div v-for="(field, index) in formFields" :key="index" class="mb-3">
            <InputLabel :for="field.id" :value="field.label" :required="field.required" />

            <TextInput
              v-if="field.type === 'text'"
              :id="field.id"
              :name="field.label"
              type="text"
              class="mt-1 block w-full"
              v-model="formData[field.label]"
              :required="field.required"
            />

            <TextInput
              v-else-if="field.type === 'date'"
              :id="field.id"
              :name="field.label"
              type="date"
              class="mt-1 block w-full"
              v-model="formData[field.label]"
              :required="field.required"
            />

            <TextInput
              v-else-if="field.type === 'number'"
              :id="field.id"
              :name="field.label"
              type="number"
              class="mt-1 block w-full"
              v-model="formData[field.label]"
              :required="field.required"
            />

            <Checkbox
              v-else-if="field.type === 'boolean'"
              :id="field.id"
              :name="field.label"
              v-model:checked="formData[field.label]"
            />

            <InputError class="mt-2" :message="formData.errors.name" />
          </div>

          <div class="text-center my-4">
            <PrimaryButton type="submit" :disabled="formData.processing">{{ $t('Save') }}</PrimaryButton>
          </div>

        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
