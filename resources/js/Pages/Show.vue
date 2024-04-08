<template>
	<AuthenticatedLayout>
	  <div class="container col-6">
		<div class="row justify-content-center p-4">
		  <div class="card mb-3">
			<div class="card-body">
			  <h5 class="card-title">{{ book.title }}</h5>
			  <p class="card-text">{{ qrcode.ISBN }}</p>
			  <p class="card-text">{{ book.annotation }}</p>
			  <button @click="reserveBook">Reserve</button>
			</div>
		  </div>
		</div>
	  </div>
	</AuthenticatedLayout>
  </template>
 <script>
 import { defineComponent } from 'vue';
 import { Inertia } from '@inertiajs/inertia';
 
 export default defineComponent({
   props: {
	 book: Object,
	 qrcode: Object,
   },
   methods: {
	 reserveBook() {
	   Inertia.post(`/books/${this.qrcode.id}/reserve`);
	 },
   },
 });
 </script>
  