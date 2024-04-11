<script setup>

</script>
<template>

          <div>
            <h2>scanner</h2>
            <div class="bg-gray-50 px-8">
              <p>{{ error }}</p>
              <p>{{ decodedString }}</p>
              <qrcode-stream @init="onInit" @decode="onDecode"></qrcode-stream>
            </div>
          </div>
</template>
<script>
import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue3-qrcode-reader';
import { defineComponent } from 'vue';
import { Inertia } from '@inertiajs/inertia';

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
    onDecode(decodedString) {
      
      Inertia.visit(`/scanner/${decodedString}`);
    }
  }
}
</script>
