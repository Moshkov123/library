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
          <table>
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
                <td>{{ qrcode.year }}</td>
                <td>
                  <img :src="`/storage/${qrcode.photo}`" />
                </td>
                <td>{{ qrcode.publish }}</td>
                <td>{{ qrcode.ISBN }}</td>
                <td>{{ qrcode.condition ? 'В наличи' : 'На руках' }}</td>
                <td>{{ qrcode.booking ? 'Свобоно' : 'За бранированно' }}</td>
                <td>{{ qrcode.user_id }}</td>
                <td>
                   <button type="button" class="btn btn-danger" @click="deleteBook(qrcode.id)">Удалить</button>
                </td>
                <td>
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
      // Fetch updated data after deletion
      await Inertia.get(`/collection/${book.id}`);
    },
    async editBook(id){
      
      await Inertia.get(`/collection/edit/${id}`);
    }
  },
});
</script>