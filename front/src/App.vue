<script setup lang="ts">
import { useQueryClient, useQuery } from '@tanstack/vue-query'

import type { Post } from './types';
import { ref } from 'vue';

const queryClient = useQueryClient()

const type = ref('common')
const price = ref(0)
const enabled = ref(false)

const fetcher = async (): Promise<Post[]> =>
  await fetch(`http://127.0.0.1:8000/api/calculate-car-price/${price.value * 100}/${type.value}`).then((response) =>
    response.json(),
  )

const { isPending, isError, data, error, refetch } = useQuery({
  queryKey: ['todos'],
  queryFn: fetcher,
  enabled: false,
})

</script>

<template>
  <main>
    <input type="text" v-model="price" />
    <select v-model="type">
      <option value="common">Common</option>
      <option value="luxury">Luxury</option>
    </select>
    <button @click="refetch">Fetch Data</button>

    <div>
      {{data}}
    </div>
  </main>
</template>

<style scoped>

</style>
