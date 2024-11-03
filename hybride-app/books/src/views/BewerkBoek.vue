<template>
  <div class="edit-book-container">
    <h1>Edit Book</h1>
    <form @submit.prevent="updateBook">
      <label for="title">Title:</label>
      <input type="text" v-model="book.title" required />

      <label for="isbn">ISBN:</label>
      <input type="text" v-model="book.isbn" required />

      <label for="description">Description:</label>
      <textarea v-model="book.description" required></textarea>

      <label for="author_id">Author:</label>
      <select v-model="book.author_id" required>
        <option v-for="author in authors" :key="author.id" :value="author.id">
          {{ author.first_name }} {{ author.last_name }}
        </option>
      </select>

      <label for="genre_id">Genre:</label>
      <select v-model="book.genre_id" required>
        <option v-for="genre in genres" :key="genre.id" :value="genre.id">
          {{ genre.genre_name }}
        </option>
      </select>

      <button type="submit" class="submit-button">Update Book</button>
      <div v-if="error" class="error">{{ error }}</div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      book: {
        id: null,
        title: '',
        isbn: '',
        description: '',
        author_id: null,
        genre_id: null
      },
      authors: [],
      genres: [],
      error: null,
      isLoading: false
    };
  },
  methods: {
    async fetchBookDetails(bookId) {
      this.isLoading = true;
      try {
        const response = await axios.get(`https://nessimelmazghari-odisee.be/getBook.php?id=${bookId}`);
        if (response.data.error) {
          this.error = 'Book not found';
        } else {
          this.book = response.data;
        }
      } catch (error) {
        this.error = 'Error fetching book details';
        console.error('Error fetching book details:', error);
      } finally {
        this.isLoading = false;
      }
    },
    async fetchAuthors() {
      this.isLoading = true;
      try {
        const response = await axios.get('https://nessimelmazghari-odisee.be/getAuthors.php');
        this.authors = response.data;
      } catch (error) {
        this.error = 'Error fetching authors';
        console.error('Error fetching authors:', error);
      } finally {
        this.isLoading = false;
      }
    },
    async fetchGenres() {
      this.isLoading = true;
      try {
        const response = await axios.get('https://nessimelmazghari-odisee.be/getGenres.php');
        this.genres = response.data;
      } catch (error) {
        this.error = 'Error fetching genres';
        console.error('Error fetching genres:', error);
      } finally {
        this.isLoading = false;
      }
    },
    async updateBook() {
      try {
        const bookDataToUpdate = {
          id: this.book.id,
          title: this.book.title,
          isbn: this.book.isbn,
          description: this.book.description,
          author_id: this.book.author_id,
          genre_id: this.book.genre_id
        };

        const response = await axios.put('https://nessimelmazghari-odisee.be/updateBook.php', bookDataToUpdate, {
          headers: {
            'Content-Type': 'application/json'
          }
        });

        console.log('Response from server:', JSON.stringify(response.data, null, 4));
        this.$router.push('/books').then(() => {
          window.location.reload();
        });
      } catch (error) {
        this.error = 'Error updating book';
        console.error('Error updating book:', error);
      }
    },
  },
  mounted() {
    const bookId = this.$route.params.id;
    this.fetchBookDetails(bookId);
    this.fetchAuthors();
    this.fetchGenres();
  }
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
