<template>
	<AuthenticatedLayout>
	  <div class="container col-6">
		<div class="row justify-content-center p-4">
		  <div class="card mb-3">
			<div class="card-body">
			  <h5 class="card-title">{{ book.title }}</h5>
			  <p class="card-text">{{ qrcode.ISBN }}</p>
			  <p class="card-text">{{ book.annotation }}</p>
			  <img :src="`/storage/${qrcode.photo}`" />
			  <input type="text" v-model="userId" placeholder="Enter User ID">
              <button @click="Issued()">{{ qrcode.condition ? 'Выдать' : 'Нет в наличии' }}</button>
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
	data() {
    return {
      userId: null
    }
  },
   props: {
	 book: Object,
	 qrcode: Object,
   },
   methods: {
	Issued() {
		Inertia.put(route('issued', { id: this.qrcode.id, userId: this.userId })); 
},
   },
 });
 </script>
  