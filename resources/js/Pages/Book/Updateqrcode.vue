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
        <th>id</th>
                <th>Year</th>
                <th>Photo</th>
                <th>Publish</th>
                <th>ISBN</th>
                <th>Condition</th>
                <th>Booking</th>
                <th>User ID</th>
                <th>обновить</th>
              </tr>
  </thead>
  <tbody>
    <tr>
      <td class="px-6 py-4">
        {{qrcode.id}}
      </td>
  <td class="px-6 py-4">
    <input v-model="qrcode.year" type="text">
  </td>
  <td class="px-6 py-4">
    <label for="photo" class="form-label">Фотография</label>
    <input type="file" class="form-control" id="photo" name="photo" @change="handleFileChange">
</td>
  <td class="px-6 py-4">  
    <input v-model="qrcode.publish" type="text">
  </td>

  <td class="px-6 py-4">
    <input v-model="qrcode.ISBN" type="text">
  </td>

  <td class="px-6 py-4">
    <input v-model="qrcode.condition" type="text"> 
  </td>
  
  <td class="px-6 py-4">
    <input v-model="qrcode.booking" type="text">
  </td>
  <td class="px-6 py-4">
    <input v-model="qrcode.user_id" type="text">
  </td>
  <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <button type="button" class="btn btn-primary"
                                                @click="updatebook(qrcode.id)">Обновить</button>
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
    qrcode: Object,
  },
  methods: {
    handleFileChange(event) {
      const file = event.target.files[0];
      this.qrcode.photo = file; // Обновляем свойство qrcode.photo новым файлом
    },
    updatebook(bookId) {


      // Отправляем данные с использованием метода put Inertia.js
      Inertia.put(`/collection/update/${bookId}`, formData);
    },
  },
});
</script>
