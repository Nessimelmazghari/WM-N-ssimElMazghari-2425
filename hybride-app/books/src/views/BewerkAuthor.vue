<template>
  <div>
    <h1>Bewerk Auteur</h1>
    <form @submit.prevent="updateAuthor">
      <label for="first_name">Voornaam:</label>
      <input type="text" v-model="author.first_name" required />

      <label for="last_name">Achternaam:</label>
      <input type="text" v-model="author.last_name" required />

      <label for="birth_year">Geboortejaar:</label>
      <input type="number" v-model="author.birth_year" required />

      <button type="submit">Auteur Bijwerken</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      author: {
        id: '',
        first_name: '',
        last_name: '',
        birth_year: null,
      },
    };
  },
  methods: {
    async fetchAuthorDetails(authorId) {
      try {
        const response = await axios.get(`https://nessimelmazghari-odisee.be/getAuthor.php?id=${authorId}`);
        if (response.data.error) {
          console.error('Auteur niet gevonden:', response.data.error);
        } else {
          this.author = response.data;
        }
      } catch (error) {
        console.error('Fout bij het ophalen van auteur details:', error);
      }
    },
    async updateAuthor() {
      try {
        // Include the author ID in the update request
        const authorDataToUpdate = {
          id: this.author.id,
          first_name: this.author.first_name,
          last_name: this.author.last_name,
          birth_year: this.author.birth_year,
        };

        // Send the update request to the server
        const response = await axios.put('https://nessimelmazghari-odisee.be/updateAuthor.php', authorDataToUpdate, {
          headers: {
            'Content-Type': 'application/json',
          },
        });

        // Log the server response for debugging
        console.log('Response van de server:', JSON.stringify(response.data, null, 4));

        // Navigate back to the author list or display a success message
        this.$router.push({ name: 'AuthorsList' }).then(() => {
          window.location.reload();});
      } catch (error) {
        console.error('Fout bij het bijwerken van auteur:', error);
      }
    },
  },
  mounted() {
    // Fetch the author details using the ID from the route params
    const authorId = this.$route.params.id;
    this.fetchAuthorDetails(authorId);
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