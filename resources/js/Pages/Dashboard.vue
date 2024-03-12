<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const hasQrcode = (qrcodes, bookId) => {
  return qrcodes.some((qrcode) => qrcode.book_id === bookId);
};

const getQrcode = (qrcodes, bookId) => {
  return qrcodes.find((qrcode) => qrcode.book_id === bookId);
};
</script>
<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div>
            <h2>Books</h2>
            <div class="card-group">
              <div v-for="book in books" :key="book.id" class="card">
                <div class="card-body">
                  <Link :href="`/books/${book.id}`" class="card mb-3">
                    <h5 class="card-title">{{ book.title }}</h5>
                  </Link>
                  <p class="card-text">by {{ book.author }}</p>
                  <img v-if="hasQrcode(qrcodes, book.id)" :src="`/storage/${getQrcode(qrcodes, book.id).photo}`" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>




<script>
import { defineComponent } from 'vue';
import { Link } from '@inertiajs/vue3';

export default defineComponent({
  components: { Link },
  props: {
    books: Array,
    qrcodes: Array,
  },
});
</script>
