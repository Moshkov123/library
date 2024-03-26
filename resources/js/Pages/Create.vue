<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

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
	publish: '',
});


</script>
<template>
	<AuthenticatedLayout>
		<form class="max-w-md mx-auto" enctype="multipart/form-data">
			<div class="mb-5">
				<button @click.prevent="toggleComponent">Нажми меня</button>
				<Author :form="form" v-if="currentComponent === 'Author'"></Author>
<ReadyAuthors :form="form" v-if="currentComponent === 'ReadyAuthors'"></ReadyAuthors>

			</div>
			<div class="mb-5">
				<label for="genre" class="form-label">Жанр</label>
				<input type="text" class="form-control" v-model="form.genre" id="genre" />
			</div>
			<div class="mb-5">
				<label for="title" class="form-label">Название</label>
				<input type="text" class="form-control" v-model="form.title" id="title" />
			</div>
			<div class="mb-5">
				<label for="age" class="form-label">Возраст</label>
				<input type="number" class="form-control" v-model="form.age" id="age" />
			</div>
			<div class="mb-5">
				<label for="annotation" class="form-label">Аннотация</label>
				<textarea class="form-control" v-model="form.annotation" id="annotation" rows="3"></textarea>
			</div>
			<div class="mb-5">
				<label for="quantity" class="form-label">Количество</label>
				<input type="number" class="form-control" v-model="form.quantity" id="quantity" />
			</div>
			<div class="mb-5">
				<label for="ISBN" class="form-label">ISBN</label>
				<input type="number" class="form-control" v-model="form.ISBN" id="ISBN" />
			</div>
			<div class="mb-5">
				<label for="publish" class="form-label"> издатель</label>
				<input type="text" class="form-control" v-model="form.publish" id="publish" />
			</div>
			<div class="mb-5">
				<label for="year" class="form-label">год издания</label>
				<input type="text" class="form-control" v-model="form.year" id="year" />
			</div>
			<div class="mb-5">
				<label for="photo" class="form-label">Фотография</label>
				<input type="file" class="form-control" id="photo" name="photo" v-on:change="handleFileChange">
			</div>

			<button class="btn btn-primary" @click="form.post(route('books.store'))"
				:disabled="form.processing">Добавить</button>
		</form>
	</AuthenticatedLayout>
</template>
<script>
import ReadyAuthors from "@/Components/ReadyAuthors.vue"
import Author from "@/Components/Author.vue"
import author from '@/Layouts/AuthenticatedLayout.vue';

export default {
	data() {
		return {
			currentComponent: 'Author'
		};
	},
	methods: {
		toggleComponent() {
			this.currentComponent = this.currentComponent === 'Author' ? 'ReadyAuthors' : 'Author';
		}
	}
};
</script>