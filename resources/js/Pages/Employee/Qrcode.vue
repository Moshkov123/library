<script setup>
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
const element = document.getElementById('pdfContent');

html2canvas(element).then(canvas => {
  
  const pdf = new jsPDF();
  pdf.addImage(imgData, 'PNG', 10, 10, 190, 0);
  pdf.save('pdfContent.pdf');
});
</script>
<template>
      <Head title="Qrcode" />
    <AuthenticatedLayout>
  <div>
    <div id="pdfContent">
      <h2>QR</h2>
      <div>
        <div class="flex-row ga">
        <div class="flex" v-for="book in books" :key="book.id">
        <div v-for="qrcode in qrcodes" :key="qrcode.id">
          <template v-if="qrcode.book_id === book.id">
            <div class="p-3 border">
                  <p><strong>Название:</strong> {{ book.title }}</p>
                  <p><strong>Автор:</strong> {{ book.author }}</p>
                  <p><strong>ISBN:</strong> {{ qrcode.ISBN}}</p>
                  <p><strong>Дата издания:</strong> {{ qrcode.year}}</p>
                  <qrcode-vue class="p-2" :value="qrcode.ISBN" :level="level" :render-as="renderAs" />
                </div>
          </template>
        </div>
      </div>
      </div>
      </div>
    </div>
    <button @click="generatePDF">Скачать файл</button>
  </div>
</AuthenticatedLayout>
</template>
<script>
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';
import QrcodeVue from 'qrcode.vue';

export default {
  props: {
    books: Array,
    qrcodes: Array,
  },
  components: {
    QrcodeVue
  },
  methods: {
    generatePDF() {
  const element = document.getElementById('pdfContent');
  html2canvas(element).then(canvas => {
    const pdf = new jsPDF();
    pdf.addImage(canvas.toDataURL(), 'PNG', 10, 10, 190, 0);
    pdf.save('pdfContent.pdf');
  });
}
  }
}
</script>
<style>

@font-face {
 font-family: 'Dited';
 src: url("macroman/Dited-webfont.woff") format('woff');
}
p {
  font-family: 'Dited', sans-serif;
}
</style>
