<template>
   
        <div class="mb-3">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" v-model="form.name" />
        </div>
        <div class="mb-3">
            <label for="surname">Фамилия</label>
            <input type="text" class="form-control" id="surname" v-model="form.surname" />
        </div>
        <div class="mb-3">
            <label for="patronymic">Отчество</label>
            <input type="text" class="form-control" id="patronymic" v-model="form.patronymic" />
        </div>
   
</template>
<script>
import { ref, inject } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    setup() {
        const form = useForm({
            name: '',
            patronymic: '',
            surname: '',
            author: '',
        });

        return { form };
    }
    props: ['form'],
};
</script>
