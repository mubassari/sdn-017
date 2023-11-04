<script setup>
import { ref, watch, onBeforeMount, onBeforeUnmount } from 'vue';
import { ModalInputLink, ModalInputImage } from '~Components/core/modal'

const isTiptapLoaded = ref(false);
let Editor;
let EditorContent;
let StarterKit;
let Underline;
let Link;
let TextAlign;
let Table;
let TableRow;
let TableCell;
let TableHeader;
let Image;

const props = defineProps({
  modelValue: { type: String, default: '' },
  error: { type: String }
});
const emits = defineEmits(['update:modelValue', 'clearError']);

const formEditor = ref(null);
const buttonIsActive = ref('bg-gray-700 border-gray-600 text-white hover:text-white hover:bg-gray-600 focus:ring-blue-500 focus:text-white dark:text-gray-900 dark:bg-white border dark:border-gray-200 dark:hover:bg-gray-100 dark:hover:text-blue-700 dark:focus:ring-blue-700 dark:focus:text-blue-700');
const buttonIsUnactive = ref('text-gray-900 bg-white border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white');

watch(() => props.modelValue, (value) => {
  const isSame = formEditor.value.getHTML() === value
  if (isSame) return
  formEditor.value.commands.setContent(value, false)
})

const loadTiptap = async () => {
  try {
    const [
      tiptapModule,
      StarterKitModule,
      UnderlineModule,
      LinkModule,
      TextAlignModule,
      TableModule,
      TableRowModule,
      TableCellModule,
      TableHeaderModule,
      ImageModule,
    ] = await Promise.all([
      import('@tiptap/vue-3'),
      import('@tiptap/starter-kit'),
      import('@tiptap/extension-underline'),
      import('@tiptap/extension-link'),
      import('@tiptap/extension-text-align'),
      import('@tiptap/extension-table'),
      import('@tiptap/extension-table-row'),
      import('@tiptap/extension-table-cell'),
      import('@tiptap/extension-table-header'),
      import('@tiptap/extension-image'),
    ]);

    Editor = tiptapModule.Editor;
    EditorContent = tiptapModule.EditorContent;
    StarterKit = StarterKitModule.default;
    Underline = UnderlineModule.default;
    Link = LinkModule.default;
    TextAlign = TextAlignModule.default;
    Table = TableModule.default;
    TableRow = TableRowModule.default;
    TableCell = TableCellModule.default;
    TableHeader = TableHeaderModule.default;
    Image = ImageModule.default;

    formEditor.value = new Editor({
      parseOptions: {
        preserveWhitespace: 'full'
      },
      extensions: [
        StarterKit.configure({
          blockquote: false,
          codeBlock: false,
          heading: { levels: [1, 2, 3] },
          listItem: true,
          paragraph: true,
        }),
        Underline,
        Link.configure({
          openOnClick: false,
        }),
        TextAlign.configure({ types: ["heading", "paragraph", 'list'] }),
        Table.configure({
          resizable: false,
          HTMLAttributes: {
            class: "w-full text-sm font-medium text-left text-gray-900 border border-separate whitespace-nowrap dark:text-white dark:border-gray-500"
          },
        }),
        TableRow,
        TableHeader,
        TableCell,
        Image.configure({
          inline: true,
          allowBase64: true,
        }),
      ],
      editorProps: {
        attributes: {
          class: 'format lg:format-lg dark:format-invert block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        },
      },
      content: props.modelValue,
      onUpdate: () => emits('update:modelValue', formEditor.value.getHTML()),
    })

    isTiptapLoaded.value = true;
    // Now you can use Carousel, Slide, and Navigation in your component
  } catch (error) {
    console.error("An error occurred while dynamically importing 'tiptap-vue-3':", error);
  }
}

onBeforeMount(() => loadTiptap())

onBeforeUnmount(() => formEditor.value.destroy())

const modalState = ref({
  ModalInputLink: false,
  ModalInputImage: false
})

const setLink = (value) => {
  formEditor.value.chain().focus().setLink({ value }).run();
  modalState.value.ModalInputLink = false
};

const setImage = (src) => {
  formEditor.value.chain().focus().setImage({ src }).run()
  modalState.value.ModalInputImage = false
}
</script>

<template>
  <div class="mb-5">
    <ModalInputLink v-if="modalState.ModalInputLink" @input="setLink" @close="modalState.ModalInputLink = false" />
    <ModalInputImage v-if="modalState.ModalInputImage" @input="setImage" @close="modalState.ModalInputImage = false" />
    <div class="sticky z-10 mb-3 overflow-x-auto bg-white rounded-lg shadow top-20 dark:bg-gray-800 whitespace-nowrap">
      <div class="relative inline-flex flex-col items-start justify-center align-middle">
        <div class="relative inline-flex px-2 py-1 text-xs leading-tight align-middle rounded-md ">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium border rounded-l-lg focus:z-10 focus:ring-2"
            title="Tebal" @click="formEditor.chain().focus().toggleBold().run()"
            :class="formEditor.isActive('bold') ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="bold"></font-awesome-icon>
          </button>
          <button class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2"
            title="Miring" @click="formEditor.chain().focus().toggleItalic().run()"
            :class="formEditor.isActive('italic') ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="italic"></font-awesome-icon>
          </button>
          <button class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2"
            title="Coret" @click="formEditor.chain().focus().toggleStrike().run()"
            :class="formEditor.isActive('strike') ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="strikethrough"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium border rounded-r-lg focus:z-10 focus:ring-2"
            title="Garis Bawah" @click="formEditor.chain().focus().toggleUnderline().run()"
            :class="formEditor.isActive('underline') ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="underline"></font-awesome-icon>
          </button>
        </div>
        <div class="relative inline-flex px-2 py-1 text-xs leading-tight align-middle rounded-md ">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium border rounded-l-lg focus:z-10 focus:ring-2"
            title="Rata Kiri" @click="formEditor.chain().focus().setTextAlign('left').run()"
            :class="formEditor.isActive({ textAlign: 'left' }) ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="align-left"></font-awesome-icon>
          </button>
          <button class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2"
            title="Rata Tengah" @click="formEditor.chain().focus().setTextAlign('center').run()"
            :class="formEditor.isActive({ textAlign: 'center' }) ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="align-center"></font-awesome-icon>
          </button>
          <button class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2 "
            title="Rata Kanan" @click="formEditor.chain().focus().setTextAlign('right').run()"
            :class="formEditor.isActive({ textAlign: 'right' }) ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="align-right"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium border rounded-r-lg focus:z-10 focus:ring-2"
            title="Rata Kiri-Kanan" @click="formEditor.chain().focus().setTextAlign('justify').run()"
            :class="formEditor.isActive({ textAlign: 'justify' }) ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="align-justify"></font-awesome-icon>
          </button>
        </div>
      </div>
      <div class="relative inline-flex flex-col items-start justify-center align-middle">
        <div class="relative inline-flex px-2 py-1 text-xs leading-tight align-middle rounded-md ">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium border rounded-l-lg focus:z-10 focus:ring-2"
            title="Heading 1" @click="formEditor.chain().focus().toggleHeading({ level: 1 }).run()"
            :class="formEditor.isActive('heading', { level: 1 }) ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="heading"></font-awesome-icon><font-awesome-icon icon="1"></font-awesome-icon>
          </button>
          <button class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2"
            title="Heading 2" @click="formEditor.chain().focus().toggleHeading({ level: 2 }).run()"
            :class="formEditor.isActive('heading', { level: 2 }) ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="heading"></font-awesome-icon><font-awesome-icon icon="2"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium border rounded-r-lg focus:z-10 focus:ring-2"
            title="Heading 3" @click="formEditor.chain().focus().toggleHeading({ level: 3 }).run()"
            :class="formEditor.isActive('heading', { level: 3 }) ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="heading"></font-awesome-icon><font-awesome-icon icon="3"></font-awesome-icon>
          </button>
        </div>
        <div class="relative inline-flex px-2 py-1 text-xs leading-tight align-middle rounded-md ">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium border rounded-l-lg focus:z-10 focus:ring-2"
            title="Paragraf" @click="formEditor.chain().focus().setParagraph().run()"
            :class="formEditor.isActive('paragraph') ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="paragraph"></font-awesome-icon>
          </button>
          <button class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2"
            title="List Simbol" @click="formEditor.chain().focus().toggleBulletList().run()"
            :class="formEditor.isActive('bulletList') ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="list-ul"></font-awesome-icon>
          </button>
          <button
            class="items-center px-4 py-2 text-sm font-medium border rounded-r-lg iinline-flex focus:z-10 focus:ring-2"
            title="List Angka" @click="formEditor.chain().focus().toggleOrderedList().run()"
            :class="formEditor.isActive('orderedList') ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="list-ol"></font-awesome-icon>
          </button>
        </div>
      </div>
      <div class="relative inline-flex flex-col items-start justify-center align-middle">
        <div class="relative inline-flex px-2 py-1 text-xs leading-tight align-middle rounded-md ">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Tambah Tabel"
            @click="formEditor.chain().focus().insertTable({ rows: 3, cols: 3, withHeaderRow: true }).run()">
            <font-awesome-icon icon="table"></font-awesome-icon>&nbsp;<font-awesome-icon icon="plus"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Buat Kepala Tabel" @click="formEditor.chain().focus().toggleHeaderCell().run()">
            <font-awesome-icon icon="table"></font-awesome-icon>&nbsp;<font-awesome-icon
              icon="heading"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Gabung atau Pisah" @click="formEditor.chain().focus().mergeOrSplit().run()">
            <font-awesome-icon icon="table"></font-awesome-icon>&nbsp;<font-awesome-icon
              icon="compress"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Hapus Tabel" @click="formEditor.chain().focus().deleteTable().run()">
            <font-awesome-icon icon="table"></font-awesome-icon>&nbsp;<font-awesome-icon icon="times"></font-awesome-icon>
          </button>
        </div>
        <div class="relative inline-flex px-2 py-1 text-xs leading-tight align-middle rounded-md">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Tambah Kolom di Kiri" @click="formEditor.chain().focus().addColumnBefore().run()">
            <font-awesome-icon icon="caret-left"></font-awesome-icon>&nbsp;<font-awesome-icon
              icon="columns"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Tambah Kolom di Kanan" @click="formEditor.chain().focus().addColumnAfter().run()">
            <font-awesome-icon icon="columns"></font-awesome-icon>&nbsp;<font-awesome-icon
              icon="caret-right"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Hapus Kolom" @click="formEditor.chain().focus().deleteColumn().run()">
            <font-awesome-icon icon="columns"></font-awesome-icon>&nbsp;<font-awesome-icon
              icon="times"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Tambah Baris di Atas" @click="formEditor.chain().focus().addRowBefore().run()">
            <font-awesome-icon icon="columns" rotation="270"></font-awesome-icon>&nbsp;<font-awesome-icon
              icon="caret-up"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Tambah Baris di Bawah" @click="formEditor.chain().focus().addRowAfter().run()">
            <font-awesome-icon icon="columns" rotation="270"></font-awesome-icon>&nbsp;<font-awesome-icon
              icon="caret-down"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Hapus baris" @click="formEditor.chain().focus().deleteRow().run()">
            <font-awesome-icon icon="columns" rotation="270"></font-awesome-icon>&nbsp;<font-awesome-icon
              icon="times"></font-awesome-icon>
          </button>
        </div>
      </div>
      <div class="relative inline-flex flex-col items-start justify-center align-middle">
        <div class="relative inline-flex px-2 py-1 text-xs leading-tight align-middle rounded-md">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Gambar" @click="modalState.ModalInputImage = true">
            <font-awesome-icon icon="image"></font-awesome-icon>
          </button>
        </div>
        <div class="relative inline-flex px-2 py-1 text-xs leading-tight align-middle rounded-md">
          <button class="inline-flex items-center px-4 py-2 text-sm font-medium border rounded-lg focus:z-10 focus:ring-2"
            title="Tautan"
            @click="formEditor.isActive('link') ? formEditor.chain().focus().unsetLink().run() : modalState.ModalInputLink = true"
            :class="formEditor.isActive('link') ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="link"></font-awesome-icon>
          </button>
        </div>
      </div>
      <div class="relative inline-flex flex-col items-start justify-center align-middle">
        <div class="relative inline-flex px-2 py-1 text-xs leading-tight align-middle rounded-md">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Bersihkan" @click="
              formEditor.chain().focus().unsetAllMarks().run();
            formEditor.chain().focus().clearNodes().run();
                          ">
            <font-awesome-icon icon="broom"></font-awesome-icon>
          </button>
        </div>
        <div class="relative inline-flex px-2 py-1 text-xs leading-tight align-middle rounded-md">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Kembali" @click="formEditor.chain().focus().undo().run()">
            <font-awesome-icon icon="undo-alt"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Ulangi" @click="formEditor.chain().focus().redo().run()">
            <font-awesome-icon icon="redo-alt"></font-awesome-icon>
          </button>
        </div>
      </div>
    </div>
    <editor-content :editor="formEditor" />
    <p v-if="error" class="mt-2 text-sm text-red-600 dark:text-red-500">
      {{ error }}
    </p>
  </div>
</template>

<style lang="scss">
/*
  Based on TailwindCSS recommendations,
  consider using classes instead of the `@apply` directive
  @see https://tailwindcss.com/docs/reusing-styles#avoiding-premature-abstraction
*/

.ProseMirror {
  @apply max-w-full;
}

.ProseMirror * {
  @apply whitespace-pre-wrap
}

.ProseMirror *>a {
  @apply text-blue-500 dark:text-blue-600;
}

.ProseMirror *>img.ProseMirror-selectednode {
  outline: 2px solid #3B82F6;
  outline-offset: 2px;
}

.ProseMirror>table {
  @apply border-spacing-0;
}

.ProseMirror>table>tbody>tr>th {
  @apply uppercase text-gray-900 dark:text-white bg-gray-200 dark:bg-gray-800 px-6 py-3;
}

.ProseMirror>table>tbody>tr>td {
  @apply font-medium px-6 py-4;
}

.ProseMirror>table>tbody>tr>th,
.ProseMirror>table>tbody>tr>td {
  @apply w-auto relative align-top box-border border border-gray-500;
}

.ProseMirror>table>tbody>tr>td>p,
.ProseMirror>table>tbody>tr>th>p {
  @apply indent-0 m-0;
}

.ProseMirror>table .selectedCell>p {
  @apply text-gray-900 dark:text-white;
}

.ProseMirror>table .selectedCell:after {
  @apply z-10 content-[""] absolute pointer-events-none inset-0 bg-blue-400/[0.4] dark:bg-gray-400/[0.4];
}

.ProseMirror>table .column-resize-handle {
  @apply w-1 absolute pointer-events-none bg-blue-300 -right-0.5 top-0 -bottom-0.5;
}
</style>