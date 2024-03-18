<script setup>
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';

const element = document.getElementById('pdfContent');

html2canvas(element).then(canvas => {
  
  const pdf = new jsPDF();
  pdf.addImage(imgData, 'PNG', 10, 10, 190, 0);
  pdf.save('pdfContent.pdf');
});

</script>
<template>
  <div>
    <div id="pdfContent">
      <h2>QR</h2>
      <div v-for="book in books" :key="book.id">
        <div v-for="qrcode in qrcodes" :key="qrcode.id">
          <template v-if="qrcode.book_id === book.id">
            <p><strong>Название:</strong> {{ book.title }}</p>
            <p><strong>Автор:</strong> {{ book.author }}</p>
            <p><strong>ISBN:</strong> {{ qrcode.ISBN}}</p>
            <p><strong>Дата издания:</strong> {{ qrcode.year}}</p>
            <p>___________</p>
            <qrcode-vue :value="qrcode.ISBN" :level="level" :render-as="renderAs" />
          </template>
        </div>
      </div>
    </div>
    <button @click="generatePDF">Скачать файл</button>
  </div>
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
