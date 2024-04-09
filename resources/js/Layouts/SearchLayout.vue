<template>
    <div>
      <input type="text" v-model="searchText" @input="getSearchResults">
      <ul v-if="searchResults.length > 0">
        <li v-for="result in searchResults" :key="result.id">
          {{ result.ISBN }} - {{ result.title }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
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
    },
  };
  </script>
  