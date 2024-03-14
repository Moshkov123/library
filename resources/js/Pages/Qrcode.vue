<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>
<template>
    <Head title="Qrcode" />
    <AuthenticatedLayout>
      <h2>QR</h2>
      <div v-for="book in books" :key="book.id">
  
  <div v-for="qrcode in qrcodes" :key="qrcode.id">
  <template v-if="qrcode.book_id === book.id">
    <p><strong>Title:</strong> {{ book.title }}</p>
  <p><strong>Author:</strong> {{ book.author }}</p>
    <p><strong>ISBN</strong> {{ qrcode.ISBN}}</p>
    <p><strong>Дата издания</strong> {{ qrcode.year}}</p>
    <qrcode-vue :value="qrcode.ISBN" :level="level" :render-as="renderAs" />
  </template>
</div>
</div>

    </AuthenticatedLayout>
  </template>
  
  <script>
  import QrcodeVue from 'qrcode.vue'
  
  export default {
    props: {
        books: Array,
        qrcodes: Array,
       

  },
    data() {
      return {
        QRValue: null,
        qrCode: '' // Update the variable name to match the one used in the template
      }
    },
    components: {
      QrcodeVue
    },
    methods: {
      generateQRCode() {
        QRCode.toDataURL(this.QRValue, (err, url) => { // Update the variable name to match the one used in the template
          if (err) {
            console.error(err)
          } else {
            this.qrCode = url // Update the variable name to match the one used in the template
          }
        })
      }
      
    }
  }
  </script>
  
