<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Auteurs</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content>
      <ion-button expand="full" @click="openHP" class="custom-button">HOME</ion-button>
      <div class="scroll-container">
        <ion-list>
          <ion-item v-for="author in authors" :key="author.id">
            <ion-label>
              <h2>{{ author.first_name }} {{ author.last_name }}</h2>
              <p>Geboortejaar: {{ author.birth_year }}</p>
            </ion-label>
            <ion-button @click="editAuthor(author)" class="custom-button">Bewerk</ion-button>
            <ion-button color="danger" @click="deleteAuthor(author.id)" class="custom-button">Verwijder</ion-button>
          </ion-item>
        </ion-list>
      </div>
      <ion-button expand="full" @click="openAddAuthor" class="custom-button">Voeg Auteur Toe</ion-button>
    </ion-content>
  </ion-page>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      authors: [],
      newAuthor: { first_name: '', last_name: '', birth_year: '' },
    };
  },
  methods: {
    async fetchAuthors() {
      try {
        const response = await axios.get('https://nessimelmazghari-odisee.be/getAuthors.php');
        this.authors = response.data;
      } catch (error) {
        console.error('Er is een fout opgetreden bij het ophalen van auteurs:', error);
      }
    },
    async addAuthor() {
      try {
        await axios.post('https://nessimelmazghari-odisee.be/createAuthor.php', this.newAuthor, {
          headers: {
            'Content-Type': 'application/json',
          },
        });
        this.fetchAuthors();
      } catch (error) {
        console.error('Er is een fout opgetreden bij het toevoegen van de auteur:', error);
      }
    },
    editAuthor(author) {
      this.$router.push({ name: 'BewerkAuthor', params: { id: author.id } }).then(() => {
        window.location.reload();});
    },
    async deleteAuthor(id) {
      try {
        await axios.delete('https://nessimelmazghari-odisee.be/deleteAuthor.php', {
          data: { id },
          headers: {
            'Content-Type': 'application/json',
          },
        });
        this.fetchAuthors();
      } catch (error) {
        console.error('Er is een fout opgetreden bij het verwijderen van de auteur:', error);
      }
    },
    openAddAuthor() {
      this.$router.push({ name: 'AddAuthor' }).then(() => {
        window.location.reload();});
    },
    openHP() {
      this.$router.push({ name: 'HP' }).then(() => {
        window.location.reload();});
    },
  },
  mounted() {
    this.fetchAuthors();
  },
};
</script>

<style scoped>
.scroll-container {
  max-height: 80vh;
  overflow-y: auto;
}

ion-content {
  --overflow: hidden;
}

.custom-button {
  --background: var(--ion-color-primary);
  --color: white;
  --border-radius: 8px;
  margin: 4px;
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
