<template>
    <div>
      <input type="text" v-model="searchText" placeholder="Поиск автора" />
      <ul>
        <li v-for="author in filteredAuthors" :key="author.id">{{ author.name }}</li>
      </ul>
    </div>
  </template>
  
  <script>
  import { ref, computed } from 'vue';
  
  export default {
    setup() {
      const searchText = ref('');
      const authors = [
        { id: 1, name: 'Александр Пушкин' },
        { id: 2, name: 'Лев Толстой' },
        { id: 3, name: 'Федор Достоевский' },
        // Добавьте других авторов по мере необходимости
      ];
  
      const filteredAuthors = computed(() => {
        return authors.filter(author =>
          author.name.toLowerCase().includes(searchText.value.toLowerCase())
        );
      });
  
      return { searchText, filteredAuthors };
    }
  };
  </script>
  