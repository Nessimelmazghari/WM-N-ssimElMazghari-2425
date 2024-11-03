<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Genres</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content>
      <ion-button expand="full" @click="openHP" class="custom-button">HOME</ion-button>
      <div class="scroll-container">
        <ion-list>
          <ion-item v-for="genre in genres" :key="genre.id">
            <ion-label>{{ genre.genre_name }}</ion-label>
            <ion-button @click="editGenre(genre)" class="custom-button">Bewerk</ion-button>
            <ion-button color="danger" @click="deleteGenre(genre.id)" class="custom-button">Verwijder</ion-button>
          </ion-item>
        </ion-list>
      </div>
      <ion-button expand="full" @click="openAddGenre" class="custom-button">Voeg Genre Toe</ion-button>
    </ion-content>
  </ion-page>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      genres: [],
      newGenre: { genre_name: '' },
    };
  },
  methods: {
    async fetchGenres() {
      try {
        const response = await axios.get('https://nessimelmazghari-odisee.be/getGenres.php');
        this.genres = response.data;
      } catch (error) {
        console.error('Er is een fout opgetreden bij het ophalen van genres:', error);
      }
    },
    async deleteGenre(id) {
      try {
        await axios.delete('https://nessimelmazghari-odisee.be/deleteGenre.php', {
          data: { id },
          headers: {
            'Content-Type': 'application/json',
          },
        });
        this.fetchGenres();
      } catch (error) {
        console.error('Er is een fout opgetreden bij het verwijderen van het genre:', error);
      }
    },
    editGenre(genre) {
      this.$router.push({ name: 'BewerkGenre', params: { id: genre.id } }).then(() => {
        window.location.reload();
      });
    },
    openAddGenre() {
      this.$router.push({ name: 'AddGenre' }).then(() => {
        window.location.reload();
      });
    },
    openHP() {
      this.$router.push({ name: 'HP' }).then(() => {
        window.location.reload();
      });
    },
  },
  mounted() {
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
