<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>
  <Head title="Editor" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Table</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div>
            <h2>Book Table</h2>
            <div class="overflow-x-auto">
              <table class="min-w-full">
                <thead>
                  <tr>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      ID</th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      author</th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      Название</th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      age</th>
                      <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      annotation</th>
                      <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      quantity</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for=" book in  books" :key=" book.id" >
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{  book.id }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200" v-for="author in authors" :key="author.id"> 
                        <span v-if="author.id === book.author_id">{{ author.author }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ book.title }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ book.age }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ book.annotation }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ book.quantity }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> <button type="button"
                        class="btn btn-danger" @click="deleteBook(book.id)"> Удалить</button>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
  <button type="button" class="btn btn-primary" @click="editBook(book.id)">Редактировать</button>
</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
<script>
import { defineComponent } from 'vue';
import { Inertia } from '@inertiajs/inertia';
export default defineComponent({
  props: {
    books: Array,
    qrcodes: Array,
    authors: Array
  },
  methods: {
    editBook(id) {
      Inertia.visit(`/editor/edit/${id}`);
    },
    deleteBook(id) {
      Inertia.delete(`/editor/${id}`);
      Inertia.get(`/editor`);
    },
  }
});
</script>
