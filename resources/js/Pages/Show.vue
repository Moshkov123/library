<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>
<template>
	  <Head title="Show" />
  <AuthenticatedLayout>
	<div class="container col-6">
		<div class="row justify-content-center p-4">
			<div
				href="#"
				class="card mb-3"
			>
				<div class="card-body">
					<h5 class="card-title">{{ book.title }}</h5>
					<p class="card-text">{{ book.author }}</p>
					<p class="card-text">{{ book.annotation}}</p>
				</div>
			</div>
		</div>
	</div>
</AuthenticatedLayout>
</template>

<script >
import { defineComponent } from 'vue';

export default defineComponent({
	props: {
  book: Object,
},
  setup() {
    return {};
  },
});
</script>