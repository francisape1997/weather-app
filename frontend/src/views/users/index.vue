<template>
  <div class="flex flex-col items-center justify-center h-screen">
    <h1 class="text-3xl font-bold mb-4">Users</h1>
    <ul class="grid gap-4 grid-cols-3">
      <li
          v-for="user in users"
          :key="user.name"
          class="bg-white p-4 rounded-lg shadow-md cursor-pointer"
          @click="showModal(user.id)">
        <h2 class="text-lg font-medium">{{ user.name }}</h2>
        <div class="flex justify-between">
          <p class="text-sm">{{ user.email }}</p>
          <p class="text-sm font-medium">{{ user.weather.main.temp }}&deg;C</p>
          <Modal
              :open="isModalOpen[user.id]"
              @close="isModalOpen[user.id] = false"
          >
            <Weather :weather="user.weather"/>
          </Modal>
        </div>
      </li>
    </ul>

  </div>
</template>

<script>
import axios from 'axios';
import Weather from '@/components/Weather.vue'
import Modal from '@/components/Modal.vue';
import { ref } from "vue";

export default {
  name: "Users",

  components: {
    Weather,
    Modal,
  },

  setup() {
    const users = ref([]);

    const isModalOpen = ref({});

    const getUsers = () => {
      axios.get('http://localhost/users')
          .then((response) => {
            if (response.status === 200) {
              const data = response.data

              users.value = data;

              for (const user of data) {
                isModalOpen.value[user.id] = false;
              }
            }
          })
    };
    getUsers();

    const showModal = (id) => {
        isModalOpen.value[id] = !isModalOpen.value[id];
    };

    return {
      users,
      isModalOpen,
      showModal,
    };
  }
}
</script>
