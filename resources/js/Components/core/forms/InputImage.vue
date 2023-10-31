<script setup>
import { ref } from '@vue/reactivity';

const props = defineProps({
  modelValue: { type: [Object, String] },
  error: { type: String },
  accept: { type: String, default: 'image/*' },
  title: { type: String },
  name: { type: String, required: true }
});
const emits = defineEmits(['update:modelValue', 'clearError']);

const imagePreview = ref(props.modelValue);

const previewImage = (event) => {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();

    reader.onload = () => {
      imagePreview.value = reader.result;
    };

    reader.readAsDataURL(file);
  }
};
defineExpose({ imagePreview })

const removeImage = () => {
  emits['update:modelValue'] = null;
  emits('clearError', props.name);
  imagePreview.value = null;
  const file = document.querySelector('.file');
  var emptyFile = document.createElement('input');
  emptyFile.type = 'file';
  file.files = emptyFile.files;
}

</script>

<template>
  <div class="mb-5">
    <label v-if="title" :for="name" class="block mb-2 text-xl font-medium"
      :class="{ 'text-red-700 dark:text-red-500': error, 'text-gray-900 dark:text-white': !error }">
      {{ title }}
    </label>
    <figure class="relative max-w-xs mx-auto mb-2" v-if="imagePreview">
      <img class="rounded-lg" :src="imagePreview">
      <figcaption class="absolute right-0 px-4 text-lg text-white top-3">
        <button type="button"
          class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
          @click="removeImage">
          <font-awesome-icon icon="trash"></font-awesome-icon>
        </button>
      </figcaption>
    </figure>
    <input class="block w-full text-sm rounded-lg cursor-pointer file"
      :class="{ 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-red-100 dark:border-red-400': error, 'text-gray-900 border-gray-300 bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400': !error }"
      :name="name" :id="name" type="file" :accept="accept"
      @input="$emit('update:modelValue', $event.target.files[0]); $emit('clearError', name)" @change="previewImage">
    <p v-if="error" class="mt-2 text-sm text-red-600 dark:text-red-500">
      {{ error }}
    </p>
  </div>
</template>