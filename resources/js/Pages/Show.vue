<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<template>
	<AuthenticatedLayout>
		<div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"></div>
		<div class="flex ">
			<div class="p-10"><img class="shadow border-8 border-white" :src="`/storage/${qrcode.photo}`" :style="{ width: '250px', height: '370px' }" /></div>
			<div  class="p-10" :style="{ width: '800px', height: '320px' }" >
				<div class="bg-gradient-to-r from-red-50 to-slate-50"></div>
				<div class="text-indigo-900 text-5xl font-semibold font-['Inter'] capitalize">{{ book.title }}</div>
				<div class="text-red-500 text-[23px] font-bold font-['Inter'] capitalize tracking-wide">+ {{ book.age }}</div>
				<div class="text-zinc-500 text-[13px] font-medium font-['Inter'] uppercase tracking-widest">Автор {{
					author.author }}</div>
				<div class="text-indigo-900 text-[28px] font-semibold font-['Inter'] capitalize">Анотация</div>
				<div class="text-neutral-500 text-base font-normal font-['Inter'] leading-[33.28px] tracking-tight">{{book.annotation }}</div>
				<div class="bg-red-500"></div>
				<div class="rounded-[7px] border border-indigo-900"></div>
					<div class="text-indigo-900 text-base font-medium font-['Inter'] uppercase leading-9 tracking-wider">
						<button @click="reserveBook">{{qrcode.booking ? 'За бранировать' : 'Занято' }}</button></div>
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
		author: Object,
	},
	methods: {
		reserveBook() {
			Inertia.post(`/books/${this.qrcode.id}/reserve`);
		},
	},

});
</script>