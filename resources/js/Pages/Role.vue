<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>
<template>
  <Head title="Role" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Table</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div>
            <h2>User Table</h2>
            <div class="overflow-x-auto">
              <table class="min-w-full">
                <thead>
                  <tr>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      ID</th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      Name</th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      Email</th>
                    <th
                      class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                      Role ID</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users" :key="user.id">
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ user.id }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ user.name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ user.email }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ user.role_id }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> <button type="button"
                        class="btn btn-danger" @click="deleteUser(user.id)"> Удалить</button>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
  <button type="button" class="btn btn-primary" @click="editUser(user.id)">Редактировать</button>
</td>
                    
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
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
    users: Array,
    role: Array
  },
  methods: {
    editUser(id) {
      Inertia.visit(`/role/edit/${id}`);
    },
    deleteUser(id) {
      Inertia.delete(`/role/${id}`);
      Inertia.get(`/role`);
    },
  }
});
</script>
