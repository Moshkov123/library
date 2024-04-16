<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>

  <Head title="Editor" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ book.title }}</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>
          <table class="min-w-full">
            <thead>
              <tr>
                <th>Year</th>
                <th>Photo</th>
                <th>Publish</th>
                <th>ISBN</th>
                <th>Condition</th>
                <th>Booking</th>
                <th>User ID</th>
                <th>удалить</th>
                <th>редактировать</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="qrcode in qrcodes" :key="qrcode.id">
                <td class="p-4">{{ qrcode.year }}</td>
                <td class="p-4">
                  <img :src="`/storage/${qrcode.photo}`"  :style="{ width: '250px', height: '370px' }"/>
                </td>
                <td class="p-4">{{ qrcode.publish }}</td>
                <td class="p-4">{{ qrcode.ISBN }}</td>
                <td class="p-4">{{ qrcode.condition ? 'В наличи' : 'На руках' }}</td>
                <td class="p-4">{{ qrcode.booking ? 'Свобоно' : 'За бранированно' }}</td>
                <td class="p-4">{{ qrcode.user_id }}</td>
                <td class="p-4">
                   <button type="button" class="btn btn-danger" @click="deleteBook(qrcode.id)">Удалить</button>
                </td>
                <td class="p-4"> 
                  <button type="button" class="btn btn-primary" @click="editBook(qrcode.id)">Редактировать</button>
                </td>
              </tr>
            </tbody>
          </table>
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
    book: Object,
    qrcodes: Array,
  },
  methods: {
    async deleteBook(id) {
      await Inertia.delete(route('qrcodes.destroy', { id }));
      await Inertia.get(`/collection/${book.id}`);
    },
    async editBook(id){
      await Inertia.get(`/collection/edit/${id}`);
    }
  },
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