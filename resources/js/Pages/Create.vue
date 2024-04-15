<script setup>
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextTextarea from '@/Components/TextTextarea.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
  name: '',
  patronymic: '',
  surname: '',
  author: '',
  genre: '',
  title: '',
  age: null,
  annotation: '',
  quantity: null,
  year: '',
  ISBN: null,
  photo: null,
  publish: ''
});
let currentComponent = 'Author'
const handleFileChange = (event) => {
  const file = event.target.files[0];
  form.photo = file; // Update the photo field in the form data
};
const toggleComponent = () => {
	currentComponent = currentComponent === 'Author' ? 'ReadyAuthors' : 'Author';
};
</script>
<template>
	<AuthenticatedLayout>
	<form class="max-w-md mx-auto" enctype="multipart/form-data">
			<div class="mb-5">
				<button @click.prevent="toggleComponent">Нажми меня</button>
				<div v-if="currentComponent === 'Author'">
					<div class="mb-3">
            <label for="name">Имя</label>
            <TextInput
            id="name" v-model="form.name"
				type="text"
                    class="mt-1 block w-full"
                    required />
        </div>
        <div class="mb-3">
            <label for="surname">Фамилия</label>
            <TextInput
            id="surname" v-model="form.surname" 
				type="text"
                    class="mt-1 block w-full"
                    required
                    />
        </div>
        <div class="mb-3">
            <label for="patronymic">Отчество</label>
            <TextInput
            id="patronymic" v-model="form.patronymic"
				type="text"
                    class="mt-1 block w-full"
                    required
                    />
        </div></div>
<div  v-if="currentComponent === 'ReadyAuthors'">
	<div>
      <TextInput
      v-model="searchText" 
				type="text"
                    class="mt-1 block w-full"
                   />
      <ul>
        <li v-for="author in filteredAuthors" :key="author.id">{{ author.name }}</li>
      </ul>
    </div></div>
			</div>
			<div class="mb-5">
				<label for="genre" class="form-label">Жанр</label>
				<TextInput
			id="genre"
			type="text"
                    class="mt-1 block w-full"
                    v-model="form.genre"
                    required
                    autofocus/>
			</div>
			<div class="mb-5">
				<label for="title" class="form-label">Название</label>
				<TextInput
				id="title"
			type="text"
                    class="mt-1 block w-full"
					v-model="form.title"
                    required
                    autofocus/>
			</div>
			<div class="mb-5">
				<label for="age" class="form-label">Возраст</label>
				<TextInput
				id="age" 
				type="number"
                    class="mt-1 block w-full"
					v-model="form.age"
                    required
                    autofocus/>
			</div>
			<div class="mb-5">
				<label for="annotation" class="form-label">Аннотация</label>
				<TextTextarea
				id="annotation"
			type="text"
                    class="mt-1 block w-full"
					v-model="form.annotation"
                    required
                    autofocus/>
			</div>
			<div class="mb-5">
				<label for="quantity" class="form-label">Количество</label>
				<TextInput
				id="quantity"
				type="number"
                    class="mt-1 block w-full"
					v-model="form.quantity"
                    required
                    autofocus/>
			</div>
			<div class="mb-5">
				<label for="ISBN" class="form-label">ISBN</label>
				<TextInput
			
				type="number"
                    class="mt-1 block w-full"
					v-model="form.ISBN" id="ISBN"
                    required
                    autofocus/>
			</div>
			<div class="mb-5">
				<label for="publish" class="form-label"> издатель</label>
				<TextInput
				 
				type="text"
                    class="mt-1 block w-full"
					v-model="form.publish" id="publish"
                    required
                    autofocus/>
			</div>
			<div class="mb-5">
				<label for="year" class="form-label">год издания</label>
				
				<TextInput
				v-model="form.year" id="year" 
				type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus/>
			</div>
			<div class="mb-5">
    <label for="photo" class="form-label">Фотография</label>
    <input type="file" class="form-control" id="photo" name="photo" @change="handleFileChange">
  </div>
			<button class="btn btn-primary" @click="form.post(route('books.store'))"
				:disabled="form.processing">Добавить</button>
		</form>
	</AuthenticatedLayout>
</template>

