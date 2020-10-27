<template>
  <div>
    <nav aria-label="Page navigation example">
      <ul class="pagination d-flex justify-content-center">
        <li
          class="page-item"
          @click.prevent="$emit('get-page', results.current_page - 1)"
          v-if="results.current_page > 1"
        >
          <a class="page-link" href="#"
            ><i class="fa fa-chevron-left" aria-hidden="true"></i
          ></a>
        </li>
        <li class="page-item" v-if="results.current_page > 5">
          <span class="page-link">...</span>
        </li>
        <li
          class="page-item"
          v-for="num in results.last_page"
          :key="num"
          v-if="
            num > results.current_page - 5 && num < results.current_page + 5
          "
          @click.prevent="$emit('get-page', num)"
          :class="{ active: num == results.current_page }"
        >
          <a href="#" class="page-link" v-text="num"></a>
        </li>
        <li class="page-item">
          <span
            class="page-link"
            v-if="results.current_page < results.last_page - 5"
            >...</span
          >
        </li>
        <li
          class="page-item"
          @click.prevent="$emit('get-page', results.current_page + 1)"
          v-if="results.current_page < results.last_page"
        >
          <a class="page-link" href="#"
            ><i class="fa fa-chevron-right" aria-hidden="true"></i
          ></a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  props: ["results"],
};
</script>
