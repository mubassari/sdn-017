<script setup>
import { ref, watch, onBeforeMount, onBeforeUnmount } from 'vue';
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from "@tiptap/starter-kit";
import Underline from "@tiptap/extension-underline";
import Link from "@tiptap/extension-link";
import TextAlign from "@tiptap/extension-text-align";
import Table from "@tiptap/extension-table";
import TableRow from "@tiptap/extension-table-row";
import TableCell from "@tiptap/extension-table-cell";
import TableHeader from "@tiptap/extension-table-header";

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

onBeforeMount(() => {
  formEditor.value = new Editor({
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
          class: "w-full text-sm text-left font-medium text-gray-900 whitespace-nowrap dark:text-white border dark:border-gray-500 border-separate"
        },
      }),
      TableRow,
      TableHeader,
      TableCell,
    ],
    editorProps: {
      attributes: {
        class: 'format lg:format-lg dark:format-invert block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
      },
    },
    content: props.modelValue,
    onUpdate: () => emits('update:modelValue', formEditor.value.getHTML()),
  })
})

onBeforeUnmount(() => formEditor.value.destroy())

const setLink = (isLink) => {
  if (!isLink) {
    const href = window.prompt('Masukkan Tautan');
    formEditor.value.chain().focus().setLink({ href }).run()
  } else {
    formEditor.value.chain().focus().unsetLink().run()
  }
}
</script>

<template>
  <div class="mb-5">
    <div class="mb-3 whitespace-nowrap overflow-x-auto">
      <div class="relative inline-flex align-middle flex-col items-start justify-center">
        <div class="relative inline-flex align-middle rounded-md py-1 px-2 leading-tight text-xs ">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2 rounded-l-lg"
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
            class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2 rounded-r-lg"
            title="Garis Bawah" @click="formEditor.chain().focus().toggleUnderline().run()"
            :class="formEditor.isActive('underline') ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="underline"></font-awesome-icon>
          </button>
        </div>
        <div class="relative inline-flex align-middle rounded-md py-1 px-2 leading-tight text-xs ">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2 rounded-l-lg"
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
            class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2 rounded-r-lg"
            title="Rata Kiri-Kanan" @click="formEditor.chain().focus().setTextAlign('justify').run()"
            :class="formEditor.isActive({ textAlign: 'justify' }) ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="align-justify"></font-awesome-icon>
          </button>
        </div>
      </div>
      <div class="relative inline-flex align-middle flex-col items-start justify-center">
        <div class="relative inline-flex align-middle rounded-md py-1 px-2 leading-tight text-xs ">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2 rounded-l-lg"
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
            class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2 rounded-r-lg"
            title="Heading 3" @click="formEditor.chain().focus().toggleHeading({ level: 3 }).run()"
            :class="formEditor.isActive('heading', { level: 3 }) ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="heading"></font-awesome-icon><font-awesome-icon icon="3"></font-awesome-icon>
          </button>
        </div>
        <div class="relative inline-flex align-middle rounded-md py-1 px-2 leading-tight text-xs ">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2 rounded-l-lg"
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
            class="iinline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2 rounded-r-lg"
            title="List Angka" @click="formEditor.chain().focus().toggleOrderedList().run()"
            :class="formEditor.isActive('orderedList') ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="list-ol"></font-awesome-icon>
          </button>
        </div>
      </div>
      <div class="relative inline-flex align-middle flex-col items-start justify-center">
        <div class="relative inline-flex align-middle rounded-md py-1 px-2 leading-tight text-xs ">
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
        <div class="relative inline-flex align-middle rounded-md py-1 px-2 leading-tight text-xs">
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
            <font-awesome-icon icon="columns" rotation="90"></font-awesome-icon>&nbsp;<font-awesome-icon
              icon="caret-up"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Tambah Baris di Bawah" @click="formEditor.chain().focus().addRowAfter().run()">
            <font-awesome-icon icon="columns" rotation="90"></font-awesome-icon>&nbsp;<font-awesome-icon
              icon="caret-down"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Hapus baris" @click="formEditor.chain().focus().deleteRow().run()">
            <font-awesome-icon icon="columns" rotation="90"></font-awesome-icon>&nbsp;<font-awesome-icon
              icon="times"></font-awesome-icon>
          </button>
        </div>
      </div>
      <div class="relative inline-flex align-middle flex-col items-start justify-center">
        <div class="relative inline-flex align-middle rounded-md py-1 px-2 leading-tight text-xs">
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium border focus:z-10 focus:ring-2 rounded-l-lg"
            title="Tautan" @click="setLink(formEditor.isActive('link'))"
            :class="formEditor.isActive('link') ? buttonIsActive : buttonIsUnactive">
            <font-awesome-icon icon="link"></font-awesome-icon>
          </button>
          <button
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
            title="Bersihkan" @click="
              formEditor.chain().focus().unsetAllMarks().run();
            formEditor.chain().focus().clearNodes().run();
            ">
            <font-awesome-icon icon="broom"></font-awesome-icon>
          </button>
        </div>
        <div class="relative inline-flex align-middle rounded-md py-1 px-2 leading-tight text-xs">
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
html.dark .ProseMirror table tbody tr th {
  border-color: #6B7280;
  color: #9CA3AF;
  background-color: #1F2937;
}

html.dark .ProseMirror table tbody tr td {
  border-color: #6B7280;
  color: #ffffff;
}


.ProseMirror {
  max-width: 100%;

  > {

    table {
      border-spacing: 0;

      >tbody>tr> {

        th {
          padding: 0.75rem 1.5rem;
          text-transform: uppercase;
          color: #374151;
          background-color: #F9FAFB;
        }

        td {
          padding: 1rem 1.5rem;
          font-weight: 500;
        }

        th,
        td {
          width: auto;
          position: relative;
          vertical-align: top;
          box-sizing: border-box;
          border-width: 1px;
        }

        td>p,
        th>p {
          margin: 0;
          text-indent: 0;
        }
      }


      .selectedCell:after {
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 2;
        content: "";
        position: absolute;
        pointer-events: none;
        background: rgba(200, 200, 255, 0.4);
      }

      .column-resize-handle {
        top: 0;
        width: 4px;
        right: -2px;
        bottom: -2px;
        position: absolute;
        pointer-events: none;
        background-color: #adf;
      }
    }
  }
}
</style>