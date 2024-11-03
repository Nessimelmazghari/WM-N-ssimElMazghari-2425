import { createRouter, createWebHistory } from '@ionic/vue-router';
import AuthorsList from '@/views/AuthorsList.vue';
import BooksList from '@/views/BooksList.vue';
import GenresList from '@/views/GenresList.vue';
import About from '@/views/About.vue';
import BewerkBoek from '@/views/BewerkBoek.vue';
import AddBook from '@/views/AddBook.vue';
import AddAuthor from '@/views/AddAuthor.vue';
import AddGenre from '@/views/AddGenre.vue';
import BewerkAuthor from '@/views/BewerkAuthor.vue';
import BewerkGenre from '@/views/BewerkGenre.vue';
import HP from '@/views/HP.vue';

const routes = [
  { path: '/', redirect: '/HP' },
  { path: '/authors', component: AuthorsList, name: 'AuthorsList' },
  { path: '/books', component: BooksList, name: 'BooksList' },
  { path: '/genres', component: GenresList, name: 'GenresList' },
  { path: '/about', component: About, name: 'About' },
  { path: '/bewerkboek/:id', component: BewerkBoek, name: 'BewerkBoek' },
  { path: '/addbook', component: AddBook, name: 'AddBook' },
  { path: '/addauthor', component: AddAuthor, name: 'AddAuthor' },
  { path: '/addgenre', component: AddGenre, name: 'AddGenre' },
  { path: '/bewerkauthor/:id', component: BewerkAuthor, name: 'BewerkAuthor' },
  { path: '/bewerkgenre/:id', component: BewerkGenre, name: 'BewerkGenre' },
  { path: '/hp', component: HP, name: 'HP' }
];

const router = createRouter({
  history: createWebHistory(import.meta.env.VITE_BASE_URL),
  routes,
});

export default router;
