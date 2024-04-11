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
                  
                  <p v-for="author in authors" :is="author.id">
                    <p v-if="author.id == book.author_id" class="card-text">by {{ author.name }}</p></p>
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
    authors: Array,
    qrcodes: Array,
  },
});
</script>
<style>
.card-group{
  display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: center;
    align-items: flex-end;
    justify-content: center;
}
.card-body{
  margin: 10px;
  padding: 20px 10px;
  width:250px;
  display: flex;
  background-color: lightblue;
  border-radius: 25px;
  flex-direction: column-reverse;
    justify-content: space-around;

}
</style>