<template>
    <div>
      <h1>Bewerk Genre</h1>
      <form @submit.prevent="updateGenre">
        <label for="genre_name">Genre Naam:</label>
        <input type="text" v-model="genre.genre_name" required />
  
        <button type="submit">Genre Bijwerken</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        genre: {
          id: '',
          genre_name: '',
        },
      };
    },
    methods: {
      async fetchGenreDetails(genreId) {
        try {
          const response = await axios.get(`https://nessimelmazghari-odisee.be/getGenre.php?id=${genreId}`);
          if (response.data.error) {
            console.error('Genre niet gevonden:', response.data.error);
          } else {
            this.genre = response.data;
          }
        } catch (error) {
          console.error('Fout bij het ophalen van genre details:', error);
        }
      },
      async updateGenre() {
        try {
          const genreDataToUpdate = {
            id: this.genre.id,
            genre_name: this.genre.genre_name,
          };
  
          await axios.put('https://nessimelmazghari-odisee.be/updateGenre.php', genreDataToUpdate, {
            headers: {
              'Content-Type': 'application/json',
            },
          });
  
          this.$router.push({ name: 'GenresList' }).then(() => {
            window.location.reload();});
        } catch (error) {
          console.error('Fout bij het bijwerken van genre:', error);
        }
      },
    },
    mounted() {
      const genreId = this.$route.params.id;
      this.fetchGenreDetails(genreId);
    },
  };
  </script>
  
  <style scoped>
  .edit-book-container {
      padding: 20px; /* Add padding around the form */
  }
  
  h1 {
      text-align: center; /* Center the title */
      color: #FF4081; /* Flashy color for the title */
  }
  
  form {
      display: flex;
      flex-direction: column; /* Stack the form elements */
  }
  
  label {
      margin-top: 15px; /* Add margin above labels */
  }
  
  input, textarea, select {
      margin-top: 8px;
      padding: 10px; /* Add padding for input fields */
      border: 1px solid #ddd; /* Border for input fields */
      border-radius: 8px; /* Rounded corners */
      font-size: 16px; /* Font size */
  }
  
  textarea {
      resize: vertical; /* Allow vertical resizing only */
      min-height: 100px; /* Minimum height for textarea */
  }
  
  .submit-button {
      margin-top: 20px; /* Margin above the submit button */
      padding: 12px; /* Increase padding for a larger button */
      font-size: 18px; /* Font size for button */
      background-color: #FF4081; /* Flashy color for the button */
      color: white; /* Button text color */
      border: none; /* No border */
      border-radius: 8px; /* Rounded corners */
      cursor: pointer; /* Pointer cursor on hover */
      transition: background-color 0.3s; /* Transition effect for background color */
  }
  
  /* Add hover effect for the submit button */
  .submit-button:hover {
      background-color: #e91e63; /* Darker shade on hover */
  }
  
  .error {
      color: red; /* Style for error messages */
      margin-top: 10px; /* Space above error message */
      text-align: center; /* Center the error message */
  }
  </style>