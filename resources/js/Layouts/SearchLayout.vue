<template>
  <div>
    <input type="text" v-model="searchText" @input="getSearchResults">
    <ul v-if="searchResults.length > 0">
      <li v-for="result in searchResults" :key="result.id">
        {{ result.ISBN }}
        <button @click="showBook(result.ISBN)">Найти</button>
      </li>
    </ul>
  </div>
</template>
<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    qrcodes: Array,
  },
  data() {
    return {
      searchText: '',
      searchResults: [],
    };
  },
  methods: {
    getSearchResults() {
      const query = this.searchText.toLowerCase();
      this.searchResults = this.qrcodes.filter(qrcode =>
        qrcode.ISBN.toLowerCase().includes(query)
      );
    },
    showBook(ISBN) {
      Inertia.visit(`/scanner/${ISBN}`);
    },
  },
};
</script>
