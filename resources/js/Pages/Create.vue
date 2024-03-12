<template>
	<form class="max-w-md mx-auto" enctype="multipart/form-data">
	  <div class="mb-5">
		<label for="author" class="form-label">Автор</label>
		<input
		  type="text"
		  class="form-control"
		  v-model="form.author"
		  id="author"
		/>
	  </div>
	  <div class="mb-5">
		<label for="genre" class="form-label">Жанр</label>
		<input
		  type="text"
		  class="form-control"
		  v-model="form.genre"
		  id="genre"
		/>
	  </div>
	  <div class="mb-5">
		<label for="title" class="form-label">Название</label>
		<input
		  type="text"
		  class="form-control"
		  v-model="form.title"
		  id="title"
		/>
	  </div>
	  <div class="mb-5">
		<label for="age" class="form-label">Возраст</label>
		<input
		  type="number"
		  class="form-control"
		  v-model="form.age"
		  id="age"
		/>
	  </div>
	  <div class="mb-5">
		<label for="annotation" class="form-label">Аннотация</label>
		<textarea
		  class="form-control"
		  v-model="form.annotation"
		  id="annotation"
		  rows="3"
		></textarea>
	  </div>
	  <div class="mb-5">
		<label for="quantity" class="form-label">Количество</label>
		<input
		  type="number"
		  class="form-control"
		  v-model="form.quantity"
		  id="quantity"
		/>
	  </div>
	  <div class="mb-5">
		<label for="ISBN" class="form-label">ISBN</label>
		<input
		  type="number"
		  class="form-control"
		  v-model="form.ISBN"
		  id="ISBN"
		/>
	  </div>
	  <div class="mb-5">
		<label for="publish" class="form-label"> издатель</label>
		<input
		type="text"
		  class="form-control"
		  v-model="form.publish"
		  id="publish"
		/>
	  </div>
	  <div class="mb-5">
		<label for="year" class="form-label">год издания</label>
		<input
		type="text"
		  class="form-control"
		  v-model="form.year"
		  id="year"
		/>
	  </div>
	  <div class="mb-5">
    <label for="photo" class="form-label">Фотография</label>
	<input type="file" class="form-control" id="photo" name="photo" v-on:change="handleFileChange">
</div>

	  <button class="btn btn-primary" @click="form.post(route('books.store'))" :disabled="form.processing">Добавить</button>
	</form>
  </template>

<script>
import { defineComponent } from 'vue';
import { useForm } from '@inertiajs/vue3';

export default defineComponent({
  setup() {
    const form = useForm({
      author: '',
      genre: '',
      title: '',
      age: null,
      annotation: '',
      quantity: null,
	  year: '',
	  ISBN: null,
      photo: null,
	  publish: '',
    });

    const handleFileChange = (event) => {
      const file = event.target.files[0];
      form.photo = file;
    };

    return { form, handleFileChange };
  },
});

</script>

  