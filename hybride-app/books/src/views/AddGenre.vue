<template>
    <div>
      <h1>Voeg Genre Toe</h1>
      <form @submit.prevent="addGenre">
        <label for="genre_name">Genre Naam:</label>
        <input type="text" v-model="genre.genre_name" required />
  
        <button type="submit">Voeg Genre Toe</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        genre: {
          genre_name: '',
        },
      };
    },
    methods: {
      async addGenre() {
        try {
          // Create a formatted object to send as JSON
          const genreDataToAdd = {
            genre_name: this.genre.genre_name,
          };
  
          // Send the formatted object as JSON
          const response = await axios.post('https://nessimelmazghari-odisee.be/createGenre.php', genreDataToAdd, {
            headers: {
              'Content-Type': 'application/json',
            },
          });
  
          // Log the response for debugging as a formatted JSON string
          console.log('Response from server:', JSON.stringify(response.data, null, 4)); // Pretty-print response data
  
          // Navigate back or show a success message as needed
          this.$router.push({ name: 'GenresList' }).then(() => {
            window.location.reload();}); 
        } catch (error) {
          console.error('Error adding genre:', error);
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
  