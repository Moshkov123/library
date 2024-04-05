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
        <div >
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
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      Удалить</th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      Редактировать</th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      Редактировать колекцию</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for=" book in  books" :key="book.id">
                    <td >{{ book.id }}</td>
                    <td  v-for="author in authors"
                      :key="author.id">
                      <p v-if="author.id === book.author_id">{{ author.author }}</p>
                    </td>
                    <td >{{ book.title }}</td>
                    <td >{{ book.age }}</td>
                    <td >{{ book.annotation }}</td>
                    <td >{{ book.quantity }}</td>
                    <td > <button type="button"
                        class="btn btn-danger" @click="deleteBook(book.id)"> Удалить</button>
                    </td>
                    <td >
                      <button type="button" class="btn btn-primary" @click="editBook(book.id)">Редактировать</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary" @click="editcollection(book.id)">Редактировать
                        колекцию</button>
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
    editcollection(id) {
      Inertia.visit(`/collection/${id}`);
    },
    deleteBook(id) {
      Inertia.delete(`/editor/${id}`);
      Inertia.get(`/editor`);
    },
  }
});
</script>
