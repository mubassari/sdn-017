<script setup>
import { InputImage, InputGeneral, InputSelect } from "~Components/core/forms";
import { usePage } from '@inertiajs/vue3'
import { ref } from '@vue/reactivity'

const jenis_kelamin_lists = ref([
  { id: 0, nama: 'Pilih Jenis Kelamin' },
  {
    id: 'laki_laki',
    nama: 'Laki-Laki'
  },
  {
    id: 'perempuan',
    nama: 'Perempuan'
  },
])

const status_lists = ref([
  { id: 0, nama: 'Pilih Status' },
  {
    id: 'pns',
    nama: 'PNS'
  },
  {
    id: 'pppk',
    nama: 'PPPK'
  },
  {
    id: 'honor',
    nama: 'Honorer'
  },
])

const inputImage = ref(null);
const page = usePage()
const jabatan_lists = ref([{ id: 0, nama: 'Pilih Jabatan' }, ...page.props.jabatan])

const props = defineProps({
  gtk: { type: Object, required: true },
})
const emits = defineEmits(['submit'])

const resetForm = () => {
  props.gtk.reset();
  inputImage.value.imagePreview = null;
}

const clearError = (name) => props.gtk.clearErrors(name)
</script>

<template>
  <form @submit.prevent="">
    <div class="mb-6">
      <div class="grid grid-cols-1 md:gap-5 md:grid-cols-2">
        <InputGeneral v-model="gtk.nama" :error="gtk.errors.nama" @clear-error="clearError" title="Nama Pegawai"
          name="nama" :required="true" />
        <InputGeneral v-model="gtk.nip" :error="gtk.errors.nip" @clear-error="clearError" title="NIP/NUPTK" name="nip"
          type="number" />
      </div>
      <InputImage v-model="gtk.foto" :error="gtk.errors.foto" @clear-error="clearError" title="Foto Profil" name="foto"
        ref="inputImage" accept="image/jpeg,image/png,image/jpg" />
      <div class="grid grid-cols-1 md:gap-5 md:grid-cols-3">
        <InputGeneral v-model="gtk.tempat_lahir" :error="gtk.errors.tempat_lahir" @clear-error="clearError"
          title="Tempat Lahir" name="tempat_lahir" />
        <InputGeneral v-model="gtk.tanggal_lahir" :error="gtk.errors.tanggal_lahir" @clear-error="clearError"
          title="Tanggal Lahir" name="tanggal_lahir" type="date" :required="true" />
        <InputSelect v-model="gtk.jenis_kelamin" :error="gtk.errors.jenis_kelamin" @clear-error="clearError"
          title="Jenis Kelamin" name="jenis_kelamin" :required="true" :lists="jenis_kelamin_lists" />
      </div>
      <div class="grid grid-cols-1 md:gap-5 md:grid-cols-2">
        <InputSelect v-model="gtk.gtk_jabatan_id" :error="gtk.errors.gtk_jabatan_id" @clear-error="clearError"
          title="Jabatan GTK" name="gtk_jabatan_id" :required="true" :lists="jabatan_lists" />
        <InputSelect v-model="gtk.status" :error="gtk.errors.status" @clear-error="clearError" title="Status Kepegawaian"
          name="status" :required="true" :lists="status_lists" />
      </div>
    </div>
    <div class="inline-flex rounded-md shadow-sm" role="group">
      <button :disabled="gtk.processing || !gtk.isDirty" :class="{ 'cursor-not-allowed': gtk.processing || !gtk.isDirty }"
        @click="resetForm"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-l-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="arrow-rotate-left" class="mr-1"></font-awesome-icon>
        Atur Ulang
      </button>
      <button :disabled="gtk.processing || !gtk.isDirty" :class="{ 'cursor-not-allowed': gtk.processing || !gtk.isDirty }"
        @click="$emit('submit')"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 border border-gray-600">
        <font-awesome-icon icon="floppy-disk" class="mr-1"></font-awesome-icon>
        Simpan
      </button>
    </div>
  </form>
</template>