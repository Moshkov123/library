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

  <Head title="Книги" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Книги</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="menu">
          <div class="sort">
            <SecondaryButton v-on:click="sortedbyname()">Сортировка по названию</SecondaryButton>
            <SecondaryButton v-on:click="sortedbyauthorname()">Сортировка по автору</SecondaryButton>
          </div>
          <div>
            <div class="flex-container">
  <div class="book" v-for="book in books" :key="book.id">
                <div class="flex" v-for="qrcode in qrcodes" :key="qrcode.id">
                  <div  v-if="qrcode.book_id === book.id" class=" p-6">
                    <div class="p-4 shadow border border-stone-200">
                      <img class="shadow" v-if="hasQrcode(qrcodes, book.id)"
                      :src="`/storage/${getQrcode(qrcodes, book.id).photo}`"
                      :style="{ width: '250px', height: '370px' }" />
                    <div class="text-center text-indigo-900 text-[22px] font-semibold font-['Inter'] capitalize">{{
                      book.title }}</div>
                    <div class="text-center text-zinc-500 text-sm font-normal font-['Inter'] capitalize tracking-tight">
                      Автор {{ book.author_id }}</div>
                    <Link 
                      :href="`/books/${qrcode.id}`"> 
                      <div class="text-center text-red-500 text-lg font-bold font-['Inter'] capitalize tracking-tight">Подробние</div>
                    </Link>
                    </div>
                    
                  </div>
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
import SecondaryButton from '@/Components/SecondaryButton.vue';

export default defineComponent({
  components: { Link },
  props: {
    books: Array,
    authors: Array,
    qrcodes: Array,
  },
  mounted() {
    this.$nextTick(function () {
      this.books.forEach(book => {
        book.author_id = this.authors.find((author) => author.id === book.author_id).author
      });
    })
  },
  methods: {
    sortedbyname() {
      function compare(a, b) {
        if (a.title < b.title)
          return -1;
        if (a.title > b.title)
          return 1;
        return 0;
      }
      return this.books.sort(compare);
    },
    sortedbyauthorname() {
      function compare(a, b) {
        if (a.author_id < b.author_id)
          return -1;
        if (a.author_id > b.author_id)
          return 1;
        return 0;
      }
      return this.books.sort(compare);
    }
  },
  data() {
    return {
      sortmethod: 'sortedbyname()',
    }
  }
});
</script>
<style>
.flex-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around; /* Измените по желанию */
}

.book {
 display: flex;
}
.menu{
  display: grid;
  grid-template-columns: 1fr 6fr;
}
</style>