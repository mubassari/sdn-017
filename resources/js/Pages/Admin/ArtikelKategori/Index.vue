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
    toast.add({ pesan: page.props.errors.nama })
  }
})

onUnmounted(() => removeFinishEventListener())

const title = ref('Daftar Kategori');
const editKategori = ref(null);
const defaultKategori = ref({
  id: 0,
  nama: null
})

const props = defineProps({ list_kategori: { type: Object, required: true } })

const formKategori = useForm({ ...defaultKategori.value })

const ubahKategori = (index) => {
  clearError()
  editKategori.value = index;
  formKategori.id = props.list_kategori.data[index].id;
  formKategori.nama = props.list_kategori.data[index].nama;
}
const deleteKategori = (route) => {
  router.delete(route, {
    onBefore: () => confirm("Apakah Anda yakin ingin menghapus kategori ini?"),
  });
}

const clearError = () => {
  formKategori.clearErrors('nama')
}

const batalAksiKategori = () => {
  editKategori.value = null;
  formKategori.id = defaultKategori.value.id;
  formKategori.nama = defaultKategori.value.nama;
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
          <form v-if="editKategori == null" class="flex space-x-3"
            @submit.prevent="formKategori.post(route('admin.artikel.kategori.simpan')); batalAksiKategori();">
            <InputGeneral v-model="formKategori.nama" name="nama" :required="true" />
            <button type="submit" title="Tambah"
              class="inline-flex items-center justify-center w-1/2 px-3 py-2 mb-5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              :disabled="formKategori.processing || !formKategori.isDirty"
              :class="{ 'cursor-not-allowed': formKategori.processing || !formKategori.isDirty }">
              <font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon>
              Tambah Kategori
            </button>
          </form>
          <button v-else type="button" title="Tambah" @click="batalAksiKategori"
            class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon>
            Tambah Kategori
          </button>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div v-for="( kategori, index ) in list_kategori.data" :key="kategori.id"
          class="bg-white border rounded dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
          <div class="flex items-center justify-between p-3 text-gray-900 dark:text-white">
            <div class="text-base font-semibold">
              <span v-if="editKategori !== kategori.id">{{ kategori.nama }}</span>
              <form class="flex space-x-2" v-else
                @submit.prevent="formKategori.post(route('admin.artikel.kategori.perbarui', kategori.id)); batalAksiKategori()">
                <InputGeneral v-model="formKategori.nama" name="nama" :required="true" />
                <button type="submit" title="Ubah"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 p-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  :disabled="formKategori.nama.length < 1 || formKategori.processing || !formKategori.isDirty"
                  :class="{ 'cursor-not-allowed': formKategori.processing || !formKategori.isDirty }">
                  <font-awesome-icon icon="floppy-disk"></font-awesome-icon>
                  <span class="sr-only">Simpan</span>
                </button>
                <button @click="batalAksiKategori" title="Ubah"
                  class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 p-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                  <font-awesome-icon icon="times"></font-awesome-icon>
                  <span class="sr-only">Batal Ubah</span>
                </button>
              </form>
            </div>
            <div v-if="editKategori !== kategori.id && kategori.forbid" class="space-x-2">
              <button @click="ubahKategori(index)" title="Ubah"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 p-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <font-awesome-icon icon="pen-to-square"></font-awesome-icon>
                <span class="sr-only">Ubah</span>
              </button>
              <button @click.prevent="deleteKategori(route('admin.artikel.kategori.hapus', kategori.id))" title="Hapus"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 p-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                <font-awesome-icon icon="trash"></font-awesome-icon>
                <span class="sr-only">Hapus</span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <Pagination :links="list_kategori.links" :dari="list_kategori.from" :ke="list_kategori.to"
        :total="list_kategori.total" />
    </div>
  </AdminLayout>
</template>