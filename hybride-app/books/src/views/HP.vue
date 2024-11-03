<template>
  <ion-header>
    <ion-toolbar>
      <ion-title>Homepage</ion-title>
    </ion-toolbar>
  </ion-header>
  <ion-content>
    <div class="button-container">
      <ion-button @click="goToAuthors" class="custom-button">Bekijk Auteurs</ion-button>
      <ion-button @click="goToBooks" class="custom-button">Bekijk Boeken</ion-button>
      <ion-button @click="goToGenres" class="custom-button">Bekijk Genres</ion-button>
      <ion-button @click="goToAbout" class="custom-button">Over de App</ion-button>
    </div>
  </ion-content>
</template>

<script>
export default {
name: 'HomePage',
methods: {
  goToAuthors() {
    this.$router.push({ name: 'AuthorsList' }).then(() => {
      window.location.reload();
    });
  },
  goToBooks() {
    this.$router.push({ name: 'BooksList' }).then(() => {
      window.location.reload();
    });
  },
  goToGenres() {
    this.$router.push({ name: 'GenresList' }).then(() => {
      window.location.reload();
    });
  },
  goToAbout() {
    this.$router.push({ name: 'About' }).then(() => {
      window.location.reload();
    });
  }
},
};
</script>

<style scoped>
/* Homepage styles */
ion-content {
  padding: 10px; /* Add padding for better spacing */
}

.button-container {
  display: flex;
  flex-wrap: wrap; /* Allows buttons to wrap onto the next line if needed */
  justify-content: space-between; /* Distributes buttons evenly */
}

.custom-button {
  --background: #FF4081; /* Flashy color for buttons (pink) */
  --color: white; /* Text color */
  --border-radius: 12px; /* Rounded corners */
  margin: 15px; /* Space between buttons */
  padding: 16px 20px; /* Padding for larger buttons */
  font-size: 18px; /* Font size */
  flex: 0 1 calc(33.33% - 30px); /* Makes buttons take up 1/3 of the row, adjusting for margins */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Add a more pronounced shadow */
  transition: transform 0.2s; /* Add a transition effect */
}

/* Add a hover effect */
.custom-button:hover {
  transform: scale(1.05); /* Slightly increase size on hover */
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .custom-button {
      font-size: 16px; /* Adjust font size on smaller screens */
      padding: 14px 16px; /* Adjust padding for smaller screens */
      flex: 0 1 calc(50% - 30px); /* Two buttons per row on smaller screens */
  }
}

@media (max-width: 480px) {
  .custom-button {
      flex: 0 1 100%; /* One button per row on very small screens */
  }
}
</style>
