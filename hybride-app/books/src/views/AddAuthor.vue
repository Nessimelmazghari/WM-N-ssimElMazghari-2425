<template>
    <div>
      <h1>Add Author</h1>
      <form @submit.prevent="AddAuthor">
        <label for="first_name">first name:</label>
        <input type="text" v-model="author.first_name" required />
  
        <label for="last_name">last name:</label>
        <input type="text" v-model="author.last_name" required />

        <label for="birth_year">Birth Year:</label>
        <input type="number" v-model="author.birth_year" required />
  
        <button type="submit">Update Book</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        author: {
          first_name: '',
          last_name: '',
          birth_year: null,
        }
      };
    },
    methods: {
      
      async AddAuthor() {
        try {
          // Create a formatted object to send as JSON
          const authorDataToAdd = {
            first_name: this.author.first_name,
            last_name: this.author.last_name,
            birth_year: this.author.birth_year,
          };
  
          // Send the formatted object as JSON
          const response = await axios.post('https://nessimelmazghari-odisee.be/createAuthor.php', authorDataToAdd, {
            headers: {
              'Content-Type': 'application/json'
            }
          });
  
          // Log the response for debugging as a formatted JSON string
          console.log('Response from server:', JSON.stringify(response.data, null, 4)); // Pretty-print response data
  
          // Navigate back or show a success message as needed
          this.$router.push('/').then(() => {
            window.location.reload();}); 
        } catch (error) {
          console.error('Error updating book:', error);
        }
      },
    },
  };
  </script>
 
<style scoped>
ion-content {
    --padding-start: 16px;
    --padding-end: 16px;
}

ion-item {
    --border-color: transparent;
}

ion-button {
    margin-top: 16px;
    --border-radius: 8px;
}
</style>
