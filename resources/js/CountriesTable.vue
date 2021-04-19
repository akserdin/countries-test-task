<template>
  <table class="table table-striped">
    <caption>Total: {{ countries.length }}</caption>
    <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Capital</th>
      <th></th>
    </tr>
    </thead>

    <tbody>
    <tr v-for="(c, index) in countries">
      <td>{{ c.id }}</td>
      <td>{{ c.name }}</td>
      <td>{{ c.capital }}</td>

      <td>
        <button class="btn btn-outline-warning" @click="editCountryByIndex(index)">Edit</button>
        <button class="btn btn-danger" @click="removeCountryByIndex(index)">Remove</button>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "CountriesTable",
  props: {
    countries: {
      type: Array,
      required: true
    }
  },

  data() {
    return {
      editCountryId: null,
      formData: {}
    };
  },

  methods: {
    removeCountryByIndex(index) {
      if (! confirm('Are you sure?')) {
        return;
      }

      this.$emit('country-removed', {index});
    },

    editCountryByIndex(index) {
      let vm = this;

      vm.$emit('country-edited', {index});
    }
  }
}
</script>

<style scoped>

</style>
