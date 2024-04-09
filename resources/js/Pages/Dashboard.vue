<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
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
          <h2>Books</h2>
          <div class="card-group">
            <div v-for="book in books" :key="book.id" class="card">
              <div class="card-body" v-for="qrcode in qrcodes" :key="qrcode.id">
                  <div v-if="qrcode.book_id === book.id">
                    <Link :href="`/books/${qrcode.id}`" class="card mb-3">
                      <h5 class="card-title">{{ book.title }}</h5>
                    </Link>
                    <p class="card-text">by {{ book.author }}</p>
                    <img :src="`/storage/${qrcode.photo}`" />
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
