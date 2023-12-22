<script setup lang="ts">
import { IFormData, IFormFieldDefinition } from '@/types/form/form.type';
import DangerButton from '@/Components/DangerButton.vue';
import FaIcon from '@/Components/FaIcon.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { InertiaForm } from '@inertiajs/vue3';

const form = defineModel<InertiaForm<IFormData>>('form', { required: true })
const message = defineModel<string>('message')

function defaultField(): IFormFieldDefinition {
  return {
    label: 'First name',
    type: 'text',
    required: false,
  }
}

function addField() {
  form.value.fields.push(defaultField())
}

function removeField(field: IFormFieldDefinition) {
  form.value.fields = form.value.fields.filter((fieldDef: IFormFieldDefinition) => fieldDef !== field)
}
</script>

<template>
  <form class="p-4">
    <div class="mb-5">
      <InputLabel for="form.name" value="Form name" required />
      <TextInput v-model="form.name" id="form.name" class="w-full" />
      <InputError :message="form.errors.name" />
    </div>

    <div class="mb-4">
      <div class="flex row justify-between items-center font-bold mb-2">
        {{ $t('Fields') }}
        <PrimaryButton type="button" @click="addField()"><FaIcon icon="plus" /></PrimaryButton>
      </div>

      <table class="table-auto w-full">
        <tr v-for="(field, index) in form.fields" :key="index" class="border-b last:border-b-0">
          <td class="py-3 px-5 font-bold text-lg pt-6"># {{ index + 1 }}</td>
          <td class="py-3 px-5">
            <InputLabel :for="`form.field.${index}.label`" value="Field label" />
            <TextInput v-model="field.label" :for="`form.field.${index}.label`" class="w-full" />
          </td>
          <td>
            <InputLabel :for="`form.field.${index}.type`" value="Field type" />
            <select v-model="field.type" :id="`form.field.${index}.type`" class="rounded border border-gray-300 shadow-sm">
              <option value="text">Text</option>
              <option value="boolean">Boolean</option>
            </select>
          </td>
          <td>
            <InputLabel :for="`form.field.${index}.required`" value="Is required" />
            <input type="checkbox" v-model="field.required" :id="`form.field.${index}.required`" class="rounded border border-gray-300 shadow-sm">
          </td>
          <td class="py-3 px-5">
            <DangerButton v-if="index > 0" type="button" @click="removeField(field)"><FaIcon icon="trash" /></DangerButton>
          </td>
        </tr>
      </table>
    </div>

    <div class="w-full border-t my-4"></div>

    <div class="text-center my-4">
      <PrimaryButton type="submit" :disabled="form.processing">{{ $t('Save') }}</PrimaryButton>
    </div>

    <InputError :message="form.errors.fields" />
    <div v-if="message" class="my-4 text-green-500 text-center">{{ message }}</div>
  </form>
</template>
