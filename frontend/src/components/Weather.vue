<template>
  <div class="modal">
    <div class="modal-overlay"></div>
    <div class="modal-container">
      <h3 class="text-2xl font-bold mb-4">User Weather Details</h3>
      <div class="flex flex-col items-center">
        <div class="flex items-center">
          <img class="w-16 h-16 mr-2" :src="iconUrl" :alt="description" />
          <div class="text-xl">{{ description }}</div>
        </div>
        <div class="text-5xl font-bold mt-2">{{ Math.round(main.temp) }}°C</div>
        <div class="text-lg mt-2">Feels like {{ Math.round(main.feels_like) }}°C</div>
        <div class="text-lg mt-2">Humidity {{ main.humidity }}%</div>
        <div class="text-lg mt-2">Pressure {{ main.pressure }}hPa</div>
        <div class="text-lg mt-2">Wind Speed {{ wind.speed }}m/s</div>
        <div class="text-lg mt-2">Wind Direction {{ wind.deg }}°</div>
      </div>
    </div>
  </div>
</template>

<script>
import { computed } from 'vue';

export default {
  name: 'Weather',
  props: {
    weather: {
      type: Object,
      required: true,
    },
  },

  setup(props) {
      const main = computed(() => {
          return props.weather.main || {};
      });

      const wind = computed(() => {
          return props.weather.wind || {};
      });

      const weatherDetails = computed(() => {
          return props.weather.weather ? props.weather.weather[0] : {};
      });

      const iconUrl = computed(() => {
          return `http://openweathermap.org/img/w/${weatherDetails.value.icon}.png`;
      });

      const description = computed(() => {
          return weatherDetails.description;
      });

      return {
        main,
        wind,
        weatherDetails,
        iconUrl,
        description,
      };
  },
};
</script>
