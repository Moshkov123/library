<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>
  <div>
    <Head title="Scanner" />
    <AuthenticatedLayout>
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <Search :qrcodes="qrcodes" />
            <ScannerLayout/>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </div>
</template>
<script>
import { defineComponent } from 'vue';
import Search from '@/Layouts/SearchLayout.vue';
import ScannerLayout from '@/Layouts/ScannerLayout.vue'
import { Head } from '@inertiajs/vue3';
export default defineComponent({
  components: { Search, Head },
  props: {
    qrcodes: Array,
  },
 
});
</script>
