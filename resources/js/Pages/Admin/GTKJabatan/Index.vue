<script setup>
import { Pagination } from '~Components/core'
import { InputGeneral } from '~Components/core/forms'
import { AdminLayout } from '~Layouts';
import { router, useForm, usePage } from "@inertiajs/vue3";
import { ref, onUnmounted } from 'vue';
import toast from '~Stores/toast'

const page = usePage()

const removeFinishEventListener = router.on('finish', () => {
  if (page.props.errors.nama) {
    toast.add({
      status: 'danger',
      pesan: page.props.errors.nama
    })
  }
})

onUnmounted(() => removeFinishEventListener())

const title = ref('Daftar Jabatan GTK');
const editJabatan = ref(null);
const defaultJabatan = ref({
  id: 0,
  nama: ''
})

const props = defineProps({ list_jabatan: { type: Object, required: true } })

const formJabatan = useForm({ ...defaultJabatan.value })

const ubahJabatan = (index, id) => {
  clearError()
  editJabatan.value = id;
  formJabatan.id = props.list_jabatan.data[index].id;
  formJabatan.nama = props.list_jabatan.data[index].nama;
}
const deleteJabatan = (route) => {
  router.delete(route, {
    onBefore: () => confirm("Apakah Anda yakin ingin menghapus jabatan ini?"),
  });
}

const clearError = () => {
  formJabatan.clearErrors('nama')
}

const batalAksiJabatan = () => {
  editJabatan.value = null;
  formJabatan.id = defaultJabatan.value.id;
  formJabatan.nama = defaultJabatan.value.nama;
}

</script>

<template>
  <AdminLayout :title="title">
    <div class="mb-4 col-span-full xl:mb-2">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
        {{ title }}
      </h1>
    </div>
    <div class="mb-4 col-span-full xl:mb-2">
      <div class="relative px-5 space-y-3 overflow-x-auto">
        <div class="py-1">
          <form v-if="editJabatan == null" class="flex space-x-3"
            @submit.prevent="formJabatan.post(route('admin.gtk.jabatan.simpan')); batalAksiJabatan();">
            <InputGeneral v-model="formJabatan.nama" name="nama" required />
            <button type="submit" title="Tambah Jabatan GTK"
              class="inline-flex items-center justify-center w-1/2 px-3 py-2 mb-5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              :disabled="formJabatan.nama.length < 1 || formJabatan.processing || !formJabatan.isDirty"
              :class="{ 'cursor-not-allowed': formJabatan.processing || !formJabatan.isDirty }">
              <font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon>
              Tambah Jabatan
            </button>
          </form>
          <button v-else type="button" title="Tambah Jabatan GTK" @click="batalAksiJabatan"
            class="inline-flex items-center justify-center w-1/2 px-3 py-2 mb-5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon>
            Tambah Jabatan
          </button>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <template v-if="list_jabatan.data.length > 0">
          <div v-for="( jabatan, index ) in list_jabatan.data" :key="jabatan.id"
            class="bg-white border rounded dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
            <div class="flex items-center justify-between p-3 text-gray-900 dark:text-white">
              <div class="text-base font-semibold">
                <span v-if="editJabatan !== jabatan.id">{{ jabatan.nama }}</span>
                <form class="flex space-x-2" v-else
                  @submit.prevent="formJabatan.put(route('admin.gtk.jabatan.perbarui', jabatan.id)); batalAksiJabatan()">
                  <InputGeneral v-model="formJabatan.nama" name="nama" required />
                  <button type="submit" title="Ubah"
                    class="text-white mb-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 p-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    :disabled="formJabatan.nama.length < 1 || formJabatan.processing || !formJabatan.isDirty"
                    :class="{ 'cursor-not-allowed': formJabatan.processing || !formJabatan.isDirty }">
                    <font-awesome-icon icon="floppy-disk"></font-awesome-icon>
                    <span class="sr-only">Simpan</span>
                  </button>
                  <button @click="batalAksiJabatan" title="Ubah"
                    class="focus:outline-none mb-5 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 p-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    <font-awesome-icon icon="times"></font-awesome-icon>
                    <span class="sr-only">Batal Ubah</span>
                  </button>
                </form>
              </div>
              <div v-if="editJabatan !== jabatan.id" class="space-x-2">
                <button @click="ubahJabatan(index, jabatan.id)" title="Ubah"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 p-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  <font-awesome-icon icon="pen-to-square"></font-awesome-icon>
                  <span class="sr-only">Ubah</span>
                </button>
                <button @click.prevent="deleteJabatan(route('admin.gtk.jabatan.hapus', jabatan.id))" title="Hapus"
                  class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 p-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                  <font-awesome-icon icon="trash"></font-awesome-icon>
                  <span class="sr-only">Hapus</span>
                </button>
              </div>
            </div>
          </div>
        </template>
        <template v-else>
          <div
            class="p-3 text-center text-gray-900 bg-white border rounded dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 dark:text-white">
            <span>Tidak Ada Data</span>
          </div>
        </template>
      </div>
      <Pagination :links="list_jabatan.links" :dari="list_jabatan.from" :ke="list_jabatan.to"
        :total="list_jabatan.total" />
    </div>
  </AdminLayout>
</template>