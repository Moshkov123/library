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
			  <button @click="updateBooking">{{ qrcode.booking ? 'Забронировать' : 'Занято' }}</button>
			  <button @click="updateCondition">{{ qrcode.condition ? 'В наличии' : 'На руках' }}</button>
			  <div>
				<input type="text" v-model="id" placeholder="Введите id" />
				<button @click="updateWithId">сохранить</button>
			  </div>
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
	data() {
	  return {
		id: '',
	  };
	},
	methods: {
	  updateBooking() {
		Inertia.post(`/scanner/booking/${this.qrcode.ISBN}`, { id: this.id });
	  },
	  updateCondition() {
		Inertia.post(`/scanner/сondition/${this.qrcode.ISBN}`, { id: this.id });
	  },
	  updateWithId() {
		// Ваш код для обновления данных с использованием id
	  },
	},
});
</script>