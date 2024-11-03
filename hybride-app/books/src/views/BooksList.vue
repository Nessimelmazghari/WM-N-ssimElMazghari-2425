<template>
    <ion-page>
      <ion-header>
        <ion-toolbar>
          <ion-title>Boeken</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-content>
        <ion-button expand="full" @click="openHP" class="custom-button">HOME</ion-button>
        <div class="scroll-container">
          <ion-list>
            <ion-item v-for="book in books" :key="book.id">
              <ion-label>
                <h2>{{ book.title }}</h2>
                <p>Auteur: {{ book.first_name }} {{ book.last_name }} | Genre: {{ book.genre_name }}</p>
              </ion-label>
              <ion-button @click="editBook(book)" class="custom-button">Bewerk</ion-button>
              <ion-button color="danger" @click="deleteBook(book.id)" class="custom-button">Verwijder</ion-button>
            </ion-item>
          </ion-list>
        </div>
        <ion-button expand="full" @click="openAddBook" class="custom-button">Voeg Boek Toe</ion-button>
      </ion-content>
    </ion-page>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        books: [],
        newBook: { title: '', isbn: '', description: '', author_id: '', genre_id: '' },
        authors: [],
        genres: [],
      };
    },
    methods: {
      async fetchBooks() {
        try {
          const response = await axios.get('https://nessimelmazghari-odisee.be/getBooks.php');
          this.books = response.data;
        } catch (error) {
          console.error('Er is een fout opgetreden bij het ophalen van boeken:', error);
        }
      },
      async fetchAuthors() {
        try {
          const response = await axios.get('https://nessimelmazghari-odisee.be/getAuthors.php');
          this.authors = response.data;
        } catch (error) {
          console.error('Er is een fout opgetreden bij het ophalen van auteurs:', error);
        }
      },
      async fetchGenres() {
        try {
          const response = await axios.get('https://nessimelmazghari-odisee.be/getGenres.php');
          this.genres = response.data;
        } catch (error) {
          console.error('Er is een fout opgetreden bij het ophalen van genres:', error);
        }
      },
      async addBook() {
        try {
          await axios.post('https://nessimelmazghari-odisee.be/createBook.php', this.newBook, {
            headers: {
              'Content-Type': 'application/json',
            },
          });
          this.fetchBooks();
        } catch (error) {
          console.error('Er is een fout opgetreden bij het toevoegen van het boek:', error);
        }
      },
      editBook(book) {
        this.$router.push({ name: 'BewerkBoek', params: { id: book.id } }).then(() => {
          window.location.reload();});
      },
      async deleteBook(id) {
        try {
          await axios.delete('https://nessimelmazghari-odisee.be/deleteBook.php', {
            data: { id },
            headers: {
              'Content-Type': 'application/json',
            },
          });
          this.fetchBooks();
        } catch (error) {
          console.error('Er is een fout opgetreden bij het verwijderen van het boek:', error);
        }
      },
      openAddBook() {
        this.$router.push({ name: 'AddBook'}).then(() => {
          window.location.reload();})
      },
      openHP() {
        this.$router.push({ name: 'HP' }).then(() => {
          window.location.reload();})}},
    mounted() {
      this.fetchBooks();
      this.fetchAuthors();
      this.fetchGenres();
    },
  };
  </script>
  
  <style scoped>
  .scroll-container {
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
  }
  
  ion-content {
    --overflow: hidden;
  }
  
  .custom-button {
    --background: var(--ion-color-primary);
    --color: white;
    --border-radius: 8px;
    margin: 4px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  }
  
  .scroll-container::-webkit-scrollbar {
    width: 8px;
  }
  
  .scroll-container::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 10px;
  }
  
  .scroll-container::-webkit-scrollbar-thumb:hover {
    background-color: #555;
  }
  </style>
  