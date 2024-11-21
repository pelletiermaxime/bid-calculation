<script setup lang="ts">
import { useQuery } from '@tanstack/vue-query'

import type { CarPrice } from './types'
import { ref, watch } from 'vue'

const type = ref('common')
const price = ref(0)

const fetcher = async (): Promise<CarPrice[]> =>
  await fetch(
    `http://127.0.0.1:8000/api/calculate-car-price/${price.value * 100}/${type.value}`,
  ).then((response) => response.json())

const { isLoading, isError, data, error, refetch } = useQuery<CarPrice[]>({
  queryKey: ['todos'],
  queryFn: fetcher,
  enabled: false,
})

watch([price, type], () => {
  refetch()
})
</script>

<template lang="pug">
  main.container
    h1 Car Price Calculator
    .input-group
      label(for="price") Price:
      input#price(type="text" v-model="price")
    .input-group
      label(for="type") Type:
      select#type(v-model="type")
        option(value="common") Common
        option(value="luxury") Luxury
    .data-display(v-if="data")
      h2 Calculated Prices
      .price-item(v-for="(item, index) in data" :key="index")
        p
          strong Base Price:
          |  {{ item.base_price }}
        .fees
          p
            strong Fees:
          ul
            li(v-for="(fee, key) in item.fees" :key="key") {{ key }}: {{ fee }}
        p
          strong Total Price:
          |  {{ item.total_price }}
    div(v-if="isLoading") Loading...
    div(v-if="isError") Error: {{ error.message }}
</template>

<style scoped lang="stylus">
.container
  max-width 600px
  margin 0 auto
  padding 20px
  font-family Arial, sans-serif

h1
  text-align center
  margin-bottom 20px

.input-group
  margin-bottom 15px

label
  display block
  margin-bottom 5px
  font-weight bold

input, select
  width 100%
  padding 8px
  box-sizing border-box

.data-display
  margin-top 20px

.price-item
  border 1px solid #ccc
  padding 15px
  margin-bottom 10px
  border-radius 5px

.fees
  margin-top 10px

ul
  list-style-type none
  padding 0

li
  margin-bottom 5px
</style>
