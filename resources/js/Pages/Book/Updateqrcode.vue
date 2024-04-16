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
      <td class="p-4">
        {{qrcode.id}}
      </td>
  <td class="p-4">
    <input v-model="qrcode.year" type="text">
  </td>
  <td class="p-4">
    <label for="photo" class="form-label">Фотография</label>
    <input type="file" class="form-control" id="photo" name="photo" @change="handleFileChange">
</td>
  <td class="p-4">  
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
      console.log(this.qrcode.photo)
    },
    updatebook(bookId) {
  const formData = new FormData();
  formData.append('photo', this.qrcode.photo);
  formData.append('year', this.qrcode.year);
  formData.append('publish', this.qrcode.publish);
  formData.append('ISBN', this.qrcode.ISBN);
  formData.append('condition', this.qrcode.condition);
  formData.append('booking', this.qrcode.booking);
  formData.append('user_id', this.qrcode.user_id);
  formData.append('_method', 'PUT'); // Добавляем это поле, чтобы симулировать PUT запрос

  Inertia.post(`/collection/update/${bookId}`, formData, {
    onBefore: () => {
      if (!this.qrcode.photo) {
        alert('Пожалуйста, выберите фотографию.');
        return false;
      }
    }
  });
},
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