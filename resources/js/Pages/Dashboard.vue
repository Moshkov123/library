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
            <div class="card-group">
              <div v-for="book in books" :key="book.id" class="card">
                <div class="card-body">
                  <Link :href="`/books/${book.id}`" class="card mb-3">
                    <h5 class="card-title underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" >{{ book.title }}</h5>
                  </Link>
                    <p >by {{ book.author_id }}</p>
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
        book.author_id = this.authors.find((author)=> author.id === book.author_id).author
     });
    })
  },
  methods: {
    sortedbyname(){
    function compare(a, b) {
      if (a.title < b.title)
        return -1;
      if (a.title > b.title)
        return 1;
      return 0;
    }
    return this.books.sort(compare);
  },

  
  sortedbyauthorname(){
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
  data(){
    return{
      sortmethod:'sortedbyname()',
    }
  }
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
  width:240px;
  display: flex;
  background-color: lightblue;
  border-radius: 25px;
  flex-direction: column-reverse;
    justify-content: space-around;

}
.card-title{
  font-size: x-large;
}
.menu{
  display: grid;
  grid-template-columns: 1fr 6fr;
}
</style>