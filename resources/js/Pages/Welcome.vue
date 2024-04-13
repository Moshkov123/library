<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Login from './Auth/Login.vue';
import Register from './Auth/Register.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    logPressed:{
        type: Boolean,
        default: true,
    },
    regPressed:{
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Welcomwe" />
    <div>
        <div v-if="canLogin">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Вы не должны бвть здесь. вы зарегестрированны. покиньте сайт.</Link>
            <template v-else>
                <div class="flex-cd">
                    <p style="font-size: xx-large; ">Библиотека</p>
                    <div class="totheright">
                        <PrimaryButton v-on:click="regPressed=false;logPressed=true">Логин</PrimaryButton>
                        <PrimaryButton v-on:click="regPressed=true;logPressed=false">Регистрация</PrimaryButton>
                    </div>
                </div>
                <div class="flex-cd">
                    <Login v-if="logPressed"></Login>
                    <a v-if="logPressed"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    v-on:click="regPressed=true;logPressed=false">
                    Already logged?</a>

                    <Register v-if="regPressed"></Register>
                    <a v-if="regPressed"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    v-on:click="regPressed=false;logPressed=true">
                    Already registered?</a>
                </div>
            </template>
        </div>
    </div>
</template>

<style>
.flex-cd{
    display: flex;
    flex-direction: column;
    align-items: center;
}
.totheright{
    position: absolute;
    right: 0px;
}
</style>
