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
                    <th>
                      ID</th>
                    <th>
                      author</th>
                    <th>
                      Название</th>
                    <th>
                      age</th>
                    <th>
                      annotation</th>
                    <th>
                      quantity</th>
                    <th>
                      Удалить</th>
                    <th>
                      Редактировать</th>
                    <th>
                      Редактировать колекцию</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for=" book in  books" :key="book.id">
                    <td class="p-4">{{ book.id }}</td>
                    <td  class="p-4">
                      {{  book.author_id }}
                    </td>
                    <td  class="p-4">{{ book.title }}</td>
                    <td  class="p-4">{{ book.age }}</td>
                    <td  class="p-4">{{ book.annotation }}</td>
                    <td  class="p-4">{{ book.quantity }}</td>
                    <td  class="p-4"> <button type="button"
                        class="btn btn-danger" @click="deleteBook(book.id)"> Удалить</button>
                    </td>
                    <td class="p-4">
                      <button type="button" class="btn btn-primary" @click="editBook(book.id)">Редактировать</button>
                    </td>
                    <td class="p-4">
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
  mounted() {
    this.$nextTick(function () {
      this.books.forEach(book => {
        book.author_id = this.authors.find((author) => author.id === book.author_id).author
      });
    })
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

<style>
  .min-w-full {
    border-collapse: separate;
    border-spacing: 0;
  }
  .min-w-full th,
  .min-w-full td {
    border: 1px solid #dee2e6;
    
  }
</style>