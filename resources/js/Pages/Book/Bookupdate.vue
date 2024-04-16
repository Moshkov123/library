<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>
<template>
  <Head title="Book Update" />
  <AuthenticatedLayout>
    <table class="min-w-full">
  <thead>
    <tr>
      <th class="p-4">ID</th>  
      <th class="p-4">Author</th>
      <th class="p-4">Title</th>
      <th class="p-4">Age</th>  
      <th class="p-4 ">Annotation</th>
      <th class="p-4">Quantity</th>
      <th class="p-4">button</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="p-4">
        <input v-model="book.id" type="text"> 
      </td>
  <td class="p-4">
    <input v-model="book.author_id" type="text">
  </td>

  <td class="p-4">  
    <input v-model="book.title" type="text">
  </td>

  <td class="p-4">
    <input v-model="book.age" type="text">
  </td>

  <td class="p-5">
    <textarea v-model="book.annotation" type="text"/> 
  </td>

  <td class="p-4">
    <input v-model="book.quantity" type="text">
  </td>
  <td class="p-4 whitespace-no-wrap border-b border-gray-200">
                                            <button type="button" class="btn btn-primary"
                                                @click="updatebook(book.id)">Обновить</button>
                                        </td>
</tr>

  </tbody>
</table>
  </AuthenticatedLayout>
</template>
<script>
import { defineComponent } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default defineComponent({
  props: {
    book: Object,
    qrcode: Array,
    author: Object
  },
  methods: {
    updatebook(bookId) {
      Inertia.put(`/editor/update/${bookId}.`, this.book);
    },
  },
});
</script>
