<template>
    <div>
      <h1>Add Book</h1>
      <form @submit.prevent="AddBook">
        <label for="title">Title:</label>
        <input type="text" v-model="book.title" required />
  
        <label for="isbn">ISBN:</label>
        <input type="text" v-model="book.isbn" required />
  
        <label for="description">Description:</label>
        <textarea v-model="book.description" required></textarea>
  
        <label for="author_id">Author ID:</label>
        <input type="number" v-model="book.author_id" required />
  
        <label for="genre_id">Genre ID:</label>
        <input type="number" v-model="book.genre_id" required />
  
        <button type="submit">Update Book</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        book: {
          title: '',
          isbn: '',
          description: '',
          author_id: null,
          genre_id: null
        }
      };
    },
    methods: {
      
      async AddBook() {
        try {
          // Create a formatted object to send as JSON
          const bookDataToAdd = {
            title: this.book.title,
            isbn: this.book.isbn,
            description: this.book.description,
            author_id: this.book.author_id,
            genre_id: this.book.genre_id
          };
  
          // Send the formatted object as JSON
          const response = await axios.post('https://nessimelmazghari-odisee.be/createBook.php', bookDataToAdd, {
            headers: {
              'Content-Type': 'application/json'
            }
          });
  
          // Log the response for debugging as a formatted JSON string
          console.log('Response from server:', JSON.stringify(response.data, null, 4)); // Pretty-print response data
  
          // Navigate back or show a success message as needed
          this.$router.push('/').then(() => {
            window.location.reload();}); // Go back to the book list or a success page
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
