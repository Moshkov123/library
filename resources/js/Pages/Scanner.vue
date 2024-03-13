<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>
<template>
  <Head title="Scanner" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Table</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div>
            <h2>scanner</h2>
            <div class="bg-gray-50 px-8">
    <p>{{ error }}</p>
    <p>{{ decodedString }}</p>
    <qrcode-stream @init="onInit" @decode="onDecode"></qrcode-stream>
  </div>
  <h2>QR</h2>
  <div>
    <form>
      <input v-model="QRValue" placeholder="Введите текст">
    <button @click="generateQRCode">Создать QR-код</button>
    <img :src="qrCode" alt="QR-код">
    </form>
    <qrcode-vue :value="QRValue" :level="level" :render-as="renderAs" />
  </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>



<script>
import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue3-qrcode-reader';

export default {
  data() {
    return {
      error: '',
      decodedString: ''
    };
  },
  components: {
    QrcodeStream,
    QrcodeDropZone,
    QrcodeCapture
  },
  methods: {
    async onInit(promise) {
      try {
        const capabilities = await promise;
        // успешная инициализация
      } catch (error) {
        if (error.name === "NotAllowedError") {
          this.error = "user denied camera access permission";
        } else if (error.name === "NotFoundError") {
          this.error = "no suitable camera device installed";
        } else if (error.name === "NotSupportedError") {
          this.error = "page is not served over HTTPS (or localhost)";
        } else if (error.name === "NotReadableError") {
          this.error = "maybe camera is already in use";
        } else if (error.name === "OverconstrainedError") {
          this.error = "did you requested the front camera although there is none?";
        } else if (error.name === "StreamApiNotSupportedError") {
          this.error = "browser seems to be lacking features";
        }
      } finally {
        // скрыть индикатор загрузки
      }
    },
    onDecode(decodedString){
      this.decodedString =decodedString;
    }
  }
}
</script>

